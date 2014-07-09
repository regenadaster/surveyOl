<?php 
  require_once '../_core/_main.inc.php';
  class interpreter{
    private $_dataSet;
    private $_survey;
    private $_problems;
    private $surveyId;
    private $surveyTailUrl;
    private $save;
    public function __construct($_data,$save){
      $this->_dataSet=$_data;
      $this->putSurvey();
      $this->save=$save;
    }
    public function echoUrl(){
      echo $this->_survey->getFileUrl();
    }
    public function putSurvey(){
      $descript=$this->_dataSet['descript'];
      $subject=$this->_dataSet["descript"];
      $title=$this->_dataSet['title'];
      $isRelease=($this->save==1)?0:1;
      $begin=date('Y-m-d H:i:s',time());
      $close=date('Y-m-d H:i:s',strtotime("next year"));
      $owner=getVal("userName");
      $passwd=getVal("password");
      $this->_survey=new survey($title,$subject,$descript,0,$begin,$close,$isRelease);
      $this->_survey->setUser($owner, $passwd);
      $this->putProblem();
      for($i=0;$i<count($this->_problems);$i++){
      	$this->_survey->addProblem($this->_problems[$i]);
      }
      $this->_survey->createSurvey();
      $this->surveyId=$this->_survey->getSid();
      $this->_survey->putUrlById();
      $this->_survey->MkFile();
    }
    public function putProblem(){
      $this->_problems=array();
      $len=count($this->_dataSet["questions"]);
      $q=$this->_dataSet["questions"];
      for($i=0;$i<$len;$i++){
      	$descript=$q[$i]["descript"];
      	$tmpPro=new problem(0,$descript,0);
      	$tmpPro->setOrder($i+1);
      	for($j=0;$j<count($q[$i]["options"]);$j++){
      	  $_opt=$q[$i]["options"][$j];
      	  $tmpOpt=new option($j,$_opt["descript"]);
      	  $tmpPro->setType($_opt["type"]);
      	  $tmpPro->addOption($tmpOpt);
      	}
      	$this->_problems[]=$tmpPro;
      }
    }
  }
?>