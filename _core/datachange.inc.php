<?php 
  require_once '../_core/_main.inc.php';
  class datachange{
  	private $_survey;
  	public function __construct($_sid){
  	  $this->getSurvey($_sid);
  	}
  	public function getSurvey($_sid){
  	  $this->_survey=new survey();
  	  $this->_survey->setIdByHand($_sid);
  	  $this->_survey->getSurveyById();
  	  $this->_survey->AddProblemById();
  	}
  	public function removeSurveyAndChildren(){
      $tmpProblems=$this->_survey->getProblems();
      for($i=0;$i<count($tmpProblems);$i++){
        $tmpProblem=$tmpProblems[$i];
        $tmpOptions=$tmpProblem->getOptions();
        for($j=0;$j<count($tmpOptions);$j++){
          $tmpOption=$tmpOptions[$j];
          $tmpOption->deleteOptionById($tmpOption->getId());
        }
      	$tmpProblem->deleteProblemsByPid($tmpProblem->getId());
      }
      $this->_survey->removeSurveyById($this->_survey->getSid());
  	}
  }



?>