<?php
  require_once '../_core/_main.inc.php';
  class collectAnswer{
  	private $answersArr;
  	private $cDb;
  	private $url;
  	private $_survey;
  	public function __construct($url){
  	  $this->answersArr=array();
  	  $this->cDb=db::getInstance(MYSQLHOST,MYSQLUSER,MYSQLPS);
  	  $this->url=$url;
  	  $this->getSurveyObj();
  	  $this->packAnswerData();
  	}
  	public function getSurveyObj(){
  	  $tmpUrl=new surveyUrl();
  	  $tmpUrl->setUrl($this->url);
  	  $tmpUrl->setSidFromDb();
  	  $surveyId=$tmpUrl->getSurveyId();
  	  $tmpSurvey=new survey();
  	  $tmpSurvey->setIdByHand($surveyId);
  	  $tmpSurvey->getSurveyById();
  	  $tmpSurvey->AddProblemById();
  	  $this->_survey=$tmpSurvey;
  	}
  	public function packAnswerData(){
  	  $problems=$this->_survey->getProblems();
  	  for($i=0;$i<count($problems);$i++){
  	  	$problemArr=array();
  	    $tmpProblem=$problems[$i];
  	    $_count=$tmpProblem->getOptionsCount();
  	    $problemArr["optNum"]=$_count;
  	    $problemArr["optCount"]=array();
  	    for($j=0;$j<$_count;$j++){
  	      $sid=$this->_survey->getSid();
  	      $pid=$tmpProblem->getId();
  	      $optnum=$this->getOptSelectNum($sid,$i+1,$j+1);
  	      $problemArr["optCount"][]=$optnum;
  	    }
  	    $this->answersArr[]=$problemArr;
  	  }
  	}
    public function getAnswersArr(){
      return $this->answersArr;
    }
  	public function getOptSelectNum($sid,$pid,$optNum){
  	  $str="surveyid=$sid and problemid=$pid and answer=$optNum";
  	  $this->cDb->select("userAnswer","count(id) as num");
  	  $this->cDb->where($str);
  	  $this->cDb->query();
  	  $res=$this->cDb->getResultArray();
  	  return $res["num"];
  	}
  	public function getAnswerBySurveyId($sid){
  	  $str="surveyid=$sid";
  	  $this->cDb->select("userAnswer","id");
  	  $this->cDb->where($str);
  	  $this->cDb->OrderBy("id",0);
  	  $this->cDb->query();
  	  $res=$this->cDb->getResultArray();
  	  foreach ($res as $arr){
  	    $aId=$arr['id'];
  	    $tmpAnswer=new userAnswer();
  	    $tmpAnswer->setIdByHand($aId);
  	    $tmpAnswer->getUserAnswerById();
  	    $this->putAnswer($tmpAnswer);
  	  }
  	}
  }
  ?>