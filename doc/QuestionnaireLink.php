<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" media="screen" />
<link href="../lib/justified-nav.css" rel="stylesheet" media="screen" />
<script src="../jquery/jquery.js"></script>
<script src="../lib/questionNaire.js"></script>
<style type="text/css">
  body{
	background-color:#eee;
  }
  .nav-justified li{
  	color:#428bca;  	
  }
  #urlContainer{
    background-color:#fff;
  }
  #surveyContainer{
  	background-color:#fff;
	display:none;
  }
  #urlContainer{
  	margin-left:0px;
    border:solid;
  	border-color:#fff;
  	border-radius:5px;
  	height:300px;
  }
  #urlspan{
  	margin-top:50px;
  	border-color:#999;
  	border:solid 1px;
  	margin-bottom:10px;
  	padding-top:10px;
  	border-radius:2px;
  	padding-bottom:10px;
  	background-color:#eee;
  }
</style>
<title>Insert title here</title>
</head>

<body style="padding-top:0px;">
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
		<div class="col-md-8 col-md-offset-2">
		<ul class="nav nav-justified">
          <li class="active" id="surveyPublish"><a href="#">收集设置</a></li>
          <li id="surveyUrl"><a href="#">问卷链接</a></li>
          <li id="surveyTake"><a href="#">网站收集</a></li>
          <li id="surveyStatic"><a href="#">数据统计</a></li>
          <li id="surveyEmail"><a href="#">邮件邀请</a></li>
        </ul>
        </br>
        </br>
        <table class="table table-bordered" id="surveyContainer">
        	<thead>
        		<tr>
        			<th class="col-md-6">
        				闂嵎鍚�
        			</th>
        			<th class="col-md-1">
        				鎿嶄綔
        			</th>
        			<th class="col-md-1">
        			</th>
        			<th class="col-md-1">
        				鐘舵�
        			</th>
        			<th class="col-md-3">
        				鏌ヨ
        			</th>
        		</tr>
        	</thead>
        	<tbody>
        		<tr>
        			<td>
        				Q1
        			</td>
        			<td>
        				<button class="btn btn-default btn-sm">
        					淇敼
        				</button>
        			</td>
        			<td>
        				<button class="btn btn-default  btn-sm">
        					鍒犻櫎
        				</button>
        			</td>
        			<td>
    					<select class="selectpicker btn btn-default  btn-sm">
    					<option>
    					鍙戝竷
    					</option>
    					<option>
    					鍏抽棴
    					</option>
    					</select>
        			</td>
        			<td>
        				<a href="#">鍒嗘瀽璋冩煡缁撴灉</a>
        			</td>
        		</tr>
        		<tr>
        			<td>
        				Q1
        			</td>
        			<td>
        				<button class="btn btn-default btn-sm">
        					淇敼
        				</button>
        			</td>
        			<td>
        				<button class="btn btn-default  btn-sm">
        					鍒犻櫎
        				</button>
        			</td>
        			<td>
    					<select class="selectpicker btn btn-default  btn-sm">
    					<option>
    					鍙戝竷
    					</option>
    					<option>
    					鍏抽棴
    					</option>
    					</select>
        			</td>
        			<td>
        				<a href="#">鍒嗘瀽璋冩煡缁撴灉</a>
        			</td>
        		</tr>
        	</tbody>
        </table>
        <div class="row col-md-12" id="urlContainer">
          <div class="row col-md-offset-1">
            <h3>问卷访问链接</h3>
          </div>
          <div class="row col-md-offset-1">
            <span>可以直接把问卷访问链接复制到Email,或者聊天工具中直接发给被访问人</span>
          </div>
          <div class="row col-md-offset-1 col-md-10" id="urlspan">
            <span id="urlSpanVal"></span>
          </div>
        </div>
		</div>
	</div>
</body>
</html>