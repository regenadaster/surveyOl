<?php
  require_once "../_core/_main.inc.php";
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
     $dataSet["title"]="你好吗asdfasdf";
     $dataSet["descript"]="我很好asdfasdf";
     $optionOne["type"]=0;
     $optionTwo["type"]=1;
     $optionOne["descript"]="我的天啊asdfasdf";
     $optionTwo["descript"]="你的天啊asdfasdf";
     $question=array();
     $questions=array();
     $question["descript"]="wentasigsdfgsdfg oneasdfasdf";
     $question["options"]=array();
     $question["options"][]=$optionTwo;
     $question["options"][]=$optionOne;
     $questions[]=$question;
     $quT=array();
     $quT["descript"]="hellosdfgsdfg world";
     $opt_one=array();
     $opt_two=array();
     $opt_one["type"]=0;
     $opt_one["descript"]="xuan xiangsdfg adsfyi";
     $opt_two["descript"]="xuan xiangsdfgsdfg asdfer";     
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
     //$dataSet=$_POST["dataSet"];
     setVal("userName","lgt");
     $_interpreter=new interpreter($dataSet);
     $_interpreter->echoUrl();
   // $myhtml=new createHtml($dataSet,1);
    //echo "hello";
    //var_dump($myhtml);
  ?>