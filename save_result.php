<?php
include "db.php";

$name = $_POST['player_name'];
$score = $_POST['score'];
$wrong = $_POST['wrong_answers'];
$total = $_POST['total_questions'];

$sql = "INSERT INTO quiz_results (player_name, score, total_questions, wrong_answers, attempt_date)
VALUES ('$name','$score','$total','$wrong',NOW())";

mysqli_query($conn,$sql);

header("Location: funpage.php");
?>