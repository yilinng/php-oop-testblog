<?php
session_start();
//Include config file
  include("includes/dbcon.php");
  include("includes/classes/User.php");

  $user = new User();

if (isset($_POST['registerButton'])) {
  
      $name = $_POST['inputFirstName'];
      $surname = $_POST['inputLastName'];
      $email = $_POST['registerEmail'];
      $password = $_POST['registerPassword'];

      $result = $user->register($name, $surname, $email, $password);

      if ($result != null) {
          $_SESSION['userLoggedIn'] = $result;
          header("Location:index.php");
      }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>register</title>
  <link rel="stylesheet" type="text/css" href="assets/css/style.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>
  <div class="container">
<div class="jumbotron">
  <h1 class="display-4">Hello, world!</h1>
  <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
  <hr class="my-4">
  <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">home</a></li>
    <li class="breadcrumb-item active" aria-current="page">register</li>
    </ol>
</nav>
  </div>
  <form action="register.php" name="register" method="POST">
    <?php
        foreach ($user->getRegisterErrors() as $error) {
            echo "<div class= 'alert alert-danger' role='alert'>$error</div>";
        }
    ?>
  <div class="form-group">
    <label for="inputFirstName">First Name</label>
    <input type="text" class="form-control" name="inputFirstName">
  </div>
    <div class="form-group">
    <label for="inputLastName">Last Name</label>
    <input type="text" class="form-control" name="inputLastName">
  </div>
    <div class="form-group">
    <label for="registerEmail">Email address</label>
    <input type="text" class="form-control" name="registerEmail">
  </div>
  <div class="form-group">
    <label for="registerPassword">Password</label>
    <input type="password" class="form-control" name="registerPassword">
  </div>
    
  <button type="submit" name="registerButton" class="btn btn-primary">register</button>
</form>
 <p>Already have an account? <a href="login.php">Login here</a>.</p>
</div>
</body>
</html>

