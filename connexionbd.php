<?php
$servername = "localhost";
$username = "root";
$password = "";
$bdname = "pfa1";

// Create connection
$conn = new mysqli($servername, $username, $password,$bdname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>