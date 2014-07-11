<?php session_start()?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link href="../bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" media="screen" />
<link href="../lib/justified-nav.css" rel="stylesheet" media="screen" />
<script src="../jquery/jquery.js"></script>
<script src="../hightCharts/js/highcharts.js"></script>
<script src="../lib/common.js"></script>
<script src="../lib/createPicture.js"></script>
<style type="text/css">
  body{
	background-color:#eee;
  	padding-top:0px;
  }
  .result{
	 border:solid;
  	border-color:#fff;
  	border-radius:5px;
  	background-color:#fff;
  	padding-bottom:50px;
  	padding-top:50px;
  	padding-left:20px;
  	padding-right:20px;
  }
  .single{
	 border:solid;
  	border-color:#eee;
  	border-width:1px;
 
  }
  .shead{
	background-color:#fafafa;
  	height:40px;
  	padding:5px 10px;
  }
  .sbody{
	margin:20px 200px;
  }
  .spic{
	padding:5px 10px;
  }
  .stable{
  	border:solid;
  	border-color:#eee;
  	border-width:1px;
  }
 </style>
<title>Insert title here</title>
</head>
<body>
  <div class="container">
	<div class="navbar-collapse collapse" style="background-color:#f8f8f8;border-color:#e7e7e7; margin-bottom:20px;">
			<ul class="nav navbar-nav">
				<a class="navbar-brand" href="#">System</a>
				<li class="active">
					<a href="http://127.0.0.1:8081/surveyOI/doc/home.php">Home</a>
				</li>
				<li>
                  <?php if($_SESSION["userName"]=="") echo '<a id="questionnaire" href="#">QuestionNaire</a>'; else{ echo '<a id="questionnaire" href="http://127.0.0.1:8081/surveyOI/doc/newCreateSurvey.php">QuestionNaire</a>';}?>
				</li>
				<li>
				<a href="#about">
					About
				</a>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li>
				<?php if($_SESSION["userName"]!="") echo '<a href="http://127.0.0.1:8081/surveyOI/doc/user.php">'.$_SESSION["userName"].'</a>'; else{ echo '<a href="http://127.0.0.1:8081/surveyOI/doc/login.html">login</a>';}?>
				</li>
				<li>
					<?php if($_SESSION["userName"]=="") echo '<a href="http://127.0.0.1:8081/surveyOI/doc/register.html">sign</a>';else{ echo '<a href="http://127.0.0.1:8081/surveyOI/_core/server.php?query=logout">logout</a>';} ?>
				</li>
			</ul>
		</div>
		<div class="result" id="results">
		  <h3 style="text-align:center" id="title"></h3>
		</div>

  </div>
</body>
</html>
