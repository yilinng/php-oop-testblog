<?php
  session_start();
  include("includes/dbcon.php");
  include("includes/classes/Post.php");

  $userLoggedIn = null;// id, name, surname, email

  if (isset($_SESSION['userLoggedIn'])) {
      $userLoggedIn = $_SESSION['userLoggedIn'];
  }else{
      header("Location: index.php");
  }

  $result = false;
  $post = new Post();

  include("includes/post_handler.php");
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>text_new</title>
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
      <a class='btn btn-primary btn-info' href='index.php' role='button'>homepage</a>
     <a class='btn btn-primary btn-lg' href='logout.php' role='button'>Logout</a>

  </div>
    
  <form action="add_post.php" name="form1" method="post">
    <?php if($result) echo "<div class = 'alert alert-success' role ='alert'>Successfully Add</div>"; ?>
      <div class="form-group">
    <label for="title">Post Title</label>
    <input type="text" class="form-control" name="title">
  </div>
  <div class="form-group">
    <label for="details">Details</label>
    <textarea type="text" class="form-control" name="details"></textarea>
  </div>
  <button type="reset" name="reset" class="btn btn-info">reset</button>
  <button type="submit" name="addButton" class="btn btn-primary">Add Post</button>
</form>
</div>
<footer style="text-align:center;">02.20.2020</footer>

</body>
</html>



