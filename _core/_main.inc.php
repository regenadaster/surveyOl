<?php
  function __autoload($class_name){
  	require_once $class_name.'.inc.php';
  }
  function is_assoc($arr){
  	if(is_array($arr)){
  	  $keys=array_keys($arr);
  	  return $keys!=array_keys($keys);
  	}
  	return false;
  }
  ?>