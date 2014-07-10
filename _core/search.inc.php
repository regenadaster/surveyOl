<?php
  session_start();
  require_once '../_core/_main.inc.php';
  class search{
  	private $text;
  	private $remoteuser;
  	public function __construct($_text){
  	  $this->text=$_text;
  	  $this->remoteuser=new user();
  	  $this->remoteuser->setName(getVal("userName"),getVal("password"));
  	  $tmpId=$this->remoteuser->getId();
  	  $this->remoteuser->getAllSurveysByTitle($_text,$tmpId);
  	  $this->packData();
  	}
  	public function packData(){
  		
  	}
  }
  
  
  
  
  ?>