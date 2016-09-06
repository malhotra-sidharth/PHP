<?php

class makeConnection{
  private $host = "mysql.hostinger.in";
  private $dbname = "u384800896_demo";
  private $pwd = "yLp#PCE0[uQn";
  private $user = "u384800896_demo";
  public $db;

public function connectDB(){
	$name = $this -> dbname;
	$h = $this -> host;
	$pass = $this -> pwd;
	$u = $this -> user;
	try{
	    $db = new PDO("mysql:host=$h;dbname=$name", $u, $pass);
	    $db -> setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

	}catch(PDOException $e){
	  echo $e -> getMessage();
	}

	return $db;
  }
}
?>