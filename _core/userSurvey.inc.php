<?php
  class userSurvey{
    private $remoteuser;
    private $dataSet;
    private $dataSt;
    public function __construct($_user=""){
      $this->remoteuser=$_user;
      $this->dataSet=array();
    }
    public function setDataSt($title,$createTime,$isPublish,$answerNum){
      $this->dataSt=array();
      $this->dataSt["title"]=$title;
      $this->dataSt["createTime"]=$createTime;
      $this->dataSt["isPublish"]=$isPublish;
      $this->dataSt["answerNum"]=$answerNum;
      $this->dataSt["others"]=array();
    }
    public function setDataStOthers($others){
       
    }
    public function setUser($_user){
      $this->remoteuser=$_user;
    }
    public function packData(){
      $tmpSurveys=$this->remoteuser->getSurveys();
      
    }
  }
  ?>