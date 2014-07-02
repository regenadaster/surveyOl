<?php
  require_once './_main.inc.php';
  class survey{
  	private $id;
  	private $title;
  	private $subject;
  	private $descript;
  	private $owner;
  	private $begin;
  	private $end;
  	private $sDb;
  	private $close;
  	private $isRelease;
  	private $isCreate;
  	private $problems;//$problems is a array of problem class
  	public function __construct($title="",$subject="",$descript="",$owner="",$begin="",$close="",$isRelease=0){
  	  $this->setTitle($title);
  	  $this->setSubject($subject);
  	  $this->setDescript($descript);
  	  $this->setOwner($owner);
  	  $this->setBegin($begin);
  	  $this->setClose($close);
  	  $this->setRelease($isRelease);
  	  @$this->sDb=db::getInstance(MYSQLHOST,MYSQLUSER,MYSQLPS);
  	  $this->isCreate=false;
  	  $problems=array();
  	}
  	public function setRelease($isre){
  	  $this->isRelease=$isre;
  	}
  	public function addProblem($problem){
  	  if($problem instanceof problem){
  	  	$this->problems[]=$problem;
  	  }
  	}
  	public function selectIdByTitleSubject(){
  	  $this->sDb->select("survey","id");
  	  $this->sDb->where("title=\"$this->title\" AND owner=\"$this->owner\" AND subject=\"$this->subject\"");
  	  $this->sDb->query();
  	  $tmp=$this->sDb->getResultArray();
  	  return $tmp;  	  
  	}
  	public function checkIsValidate(){
  	  $res=$this->selectIdByTitleSubject();
      if(empty($res)){
      	return true;
      }
      else{
      	return false;
      }
  	}
  	public function setSid(){
      $res=$this->selectIdByTitleSubject();
  	  $this->id=(int)$res["id"];
  	}
  	public function getSid(){
  	  if($this->id==0){
  	  	echo "set id      ";
  	  	$this->setSid();
  	  }
  	  return $this->id;
  	}
  	public function setTitle($_title){
  	  $this->title=$_title;
  	}
  	public function setSubject($_subject){
  	  $this->subject=$_subject;
  	}
  	public function setDescript($_descript){
  	  $this->descript=$_descript;
  	}
  	public function setOwner($_owner){
  	  $this->owner=$_owner;
  	}
  	public function setBegin($_begin){
  	  $this->begin=$_begin;
  	}
  	public function setClose($_close){
  	  $this->close=$_close;
  	}
  	public function __destruct(){
  	}
  	/***
  	 * this function is to check all the field are filled;
  	 */
  	public function checkSurvey(){
  	  $flag=!empty($this->title)&&!empty($this->subject)&&!empty($this->descript)&&!empty($this->close);
  	  $anotherFlag=!empty($this->owner)&&!empty($this->begin);
  	  return $flag&&$anotherFlag;
  	}
  	public function createSurvey(){
  	  if($this->checkSurvey()){
  	  	if($this->isCreate) return;
  	  	echo "returning";
	    $arr=array();
	  	$arr["title"]=$this->title;
	  	$arr["subject"]=$this->subject;
	    $arr["descript"]=$this->descript;
	  	$arr["owner"]=$this->owner;
	  	$arr["begin"]=$this->begin;
	  	$arr["close"]=$this->close;
	  	$arr["isrelease"]=$this->isRelease;
	  	$this->sDb->insert("survey",$arr);
	  	$this->sDb->query();
	  	$this->isCreate=true;
	  	$i=0;
	  	foreach($this->problems as $problem){
	  	 $i++;
	  	 $problem->setSid($this->getSid());
	  	 $problem->setOrder($i);
	  	 $problem->createProblem();
	  	}
  	  }
  	}
  }
  ?>
  