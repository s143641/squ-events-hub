<?php
include "db.php";

// get data
$id = $_POST['id'];
$name = $_POST['name'];
$email=$_POST['email'];
$student_id = $_POST['student_id'];
$event = $_POST['event'];
$notes = $_POST['notes'];

// update query
$sql = "UPDATE registration SET
name='$name',
email='$email',
student_id='$student_id',
event='$event',
notes='$notes'
WHERE id=$id";

// execute
mysqli_query($conn, $sql);

// redirect
header("Location: register.php");
?>