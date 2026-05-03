<?php
// Include database connection
include "db.php";

// GET DATA FROM FORM
// $_POST is used to receive data from form

$name = $_POST['name'];
$date = $_POST['date'];
$location = $_POST['location'];
$category = $_POST['category'];

// INSERT QUERY 
// Insert data into events table

$sql = "INSERT INTO events (name, date, location, category)
VALUES ('$name','$date','$location','$category')";

// Execute query
mysqli_query($conn, $sql);

//  REDIRECT 
// After inserting, go back to events page

header("Location: events.php");
?>