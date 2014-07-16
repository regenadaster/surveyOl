<?php
  session_start();
  require_once '../_core/_main.inc.php'; 
  if(IsAnonymous()){
    header("Location: http://127.0.0.1:8081/surveyOI/doc/login.php");
  }
?>
<html>
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=gb2312">
  <title>createSurvey</title>
  <link rel="stylesheet" href="../Bootstrap/dist/css/bootstrap.min.css" type="text/css">  
  <script type="text/javascript" src="../Jquery/jquery.js"></script>
  <script type="text/javascript" src="../pickerSrc/jquery.fs.picker.js"></script>
  <link rel="stylesheet" type="text/css" href="../pickerSrc/jquery.fs.picker.css">
  <script type="text/javascript" src="../jquery-ui/jquery-ui.min.js"></script>
  <script type="text/javascript" src="../lib/common.js"></script>
  <script type="text/javascript" src="../lib/action.js"></script>
  <script type="text/javascript" src="../lib/newCreateSurvey.js"></script>
  <script type="text/javascript" src="../lib/surveyDataProcess.js"></script>
  <style type="text/css">
    #createRow{
    }
    #editButton{
      display:none;
    }
    .rightSide{
      margin-right:0;
    }
    .block{
      padding-top:10;
      padding-bottom:10;
      border-style:solid;
      border-color:#e7e7e7;
      background-color:#fff;
      border-radius:5px;
      cursor:text;
    }
    .block:hover{
      background-color:#FDF9CD;
    }
    .option{
    	
    }
    .addTAG{
      display:none;      
    }
    .addTAG:hover{
      cursor:hand;
    }
    .removeTagDiv{
      border-style:solid;
      border-color:#e7e7e7;
      border-radius:5px;
    }
    #titleRow{
    }
    #sytitle{
      text-align:center;
      margin-right:-5px;
    }
    .preDiv{
      height:20px;
      border:solid;
      padding-left:30px;
      border-color:#eee;
      background-color:#fff;
    }
    .blocks{
      background-color:#fff;
    }
    #titleBlocks{
      text-align:center;
    }
    .limit{
      max-width:400px;
    }
    .oneLimit{
    }
    #table1{
      text-align:center;
    }
    .glyphicon{
      display:none;
    }
    #addBorder{
      background-color:#efefef;
      margin-left:300px;
      border-bottom:solid 1px;
      border-right:solid 1px;
      border-left:solid 1px;
      border-color:#e7e7e7;
    }
   #sBottom{
     height:150px;
     background-color:#eaeaea;
     margin-top:150px;
   }
  </style>
  <link rel="stylesheet" type="text/css" href="../css/common.css"/>
  </head>
  <body>
    <div class="container">
            <div class="row">
    		<div class="navbar-collapse collapse" style="background-color:#f8f8f8;border-color:#e7e7e7; margin-bottom:20px;">
			<ul class="nav navbar-nav">
				<a class="navbar-brand" href="#">System</a>
				<li class="active">
					<a href="http://127.0.0.1:8081/surveyOI/doc/home.php">Home</a>
				</li>
				<li>
				<a href="#questionnaire">
					Questionnaire
				</a>
				</li>
				<li>
				<a href="#about">
					About
				</a>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li>
				<?php if($_SESSION["userName"]!="") echo '<a href="http://127.0.0.1:8081/surveyOI/doc/user.php">'.$_SESSION["userName"].'</a>'; else{ echo '<a href="http://127.0.0.1:8081/surveyOI/doc/login.php">login</a>';}?>
				</li>
				<li>
					<?php if($_SESSION["userName"]=="") echo '<a href="http://127.0.0.1:8081/surveyOI/doc/register.php">sign</a>';else{ echo '<a href="http://127.0.0.1:8081/surveyOI/_core/server.php?query=logout">logout</a>';} ?>
				</li>
			</ul>
		</div>
	  <div class="row">
      <div class="navbar-collapse collapse col-md-8 col-md-offset-3" >
        <ul class="nav nav-tabs">
          <li class="active"><a href="http://127.0.0.1:8081/surveyOI/doc/newCreateSurvey.php">创建新的问卷</a></li>
          <li><a href="#profile">复制现有的问卷</a></li>
          <li><a href="#messages">引用官方模板</a></li>
          <li><a href="#settings">引用共享问题</a></li>
        </ul>
      </div>
      </div>
      <div class="row col-md-8 col-md-offset-2"  id="titleRowSet">
        <div>
          <span id="titleSet"></span>
        </div>
      </div>
      <div class="row col-md-8 col-md-offset-2">
        <div class="col-md-offset-3" id="editButton">
          <button type="button" class="btn btn-default" id="choice">单选题</button>
          <button type="button" class="btn btn-default" id="multiplechoice">多选题</button>
          <button type="button" class="btn btn-default" id="judge">判断题</button>
          <button type="button" class="btn btn-default" id="eassyQuestion">问答题</button>
          <button type="button" class="btn btn-default" id="publish">发布</button>
          <button type="button" class="btn btn-default" id="saveSurvey">保存</button>
        </div>
      </div>
      <div class="row col-md-5 col-md-offset-3" id="addBorder">
      <div class="row hideStyle" style="height:100px"></div>
      <div class="row" id="titleRow">
        <div class="col-md-4 col-md-offset-2">
         <span id="sytitle">新问卷标题</span>
         </div>
        <div class="col-md-5">
          <input type="text" class="form-control" id="titleVal"/>
        </div>
      </div>
      </br>
      <div class="row" style="height:20px"></div>
      <div class="row col-md-8 col-md-offset-2" id="createRow">
        <div class="col-md-offset-2">
          <button type="button" class="btn btn-primary" id="createBtn">创建问卷</button>
        </div>
      </div>
      <div class="row hideStyle" style="height:80px"></div>
      </div>
      </div>
      <div class="row">
      <div class="col-md-8 col-md-offset-2" id="BlockContainer">
        <div class="row" id="blocksContent">
        </div>
      </div>
      </div>
      <div class="row">
        <div class="col-md-12" id="sBottom">
          <div class="row" style="height:50px;"></div>
          <span id="cr">@2014 by lgt regenadaster@gmail.com</span>
        </div>
      </div>
    </div>
  </body>
</html>