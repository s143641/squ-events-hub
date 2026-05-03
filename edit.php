<?php
// ================= DATABASE CONNECTION =================
include "db.php";

// ================= GET ID =================
$id = $_GET['id'];

// ================= FETCH DATA =================
$sql = "SELECT * FROM events WHERE id=$id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Event</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">
<h3>Edit Event</h3>

<!-- FORM  -->
<form action="update.php" method="POST">

<!-- hidden id -->
<input type="hidden" name="id" value="<?php echo $row['id']; ?>">

<label>Event Name</label>
<input type="text" name="name" class="form-control mb-3" value="<?php echo $row['name']; ?>">

<label>Date</label>
<input type="text" name="date" class="form-control mb-3" value="<?php echo $row['date']; ?>">

<label>Location</label>
<input type="text" name="location" class="form-control mb-3" value="<?php echo $row['location']; ?>">

<label>Category</label>
<input type="text" name="category" class="form-control mb-3" value="<?php echo $row['category']; ?>">

<button class="btn btn-primary">Update</button>

</form>

</div>

</body>
</html>