<?php
include "db.php";

// get id
$id = $_GET['id'];

// get current data
$result = mysqli_query($conn, "SELECT * FROM registration WHERE id=$id");
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

<h3>Edit Registration</h3>

<form action="update_register.php" method="POST">

<!-- hidden id -->
<input type="hidden" name="id" value="<?php echo $row['id']; ?>">

<input type="text" name="name" class="form-control mb-2" value="<?php echo $row['name']; ?>">
<input type="text" name="email" class="form-control mb-2" value="<?php echo $row['email']; ?>">
<input type="text" name="student_id" class="form-control mb-2" value="<?php echo $row['student_id']; ?>">

<input type="text" name="event" class="form-control mb-2" value="<?php echo $row['event']; ?>">
<textarea name="notes" class="form-control mb-2"><?php echo $row['notes']; ?></textarea>

<button class="btn btn-success">Update</button>

</form>

</div>

</body>
</html>