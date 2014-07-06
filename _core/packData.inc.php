<?php
  require_once '../_core/_main.inc.php';
  class packData{
  	private $fileUrl;
  	private $fileName;
  	private $dataSet;
  	private $_survey;
  	private $_surveyUrl;
  	public function __construct($_url){
  	  $this->fileUrl=$_url;
  	  $this->dataSet=array();
  	  $this->dataSet["questions"]=array();
  	  $this->fileName="";
  	  $this->setFileName();
  	  $this->_survey=new survey();
  	  $this->_surveyUrl=new surveyUrl();
  	  $this->getSurveyId();
  	  $this->setSurvey();
  	  $this->createDataSet();
  	}
  	public function setSurvey(){
  	  $this->_survey->setIdByHand($this->getSurveyId());
  	  $this->_survey->getSurveyById();
  	  $this->_survey->AddProblemById();
  	  $this->_survey->sortProblems();
  	}
  	public function getSurveyId(){
  	  $this->_surveyUrl->setUrl($this->getFileName());
  	  $this->_surveyUrl->setSidFromDb();
  	  return $this->_surveyUrl->getSurveyId();
  	}
  	public function createDataSet(){
  	  $this->dataSet["descript"]=$this->_survey->getDescript();
  	  $this->dataSet["title"]=$this->_survey->getTitle();
  	  $tmpPros=$this->_survey->getProblems();
      for($i=0;$i<count($tmpPros);$i++){
        $tmpP=array();
        $tmpP["descript"]=$tmpPros[$i]->getDescript();
        $tmpP["options"]=array();
        $tmpOptions=$tmpPros[$i]->getOptions();
        for($j=0;$j<count($tmpOptions);$j++){
          $tmpOpt=array();
          $tmpOpt["descript"]=$tmpOptions[$j]->getDescript();
          $tmpOpt["type"]=$tmpPros[$i]->getType();
          $tmpP["options"][]=$tmpOpt;
        }
        $this->dataSet["questions"][]=$tmpP;
      }
  	}
  	public function getDataSet(){
  	  if(count($this->dataSet)==0){
  	    $this->createDataSet();
  	  }
      return $this->dataSet;
  	}
  	public function setFileName(){
  	  $arr=explode("\\",$this->fileUrl);
  	  for($i=0;$i<count($arr);$i++){
  		if(preg_match("/.php/",$arr[$i])){
  		  $fir=strpos($arr[$i], '.');
  		  $this->fileName=substr($arr[$i],0,$fir);
  		}
  	  } 	  
  	}
  	public function getFileName(){
      if($this->fileName==""){
        $this->setFileName();
      }
      return $this->fileName;
  	}
  }
  
  ?>