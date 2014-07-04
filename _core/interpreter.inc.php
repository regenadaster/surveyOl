<?php 
  require_once './_main.inc.php';
  class interpreter{
    private $_dataSet;
    private $_survey;
    private $_problems;
    public function __construct($_data){
      $this->$dataSet=$_data;
      $this->putSurvey();
    }
    public function putSurvey(){
      $descript=$this->$dataSet['descript'];
      $subject=$this->$dataSet["subject"];
      $title=$this->dataSet['title'];
      $isRelease=0;
      $begin=date('Y-m-d h:i:s',time());
      $close=date('Y-m-d h:i:s',strtotime("last year"));
      $owner=getVal("userName");
      $_survey=new survey($title,$subject,$descript,$owner,$begin,$close,$isRelease);
      
    }
    public function putProblem(){
      
    }
  	
  	
  }






?>