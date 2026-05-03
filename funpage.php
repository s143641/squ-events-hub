<?php
include "db.php";
$result = mysqli_query($conn,"SELECT player_name, MAX(score) as score, MIN(wrong_answers) as wrong_answers,MAX(attempt_date) as attempt_date FROM quiz_results GROUP BY player_name");

//class
class Result{
  public $name;
  public $score;
  public $wrong;
  public $date;
}

//array
$resultsArr=[];
while ($row=mysqli_fetch_assoc($result)){
  $r=new Result();
  $r->name=$row['player_name'];
  $r->score=$row['score'];
  $r->wrong=$row['wrong_answers'];
  $r->date=$row['attempt_date'];

  $resultsArr[]=$r;
}

//function
function displayResults($results){
  $i=0;
  while($i<count($results)){
    echo "<tr>";
    echo "<td>".$results[$i]->name."</td>";
    echo "<td>".$results[$i]->score."</td>";
    echo "<td>".$results[$i]->wrong."</td>";
    echo "<td>".$results[$i]->date."</td>";
    echo "</tr>";

    $i++;
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Fun Page</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex flex-column min-vh-100">

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
        <li class="nav-item"><a class="nav-link text-white" href="events.php">Events</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="register.php">Register</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="contact.html">Contact</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="questionnaire.html">Feedback</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="calculator.html">Calculator</a></li>
        <li class="nav-item"><a class="nav-link text-warning active" href="funpage.php">Fun</a></li>
      </ul>
    </div>

  </div>
</nav>


<!-- GAME -->
<div class="container mt-5 mb-5" id="gameBox">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="bg-dark text-white p-4 rounded text-center">

        <h4 id="gameTitle">Start Quiz</h4>
        <div id="startBox">
            <input type="text" id="playerName" class="form-control mb-3" placeholder="Enter your name">
            <div id="nameError" class="text-danger mb-2"></div>
            <button class="btn btn-success w-100 mb-3" onclick="startGame()">Start</button>
        </div>
        <div id="quizBox" style="display:none;">
        <p id="questionBox"></p>

        <div id="optionsBox">
          <button class="btn btn-light m-2" onclick="checkAnswer(1)" id="btn1"></button>
          <button class="btn btn-light m-2" onclick="checkAnswer(2)" id="btn2"></button>
          <button class="btn btn-light m-2" onclick="checkAnswer(3)" id="btn3"></button>
        </div>

        <p id="resultText"></p>
        <button id="nextBtn" class="btn btn-warning" onclick="nextQuestion()">Next</button>
        </div>
        <hr>

        <div class="progress">
          <div id="progressBar" class="progress-bar bg-success" style="width:0%">0%</div>
        </div>

      </div>
    </div>
  </div>
</div>

<!-- RESULT TABLE -->
<div class="container mb-5">
  <h4 class="text-center mt-5">Results</h4>
  <table class="table table-bordered text-center">
    <tr>
      <th>Name</th>
      <th>Score</th>
      <th>Wrong</th>
      <th>Date</th>
    </tr>

<?php displayResults($resultsArr); ?>

  </table>
</div>

<!-- HIDDEN FORM -->
<form id="resultForm" action="save_result.php" method="POST">
  <input type="hidden" name="player_name" id="hiddenName">
  <input type="hidden" name="score" id="hiddenScore">
  <input type="hidden" name="wrong_answers" id="hiddenWrong">
  <input type="hidden" name="total_questions" value="5">
</form>

<!-- FOOTER  -->
<footer class="bg-dark text-white text-center p-3">
    <p class="mb-0">&copy; 2026 SQU Events Hub</p>
</footer>



<script>

// QUESTIONS 
let questions = [
"Which workshop helps you learn AI?",
"If you want web design skills, which event?",
"Which workshop improves cybersecurity skills?",
"Which event helps teamwork?",
"Which workshop improves programming?"
];

let option1 = ["AI Workshop","Web Workshop","Security Workshop","Team Building","Programming Workshop"];
let option2 = ["Cultural Festival","Art Show","Sports Day","Seminar","Music Event"];
let option3 = ["Sports Day","Food Festival","Cooking Class","Dance Show","Art Show"];

let correct = [1,1,1,1,1];

let index = 0;
let score = 0;
let answered = false;
let playerName = "";

// START GAME
function startGame(){

  let playerNameInput = document.getElementById("playerName");
  playerName=playerNameInput.value;

  // clear old error
  document.getElementById("nameError").innerHTML = "";
  playerNameInput.style.border = "";

  // validation
  if(playerName === "" || playerName.length < 3){
    document.getElementById("nameError").innerHTML = "Name must be at least 3 characters";
    playerNameInput.style.border = "2px solid red";
    return;
  }

  // hide start
  document.getElementById("startBox").style.display = "none";

  // show quiz
  document.getElementById("quizBox").style.display = "block";

  document.getElementById("gameTitle").innerHTML = "Good luck " + playerName;

  loadQuestion();
}

// LOAD QUESTION
function loadQuestion(){
  document.getElementById("questionBox").innerHTML = questions[index];
  document.getElementById("btn1").innerHTML = option1[index];
  document.getElementById("btn2").innerHTML = option2[index];
  document.getElementById("btn3").innerHTML = option3[index];
  document.getElementById("resultText").innerHTML = "";
  answered = false;
}

// CHECK ANSWER
function checkAnswer(choice){
  if(answered) return;

  answered = true;
  let correctAnswer = correct[index];

  if(choice === correctAnswer){
    score++;
    document.getElementById("resultText").innerHTML = "✅ Correct!";
  }else{
    let correctText = option1[index];
    document.getElementById("resultText").innerHTML =
    "❌ Wrong! Correct: " + correctText;
  }

  updateProgress();
}

// NEXT
function nextQuestion(){
  index++;

  if(index < questions.length){
    loadQuestion();
  }else{
    let wrong = questions.length - score;

    document.getElementById("questionBox").innerHTML =
    "Score: " + score + " / 5";

    document.getElementById("resultText").innerHTML =
    "Wrong answers: " + wrong;

    document.getElementById("optionsBox").innerHTML="";
    document.getElementById("nextBtn").innerHTML="Finish";
    document.getElementById("nextBtn").onclick=finishGame;

    // SAVE TO DB
    document.getElementById("hiddenName").value = playerName;
    document.getElementById("hiddenScore").value = score;
    document.getElementById("hiddenWrong").value = wrong;

    
  }
}

// PROGRESS
function updateProgress(){
  let percent = ((index + 1) / questions.length) * 100;
  document.getElementById("progressBar").style.width = percent + "%";
  document.getElementById("progressBar").innerHTML = Math.floor(percent) + "%";
}

//finish game
function finishGame(){
    let wrong=questions.length-score;
    document.getElementById("hiddenName").value=playerName;
    document.getElementById("hiddenScore").value=score;
    document.getElementById("hiddenWrong").value=wrong;
   
    document.getElementById("resultForm").submit();

}
document.getElementById("playerName").addEventListener("input", function(){
  let value = this.value;

  if(value.length >= 3){
    this.style.border = "";
    document.getElementById("nameError").innerHTML = "";
  }
});
</script>

</body>
</html>