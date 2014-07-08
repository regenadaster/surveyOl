<?php
  require_once '../_core/_main.inc.php';
  //$remoteuser=new userAnswer();
  //$remoteuser->setSurveyId(2);
  //$tmpcount=$remoteuser->getSubveyAnswerNum();
  //echo $tmpcount;
  /*
  $dataSet["surveyId"]="a966bb1";
  $dataSet["answer"]=array();
  $dataSet["answer"][]="q1o1";
  $dataSet["answer"][]="q2o2";
  $tmpUrl=new surveyUrl();
  $tmpUrl->setUrl($dataSet["surveyId"]);
  $tmpUrl->setSidFromDb();
  $surveyId=$tmpUrl->getSurveyId();
  $tmpSurvey=new survey();
  $tmpSurvey->setIdByHand($surveyId);
  $tmpSurvey->getSurveyById();
  $ownerId=$tmpSurvey->getOwner();
  for($i=0;$i<count($dataSet["answer"]);$i++){
  	$onum=(int)getOptNum($dataSet["answer"][$i]);
  	$qnum=getQNum($dataSet["answer"][$i]);
  	$tmpAnswer=new userAnswer();
  	$tmpAnswer->setAnswer($onum);
  	$tmpAnswer->setProblemId($qnum);
  	$tmpAnswer->setIsEassy(0);
  	$tmpAnswer->setSurveyId($surveyId);
  	$tmpAnswer->setUserId($ownerId);
  	$tmpAnswer->createAnswer();
  }
  */
  setVal("userName","lgt");
  setVal("password","5363513l");
  $remoteUser=new user();
  $remoteUser->setName(getVal("userName"));
  $remoteUser->setPasswd(getVal("password"));
  $tmpUserSurvey=new userSurvey($remoteUser);
  $dataSet=$tmpUserSurvey->getDataSet();
  var_dump($dataSet);
  ?>