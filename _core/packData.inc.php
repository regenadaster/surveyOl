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
  	  if(!$this->setSurvey()){
  	  	return;
  	  }
  	  $this->createDataSet();
  	}
  	public function setSurvey(){
  	  $this->_survey->setIdByHand($this->getSurveyId());
  	  $this->_survey->getSurveyById();
  	  if(!$this->_survey->getRelease()){
  	  	if(getVal("save")=="hello"){
  	  	}
  	  	else{
  	  	  return false;
  	  	}
  	  }
  	  $now=date('Y-m-d H:i:s',time());
  	  $closeTime=$this->_survey->getClose();
  	  if(strtotime($now)>strtotime($closeTime)){
  	  	return false;
  	  }
  	  $this->_survey->AddProblemById();
  	  $this->_survey->sortProblems();
  	  return true;
  	}
  	public function getSurveyId(){
  	  $this->_surveyUrl->setUrl($this->getFileName());
  	  $this->_surveyUrl->setSidFromDb();
  	  return $this->_surveyUrl->getSurveyId();
  	}
  	public function createDataSet(){
  	  $this->dataSet["descript"]=$this->_survey->getDescript();
  	  $this->dataSet["title"]=$this->_survey->getTitle();
  	  $this->dataSet["subject"]=$this->_survey->getSubject();
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