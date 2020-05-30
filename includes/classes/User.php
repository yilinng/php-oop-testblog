<?php

class User extends DB_Connection{

	private $conn;
	private $loginErrorArray;
	private $registerErrorArray;

	public function __construct() {
		$this->conn = $this->connect();
		$this->loginErrorArray = array();
		$this->registerErrorArray = array();
	}

	public function login($name, $password) {

		$password = md5($password);
		$sql = "SELECT * from user WHERE name = ? AND password = ?";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute([$name, $password]);
		$user = $stmt->fetch();

		if ($user == null) {
			array_push($this->loginErrorArray, "Name or Password is invalid");
		}

		return $user;
	}

	public function register($name, $surname, $email, $password){

		$this->validateFirstName($name);
		$this->validateLastName($surname);
		$this->validateEmail($email);
		$this->validatePassword($password);

		if (empty($this->registerErrorArray) == true) {
			//insert the user
			return $this->insertUserDetails($name, $surname, $email, $password);
			
		}else{
			return null;
		}

	}

	public function insertUserDetails($name, $surname, $email, $password){

		$password = md5($password);//Encrypted password

		$sql = "INSERT INTO user(name, surname, email, password) VALUES(?,?,?,?)";
		$stmt = $this->conn->prepare($sql);

		try{

			$stmt->execute([$name, $surname, $email, $password]);
			$last_id = $this->conn->lastInsertId();//4,5

			$user = new stdClass();//empty object
			$user->id = $last_id;
			$user->name = $name;
			$user->surname = $surname;
			$user->email = $email;

			return $user;

		}catch(Exception $e){
			echo $e->getMessage();
			return null;
		}
	}


	public function validateFirstName($name){

		if (strlen($name) < 4 || strlen($name) > 25) {
			array_push($this->registerErrorArray, "Your first Name must be between 4 and 25 characters");
			return;
		}
	}

	public function validateLastName($surname){

		if (strlen($surname) < 4 || strlen($surname) > 25) {
			array_push($this->registerErrorArray, "Your last Name must be between 4 and 25 characters");
			return;
		}
	}

	public function validateEmail($email){

		//@, gmail, hotmail.com.....
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			rray_push($this->registerErrorArray, "This email address is invalid");
			return;
		}

		$sql = "SELECT email FROM user WHERE email = ?";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute([$email]);
		$result = $stmt->fetch();

		if ($result != null) {
			array_push($this->registerErrorArray, "This email is already in use");
			return;
		}
	}

	public function validatePassword($password){

		if (strlen($password) < 8 || strlen($password) > 30) {
			array_push($this->registerErrorArray, "Your password must be between 8 and 30 characters");
			return;
		}
	}



	public function getLoginErrors() {
 
		//check if the loginErrorArray has any item in it
		if (!empty($this->loginErrorArray)) {
			$error = $this->loginErrorArray[0];
			return "<div class='alert alert-danger role='alert'>$error</div>";
		}
	}

	public function getRegisterErrors() {

		return $this->registerErrorArray;
	}

	public function getName($user_id) {

		$sql = "SELECT name FROM user WHERE id = ?";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute([$user_id]);
		$user = $stmt->fetch();

		if ($user == null) {
			return null;
		}

		return $user->name;
	}	
}
