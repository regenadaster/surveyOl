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
    goHome();
  }
  if($_GET["query"]=="adminLogout"){
    session_destroy();
    goHome();
  }
  if(@$_GET["query"]==="sign"){
   	@$username=$_POST["user"];
 	@$password=$_POST["password"];
 	@$password2=$_POST["password2"];
 	if($password!=$password2){
 		$str=<<<mark
  		    <script language="javascript"type="text/javascript">
			window.location.href="http://127.0.0.1:8081/surveyOI/doc/register.php";
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
 	  setVal("userName", $_POST["user"]);
 	  setVal("password", $_POST["password"]);
 	  $str=<<<mark
  		    <script language="javascript"type="text/javascript">
			window.location.href="http://127.0.0.1:8081/surveyOI/doc/home.php";
  			</script>
mark;
 	  echo  $str;
 	}
 	else{
 		$str=<<<mark
  		    <script language="javascript"type="text/javascript">
  			alert("÷ÿ–¬ ‰»Î")
			window.location.href="http://127.0.0.1:8081/surveyOI/doc/register.php";
  			</script>
mark;
 		echo  $str;

 	}
   }
   }
   if($_GET["query"]=="admin"){
   	 $username=$_POST["username"];
     $password=$_POST["password"];
     $adminUser=new user($username,$password);
     $res=$adminUser->checkAdmin();
     if($res){
       setVal("admin", "admin");
       goAdmin();
     }
     else{
       goAdminLogin();
     }
   }
   if($_GET["query"]=="remove"){
   	 $url=$_POST['url'];
   	 $tmpUrl=new surveyUrl();
   	 if(!empty($url)){
   	   $tmpUrl->setUrl($url);
   	   $tmpUrl->setSidFromDb();
   	   $surveyId=$tmpUrl->getSurveyId();
   	   $dc=new datachange($surveyId);
   	   $dc->removeSurveyAndChildren();
   	 }
   }
   if($_GET["query"]=="adminData"){
   	 if($_GET["time"]=="day"){
   	   $tmpUserSurvey=new userSurvey("admin","admin",1);
   	 }
   	 if($_GET["time"]=="week"){
   	   $tmpUserSurvey=new userSurvey("admin","admin",2);	 	
   	 }
   	 if($_GET["time"]=="month"){
   	   $tmpUserSurvey=new userSurvey("admin","admin",3); 	 	
   	 }
   	 if($_GET["all"]=="all"){
   	   $tmpUserSurvey=new userSurvey("admin","admin",4);
   	 }
   	 $dataSet=$tmpUserSurvey->getDataSet();
   	 echo json_encode($dataSet);
   }
   if($_GET["query"]=="searchAdmin"){
   	 $search=$_POST["data"];
   	 $searchData=new userSurvey();
   	 $searchData->setText($search);
   	 $searchData->searchPack(6);
   	 $dataSet=$searchData->getDataSet();
   	 echo json_encode($dataSet);   	
   }
   if($_GET["query"]=="search"){
   	 $search=$_POST["data"];
   	 $searchData=new userSurvey();
   	 $searchData->setText($search);
   	 $searchData->searchPack(5);
   	 $dataSet=$searchData->getDataSet();
   	 echo json_encode($dataSet);
   }
   if($_GET["query"]=="survey"){
     $dataSet=$_POST["dataSet"];
     $save=0;
     if($_GET["save"]=="1") $save=1;
     $_interpreter=new interpreter($dataSet,(int)$save);
     $_interpreter->echoUrl();
   }
   if($_GET["query"]=="userSurvey"){
   	 $remoteUser=new user();
     $remoteUser->setName(getVal("userName"));
     $remoteUser->setPasswd(getVal("password"));
     $tmpUserSurvey=new userSurvey($remoteUser);
     $dataSet=$tmpUserSurvey->getDataSet();
     echo json_encode($dataSet);
   }
   if($_GET['query']=="dataCollection"){
   	 $dataSet=$_POST["dataSet"];
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
   	 //echo ($dataSet["answer"]);
   }
   if($_GET["query"]=="statics"){
   	 $url=$_GET["url"];
     $collecter=new collectAnswer($url);
     $dataSet=$collecter->getAnswersArr();
     echo json_encode($dataSet);
   }
   if($_GET["query"]=="getBlocks"){
   	 $url=$_POST["surveyurl"];
   	 $url.=".php";
   	 $myPackData=new packData($url);
   	 $dataSet=$myPackData->getDataSet();
   	 setVal("save","hello");
   	 echo json_encode($dataSet);
   	 SetVal("save","world");
   }
   if($_GET["query"]=="set"){
     $setval=$_POST["set"];
     $begin=$_POST["begin"];
   	 $tmps=new survey();
   	 $tmps->setBegin($begin);
   	 $tmps->getSurveyByBegin();
   	 $now=date('Y-m-d H:i:s',time());
   	 if(((int)$setval)==2) {
   	   $tmps->setClose($now);
   	   $tmps->setCloseToDb();
   	   echo "Has Closed success,Thank You!";
   	 }
   	 if(((int)$setval)==1){
   	   $tmps->setRelease(1);
   	   $tmps->setPublishToDb();
   	   echo "Has Publish success,Thank You!";
   	 }
   }
  ?>
  