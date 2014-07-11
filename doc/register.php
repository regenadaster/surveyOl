<?php?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link href="../bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" media="screen" />
<script type="text/javascript">
	function check(){
		document.getElementById("ms").innerHTML="";
		var p1=document.getElementById("pw1").value;
		var p2=document.getElementById("pw2").value;
		if(p1!=p2){
			document.getElementById("ms").innerHTML="两次输入密码不一致，请重新输入";
		}
	}
	function checkn()
	{
		var p1=document.getElementById("n").value;
		if(p1=="")
			{
			document.getElementById("ns").innerHTML="不能为空！";
			}
		else
			{
			document.getElementById("ns").innerHTML="";
			}
	}
</script>
<script src="../Jquery/jquery.js"></script>
<title>Insert title here</title>
<style type="text/css">
  .logintable{
    background-color:#e7e7e7;
  	width:600px;
  	padding-top:50px;
  	padding-bottom:50px;
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
		<form class="form-horizontal" action="http://127.0.0.1:8081/surveyOI/_core/server.php?query=sign" method="post">
			</br>
			</br>
			</br>
		<div class="logintable col-md-offset-2">
			<div class="form-group"">
            	<label class="col-md-2 control-label col-md-offset-3" for="user">用户名：</label>
           		<div class="col-md-3">
                	<input class="form-control" type="text" placeholder="不能为空" name="user" id="n" onblur="checkn()"/>
            	</div>
            	<div id="ns" style="color:red;"></div>
        	</div>
        	<div class="form-group"">
            	<label class="col-md-2 control-label col-md-offset-3" for="password">密码:</label>
           		<div class="col-md-3">
                	<input class="form-control" type="password" name="password" id="pw1"/>
            	</div>
        	</div>
        	<div class="form-group"">
            	<label class="col-md-2 control-label col-md-offset-3" for="password2">确认密码:</label>
           		<div class="col-md-3">
                	<input class="form-control" type="password" name="password2" id="pw2" onblur="check()"/>
            	</div>
            	<div id="ms" style="color:red;"></div>
        	</div>
        	<div class="form-group"">
            	<label class="col-md-2 control-label col-md-offset-3" for="Email">Email:：</label>
           		<div class="col-md-3">
                	<input class="form-control" type="text" name="Email"/>
            	</div>
        	</div>
        	</br>
        	<button class="btn btn-primary col-md-2 col-md-offset-4" type="submit" id="signup">提交</button>
        </div>
		</form>
	</div>
</body>
</html>
