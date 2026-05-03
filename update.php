<?php
include "db.php";

//  GET DATA 
$id = $_POST['id'];
$name = $_POST['name'];
$date = $_POST['date'];
$location = $_POST['location'];
$category = $_POST['category'];

// UPDATE 
$sql = "UPDATE events SET 
name='$name',
date='$date',
location='$location',
category='$category'
WHERE id=$id";

mysqli_query($conn, $sql);

// REDIRECT
header("Location: events.php");
?>