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
  	private $description;
  	private $userAnswerTb;
  	public function __construct(){
  	  $this->id=0;
  	  $this->userid=0;
  	  $this->surveyid=0;
  	  $this->problemid=0;
  	  $this->isEassy=0;
  	  $this->answer=0;
  	  $this->userAnswerTb="useranswer";
  	  $this->description=" ";
  	  $this->uaDb=db::getInstance(MYSQLHOST,MYSQLUSER,MYSQLPS);
  	}
  	public function getSubveyAnswerNum(){
      $numArr=array();
  	  if($this->surveyid==0){
  	    return false;
  	  }
  	  else{
  	    $tmpStr="surveyid=$this->surveyid";
  	    $this->uaDb->select($this->userAnswerTb,"problemid as num");
  	    $this->uaDb->where($tmpStr);
  	    $this->uaDb->query();
  	    $res=$this->uaDb->getResultArray(1);
  	    $minval=maxInt;
  	    foreach ($res as $arr){
          $numArr[]=$arr['num'];
  	    }
  	    return getTheMinCountInArr($numArr);
  	  }
  	}
  	public function createAnswer(){
  	  $arr=array();
  	  $arr["userid"]=$this->userid;
  	  $arr["surveyid"]=$this->surveyid;
  	  $arr["isEassy"]=$this->isEassy;
  	  $arr["answer"]=$this->answer;
  	  $arr["problemid"]=$this->problemid;
  	  $arr["description"]=$this->description;
  	  $this->uaDb->insert($this->userAnswerTb,$arr);
  	  $this->uaDb->query();
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
  	    $this->userid=$res["userid"];
  	    $this->surveyid=$res["surveyid"];
  	    $this->problemid=$res["problemid"];
  	    $this->isEassy=$res["isEassy"];
  	    $this->answer=$res["answer"];
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
  	  $this->problemid=$_id;
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