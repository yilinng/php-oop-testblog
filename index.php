<?php

  session_start();//get the session information
  include("includes/dbcon.php");
  include("includes/classes/Post.php");
  include("includes/classes/User.php");
  //include("example.php");

  $userLoggedIn = null;

  if (isset($_SESSION['userLoggedIn'])) {
      $userLoggedIn = $_SESSION['userLoggedIn']; 
      echo $userLoggedIn->name;
  }

  $post_ = new Post();

  $result = false;

  if (isset($_POST['delete_id'])) {
    
    $delete_id = $_POST['delete_id'];

    $result = $post_->deletePost($delete_id);
  }

  $user = new User();
  $allPosts = $post_->getAllPosts();

  
?>




<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>home page</title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script
        src="https://code.jquery.com/jquery-3.4.1.js"
        integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
        crossorigin="anonymous"></script>
</head>
<body>
		  <div class="container">
	   <div class="jumbotron">
    <h1 class="display-4">Hello, world!</h1>
  <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
  <hr class="my-4">
  <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
    <?php if($userLoggedIn != null) {
        echo "  
                <a class='btn btn-outline-primary' href='add_post.php' role='button'>Add New</a>
            <a class='btn btn-outline-warning' href='logout.php' role='button'>logout</a>

          ";
           }else{
        echo  "<a class='btn btn-outline-primary' href='login.php' role='button'>login</a>";
          }
          ?>
  
</div>
<?php 
    if ($result != false) {
        echo "<div class= 'alert alert-danger' role='alert'>Post Successfully Delete</div>";
    }
?>
<?php foreach ($allPosts as $post) {
  # code...
 ?>
<div class="alert alert-success" role="alert">
  <h4 class="alert-heading"><?php echo $post->title ?></h4>
  <?php 
      if (($userLoggedIn != null) && ($post->user_id == $userLoggedIn->id)) {
            echo "<button class='btn-outline-warning' onclick='deletePost($post->id)'>Delet Post</button>
                  <a href='edit.php?id=" . ($post->id) . "'<button class='btn-outline-info' >edit post</button></a>";
      }
   ?>
   <p>
  <?php  
    $date = strtotime($post->create_at);
    $convert_date = date('F d,Y', $date);
    echo $convert_date;
   ?>
   <a href="#">
    <?php echo $user->getName($post->user_id) ?>
   </a></p>
  <p><?php echo $post->details ?></p>
</div>
<?php } ?>

</div>
  <form action="index.php" method="POST" id="deletePost">
    <input type="hidden" name="delete_id" id="delete_id" value="">
  </form>

<footer style="text-align:center;">02.20.2020</footer>
</body>
      <script type="text/javascript">
        function deletePost(id){
          Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.value) {
          document.getElementById("delete_id").value = id;
          document.getElementById("deletePost").submit();

        }
      })
      }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <div id="app-2">
    <span v-bind:title="message">
     Hover your mouse over me for a few seconds
      to see my dynamically bound title!
    </span>
    </div>
    <script>

     var app2 = new Vue({
        el: '#app-2',
        data: {
         message: 'You loaded this page on ' + new Date().toLocaleString()
          }
    })

     </script>
</html>