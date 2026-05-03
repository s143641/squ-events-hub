<?php
include "db.php";

$name = $_POST['name'];
$student_id = $_POST['student_id'];
$event = $_POST['event'];
$notes = $_POST['notes'];

$sql = "INSERT INTO registration (name, student_id, event, notes)
VALUES ('$name','$student_id','$event','$notes')";

mysqli_query($conn, $sql);

header("Location: register.php");
?>