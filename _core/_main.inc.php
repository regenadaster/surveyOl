<?php
  require_once "_init.inc.php";
  function __autoload($class_name){
    $fileName=$class_name.'.inc.php';
    if(file_exists($class_name.'.inc.php')){
  	  require_once $class_name.'.inc.php';
    }
  	else{
  	  $fileName="../_core/createHtml.inc.php";
  	  if(file_exists($fileName)){
       require_once "../_core/createHtml.inc.php";
  	  }
  	}
  }
  function is_assoc($arr){
  	if(is_array($arr)){
  	  $keys=array_keys($arr);
  	  return $keys!=array_keys($keys);
  	}
  	return false;
  }
  function is_two_dim_array($arr){
  	$d=1;
  	foreach($arr as $val){
  	  if(is_array($val)){
  	  	$d=2;
  	  	break;
  	  }
  	}
  	return $d;
  }
  function strindex($str,$index){
  	$len=strlen($str);
  	if($index>=$len){
  	  return false;
  	}
  	else{
  	  return substr($str,$index,1);
  	}
  }
  function getLastChar($str){
  	return strindex($str,strlen($str)-1);
  }
  function getVal($name){
    return $_SESSION[$name];
  }
  function setVal($name,$val){
    $_SESSION[$name]=$val;
  }
  function myUlrmd5($str){
  	$str.="survey";
  	$newStr=md5($str);
    return substr($newStr,0,7);
  }
  ?>