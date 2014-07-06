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
    }
    </style>
  <body>
    <div class="container">
    <fieldset>
    <input type="radio" id="radio_1" name="radio_1" value="Radio One" />
    <label for="radio_1">One</label>
    <input type="radio" id="radio_2" name="radio_1" value="Radio One" />
        <label for="radio_2">One</label>
    <input type="radio" id="radio_3" name="radio_1" value="Radio One" /> 
        <label for="radio_3">One</label>
    <input type="radio" id="radio_4" name="radio_1" value="Radio One" />
        <label for="radio_4">One</label>
</fieldset>

<fieldset>
    <input type="checkbox" id="checkbox_1" name="checkbox_1" value="Checkbox One" />
    <label for="checkbox_1">One</label>
</fieldset>
    </div>
  </body>
</html>
