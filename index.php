<?php
$login = 0;
$invalid = 0;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  include 'message.php';
  $email = $_POST['email'];
  $password = $_POST['psw'];

  $sql = "SELECT id, email FROM `registration1` WHERE email='$email' AND password='$password'";
  $result = mysqli_query($cons, $sql);
  if ($result) {
    $num = mysqli_num_rows($result);
    if ($num > 0) {
      session_start();
      $row = mysqli_fetch_assoc($result);
      $_SESSION['user_id'] = $row['id'];
      $_SESSION['email'] = $row['email'];
      header('location: home.php');
    } else {
      $invalid = 1;
      echo '<script>alert("Invalid Credentials");</script>';
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-9R52XVPESL"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-9R52XVPESL');

  document.getElementById('generatebtn').addEventListener('click', function() {
  gtag('event', 'click', {
    'event_category': 'Button',
    'event_label': 'Click me',
  });
});
</script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="author" content="Vishal Kumar Jangid, Vishal Suthar">
    <meta name="description" content="Website for password generator and manager">
    <title>PassGen Manager</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./CSS/style.css">
</head>
<body>

  <!-- <div class="loading-skeleton">
    <div class="loader"> -->

    </div>
  </div>
  <div class="content-loaded">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
      <a class="navbar-brand" href="#">PassGen Manager</a>
       <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
      aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav ml-auto"> <!-- Align to the right -->
          <li class="nav-item active">
            <a class="nav-link" href="#">Home<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./HTML/loginPage.php">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./HTML/signUpPage.php">Sign Up</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="./HTML/loginPage.php" >Manage Passwords</a>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">More Options
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="#">About Us</a>
              <a class="dropdown-item" href="#">Contact Us</a>
              <a class="dropdown-item" href="#">Report a problem</a>
            </div>
          </li>
        </ul>
      </div>
    </nav>

    <div class="content">
    <h1 class="h1">Password Generator and Manager</h1>
    <br>
    <div class="container">
        <div class="row d-flex justify-content-center">
          <div class="form">
            <form action="Submit">
              <div class="mb-3"> <!-- Add margin to create space -->
                <input type="text" placeholder="Generated Password" id="generateout" class="form-control" oninput="passwordStrengthMeter()">
              </div>
              <button onclick="copyToClipboard()" type="button" name="copy" id="copy" class="btn btn-primary">Copy</button>
              <br>
              <div id="password_strength_meter">Strength: Very Weak</div>
              <br>
              <div class="form-check">
                <input type="checkbox" class="form-check-input" checked="checked" id="numbers" name="numbers">
                <label class="form-check-label" for="numbers">Include Numbers</label>
              </div>
              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="characters" name="characters">
                <label class="form-check-label" for="characters">Include Special Characters</label>
              </div>
              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="alphabets" checked="checked" name="alphabets">
                <label class="form-check-label" for="alphabets">Include Alphabets</label>
              </div>
              <br>
              <div id="alertMessage" style="color: red;"></div>

              <br>
              <p>Set Password Length</p>
              <input type="range" min="8" max="32" value="10" class="slider" id="myRange" oninput="rangeValue.innerText = this.value">
              <p id="rangeValue">10</p>
            </form>
          </div>
        </div>
        <div class="row d-flex justify-content-center"> <!-- Center the "Generate Password" button -->
          <button type="button" name="generate" id="generatebtn" class="btn btn-primary">Generate Password</button>
        </div>
    </div>
  </div>
</div>
    <script src="./JS/script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.4.2/zxcvbn.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>