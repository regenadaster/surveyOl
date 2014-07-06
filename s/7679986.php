<?php $fatherFile=__FILE__;
  	   	  require_once "../_core/packData.inc.php";
  	  	  require_once "../_core/createHtml.inc.php";
  	   	  $myPackData= new packData($fatherFile);
  	   	  $dataSet=$myPackData->getDataSet();
  	   	  $myHtml=new createHtml($dataSet,0);
  	  ?>