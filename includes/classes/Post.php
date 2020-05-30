<?php 

class Post extends DB_Connection{

	private $conn;
	private $errorArray;

	public function __construct() {
		$this->conn = $this->connect();
		$this->errorArray = array();
	}

	public function getAllPosts(){

		$sql = "SELECT * FROM posts";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute([]);
		$result = $stmt->fetchAll();

		return $result;
	}

	public function getOnePost($id){
		$sql = "SELECT title, details FROM posts WHERE id = ?";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute([$id]);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->title = $result['title'];
    	$this->details = $result['details'];



	}



	public function insertPost($user, $title, $details){

		//user_id, title, details, date
		$date = date("Y-m-d");//YYYY-mm-dd

		$sql = "INSERT INTO posts(title, details, user_id, create_at) VALUES(?,?,?,?)";
		$stmt = $this->conn->prepare($sql);

		try{
			$stmt->execute([$title, $details, $user, $date]);
			return true;
		} catch(Exception $e) {
			echo $e->getMessage();
			return false;
		}
	}

	public function deletePost($post_id){

		$sql = "DELETE FROM posts WHERE id = ?";
		$stmt = $this->conn->prepare($sql);

		try{
			$stmt->execute([$post_id]);
			return true;
		} catch(Exception $ex) {
			return false;
		}
	}

	public function updatePost($id, $title, $details){

		$sql = "UPDATE posts SET title = ?,details = ? WHERE id = ?";
		$stmt = $this->conn->prepare($sql);
		
		try{
			$stmt->execute([$id, $title, $details]);
			return true;
		} catch(Exception $ex) {
			return false;
		}	
	
	}

	
}






















?>