<?php session_start()?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312"/> 
<title>login</title>
<link href="../bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" media="screen" />
<script src="../jquery/jquery.js"></script>
<style type="text/css">
 body{
  background-color:#eee;
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
				  <?php if($_SESSION["userName"]!="") echo '<a href="http://127.0.0.1:8081/surveyOI/doc/user.php">'.$_SESSION["userName"].'</a>'; else{ echo '<a href="http://127.0.0.1:8081/surveyOI/doc/login.php">login</a>';}?>
				</li>
				<li>
					<?php if($_SESSION["userName"]=="") echo '<a href="http://127.0.0.1:8081/surveyOI/doc/register.html">sign</a>';else{ echo '<a href="http://127.0.0.1:8081/surveyOI/_core/server.php?query=logout">logout</a>';} ?>
				</li>
			</ul>
		</div>
		</br>
		</br>
		</br>
	    </br>
	    </br>
	    </br>
    <form class="form-horizontal" action="http://127.0.0.1:8081/surveyOI/_core/server.php?query=login" method="post">
        <div class="form-group">
            <label class="col-sm-2 control-label col-sm-offset-2" for="user">用户名：</label>
            <div class="col-sm-3">
                <input class="form-control" type="text" placeholder="不能为空" name="user"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label col-sm-offset-2" for="password">密码：</label>
            <div class="col-sm-3">
                <input class="form-control" type="password"  placeholder="" name="password" />
            </div>
        </div>
        <div class="form-group">
        	<div class="col-sm-offset-4 col-sm-10">
 				<label class="checkbox"><input type="checkbox" />记住我</label>
        	</div>
            <div class="col-sm-offset-4 col-sm-10">
                <button class="btn btn-primary" type="submit" id="login">登陆</button>
                <button class="btn" type="reset">取消</button>
            </div>
        </div>
    </form>
    </div>
</body>
</html>
