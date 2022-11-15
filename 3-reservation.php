<?php 
  include './core/db/db_con.php';

  $status = "";
  if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $room = $_POST['room'];
    $tel = $_POST['tel'];
    $notes = $_POST['notes'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    $sql = "INSERT INTO reservations (`res_name`, `res_room`, `res_tel`, `res_notes`, `res_date`, `res_time`) VALUES ('$name', '$room', '$tel', '$notes', '$date', '$time');";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(['name' => $name, 'room' => $room, 'tel' => $tel, 'notes' => $notes, 'date' => $date, 'time' => $time]);
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Divers-reserveer-systeem</title>
    <link href="3-theme.cs" rel="stylesheet">
  </head>
  <body>
    <!-- (B) RESERVATION FORM -->
    <h1>Reservering</h1>
    <form id="resForm" method="POST">
      <label for="res_name">Naam</label>
      <input type="text" required name="name" value=""/>

      <label for="res_room">lokaal</label>
      <select id="room" name="room">
      <option value="w001">w001</option>
      <option value="w002">w002</option>
      <option value="w003">w003</option>
      <option value="w004">w004</option>
      <option value="w005">w005</option>
      <option value="w006">w006</option>
      <option value="w007">w007</option>
      <option value="w008">w008</option>
      </select>




      <label for="res_tel">School nummer</label>
      <input type="text" required name="tel" value=""/>

      <label for="res_notes">Notitie (optioneel)</label>
      <input type="text" name="notes" value=""/>

      <?php
      // @TODO - MINIMUM DATE (TODAY)
      // $mindate = date("Y-m-d", strtotime("+2 days"));
      $mindate = date("Y-m-d");
      ?>
      <label>Welke dag wil je reserveren?</label>
      <input type="date" required id="res_date" name="date"
             min="<?=$mindate?>">


      <label for="time">Kies je tijd van de reservering.</label>
      <input type="time" id="time" name="time" min="09:00" max="17:00" required>
      <small>Lokalen kun je reserveren van 09:00 tot 17:00 uur.</small>

      </select>

      <input type="submit" value="Submit"/>
    </form>
  </body>
</html>
