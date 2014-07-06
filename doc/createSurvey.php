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
    body{
      background-color:#eee;
    }
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
    .removeTag{
      display:none;
      margin-top:-30px;
      padding-top:-30px;
    }
  </style>
  <body>
    <div class="container">
    		<div class="navbar-collapse collapse" style="background-color:#f8f8f8;border-color:#e7e7e7; margin-bottom:20px;">
			<ul class="nav navbar-nav">
				<a class="navbar-brand" href="#">System</a>
				<li class="active">
					<a href="http://127.0.0.1:8081/surveyOI/doc/home.php">Home</a>
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
				<a href="http://127.0.0.1:8081/surveyOI/doc/login.html"><?php if($_SESSION["userName"]!="") echo $_SESSION["userName"]; else{ echo "��½";}?></a>
				</li>
				<li>
					<a href="http://127.0.0.1:8081/surveyOI/doc/register.html"><?php if($_SESSION["userName"]=="") echo "sign"; ?></a>
				</li>
			</ul>
		</div>
	  <div class="row">
      <div class="row col-md-8 col-md-offset-2">
        <ul class="nav nav-tabs ">
          <li><a href="http://127.0.0.1:8081/surveyOI/doc/createSurvey.php" data-toggle="tab">�����µ��ʾ�</a></li>
          <li><a href="#profile" data-toggle="tab">�������е��ʾ�</a></li>
          <li><a href="#messages" data-toggle="tab">���ùٷ�ģ��</a></li>
          <li><a href="#settings" data-toggle="tab">���ù�������</a></li>
        </ul>
      </div>
      <div class="row col-md-8 col-md-offset-2"  id="titleRowSet">
        <div class="col-md-2">
          <span id="titleSet"></span>
        </div>
      </div>
      <div class="row col-md-8 col-md-offset-2">
        <div class="col-md-offset-3" id="editButton">
          <button type="button" class="btn btn-default" id="choice">��ѡ��</button>
          <button type="button" class="btn btn-default" id="multiplechoice">��ѡ��</button>
          <button type="button" class="btn btn-default" id="judge">�ж���</button>
          <button type="button" class="btn btn-default" id="eassyQuestion">�ʴ���</button>
          <button type="button" class="btn btn-default" id="publish">����</button>
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
         <span><h5 id="title">���ʾ����</h5></span>
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
          <button type="button" class="btn btn-primary" id="createBtn">�����ʾ�</button>
        </div>
      </div>
      <div class="col-md-10 col-md-offset-1" id="BlockContainer">
      </div>
      </div>
    </div>
  </body>
</html>