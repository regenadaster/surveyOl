<?php session_start();?>
<html>
  <meta http-equiv="Content-Type" content="text/html; charset=gb2312">
  <title>createSurvey</title>
  <link rel="stylesheet" href="../Bootstrap/dist/css/bootstrap.min.css" type="text/css">  
  <script type="text/javascript" src="../Jquery/jquery.js"></script>
  <script type="text/javascript" src="../lib/common.js"></script>
  <script type="text/javascript" src="../lib/createSurvey.js"></script>
  <script type="text/javascript" src="../lib/surveyDataProcess.js"></script>
  <style type="text/css">
    #editButton{
      display:none;
    }
    .rightSide{
      margin-right:0;
    }
    #title{
      margin-left:50;
    }
    .block{
      padding-top:10;
      padding-bottom:10;
      border-style:solid;
      border-color:#e7e7e7;
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
  </style>
  <body>
    <div class="container">
    		<div class="navbar-collapse collapse" style="background-color:#f8f8f8;border-color:#e7e7e7; margin-bottom:20px;">
			<ul class="nav navbar-nav">
				<a class="navbar-brand" href="#">System</a>
				<li class="active">
					<a href="#">Home</a>
				</li>
				<li>
				<a href="http://127.0.0.1:8081/surveyOI/doc/createSurvey.php">
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
				<a href="http://127.0.0.1:8081/surveyOI/doc/login.html"><?php if($_SESSION["userName"]!="") echo $_SESSION["userName"]; else{ echo "登陆";}?></a>
				</li>
				<li>
					<a href="http://127.0.0.1:8081/surveyOI/doc/register.html"><?php if($_SESSION["userName"]=="") echo "sign"; ?></a>
				</li>
			</ul>
		</div>
	  <div class="row">
      <div class="row col-md-8 col-md-offset-2">
        <ul class="nav nav-tabs ">
          <li><a href="#home" data-toggle="tab">创建新的问卷</a></li>
          <li><a href="#profile" data-toggle="tab">复制现有的问卷</a></li>
          <li><a href="#messages" data-toggle="tab">引用官方模板</a></li>
          <li><a href="#settings" data-toggle="tab">引用共享问题</a></li>
        </ul>
      </div>
      <div class="row col-md-8 col-md-offset-2"  id="titleRowSet">
        <div class="col-md-2">
          <span id="titleSet"></span>
        </div>
      </div>
      <div class="row col-md-8 col-md-offset-2">
        <div class="col-md-offset-3" id="editButton">
          <button type="button" class="btn btn-default" id="choice">单选题</button>
          <button type="button" class="btn btn-default" id="multiplechoice">多选题</button>
          <button type="button" class="btn btn-default" id="judge">判断题</button>
          <button type="button" class="btn btn-default" id="eassyQuestion">问答题</button>
          <button type="button" class="btn btn-default" id="preview">预览</button>
          <button type="button" class="btn btn-default" id="publish">发布</button>
        </div>
      </div>
      </br>
      </br>
      </br>
      </br>
      </br>
      </br>
      </br>
      <div class="row col-md-8 col-md-offset-2" id="titleRow">
        <div class="col-md-3">
         <span><h5 id="title">新问卷标题</h5></span>
         </div>
        <div class="col-md-3">
          <input type="text" class="form-control" id="titleVal"/>
        </div>
      </div>
      </br>
      </br>
            </br>
      </br>
            </br>

      <div class="row col-md-8 col-md-offset-2" id="createRow">
        <div class="col-md-offset-2">
          <button type="button" class="btn btn-primary" id="createBtn">创建问卷</button>
        </div>
      </div>
      <div class="col-md-10 col-md-offset-1" id="BlockContainer">
      </div>
      </div>
    </div>
  </body>
</html>