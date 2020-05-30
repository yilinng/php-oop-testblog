<?php
session_start();
  include("includes/dbcon.php");
  include("includes/classes/Post.php");



  if (isset($_SESSION['userLoggedIn'])) {
      $userLoggedIn = $_SESSION['userLoggedIn'];
  }else{
      header("Location: index.php");
  }

  $post = new Post();


  $id = isset($_GET['id']) ? $_GET['id'] : '';

  var_dump($id);
       
  $post->getOnePost($id);

if (isset($_POST['editButton'])) {

    $id = $_POST['editid'];
    $title = $_POST['edittitle'];
    $details = $_POST['editdetails'];

    $result = $post->updatePost($id, $title, $details);

    if (isset($result)) {
      echo "<div class = 'alert alert-success' role ='alert'>Successfully edit</div>";
    }else{
            echo "<div class = 'alert alert-danger' role ='alert'>fail edit</div>";

    }

  }


?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>edit text</title>
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
  
    	 <form action="edit.php" name="editform" method="POST">
    	 	<input type="hidden" name="editid" value="<?php echo $id; ?>">
      <div class="form-group">
    <label for="title">Post Title</label>
    <input type="text" class="form-control" name="edittitle" value="<?php echo $post->title; ?>">
  </div> 
  <div class="form-group">
    <label for="details">Details</label>
    <textarea type="text" class="form-control" name="editdetails"><?php echo $post->details; ?></textarea>
  </div>
  <button type="reset" name="reset" class="btn btn-info">reset</button>
  <button type="submit"name="editButton" class="btn btn-primary">edit post</button>
</form>

</div>
</body>
</html>

	
	 
	


