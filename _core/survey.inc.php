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
  	private $problems;//$problems is a array of problem class
  	public function __construct($id="",$title="",$subject="",$descript="",$owner="",$begin="",$end=""){
  	  $this->setId($id);
  	  $this->setTitle($title);
  	  $this->setSubject($subject);
  	  $this->setDescript($descript);
  	  $this->setOwner($owner);
  	  $this->setBegin($begin);
  	  $this->setEnd($end);
  	  $this->sDb=db::getInstance("127.0.0.1","root","");
  	  $problems=[];
  	}
  	public function addProblem($problem){
  	  if($problem instanceof problem){
  	  	$problems[]=problem;
  	  }
  	}
  	public function setSid(){
  	  $this->sDb->select("survey","id");
  	  $this->sDb->where("title=$this->title AND owner=$this->owner AND subject=$this->subject");
  	  $this->sDb->query();
  	}
  	public function setTitle($_title){
  	  $this->title=$_title;
  	}
  	public function setSubject($_subject){
  	  $this->subject=$_subject;
  	}
  	public function setDescript($_descript){
  	  $this->setDescript($_descript);
  	}
  	public function setOwner($_owner){
  	  $this->owner=$_owner;
  	}
  	public function setBegin($_begin){
  	  $this->begin=$_begin;
  	}
  	public function setEnd($_end){
  	  $this->end=$_end;
  	}
  	public function setClose($_close){
  	  $this->close=$_close;
  	}
  	public function __destruct(){
  	}
  	public function createSurvey(){
  	  $arr=array();
  	  $arr["id"]=$this->id;
  	  $arr["title"]=$this->title;
  	  $arr["subject"]=$this->subject;
  	  $arr["descript"]=$this->descript;
  	  $arr["owner"]=$this->owner;
  	  $arr["begin"]=$this->begin;
  	  $arr["end"]=$this->end;
  	  $arr["close"]=$this->close;
  	  $this->sDb->insert("survey",$arr);
  	  $this->sDb->query();
  	  foreach($this->problems as $problem){
  	  	$problem->createProblem();
  	  }
  	}
  }
  
  
  
  
  ?>
  