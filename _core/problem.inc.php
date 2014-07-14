<?php
  require_once '../_core/_main.inc.php';
  class problem{
  	private $id;
  	private $surveyid;
  	private $ptype;
  	private $order;
  	private $descri;
  	private $isEassy;
  	private $pDb;
  	private $isCreate;
  	private $options;
  	public function __construct($type=0,$descri="",$isEassy=0){
  	  $this->setType($type);
  	  $this->setDescript($descri);
  	  $this->setIsEassy($isEassy);
  	  @$this->pDb=db::getInstance(MYSQLHOST,MYSQLUSER,MYSQLPS);
  	  $this->options=array();
  	  $this->id=0;
  	}
  	public function setIdByHand($_id){
  	  $this->id=$_id;
  	}
  	public function getOptionsCount(){
  	  return count($this->options);
  	}
  	public function AddOptionById(){
  	  if($this->id==0){
  	    return false;
  	  }
  	  else{
  	    $this->pDb->select("poption");
  	    $this->pDb->where("problemid=$this->id");
  	    $this->pDb->query();
  	    $res=$this->pDb->getResultArray(1);
  	    foreach ($res as $_arr){
  	      $tmpOpt=new option();
  	      $tmpOpt->setProblemid((int)$_arr["problemid"]);
  	      $tmpOpt->setPnum((int)$_arr["pnum"]);
  	      $tmpOpt->setDescript($_arr["odescript"]);
  	      $tmpOpt->setIdByHand((int)$_arr["id"]);
  	      $this->addOption($tmpOpt);
  	    }
  	  }
  	}
  	public function deleteProblemsByPid($_pid){
  	  $str="id=$_pid";
  	  $this->pDb->deleteData("problem");
  	  $this->pDb->where($str);
  	  $this->pDb->query();
  	}
  	public function setId(){
  	  $this->pDb->select("problem","id");
  	  $this->pDb->where("description=\"$this->descri\" AND surveyid=$this->surveyid AND num=$this->order");		
  	  $this->pDb->query();
  	  $tmp=$this->pDb->getResultArray();
  	  $this->id=$tmp["id"];
  	}
    public function getId(){
      if($this->id==0){
      	$this->setId();
      }
      return $this->id;
    }
    public function addOption($_opt){
      if($_opt instanceof option){
        $this->options[]=$_opt;
      }
      else{
        if(is_numeric($_opt)){
          $this->options[]=new option($_opt,"");
        }
        if(is_string($_opt)){
          $this->options[]=new option(0,$_opt);
        }
        if(is_array($_opt)){
          $this->options[]=new option($_opt[0],$_opt[1]);
        }
      }
    }
  	public function setSid($sid){
  	  $this->surveyid=$sid;
  	}
  	public function setType($type){
  	  $this->ptype=$type;
  	}
  	public function getType(){
  	  return $this->ptype;
  	}
  	public function setOrder($order){
  	  $this->order=$order;
  	}
  	public function getOrder(){
  	  return $this->order;
  	}
  	public function setDescript($descri){
  	  $this->descri=$descri;
  	}
  	public function getDescript(){
  	  return $this->descri;
  	}
  	public function sortOptions(){
  	  if(count($this->options)==0) return;
  	  for($i=0;$i<count($this->options);$i++){
  	  	for($j=$i+1;$j<count($this->options);$j++){
  	  	  if($this->options[$i]->getPnum()>$this->options[$j]->getPnum()){
  	  	  	$tmpOpt=clone $this->options[$i];
  	  	  	$this->options[$i]=$this->options[$j];
  	  	  	$this->options[$j]=$tmpOpt;
  	  	  }
  	  	}
  	  }
  	}
  	public function getOptions(){
  	  return $this->options;
  	}
  	public function setIsEassy($isEassy){
  	  $this->isEassy=$isEassy;
  	}
  	public function checkIsValidate(){
  	  $flag=!empty($this->surveyid)||!empty($this->ptype)||!empty($this->order);
  	  $anotherflag=!empty($this->descri)||!empty($this->isEassy);
  	  return $flag||$anotherflag;
  	}
  	public function createProblem(){
  	  if(!$this->checkIsValidate()) return;
  	  if($this->isCreate) return;
  	  $arr=array();
  	  $arr["surveyid"]=$this->surveyid;
  	  $arr["ptype"]=$this->ptype;
  	  $arr["num"]=$this->order;
  	  $arr["description"]=$this->descri;
  	  $arr["isEassy"]=$this->isEassy;
  	  $this->pDb->insert("problem",$arr);
  	  $this->pDb->query();
  	  $this->isCreate=true;
  	  $i=0;
  	  foreach($this->options as $_opt){
  	  	$i++;
  	  	$_opt->setProblemid($this->getId());
  	  	$_opt->setPnum($i);
  	  	$_opt->createOption();
  	  }
  	}
  }
  ?>