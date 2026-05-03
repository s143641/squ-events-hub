<?php
//DATABASE CONNECTION
include "db.php";

//GET DATA
if(isset($_GET['search'])){
  $search = $_GET['search'];
  $sql = "SELECT * FROM events WHERE name LIKE '%$search%'";
}else{
  $sql = "SELECT * FROM events";
}

$result = mysqli_query($conn, $sql);
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

<!--NAVBAR -->
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
        <li class="nav-item"><a class="nav-link text-warning active" href="events.php">Events</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="register.php">Register</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="contact.html">Contact</a></li>

        <li class="nav-item"><a class="nav-link text-white" href="questionnaire.html">Feedback</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="calculator.html">Calculator</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="funpage.php">Fun</a></li>
      </ul>
    </div>

  </div>
</nav>

<!-- PAGE TITLE -->
<div class="container text-center py-4 ">
  <h2>Events</h2>
  <p class="text-secondary">Explore university activities</p>
</div>

<!-- SEARCH-->
<div class="container text-center mb-4">
  <form method="GET">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <input type="text" name="search" class="form-control" placeholder="Search event...">
      </div>
    </div>

    <button class="btn btn-secondary mt-2">Search</button>
  </form>

  <hr/>
  <br/>
</div>

<!-- TABLE -->
<div class="container">
<table class="table table-bordered text-center">

<tr class="table-dark">
<th>Event</th>
<th>Date</th>
<th>Location</th>
<th>Category</th>
<th>Action</th>
</tr>

<?php

while($row = mysqli_fetch_assoc($result)){
  echo "<tr>";
  echo "<td>".$row['name']."</td>";
  echo "<td>".$row['date']."</td>";
  echo "<td>".$row['location']."</td>";
  echo "<td>".$row['category']."</td>";
  echo "<td>";
  echo "<a href='edit.php?id=".$row['id']."' class='btn btn-primary btn-sm me-1'>Edit</a>";
  echo "<a href='delete.php?id=".$row['id']."' class='btn btn-danger btn-sm'>Delete</a>";
  echo "</td>";
  echo "</tr>";
}
?>

</table>

<hr/>
<br/>
</div>

<!--ADD EVENT-->
<div class="container mb-4 text-center">
    <h3 class="mb-0 text-center ">Add A New Event</h3>
    <h6 class="text-center text-secondary mb-3">Write the Event's Information Below</h6>

    <div class="row justify-content-center">
        <div class="col-md-4">

<form action="add_event.php" method="POST" onsubmit="return validateEvent()">

  <!-- Event Name -->
<input type="text" id="name" name="name" class="form-control mb-1" placeholder="Event Name">
<div id="nameError" class="text-danger mb-2"></div>

<!-- Date -->
<input type="date" id="date" name="date" class="form-control mb-1">
<div id="dateError" class="text-danger mb-2"></div>

<!-- Location -->
<input type="text" id="location" name="location" class="form-control mb-1" placeholder="Location">
<div id="locationError" class="text-danger mb-2"></div>

<!-- Category -->
<input type="text" id="category" name="category" class="form-control mb-1" placeholder="Category">
<div id="categoryError" class="text-danger mb-2"></div>
  
<!--confirmation checkbox-->
<div class="form-check mb-3">
  <input class="form-check-input" type="checkbox" id="confirm">
  <label class="form-check-label mb-3">
    I confirm that the event details are correct.
  </label>

<!-- Error message-->
 <div id="confirmError" class="text-danger"></div>
</div>


  <button class="btn btn-secondary" type="submit">Add Event</button>

</form>

</div>
</div>
</div>

<!-- FOOTER -->
<footer class="bg-dark text-white text-center p-3">
    <p class="mb-0">&copy; 2026 SQU Events Hub</p>
</footer>
<script>

function validateEvent(){

  let valid = true;

  // get values
  let name = document.getElementById("name");
  let date = document.getElementById("date");
  let location = document.getElementById("location");
  let category = document.getElementById("category");

  // clear old errors
  document.getElementById("nameError").innerHTML = "";
  document.getElementById("dateError").innerHTML = "";
  document.getElementById("locationError").innerHTML = "";
  document.getElementById("categoryError").innerHTML = "";

  name.style.border="";
  date.style.border="";
  location.style.border="";
  category.style.border="";

  //  NAME
  let namePattern = /^[A-Za-z\s]+$/;

  if(name.value === "" || name.value.length < 3 || !name.value.match(namePattern)){
    document.getElementById("nameError").innerHTML = "Name must be letters only (min 3)";
    name.style.border="2px solid red";
    valid = false;
  }

  // DATE 
  if(date.value === ""){
    document.getElementById("dateError").innerHTML = "Please select a date";
    date.style.border="2px solid red";
    valid = false;
  }

  // LOCATION
  let locationPattern = /^[A-Za-z0-9\s]+$/;

  if(location.value === "" || !location.value.match(locationPattern)){
    document.getElementById("locationError").innerHTML = "Location can be letters and numbers";
    location.style.border="2px solid red";
    valid = false;
  }

  //  CATEGORY 
  let categoryPattern = /^[A-Za-z\s]+$/;

  if(category.value === "" || !category.value.match(categoryPattern)){
    document.getElementById("categoryError").innerHTML = "Category must be letters only";
    category.style.border="2px solid red";
    valid = false;
  }

  //CONFIRM 
  let confirm=document.getElementById("confirm");
  document.getElementById("confirmError").innerHTML="";

  if(confirm.checked===false){
    document.getElementById("confirmError").innerHTML="You Must Confirm The Event Details!";
    valid=false;
  }

  return valid;
}


// LIVE VALIDATION 

// name
document.getElementById("name").oninput = function(){
  let pattern = /^[A-Za-z\s]+$/;
  if(this.value.length >= 3 && this.value.match(pattern)){
    this.style.border="";
    document.getElementById("nameError").innerHTML="";
  }
}

// location
document.getElementById("location").oninput = function(){
  let pattern = /^[A-Za-z\s]+$/;
  if(this.value.match(pattern)){
    this.style.border="";
    document.getElementById("locationError").innerHTML="";
  }
}

// category
document.getElementById("category").oninput = function(){
  let pattern = /^[A-Za-z\s]+$/;
  if(this.value.match(pattern)){
    this.style.border="";
    document.getElementById("categoryError").innerHTML="";
  }
}

// date
document.getElementById("date").onchange = function(){
  if(this.value !== ""){
    this.style.border="";
    document.getElementById("dateError").innerHTML="";
  }
}

</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>