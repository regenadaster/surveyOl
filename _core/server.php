<?php
   require_once './_main.inc.php';
   //require_once './survey.inc.php';
   if($_GET["query"]==="login"){
     var_dump($_POST["user"]);
     var_dump($_POST["password"]);
   }
   if($_GET["query"]==="survey"){
   	 echo "before new";
     $mysurvey=new survey("helloasdfaaaaaaa gadasdfworld","asdfasdasaaaafhello","asdfworld","asdflgt","1993-03-10 12:30:10","1993-03-10 12:30:10",0);
     echo "after new";
     $mysurvey->addProblem(new problem(1,"are you a girl"));
     $mysurvey->createSurvey();
     
   }
  ?>
  