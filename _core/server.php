<?php
   session_start();
   require_once '../_core/_main.inc.php';
   //require_once './survey.inc.php';
   
  if(@$_GET["query"]==="login"){
  	 @$username=$_POST["user"];
  	 @$password=$_POST["password"];
  	 @$myuser=new user($username,$password);
  	 @$myuser->loopPage();
	  
	//@$myuser->createUser();
   }
  if($_GET["query"]=="logout"){
    $_SESSION["username"]='';
    $_SESSION["password"]='';
    session_destroy();
    header("Location: http://127.0.0.1:8081/surveyOI/doc/home.php");
  }
  if(@$_GET["query"]==="sign"){
   	@$username=$_POST["user"];
 	@$password=$_POST["password"];
 	@$password2=$_POST["password2"];
 	if($password!=$password2){
 		$str=<<<mark
  		    <script language="javascript"type="text/javascript">
  			alert("���벻һ����ButtonӦ�õ㲻���Ŷ�")
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
  			alert("ע��ɹ�����½ȥ�ɣ�")
			window.location.href="http://127.0.0.1:8081/surveyOI/doc/login.html";
  			</script>
mark;
 	  echo  $str;
 	}
 	else{
 		$str=<<<mark
  		    <script language="javascript"type="text/javascript">
  			alert("��������")
			window.location.href="http://127.0.0.1:8081/surveyOI/doc/register.html";
  			</script>
mark;
 		echo  $str;

 	}
   }
   }
   if($_GET["query"]=="survey"){
     $dataSet=$_POST["dataSet"];
     //echo $_SESSION["password"];
     $_interpreter=new interpreter($dataSet);
     $_interpreter->echoUrl();
   }
   if($_GET["query"]=="userSurvey"){
   	 $remoteUser=new user();
     $remoteUser->setName(getVal("userName"));
     $remoteUser->setPasswd(getVal("password"));
     $remoteUser->getAllSurveys();
   }
  ?>
  