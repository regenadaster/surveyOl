<?php
   session_start();
   require_once './_main.inc.php';
   //require_once './survey.inc.php';
   /*
  if(@$_GET["query"]==="login"){
  	 @$username=$_POST["user"];
  	 @$password=$_POST["password"];
  	 @$myuser=new user($username,$password);
  	 //var_dump($_POST["user"]);
  	 //var_dump($_POST["password"]);
  	 //var_dump($password);
  	 @$myuser->loopPage();
	  
	//@$myuser->createUser();
   }
  if(@$_GET["query"]==="sign"){
 	@$username=$_POST["user"];
 	@$password=$_POST["password"];
 	var_dump($username);
 	var_dump($password);
 	@$myuser=new user($username,$password);
 	if(@$myuser->regUser()){
 	  @$myuser->createUser();
 	}
 	else{
 	  echo"buhao";
 	}
   }
   if($_GET["query"]=="survey"){
    */
     $dataSet=$_POST["dataSet"];
     
     setVal("userName", "lgt");
     $optionOne=array();
     $optionTwo=array();
     $dataSet=array();
     $dataSet["title"]="okasdf";
     $dataSet["descript"]="hello sdfgasdfasdasdffasdfasdfworld";
     $optionOne["type"]=0;
     $optionTwo["type"]=1;
     $optionOne["descript"]="xuan sdfgasdfasdfasdfxiang yi";
     $optionTwo["descript"]="xuangasdfgdsfsasdfdf xiang er";
     $question=array();
     $questions=array();
     $question["descript"]="wenti one";
     $question["options"]=array();
     $question["options"][]=$optionTwo;
     $question["options"][]=$optionOne;
     $questions[]=$question;
     $dataSet["questions"]=$questions;
     $_interpreter=new interpreter($dataSet);
     
   	/*
   	$mysurvey=new survey("helloaasdsdfaaaaaaa gadasdfwoasdrld","asasdfasdasaaaafhello","asdfworld","asdflgt","1993-03-10 12:30:10","1993-03-10 12:30:10",0);
   	echo "after";
   	*/
    // echo json_encode($dataSet["questions"][0]["options"][0]["descript"]);
    //setVal("userName","lgt");
    $_interpreter=new interpreter($dataSet);
   //}
  ?>
  