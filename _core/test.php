<?php
  require_once "./_main.inc.php";
  /*
  $sUrl=new surveyUrl();
  $sUrl->setUrl("asdfghjkl");
  $sUrl->setSidFromDb();
  var_dump($sUrl->getSurveyId());
  */
  
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
     $quT=array();
     $quT["descript"]="hello world";
     $opt_one=array();
     $opt_two=array();
     $opt_one["type"]=0;
     $opt_one["descript"]="xuan xiang yi";
     $opt_two["descript"]="xuan xiang er";     
     $opt_two["type"]=0;  
     $quT["options"][]=$opt_one;
     $quT["options"][]=$opt_two;
     $questions[]=$quT;
     $dataSet["questions"]=$questions;
     //$_interpreter=new interpreter($dataSet);
   
    //$mysurvey=new survey();
    //$mysurvey->setIdByHand(105);
    //$mysurvey->AddProblemById();
    //var_dump($mysurvey);
    //$myhtml=new divTag();
   // $myhtml->addAttr("class","hello")->addAttr("class","myhtmltag");
    //$myhtml->addAttr("class",array("world","good"))->addAttr(array("id"=>"night"));
    //$myhtml->echoHtml();
    //var_dump($myhtml);
    $myhtml=new createHtml($dataSet,1);
    //echo "hello";
    //var_dump($myhtml);
  ?>