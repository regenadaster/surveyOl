<html>
  <meta http-equiv="Content-Type" content="text/html; charset=gb2312">
  <title>createSurvey</title>
  <link rel="stylesheet" href="../Bootstrap/dist/css/bootstrap.min.css" type="text/css">  
  <script type="text/javascript" src="../Jquery/jquery.js"></script>
  <script type="text/javascript" src="../lib/common.js"></script>
  <script type="text/javascript" src="../lib/createSurvey.js"></script>
  <script type="text/javascript" src="../lib/surveyDataProcess.js"></script>
  <style type="text/css">
    #editButton{
      display:none;
    }
    .rightSide{
      margin-right:0;
    }
    #title{
      margin-left:50;
    }
    .block{
      padding-top:10;
      padding-bottom:10;
      border-style:solid;
      border-color:#e7e7e7;
      border-radius:5px;
      cursor:text;
    }
    .block:hover{
      background-color:#FDF9CD;
    }
    .option{
    	
    }
    .addTAG{
      display:none;      
    }
    .addTAG:hover{
      cursor:hand;
    }
  </style>
  <body>
    <div class="container">
      <div class="row">
        <ul class="nav nav-tabs">
          <li><a href="#home" data-toggle="tab">�����µ��ʾ�</a></li>
          <li><a href="#profile" data-toggle="tab">�������е��ʾ�</a></li>
          <li><a href="#messages" data-toggle="tab">���ùٷ�ģ��</a></li>
          <li><a href="#settings" data-toggle="tab">���ù�������</a></li>
        </ul>
      </div>
      <div class="row" id="titleRowSet">
        <div class="col-md-2">
          <span id="titleSet"></span>
        </div>
      </div>
      <div class="row">
        <div class="col-md-offset-3" id="editButton">
          <button type="button" class="btn btn-default" id="choice">��ѡ��</button>
          <button type="button" class="btn btn-default" id="multiplechoice">��ѡ��</button>
          <button type="button" class="btn btn-default" id="judge">�ж���</button>
          <button type="button" class="btn btn-default" id="eassyQuestion">�ʴ���</button>
          <button type="button" class="btn btn-default" id="preview">Ԥ��</button>
          <button type="button" class="btn btn-default" id="publish">����</button>
        </div>
      </div>
      </br>
      </br>
      <div class="row" id="titleRow">
        <div class="col-md-2">
         <span><h5 id="title">���ʾ����</h5></span>
         </div>
        <div class="col-md-3">
          <input type="text" class="form-control" id="titleVal"/>
        </div>
      </div>
      </br>
      </br>
      <div class="row" id="createRow">
        <div class="col-md-offset-2">
          <button type="button" class="btn btn-primary" id="createBtn">�����ʾ�</button>
        </div>
      </div>
      <div id="BlockContainer">
      
      </div>
    </div>
  </body>
</html>