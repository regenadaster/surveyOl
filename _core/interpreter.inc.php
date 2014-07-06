<?php 
  require_once '../_core/_main.inc.php';
  class interpreter{
    private $_dataSet;
    private $_survey;
    private $_problems;
    private $surveyId;
    private $surveyTailUrl;
    public function __construct($_data){
      //echo "come in";
      $this->_dataSet=$_data;
      $this->putSurvey();
    }
    public function echoUrl(){
      echo $this->_survey->getFileUrl();
    }
    public function putSurvey(){
      $descript=$this->_dataSet['descript'];
      $subject=$this->_dataSet["descript"];
      $title=$this->_dataSet['title'];
      $isRelease=0;
      $begin=date('Y-m-d H:i:s',time());
      $close=date('Y-m-d H:i:s',strtotime("next year"));
      $owner=getVal("userName");
      //var_dump($descript);
      //echo "</br>";
      //var_dump($subject);
      //echo "</br>";
      //var_dump($title);
      //echo "</br>";
      //var_dump($isRelease);
      //echo "</br>";
      //var_dump($begin);
      //echo "</br>";
     // var_dump($close);
      //echo "</br>";
      //var_dump($owner);
      //echo "</br>";
      $this->_survey=new survey($title,$subject,$descript,$owner,$begin,$close,$isRelease);
      //echo "after survey</br>";
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