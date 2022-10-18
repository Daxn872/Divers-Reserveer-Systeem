<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Verbinding met de database is mislukt: " . $conn->connect_error);
}
echo "Verbinding met de database is gelukt";
?>