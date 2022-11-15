<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbName = "divers-reserveer-systeem";

try {
  $dsn = "mysql:host=$servername;dbname=$dbName";
  // set the PDO error mode to exception
  $pdo = new PDO($dsn, $username, $password);
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>