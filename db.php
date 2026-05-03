<?php
//DATABASE CONNECTION

// Database credentials
$servername = "localhost";   // server name
$username = "root";          // default username in XAMPP
$password = "";              // default password (empty)
$dbname = "eventsDB";        // database name

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if(!$conn){
  die("Connection failed: " . mysqli_connect_error());
}
?>