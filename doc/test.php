<?php session_start();?>
<html>
  <meta http-equiv="Content-Type" content="text/html; charset=gb2312">
  <title>createSurvey</title>
  <link rel="stylesheet" href="../Bootstrap/dist/css/bootstrap.min.css" type="text/css">  
  <script type="text/javascript" src="../Jquery/jquery.js"></script>
  <script src="../pickerSrc/jquery.fs.picker.js"></script>
  <link href="../pickerSrc/jquery.fs.picker.css" rel="stylesheet">
  <script type="text/javascript">
  $(document).ready(function() {$("input[type=radio], input[type=checkbox]").picker();});
  </script>
  <style type="text/css">
    body{
      background-color:#eee;
      font-size:18;
    }
    #syHeader{
      background-color:#FDF9CD;
      height:40px;
    }
    #syBody{
      background-color:#fff;
      height:300px;
    }
    #sytitle{
     text-align:center;
    }
    #blueLine{
      height:3px;
      background-color:#55a1e3;
    }
    .margin_top{
      margin-top:20px;	
    }
    </style>
  <body>
    <div class="container">
      <div class="row">
        <div id="syHeader" class="col-md-8 col-md-offset-2">
          hello this is title;
        </div>
      </div>
      <div class="row" style="height:30px">
      </div>
      <div class="row">
        <div id="syBody" class="col-md-8 col-md-offset-2">
          <div class="row">
            <div id="sytitle" class="margin_top">
              good nigth!
            </div>
          </div>
          <div class="row">
            <div id="descript" class="margin_top col-md-offset-1">
              good night;
            </div>
          </div>
          <div class="row">
            <div id="blueLine" class="margin_top col-md-offset-1 col-md-10">
          
            </div>
          </div>
          <div class="row">
            <div class="question margin_top col-md-offset-1">
              1.adsfasdfasdf
            
            </div>
          </div>
          <div class="row">
            <div class="question margin_top col-md-offset-1">
                <input type="radio" id="radio_1" name="radio_1" value="a" />
                <label for="radio_1">One</label>
                <input type="checkbox" id="checkbox_1" name="checkbox_1" value="b" />
                <label for="checkbox_1">One</label>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
