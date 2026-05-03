<?php
include "db.php";

if(isset($_POST['submit'])){
  $name = $_POST['name'];
  $email = $_POST['email'];
  $student_id = $_POST['student_id'];
  $event = $_POST['event'];
  $notes = $_POST['notes'];

  $sql = "INSERT INTO registration (name,email,student_id,event,notes)
          VALUES ('$name','$email','$student_id','$event','$notes')";

  mysqli_query($conn,$sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Events - SQU Events Hub</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<nav class="navbar navbar-expand-lg bg-black navbar-dark">
  <div class="container">
    <div class="d-flex align-items-center text-white">
      <img src="images/logo.png" width="50" class="me-2">
      <div>
        <h4 class="mb-0">SQU Events Hub</h4>
        <h6 class="text-white">Inspiring Campus Life</h6>
      </div>
    </div>

    <button class="navbar-toggler bg-light" data-bs-toggle="collapse" data-bs-target="#nav"></button>

    <div class="collapse navbar-collapse justify-content-end" id="nav">
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link text-white" href="index.html">Home</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="about.html">About</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="events.php">Events</a></li>
        <li class="nav-item"><a class="nav-link text-warning active" href="register.php">Register</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="contact.html">Contact</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="questionnaire.html">Feedback</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="calculator.html">Calculator</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="funpage.php">Fun</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container text-center py-4">
  <h2>Event Registration</h2>
</div>

<div class="container mb-5">
  <div class="row justify-content-center">
    <div class="col-md-6">

<form method="POST" action="insert_register.php" onsubmit="return validateForm()" novalidate>

<input type="text" id="name" name="name" class="form-control mb-1" placeholder="Full Name" oninput="liveName()">
<div id="nameError" class="text-danger mb-2"></div>

<input type="email" id="email" name="email" class="form-control mb-1" placeholder="Email" oninput="liveEmail()">
<div id="emailError" class="text-danger mb-2"></div>

<input type="text" id="student_id" name="student_id" class="form-control mb-1" placeholder="Student ID" oninput="liveID()">
<div id="idError" class="text-danger mb-2"></div>

<select id="event" name="event" class="form-select mb-1" onchange="liveEvent()">
  <option value="">Select Event</option>

  <?php
  $result = mysqli_query($conn, "SELECT name FROM events");
  while($row = mysqli_fetch_assoc($result)){
    echo "<option>".$row['name']."</option>";
  }
  ?>
</select>
<div id="eventError" class="text-danger mb-2"></div>

<textarea name="notes" class="form-control mb-3" placeholder="Additional Notes"></textarea>

<button name="submit" class="btn btn-dark w-100">Submit Registration</button>

</form>

    </div>
  </div>
</div>

<div class="container mb-5">
  <h3 class="text-center mb-3">Registered Participants</h3>

  <table class="table table-bordered text-center">

    <tr class="table-dark">
      <th>Name</th>
      <th>Student ID</th>
      <th>Event</th>
      <th>Notes</th>
      <th>Actions</th>
    </tr>

    <?php
    $result = mysqli_query($conn, "SELECT * FROM registration");

    while($row = mysqli_fetch_assoc($result)){
      echo "<tr>";
      echo "<td>".$row['name']."</td>";
      echo "<td>".$row['student_id']."</td>";
      echo "<td>".$row['event']."</td>";
      echo "<td>".$row['notes']."</td>";
      echo "<td>
        <a href='edit_register.php?id=".$row['id']."' class='btn btn-primary btn-sm'>Edit</a>
        <a href='delete_register.php?id=".$row['id']."' class='btn btn-danger btn-sm'>Delete</a>
      </td>";
      echo "</tr>";
    }
    ?>

  </table>
</div>

<footer class="bg-dark text-white text-center p-3">
  <p class="mb-0">&copy; 2026 SQU Events Hub</p>
</footer>

<script>
function validateForm(){
  let valid = true;

  let name = document.getElementById("name");
  let email = document.getElementById("email");
  let id = document.getElementById("student_id");
  let event = document.getElementById("event");

  document.getElementById("nameError").innerHTML="";
  document.getElementById("emailError").innerHTML="";
  document.getElementById("idError").innerHTML="";
  document.getElementById("eventError").innerHTML="";

  if(name.value === "" || name.value.length < 3){
    document.getElementById("nameError").innerHTML = "Name must be at least 3 characters";
    name.style.border="2px solid red";
    valid = false;
  }else {
    name.style.border = "";
  }

  let emailPattern=/^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
  if(!email.value.match(emailPattern)){
    document.getElementById("emailError").innerHTML = "Enter a valid email";
    email.style.border="2px solid red";
    valid = false;
  }else {
    email.style.border = "";
  }

  let idPattern=/^[0-9]{6}$/;
  if(!id.value.match(idPattern)){
    document.getElementById("idError").innerHTML = "Student ID must be 6 digits";
    id.style.border="2px solid red";
    valid = false;
  } else {
    id.style.border = "";
  }

  if(event.value === ""){
    document.getElementById("eventError").innerHTML = "Please select an event!";
    event.style.border = "2px solid red";
    valid = false;
  } else {
    event.style.border = "";
  }

  return valid;
}

//LIVE VALIDATION
function liveName(){
  let name = document.getElementById("name");
  if(name.value.length >= 3){
    name.style.border = "";
    document.getElementById("nameError").innerHTML = "";
  }
}

function liveEmail(){
  let email = document.getElementById("email");
  let pattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;

  if(email.value.match(pattern)){
    email.style.border = "";
    document.getElementById("emailError").innerHTML = "";
  }
}

function liveID(){
  let id = document.getElementById("student_id");
  let pattern = /^[0-9]{6}$/;

  if(id.value.match(pattern)){
    id.style.border = "";
    document.getElementById("idError").innerHTML = "";
  }
}

function liveEvent(){
  let event = document.getElementById("event");

  if(event.value !== ""){
    event.style.border = "";
    document.getElementById("eventError").innerHTML = "";
  }
}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>