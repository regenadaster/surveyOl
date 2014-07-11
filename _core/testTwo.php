<?php
  //this file is for unit test and just for unit test;
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
  /*
  setVal("userName","lgt");
  setVal("password","5363513l");
  $remoteUser=new user();
  $remoteUser->setName(getVal("userName"));
  $remoteUser->setPasswd(getVal("password"));
  $tmpUserSurvey=new userSurvey($remoteUser);
  $dataSet=$tmpUserSurvey->getDataSet();
  var_dump($dataSet);
  */
  //$username="admin";
  //$userpasswd="admin";
  //$adminUser=new user($username,$userpasswd);
 // $res=$adminUser->checkAdmin();
  //echo $res;
  //$tmpUserSurvey=new userSurvey("admin","admin",1);
  //$dataSet=$tmpUserSurvey->getDataSet();
  //echo json_encode($dataSet);
  //$dataSet=$_POST["dataSet"];
  /*
  $dataSet=array();
  $dataSet["answer"]=array();
  $dataSet["surveyId"]="7bfb3a7";
  $dataSet["answer"][]="q1o2";
  $dataSet["answer"][]="q2o1";
  $dataSet["answer"][]="q2o2";
  $dataSet["answer"][]="q3o1";
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
    
     //$collecter=new collectAnswer("7bfb3a7");
    // $dataSet=$collecter->getAnswersArr();
    // echo json_encode($dataSet);
   //	 $tmpUserSurvey=new userSurvey("admin","admin",1);
    //     $dataSet=$tmpUserSurvey->getDataSet();
   //	 echo json_encode($dataSet);
   //   	   $tmpUrl=new surveyUrl();
    //  	   $tmpUrl->setUrl("7bfb3a7");
   //	   $tmpUrl->setSidFromDb();
   //	   $surveyId=$tmpUrl->getSurveyId();
   //	   $dc=new datachange($surveyId);
   //	   $dc->removeSurveyAndChildren();
         //setVal("userName","lgt");
         //setVal("password","5363513l");
      	 //$search=$_POST["data"];
   	 //$searchData=new userSurvey();
   	 //$searchData->setText("hello");
   	// $searchData->searchPack(6);
   	 //$dataSet=$searchData->getDataSet();
   	// echo json_encode($dataSet);
   	$myPackData=new packData("d64156c.php");
   	$dataSet=$myPackData->getDataSet();
   	var_dump($dataSet);
  ?>