<?php
  require_once "./_main.inc.php";
  class db{
  	private $link;
  	private $sqlsen;
  	static private $instance;
  	private function __construct($host,$user,$passwd){
  	  $this->connect($host, $user, $passwd);
  	}
  	private function __clone(){}
  	public function connect($host,$user,$passwd){
  	  $this->link=mysql_connect($host,$user,$passwd);
  	  if(!$this->link){
  	  	die("could not connect: ".mysql_error());
  	  }
  	  mysql_select_db("surveyoi",$this->link);
  	}
  	public function getInstance($host,$user,$passwd){
  	  if(!self::$instance instanceof db){
  	  	$this->instance=new db($host,$user,$passwd);
  	  }
  	  return $this->instance;
  	}
  	public function getResultNumber(){
  	  return $this->mysql_num_rows();
  	}
  	public function query(){
  	  echo $this->sqlsen;
  	  $res=mysql_query($this->sqlsen,$this->link);
  	  if(!$res){
  	  	die("error ".mysql_error());
  	  }
  	}
  	/*insert()ÊµÀý
  	 *   insert("user",array("name"=>"lgt","passwd"=>"5363513l"));
  	 *   =========>
  	 *   the sql sentence become "insert into user(name,passwd) values("lgt","5363513l")";
  	 *   
  	  */
  	public function insert($table,$params){
  	  $this->sqlsen.="insert into $table";
  	  if(is_assoc($params)){
  	  	$keys=array_keys($params);
  	  	$values=array_values($params);
  	  	$_params=implode($keys, ",");
  	  	$this->sqlsen.="($_params)";
  	  }
  	  else{
  	    $values=$params;
  	  }
  	  for($i=0;$i<count($values);$i++){
  	    if(is_string($values[$i])){
  	  	  $values[$i]='"'.$values[$i].'"';
  	    }
  	  }
      $tmpstr=implode($values,',');
      $valuesSql.='('.$tmpstr.');';
      $this->sqlsen.=" values".$valuesSql;
  	}
  	public function hello(){
  	  echo "hello";
  	}
  }
  ?>