<?php
// Include database connection
include "db.php";

// GET EVENT ID
// The id is passed in the URL

$id = $_GET['id'];

// DELETE QUERY
// Delete the event using its ID

$sql = "DELETE FROM events WHERE id=$id";

// Execute query
mysqli_query($conn, $sql);

// REDIRECT
// Return to events page

header("Location: events.php");
?>