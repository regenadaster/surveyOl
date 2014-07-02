<?php
  require_once './_main.inc.php';
  class problem{
  	private $id;
  	private $surveyid;
  	private $ptype;
  	private $order;
  	private $descri;
  	private $isEassy;
  	private $pDb;
  	public function __construct($id=0,$sid=0,$type=0,$order=0,$descri="",$isEassy=false){
  	  $this->setId($id);
  	  $this->setSid($sid);
  	  $this->setType($type);
  	  $this->setOrder($order);
  	  $this->setDescript($descri);
  	  $this->setIsEassy($isEassy);
  	  $this->pDb=db::getInstance(MYSQLHOST,MYSQLUSER,MYSQLPS);
  	}
  	public function setID($id){
  	  $this->id=$id;
  	}
  	public function setSid($sid){
  	  $this->surveyid=$sid;
  	}
  	public function setType($type){
  	  $this->ptype=$type;
  	}
  	public function setOrder($order){
  	  $this->order=$order;
  	}
  	public function setDescript($descri){
  	  $this->descri=$descri;
  	}
  	public function setIsEassy($isEassy){
  	  $this->isEassy=$isEassy;
  	}
  	public function createProblem(){
  	  $arr=array();
  	  $arr["id"]=$this->id;
  	  $arr["surveyid"]=$this->surveyid;
  	  $arr["ptype"]=$this->ptype;
  	  $arr["order"]=$this->order;
  	  $arr["descri"]=$this->descri;
  	  $this->pDb->insert("problem",$arr);
  	}
  }
  ?>