<?php
class Reservation {
  // (A) CONSTRUCTOR - CONNECT TO DATABASE
  private $pdo; // PDO object
  private $stmt; // SQL statement
  public $error; // Error message
  function __construct() {
    try {
      $this->pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET,
        DB_USER, DB_PASSWORD, [
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
          PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_NAMED
        ]
      );
    } catch (Exception $ex) { exit($ex->getMessage()); }
  }

  // (B) DESTRUCTOR - CLOSE DATABASE CONNECTION
  function __destruct() {
    $this->pdo = null;
    $this->stmt = null;
  }

  // (C) SAVE RESERVATION
  function save ($date, $slot, $name, $room, $tel, $notes="") {
    // (C1) CHECKS & RESTRICTIONS
    // @TODO - ADD YOUR OWN RULES & REGULATIONS HERE
    // MAX # OF RESERVATIONS ALLOWED?
    // USER CAN ONLY BOOK X DAYS IN ADVANCE?
    // USER CAN ONLY BOOK A MAX OF X SLOTS WITHIN Y DAYS?

    // (C2) DATABASE ENTRY
    try {
      $this->stmt = $this->pdo->prepare(
        "INSERT INTO `reservations` (`res_date`, `res_slot`, `res_name`, `res_room`, `res_tel`, `res_notes`) VALUES (?,?,?,?,?,?)"
      );
      $this->stmt->execute([$date, $slot, $name, $room, $tel, $notes]);
    } catch (Exception $ex) {
      $this->error = $ex->getMessage();
      return false;
    }

    // (C3) EMAIL
    // @TODO - REMOVE IF YOU WANT TO MANUALLY CALL TO CONFIRM OR SOMETHING
    // OR EMAIL THIS TO A TEACHER OR SOMETHING
    $subject = "Reservering ontvangen";
    $message = "Bedankt, we hebben uw aanvraag ontvangen en zullen deze binnenkort verwerken.";
    @mail($email, $subject, $message);
    return true;
  }

  // (D) GET RESERVATIONS FOR THE DAY
  function getDay ($day="") {
    // (D1) DEFAULT TO TODAY
    if ($day=="") { $day = date("Y-m-d"); }

    // (D2) GET ENTRIES
    $this->stmt = $this->pdo->prepare(
      "SELECT * FROM `reservations` WHERE `res_date`=?"
    );
    $this->stmt->execute([$day]);
    return $this->stmt->fetchAll();
  }
}
// (E) DATABASE CONNECTION
include "core/db/db_con.php";

// (F) NEW RESERVATION OBJECT
$_RSV = new Reservation();
