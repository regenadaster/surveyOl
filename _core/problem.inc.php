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
  	public function __construct($type=0,$descri="",$isEassy=0){
  	  $this->setType($type);
  	  $this->setDescript($descri);
  	  $this->setIsEassy($isEassy);
  	  @$this->pDb=db::getInstance(MYSQLHOST,MYSQLUSER,MYSQLPS);
  	}
  	public function setId(){
  	  $this->pDb->select("problem","id");
  	  $this->pDb->where("descri=\"$this->descri\" AND surveyid=\"this->surveyid\" ");		
  	  $this->pDb->query();
  	  $tmp=$this->pDb->getResultArray();
  	  $this->id=$tmp["id"];
  	}
    public function getId(){
      if($this->id==0){
      	$this->setId();
      }
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
  	  $arr["surveyid"]=$this->surveyid;
  	  $arr["ptype"]=$this->ptype;
  	  $arr["num"]=$this->order;
  	  $arr["description"]=$this->descri;
  	  $arr["isEassy"]=$this->isEassy;
  	  $this->pDb->insert("problem",$arr);
  	  $this->pDb->query();
  	}
  }
  ?>