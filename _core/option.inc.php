<?php
  require_once './_main.inc.php';
  class option{
  	private $id;
  	private $pnum;
  	private $problemid;
  	private $descipt;
  	private $isCreate;
  	private $opDb;
  	private $dbTable;
  	public function __construct($num=0,$descript=""){
  	  $this->setPnum($num);
  	  $this->setDescript($descript);
  	  $this->setProblemid(0);
  	  @$this->opDb=db::getInstance(MYSQLHOST,MYSQLUSER,MYSQLPS);
  	  $this->isCreate=false;
  	  $this->dbTable="poption";
  	}
  	public function selectIdByNumAndPid(){
      $this->opDb->select($this->dbTable,"id");
      $this->opDb->where("pnum=\"$this->pnum\" AND problemid=\"$this->problemid\"");
  	  $this->opDb->query();
  	  $res=$this->opDb->getResultArray();
  	}
  	public function setId(){
  	  $res=$this->selectIdByNumAndPid();
  	  if(empty($res)){
  	  	return false;
  	  }
  	  else{
  	    $this->id=(int)$res["id"];
  	    return true;
  	  }
  	}
  	public function setIdByHand($_id){
  	  $this->id=$_id;
  	}
  	public function getId(){
  	  if($this->id==0){
  	    $tmp=$this->setId();
  	    if($tmp) return $this->id;
  	    else{
  	      return false;
  	    }
  	  }
  	  else{
  	    return $this->id;
  	  }
  	}
  	public function setDescript($_des){
  	  $this->descipt=$_des;
  	}
  	public function getDescript(){
  	  return $this->descipt;
  	}
  	public function setPnum($_num){
  	  $this->pnum=$_num;
  	}
  	public function getPnum(){
  	  return $this->pnum;
  	}
  	public function setProblemid($_id){
  	  $this->problemid=$_id;
  	}
  	public function getProblemid(){
  	  return $this->problemid;
  	}
  	public function isValidate(){
  	  if($this->pnum==0||$this->problemid==0) {
  	  	return false;
  	  }
  	  return true;
  	}
  	public function createOption(){
  	  if($this->isValidate()&&$this->isCreate==false){
  	  	$arr=array();
  	  	$arr["pnum"]=$this->getPnum();
  	  	$arr["problemid"]=$this->getProblemid();
  	  	$arr["odescript"]=$this->getDescript();
  	  	$this->opDb->insert($this->dbTable, $arr);
  	  	$this->opDb->query();
  	  	$this->isCreate=true;
  	  	echo "adsfasdf";
  	  	$this->getId();
  	  }
  	}
  }

  ?>