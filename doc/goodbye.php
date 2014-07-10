<?php session_start()?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link href="../bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" media="screen" />
<script src="../jquery/jquery.js"></script>
<script>
  GoHome=function(){
	window.location="http://127.0.0.1:8081/surveyOI/doc/home.php";
  }
  binFun=function(){
    $("#goHome").click(GoHome);
  }
  $(document).ready(binFun);

</script>
  <style type="text/css">
  body{
	background-color:#eee;
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
				<?php if($_SESSION["userName"]!="") echo '<a href="http://127.0.0.1:8081/surveyOI/doc/user.php">'.$_SESSION["userName"].'</a>'; else{ echo '<a href="http://127.0.0.1:8081/surveyOI/doc/login.php">login</a>';}?>
				</li>
				<li>
					<?php if($_SESSION["userName"]=="") echo '<a href="http://127.0.0.1:8081/surveyOI/doc/register.html">sign</a>';else{ echo '<a href="http://127.0.0.1:8081/surveyOI/_core/server.php?query=logout">logout</a>';} ?>
				</li>
			</ul>
		</div>
		<div style="text-align:center; background:url('../lib/back.jpg'); width:100%; height:400px; padding:100px 100px;">
			<h2>感谢您参与本次调查!</h2>
			<button class="btn btn-default" id="goHome">返回首页</button>
		</div>
	</div>
</body>
</html>