<?php
  require_once './_main.inc.php';
  class surveyUrl{
  	private $url;
  	private $surveyId;
  	private $syDb;
  	private $sUrlTable;
  	public function __construct(){
  	  $this->surveyId=0;
  	  $this->url="";
  	  $this->sUrlTable="surveyUrl";
  	  $this->syDb=db::getInstance(MYSQLHOST,MYSQLUSER,MYSQLPS);
  	}
  	public function setUrlFromDb(){
  	  if($this->getSurveyId()!=0){
  	    $this->syDb->select($this->sUrlTable,"url");
  	    $this->syDb->where("surveyid=$this->surveyId");
  	    $this->syDb->query();
  	    $res=$this->syDb->getResultArray();
  	    $this->url=$res["url"];
  	  }
  	}
  	public function setSidFromDb(){
  	  if($this->getUrl()!=""){
  	    $this->syDb->select($this->sUrlTable,"surveyid");
  	    $this->syDb->where("url=\"$this->url\"");
  	    $this->syDb->query();
  	    $res=$this->syDb->getResultArray();
  	    $this->surveyId=$res["surveyid"];
  	  }
  	}
  	public function insertUrl(){
  	  $arr=array();
  	  $arr["surveyid"]=$this->surveyId;
  	  $arr["url"]=$this->url;
  	  $this->syDb->insert($this->sUrlTable,$arr);
  	  $this->syDb->query();
  	}
  	public function setUrl($_url){
  	  $this->url=$_url;
  	}
  	public function getUrl(){
  	  return $this->url;
  	}
  	public function setSurveyId($_id){
  	  $this->surveyId=$_id;
  	}
  	public function getSurveyId(){
  	  return $this->surveyId;
  	}
  	
  }
  ?>