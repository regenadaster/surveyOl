<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link href="../bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" media="screen" />
<link href="../lib/justified-nav.css" rel="stylesheet" media="screen" />
<script src="../jquery/jquery.js"></script>
<script src="../bootstrap/dist/js/bootstrap.js"></script>
<script src="../lib/common.js"></script>
<script src="../lib/user.js"></script>
<title>Insert title here</title>
<style type="text/css">
  th{
    background-color:#e7e7e7;
  }
  .addAndSearch{
    margin-top:-10px;
  }
</style>
</head>
<body style="padding-top:0px;">
	<div class="container">
	<div class="navbar-collapse collapse" style="background-color:#eaeaea;border-color:#e7e7e7; margin-bottom:20px;">
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
				<a href="#login">login</a>
				</li>
				<li>
					<a href="#sign">sign</a>
				</li>
			</ul>
		</div>
		<div class="col-md-10 col-md-offset-1">
		<div class="row" id="addAndSearch">
		  <div class="col-md-2">
		  <button type="button" class="btn btn-primary">+新建问卷</button>
		  </div>
		  <div class="col-md-2 col-md-offset-8" data-spy="affix" data-offset-top="60" data-offset-bottom="200">我会在这放搜索框
		  </div>
		</div>
		<div class="row col-md-12" style="height:20px"></div>
		<div class="row" id="userDataContainer">
         <table class="table table-bordered" id="userTable">
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
	</div>
</body>
</html>