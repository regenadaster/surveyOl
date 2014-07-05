<?php
  require_once "./_main.inc.php";
  /*
  $sUrl=new surveyUrl();
  $sUrl->setUrl("asdfghjkl");
  $sUrl->setSidFromDb();
  var_dump($sUrl->getSurveyId());
  */
  /*
     setVal("userName", "lgt");
     $optionOne=array();
     $optionTwo=array();
     $dataSet=array();
     $dataSet["title"]="okasdfsfasdfdgasdf";
     $dataSet["descript"]="helafasasdfdfworld";
     $optionOne["type"]=0;
     $optionTwo["type"]=1;
     $optionOne["descript"]="xuan asdfassd";
     $optionTwo["descript"]="xuangasasdfasddfgang er";
     $question=array();
     $questions=array();
     $question["descript"]="wentasi one";
     $question["options"]=array();
     $question["options"][]=$optionTwo;
     $question["options"][]=$optionOne;
     $questions[]=$question;
     $dataSet["questions"]=$questions;
     $_interpreter=new interpreter($dataSet);
   */
    //$mysurvey=new survey();
    //$mysurvey->setIdByHand(105);
    //$mysurvey->AddProblemById();
    //var_dump($mysurvey);
    $myhtml=new divTag();
    $myhtml->addAttr("class","hello")->addAttr("class","myhtmltag");
    $myhtml->addAttr("class",array("world","good"))->addAttr(array("id"=>"night"));
    $myhtml->echoHtml();
    var_dump($myhtml);
  ?>