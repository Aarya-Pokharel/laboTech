<?php

Class Database{
	private $server = "mysql:host=localhost;dbname=tourate";
	private $username = "root";
	private $password = "";
	protected $conn;
	
	public function open(){
 		try{
 			$this->conn = new PDO($this->server, $this->username, $this->password);
 			return $this->conn;
 		}
 		catch (PDOException $e){
 			$_SESSION['error']= "There is some problem in connection: " . $e->getMessage();
  
 		}
 
    }
 
	public function close(){
   		$this->conn = null;
 	}
 
}

$pdo = new Database();
 
?>