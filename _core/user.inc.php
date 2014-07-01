<?php
  require_once './_main.inc.php';
  class user{
  	private $name;
  	private $passwd;
  	private $id;
  	private $uDb;
  	public function __construct($_name="",$_passwd=""){
  	  $this->setName($_name);
  	  $this->setPasswd($_passwd);
  	  $this->uDb=db::getInstance("127.0.0.1","root","");
  	}
  	public function setName($_name){
  	  $this->name=$_name;
  	}
  	public function getName(){
  	  return $this->name;
  	}
  	public function setPasswd($_passwd){
  	  $this->passwd=$_passwd;
  	}
  	public function getPasswd(){
  	  return $this->passwd;
  	}
  	public function checkUser(){
  	}
  	public function createUser(){
  	}
  }
  ?>