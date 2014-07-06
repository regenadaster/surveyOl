<?php
   session_start();
   require_once '../_core/_main.inc.php';
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
 	@$password2=$_POST["password2"];
 	if($password!=$password2){
 		$str=<<<mark
  		    <script language="javascript"type="text/javascript">
  			alert("密码不一样，Button应该点不动才对")
			window.location.href="http://127.0.0.1:8081/surveyOI/doc/register.html";
  			</script>
mark;
 		echo  $str;
 	}
 	else {
 	//var_dump($username);
 	//var_dump($password);
 	@$myuser=new user($username,$password);
 	if(@$myuser->regUser()){
 	  @$myuser->createUser();
 	  $str=<<<mark
  		    <script language="javascript"type="text/javascript">
  			alert("注册成功，登陆去吧！")
			window.location.href="http://127.0.0.1:8081/surveyOI/doc/login.html";
  			</script>
mark;
 	  echo  $str;
 	}
 	else{
 		$str=<<<mark
  		    <script language="javascript"type="text/javascript">
  			alert("重新输入")
			window.location.href="http://127.0.0.1:8081/surveyOI/doc/register.html";
  			</script>
mark;
 		echo  $str;

 	}
   }
   }
   if($_GET["query"]=="survey"){
     $dataSet=$_POST["dataSet"];
     //echo $dataSet["descript"];
     setVal("userName","lgt");
     $_interpreter=new interpreter($dataSet);
     $_interpreter->echoUrl();
   }
  ?>
  