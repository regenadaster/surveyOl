<?php
  //this answer is just for not eassy question.
  class userAnswer{
  	private $id;
  	private $userid;
  	private $surveyid;
  	private $problemid;
  	private $isEassy;
  	private $answer;
  	private $uaDb;
  	private $userAnswerTb;
  	public function __construct(){
  	  $this->id=0;
  	  $this->userAnswerTb="useranswer";
  	  $this->uaDb=db::getInstance(MYSQLHOST,MYSQLUSER,MYSQLPS);
  	}
  	public function getUserAnswerById(){
  	  if($this->id==0){
  	    return false;
  	  }
  	  else{
  	    $tmpStr="id=$this->id";
  	    $this->uaDb->select($this->userAnswerTb);
  	    $this->uaDb->where($tmpStr);
  	    $this->uaDb->query();
  	    $res=$this->uaDb->getResultArray();
  	  }
  	}
  	public function setIdByHand($_id){
  	  $this->id=$_id;
  	}
  	public function getId(){
  	  return $this->id;
  	}
  	public function setUserId($_id){
  	  $this->userid=$_id;
  	}
  	public function getUserId(){
  	  return $this->userid;
  	}
  	public function setSurveyId($_id){
  	  $this->surveyid=$_id;
  	}
  	public function getSurveyId(){
  	  return $this->surveyid;
  	}
  	public function setProblemId($_id){
  	  $this->surveyid=$_id;
  	}
  	public function getProblemId(){
  	  return $this->problemid;
  	}
  	public function setIsEassy($_isEassy){
  	  $this->isEassy=$_isEassy;
  	}
  	public function getIsEassy(){
  	  return $this->isEassy;
  	}
  	public function setAnswer($_answer){
  	  $this->answer=$_answer;
  	}
  	public function getAnswer(){
  	  return $this->answer;
  	}
  }
  
  ?>