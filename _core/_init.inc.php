<?php
  defined("HOST") || define("HOST","127.0.0.1");
  defined("SOCKET") || define("SOCKET","8081");
  defined("BASEDIR") || define("BASEDIR","/surveyOI/");
  defined("MYSQLHOST")|| define("MYSQLHOST","127.0.0.1");
  defined("MYSQLUSER")|| define("MYSQLUSER","root");
  defined("MYSQLPS") || define("MYSQLPS","");
  date_default_timezone_set('PRC');
  defined("BootstrapUrl")||define("BootstrapUrl",'../Bootstrap/dist/css/bootstrap.min.css');
  defined("Jquery")||define("Jquery","../Jquery/jquery.js");
  defined("BaseCss")||define("BaseCss","../css/base.css");
  defined("BaseJs")||define("BaseJs","../lib/createHtml.js");
  defined("PickerCss")||define("PickerCss","../pickerSrc/jquery.fs.picker.css");
  defined("PickerJs")||define("PickerJs","../pickerSrc/jquery.fs.picker.js");
  defined("DataCollectionJs")||define("DataCollectionJs","../lib/dataCollection.js");
  defined("maxInt")||define("maxInt",0x7fffffff);
  $utf8_string=mb_convert_encoding($gb_string, UTF-8,GB2312);
  ?>