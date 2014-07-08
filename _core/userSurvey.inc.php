<?php
  require_once '../_core/_main.inc.php';
  class userSurvey{
    private $remoteuser;
    private $dataSet;
    public function __construct($userName="",$passwd=""){
      if($userName instanceof user){
      	$this->remoteuser=$userName;
      }
      else{
        if(is_string($userName)&&is_string($passwd)){
          $this->remoteuser=new user($userName,$passwd);
        }
      }
      if($this->remoteuser instanceof user){
        $this->remoteuser->setId();
      }
      $this->dataSet=array();
      $this->packData();
    }
    public function getDataSet(){
      return $this->dataSet;
    }
    public function addDataSt($dataSt){
      $this->dataSet[]=$dataSt;
    }
    public function setDataSt($title,$createTime,$isPublish,$answerNum){
      $dataSt=array();
      $dataSt["title"]=$title;
      $dataSt["createTime"]=$createTime;
      $dataSt["isPublish"]=$isPublish;
      $dataSt["answerNum"]=$answerNum;
      $dataSt["others"]=array();
      $this->addDataSt($dataSt);
    }
    public function setDataStOthers($others){
       
    }
    public function setUser($_user){
      $this->remoteuser=$_user;
    }
    public function packData(){
      $this->remoteuser->getAllSurveys();
      $tmpSurveys=$this->remoteuser->getSurveys();
      for($i=0;$i<count($tmpSurveys);$i++){
        $title=$tmpSurveys[$i]->getTitle();
        $createTime=$tmpSurveys[$i]->getBegin();
        $isPublish=$tmpSurveys[$i]->getRelease();
        $tmpUserAnswer=new userAnswer();
        $tmpSurveyId=$tmpSurveys[$i]->getSid();
        $tmpUserAnswer->setSurveyId($tmpSurveyId);
        $answerNum=$tmpUserAnswer->getSubveyAnswerNum();
        $this->setDataSt($title, $createTime, $isPublish, $answerNum);
      }
    }
  }
  ?>