<?php
   require_once './_main.inc.php';
   //require_once './survey.inc.php';
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
   if($_GET["query"]==="survey"){
   	 echo "before new";
     $mysurvey=new survey("helloasdfaaaaaaa gadasdfworld","asdfasdasaaaafhello","asdfworld","asdflgt","1993-03-10 12:30:10","1993-03-10 12:30:10",0);
     echo "after new";
     $mysurvey->addProblem(new problem(1,"are you a girl"));
     $mysurvey->createSurvey();
     
   }
  ?>
  