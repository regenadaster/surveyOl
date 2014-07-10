<?php
  require_once '../_core/_main.inc.php';
  class user{
  	private $name;
  	private $passwd;
  	private $id;
  	private $uDb;
  	private $userTable;
  	private $surveys;
  	private $adminName;
  	private $adPasswd;
  	public function __construct($_name="",$_passwd=""){
  	  $this->setName($_name);
  	  $this->setPasswd($_passwd);
  	  @$this->uDb=db::getInstance("127.0.0.1","root","");
  	  $this->id=0;
  	  $this->userTable="user";
  	  $this->surveys=array();
  	  $this->adminName="admin";
  	  $this->adPasswd="admin";
  	}
  	public function putSurvey($_survey){
  	  $this->surveys[]=$_survey;
  	}
  	public function getSurveys(){
  	  return $this->surveys;
  	}
  	public function putSurveysByDbResult($res){
  	  foreach ($res as $arr){
  		$tmpSurvey=new survey();
  		$tmpSurvey->setIdByHand($arr["id"]);
  		$tmpSurvey->getSurveyById();
  		$tmpSurvey->AddProblemById();
  		$tmpSurvey->setUser($this->name, $this->passwd);
  		$this->putSurvey($tmpSurvey);
  	  }
  	}
  	public function putSurveysByDbResultId($res){
  	  foreach ($res as $arr){
  		$tmpSurvey=new survey();
  		$tmpSurvey->setIdByHand($arr["id"]);
  		$tmpSurvey->getSurveyById();
  		$tmpSurvey->AddProblemById();
  		$tmpSurvey->setUserById($arr["owner"]);
  		$this->putSurvey($tmpSurvey);
  	  }
  	}
  	public function getLastDaySurveys(){
  	  $str=getToday();
  	  $this->uDb->select("survey");
  	  $this->uDb->where("begin>=\"$str\"");
   	  $this->uDb->OrderBy("begin",0);
   	  $this->uDb->query();
   	  $res=$this->uDb->getResultArray();
   	  $this->putSurveysByDbResultId($res);
  	}
  	public function getLastWeekSurveys(){
  	  $str=getThisWeekFirstDay();
  	  $this->uDb->select("survey");
  	  $this->uDb->where("begin>=\"$str\"");
  	  $this->uDb->OrderBy("begin",0);
  	  $this->uDb->query();
  	  $res=$this->uDb->getResultArray();
  	  $this->putSurveysByDbResultId($res);
  	}
  	public function getLastMonthSurveys(){
  	  $str=getThisMonthFirstDay();
  	  $this->uDb->select("survey");
  	  $this->uDb->where("begin>=\"$str\"");
  	  $this->uDb->OrderBy("begin",0);
  	  $this->uDb->query();
  	  $res=$this->uDb->getResultArray();
  	  $this->putSurveysByDbResultId($res);
  	}
  	public function getAllSurveysByAdmin(){
  	  $this->uDb->select("survey","id");
  	  $this->uDb->OrderBy("begin",0);
  	  $this->uDb->query();
  	  $res=$this->uDb->getResultArray();
  	  $this->putSurveysByDbResultId($res);
  	}
  	public function getAllSurveys(){
  	  if($this->id==0){
  	    $this->setId();
  	  }
  	  $tmpStr="owner=$this->id";
  	  $this->uDb->select("survey","id");
  	  $this->uDb->where($tmpStr);
  	  $this->uDb->OrderBy("begin",0);
  	  $this->uDb->query();
  	  $res=$this->uDb->getResultArray();
      $this->putSurveysByDbResult($res);
  	}
  	public function getAllSurveysByTitle($_title,$userId){
  	  $tmpStr="title like \"%$_title%\"";
  	  if(!empty($userId)) $tmpStr.=" and owner=$userId";
  	  $this->uDb->select("survey");
  	  $this->uDb->where($tmpStr);
  	  $this->uDb->query();
  	  $res=$this->uDb->getResultArray();
  	  $this->putSurveysByDbResultId($res);
  	}
  	public function setName($_name){
  	  $this->name=$_name;
  	}
  	public function getName(){
  	  return $this->name;
  	}
  	public function setPasswd($_passwd){
  	  $this->passwd=$_passwd;
  	}
  	public function setIdbyHand($_id){
  	  $this->id=$_id;
  	}
  	public function getNameAndPasswdById(){
  	  if($this->id==0){
  	    return false;
  	  }
  	  else{
  	    $str="id=\"$this->id\"";
  	    $this->uDb->select($this->userTable);
  	    $this->uDb->where($str);
  	    $this->uDb->query();
  	    $res=$this->uDb->getResultArray();
  	    if(empty($res)){
  	      return false;
  	    }
  	    else{
  	      $this->name=$res["name"];
  	      $this->passwd=$res["passwd"];
  	      return true;
  	    }
  	  }
  	}
  	public function setId(){
  	  $str="name=\"$this->name\" AND passwd=\"$this->passwd\"";
  	  $this->uDb->select($this->userTable,"id");
  	  $this->uDb->where($str);
  	  $this->uDb->query();
      $res=$this->uDb->getResultArray();
      $this->id=$res['id'];
  	}
  	public function getId(){
  	  if($this->id==0){
  	    $this->setId();
  	  }
  	  return $this->id;
  	}
  	public function getPasswd(){
  	  return $this->passwd;
  	}
  	public function isValidate(){
  	  if(empty($this->name)||empty($this->passwd)){
  	  	return false;
  	  }
  	  else{
  	  	return true;
  	  }
  	}
  	public function checkUser(){
  	  if(!$this->isValidate()){
  	  	return false;
  	  }
  	  else{
  	  	$str="user.name=\"$this->name\" AND user.passwd=\"$this->passwd\"";
  	  	$this->uDb->select("user");
  	  	$this->uDb->where($str);
  	  	$this->uDb->query();
  	    $res=$this->uDb->getResultArray();
  	    if(empty($res)){
  	      return false;
  	    }
  	    else{
  	      return true;
  	    }
  	  }
  	}
  	public function loopPage(){
  	  $tof=$this->checkUser();
  	  if($tof){
  	  	$_SESSION["userName"]=$_POST['user'];
  	  	setVal("password",$_POST["password"]);
        header("Location: http://127.0.0.1:8081/surveyOI/doc/home.php");
  			/*$str=<<<mark
  		    <script language="javascript"type="text/javascript">
  			alert("shshhd");
  			</script>
  			mark;
  			echo $str;
  			*/
  	  }
  	  else{
  	    header("Location: http://127.0.0.1:8081/surveyOI/doc/login.php");
  	  }
  	}
  	public function checkAdmin(){
      $str="name=\"$this->name\" AND passwd=\"$this->passwd\"";
      $this->uDb->select($this->userTable);
      $this->uDb->where($str);
      $this->uDb->query();
      $res=$this->uDb->getResultArray();
      if($res["name"]=="admin"&&$res["passwd"]=="admin"){
        return true;
      }
      else{
        return false;
      }
  	}
  	public function regUser(){
  	  if(!$this->isValidate()) return false;
  	  $str="user.name=\"$this->name\"";
  	  $this->uDb->select("user");
  	  $this->uDb->where($str);
  	  $this->uDb->query();
  	  $res=$this->uDb->getResultArray();
  	  if(empty($res)){
  		return true;
  	  }
  	  else{
  		return false;
  	  }
  	}
  	public function createUser(){
  	  if(!$this->isValidate()){
  	  	return false;
  	  }
  	  else{
  	    $params=array();
  	    $params["name"]=$this->getName();
  	    $params["passwd"]=$this->getPasswd();
  	   // var_dump($params);
  	  	$this->uDb->insert("user",$params);
        return $this->uDb->query();
  	  }
  	}
  }
  ?>