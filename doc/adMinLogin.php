<?php session_start()?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link href="../bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" media="screen" />
<script src="../jquery/jquery.js"></script>
<title>administratorLogin</title>
<style type="text/css">
  #loginForm{
    border:solid 1px;
  	border-color:#eee;
  	border-radius:5px;
  	background-color:#c7c7c7;
  }
</style>
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
				<a href="#login">login</a>
				</li>
				<li>
					<a href="#sign">sign</a>
				</li>
			</ul>
		</div>
		<div class="row" style="height:100px;"></div>
		<div class="row col-md-6 col-md-offset-2" id="loginForm">
		<div class="row" style="height:50px;"></div>
		<form role="form" class="form-horizontal" action="http://127.0.0.1:8081/surveyOI/_core/server.php?query=admin" method="post">
		  <div class="form-group">
		    <label for="username" class="control-label col-md-3 col-md-offset-1">用户名:</label>
		    <div class="col-md-4">
		      <input type="text" class="form-control" name="username" placeholder="username">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="password" class="control-label col-md-3 col-md-offset-1">密码:</label>
		    <div class="col-md-4">
		      <input type="password" class="form-control" name="password" placeholder="password">
		    </div>
		  </div>
		  <div class="row" style="height:30px;"></div>
		  <div class="form-group">
		    <div class="col-md-offset-4 col-md-8">
		      <button type="submit" class="btn btn-primary">sign in</button>
		    </div>
		  </div>
		</form>
		<div class="row" style="height:50px;"></div>
		</div>
    </div>
  </body>
</html>