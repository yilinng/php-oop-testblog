<?php

	if (isset($_POST['loginButton'])) {

		$name = $_POST['loginname'];
		$password = $_POST['loginPassword'];

		$result = $user->login($name, $password);

		if ($result != null) {
			
			$_SESSION['userLoggedIn'] = $result;
  			header("Location: index.php");
		}

	}
?>