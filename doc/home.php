<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link href="../bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" media="screen" />
<script src="../jquery/jquery.js"></script>
<script src="../lib/home.js"></script>
<title>Insert title here</title>
<link rel="stylesheet" type="text/css" href="../css/common.css"/>
<style type="text/css">
  #sBottom{
    height:150px;
    background-color:#eaeaea;
  }
</style>
</head>
<body>
	<div class="container">
	   <div class="row">
		<div class="navbar-collapse collapse" style="background-color:#f8f8f8;border-color:#e7e7e7;">
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
		</div>
		<div class="row">
			<div class="jumbotron">
			    </br>
			    <div class="row">
			      <div class="col-lg-6 col-lg-offset-1">
			        <h1>NBD�ʾ�����</h1>
			      </div>
			    </div>
			        </br>
				<div class="row">
				 <div class="col-lg-6 col-lg-offset-1">
					<div class="input-group">
						<input type="text" class="form-control" />
						<span class="input-group-btn">
						<button class="btn btn-default" type="button">����</button>
						</span>
					</div>
				  </div>
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