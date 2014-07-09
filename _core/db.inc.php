<?php
  require_once "../_core/_main.inc.php";
  class db{
  	private $isWhere;
  	private $link;
  	private $sqlsen;
  	private $isOpen;
  	private $result;
  	static private $instance;
  	private function __construct($host,$user,$passwd){
  	  $this->connect($host, $user, $passwd);
  	  //var_dump($this->link);
  	  $this->isOpen=true;
  	}
  	private function __clone(){}
  	public function __destruct(){
  	}
  	public function connect($host,$user,$passwd){
  	  $this->link=mysql_connect($host,$user,$passwd);
  	  if(!$this->link){
  	  	die("could not connect: ".mysql_error());
  	  }
  	  mysql_select_db("surveyoi",$this->link);
  	  mysql_query("set names utf-8");
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
  	public function getResultArray($type=MYSQL_ASSOC){
  	  $tmp=array();
  	  while($row = mysql_fetch_array($this->result,$type)){
  	  	$tmp[]=$row;
  	  }
  	  if(count($tmp)===1){
  	  	return $tmp[0];
  	  }
  	  else{
  	  	return $tmp;
  	  }
  	}
  	public function OrderBy($str,$asc=1){
  	  $this->sqlsen.=" order by `".$str."` ";
  	  if($asc==1){
  	    $this->sqlsen.=" asc";
  	  }
  	  else{
  	    $this->sqlsen.=" desc";
  	  }
  	}
  	public function query(){
  	  if(";"!=getLastChar($this->sqlsen)){
  	  	$this->sqlsen.=";";
  	  }
  	 // echo "   </br>";
  	  //var_dump($this->sqlsen);
  	  //echo "</br>";
  	  //var_dump($this->link);
  	  $this->result=mysql_query($this->sqlsen,$this->link);
  	  //var_dump($this->result);
  	  //echo "</br>";
  	  if(!$this->result){
  	  	die("error ".mysql_error());
  	  }
  	  $this->freshsql();
  	  $this->isWhere=false;
  	  return $this->result;
  	}
  	/***
  	 * you can use more than once where();
  	 */
  	public function where($judge){
  	  if($this->isWhere){
  	  	$this->sqlsen.=" ".$judge;
  	  }
  	  else{
  	  	$this->sqlsen.=" where ".$judge;
  	  	$this->isWhere=true;
  	  }
  	}
  	/***
  	 * select(array("user","problem"),array("userid","problemid"))
  	 * ========>
  	 * "select userid,problem
  	 *   from user,problem"
  	 * ===============================================
  	 * select("user","id")
  	 * ========>
  	 * "select id from user;"
  	 * 
  	 */
  	public function select($tables,$params="*"){
  	  $tmpstr.="select ";
  	  if(is_array($params)){
  	  	$str=implode($params,',');
  	  	$tmpstr.=$str;
  	  }
  	  else{
  	  	$tmpstr.=$params;
  	  }
  	  $tmpstr.=" from ";
  	  if(is_array($tables)){
  	  	$_str=implode($tables,',');
  	  	$tmpstr.=$_str;
  	  }
  	  else{
  	  	$tmpstr.=$tables;
  	  }
  	  $this->sqlsen.=$tmpstr;
  	}
  	public function groupBy($begin){
  	  if(!empty($begin)){
        $this->sqlsen.=" group by $begin";
  	  }
  	}
  	public function addLimit($begin,$end=""){
  	  $tmpstr="";
  	  $tmpstr.=" limit";
  	  if($end===""){
  	    $this->sqlsen.="$tmpstr $begin";
  	  }
  	  else{
  	  	$this->sqlsen.="$tmpstr $begin,$end";
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
    public function freshsql(){
      $this->sqlsen="";
    }
    public function close(){
      mysql_close($this->link);
    }
  }
  ?>