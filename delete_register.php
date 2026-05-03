<?php
// Include database
include "db.php";


// Get id from URL
$id = $_GET['id'];

// DELETE QUERY 
$sql = "DELETE FROM registration WHERE id=$id";

// Execute query
mysqli_query($conn, $sql);

// REDIRECT back
header("Location: register.php");
?>