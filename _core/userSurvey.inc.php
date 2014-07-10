<?php
  require_once '../_core/_main.inc.php';
  class userSurvey{
    private $remoteuser;
    private $dataSet;
    private $type;
    private $text;
    public function __construct($userName="",$passwd="",$type=0){
      if($userName instanceof user){
      	$this->remoteuser=$userName;
      	$this->type=0;
      }
      else{
        if(is_string($userName)&&is_string($passwd)&&!empty($userName)){
          $this->remoteuser=new user($userName,$passwd);
        }
        else{
          $this->remoteuser=new user();
          $this->remoteuser->setName(getVal("userName"),getVal("password"));
          return;          
        }
      }
      if($this->remoteuser instanceof user){
        $this->remoteuser->setId();
      }
      $this->dataSet=array();
      $this->type=$type;
      $this->packData();
    }
    public function setText($_text){
      $this->text=$_text;
    }
    public function searchPack($_type){
      $this->type=$_type;
      if($this->type==6){
      	$this->remoteuser=new user();
      }
      $this->packData();
    }
    public function getDataSet($_text){
      return $this->dataSet;
    }
    public function addDataSt($dataSt){
      $this->dataSet[]=$dataSt;
    }
    public function setDataSt($title,$createTime,$isPublish,$answerNum,$url,$name){
      $dataSt=array();
      $dataSt["title"]=$title;
      $dataSt["createTime"]=$createTime;
      $dataSt["isPublish"]=$isPublish;
      $dataSt["answerNum"]=$answerNum;
      $dataSt["url"]=$url;
      $dataSt["name"]=$name;
      $dataSt["others"]=array();
      $this->addDataSt($dataSt);
    }
    public function setDataStOthers($others){
       
    }
    public function setUser($_user){
      $this->remoteuser=$_user;
    }
    public function packData(){
      if($this->type==0) $this->remoteuser->getAllSurveys();
      if($this->type==1) $this->remoteuser->getLastDaySurveys();
      if($this->type==2) $this->remoteuser->getLastWeekSurveys();
      if($this->type==3) $this->remoteuser->getLastMonthSurveys();
      if($this->type==4) $this->remoteuser->getAllSurveysByAdmin();
      if($this->type==5) $this->remoteuser->getAllSurveysByTitle($this->text,$this->remoteuser->getId());
      if($this->type==6) $this->remoteuser->getAllSurveysByTitle($this->text);
      $tmpSurveys=$this->remoteuser->getSurveys();
      for($i=0;$i<count($tmpSurveys);$i++){
      	$tmpSurvey=$tmpSurveys[$i];
        $title=$tmpSurvey->getTitle();
        $createTime=$tmpSurvey->getBegin();
        $isPublish=$tmpSurvey->getRelease();
        $tmpUserAnswer=new userAnswer();
        $tmpSurveyId=$tmpSurvey->getSid();
        $tmpUserAnswer->setSurveyId($tmpSurveyId);
        $answerNum=$tmpUserAnswer->getSubveyAnswerNum();
        $tmpSurveyUrl=new surveyUrl();
        $tmpSurveyUrl->setSurveyId($tmpSurveyId);
        $tmpSurveyUrl->setUrlFromDb();
        $tmpUrl=$tmpSurveyUrl->getUrl();
        $tmpUser=new user();
	    //echo $tmpSurvey->getOwner();
        $tmpUser->setIdbyHand($tmpSurvey->getOwner());
        $tmpUser->getNameAndPasswdById();
        $name=$tmpUser->getName();
        $this->setDataSt($title, $createTime, $isPublish, $answerNum,$tmpUrl,$name);
      }
    }
  }
  ?>