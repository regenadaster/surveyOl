<?php
  require_once "../_core/_main.inc.php";
  session_start();
  if(getVal("admin")==""){
    header("Location: http://127.0.0.1:8081/surveyOI/doc/adMinLogin.php");
  }
  ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" media="screen" />
<script src="../jquery/jquery.js"></script>
<script src="../bootstrap/dist/js/bootstrap.js"></script>
<script src="../lib/common.js"></script>
<script src="../lib/admin.js"></script>
<title>administrator</title>
<style type="text/css">
  #surveyTable thead{
    background-color:#e7e7e7;
  }
</style>
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
				<a href="http://127.0.0.1:8081/surveyOI/_core/server.php?query=adminLogout">logout</a>
				</li>
			</ul>
		</div>
		</br>
		</br>
		</br>
		<div data-spy="affix" datq-offset-top="200">
		  <button class="btn btn-primary" id="today">今日添加</button>
		  </br>
		  <button class="btn btn-default" id="thisWeek">今周添加</button>
		  </br>
		  <button class="btn btn-default" id="thisMonth">今月添加</button>
		  </br>
		  <button class="btn btn-default" id="all">全部问卷</button>
		</div>
		<div class="col-md-11 col-md-offset-1">
         <table class="table table-bordered" id="surveyTable">
          <thead>
            <tr>
              <th>
                                                      问卷标题
              </th>
              <th>
                                                        创建时间
              </th>
              <th>
                                                         状态
              </th>
              <th>
                                                       收到答案
              </th>
              <th class="col-md-4">
                                                        操作
              </th>
            </tr>
         
          </thead>
          </table>
        
		</div>
</div>
</body>
</html>