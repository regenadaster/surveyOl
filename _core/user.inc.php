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
  	  @$this->uDb=db::getInstance("127.0.0.1","root","");
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
  	public function isValidate(){
  	  if(empty($this->name)||empty($this->passwd)){
  	  	return false;
  	  }
  	  else{
  	  	return true;
  	  }
  	}
  	public function checkUser(){
  	  if(!$this->isValidate()){
  	  	return false;
  	  }
  	  else{
  	  	$str="user.name=\"$this->name\" AND user.passwd=\"$this->passwd\"";
  	  	$this->uDb->select("user");
  	  	$this->uDb->where($str);
  	  	$this->uDb->query();
  	    $res=$this->uDb->getResultArray();
  	    if(empty($res)){
  	      return false;
  	    }
  	    else{
  	      return true;
  	    }
  	  }
  	}
  	public function regUser(){
  	  $str="user.name=\"$this->name\"";
  	  $this->uDb->select("user");
  	  $this->uDb->where($str);
  	  $this->uDb->query();
  	  $res=$this->uDb->getResultArray();
  	  if(empty($res)){
  		return true;
  	  }
  	  else{
  		return false;
  	  }
  	}
  	public function createUser(){
  	  if(!$this->isValidate()){
  	  	return false;
  	  }
  	  else{
  	    $params=array();
  	    $params["name"]=$this->getName();
  	    $params["passwd"]=$this->getPasswd();
  	    var_dump($params);
  	  	$this->uDb->insert("user",$params);
        return $this->uDb->query();
  	  }
  	}
  }
  ?>