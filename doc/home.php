<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="../bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" media="screen" />
<script src="../jquery/jquery.js"></script>
<title>Insert title here</title>

</head>
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
				<a href="http://127.0.0.1:8081/surveyOI/doc/login.html"><?php if($_SESSION["userName"]!="") echo $_SESSION["userName"]; else{ echo "��½";}?></a>
				</li>
				<li>
					<a href="http://127.0.0.1:8081/surveyOI/doc/register.html"><?php if($_SESSION["userName"]=="") echo "sign"; ?></a>
				</li>
			</ul>
		</div>
			<div class="jumbotron">
			    </br>
			    <div class="row">
			      <div class="col-lg-6 col-lg-offset-1">
			        <h1>NBD问卷系统</h1>
			      </div>
			    </div>
			        </br>
				<div class="row">
				 <div class="col-lg-6 col-lg-offset-1">
					<div class="input-group">
						<input type="text" class="form-control" />
						<span class="input-group-btn">
						<button class="btn btn-default" type="button">搜索问卷</button>
						</span>
					</div>
				  </div>
				 </div>
			</div>
		<div class="row">
			
		</div>
	</div>

</body>
</html>