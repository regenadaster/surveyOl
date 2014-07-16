<?php
  require_once '../_core/_main.inc.php';
  class survey{
  	private $id;
  	private $title;
  	private $subject;
  	private $descript;
  	private $owner;
  	private $begin;
  	private $sDb;
  	private $close;
  	private $isRelease;
  	private $isCreate;
  	private $url;
  	private $problems;//$problems is a array of problem class
  	private $urlObject;
  	private $sTable;
  	private $fileUrl;
  	private $surveyUser;
  	private $ownerName;
  	public function __construct($title="",$subject="",$descript="",$owner=0,$begin="",$close="",$isRelease=0){
  	  $this->setTitle($title);
  	  $this->setSubject($subject);
  	  $this->setDescript($descript);
  	  $this->setOwner($owner);
  	  $this->setBegin($begin);
  	  $this->setClose($close);
  	  $this->setRelease($isRelease);
  	  @$this->sDb=db::getInstance(MYSQLHOST,MYSQLUSER,MYSQLPS);
  	  $this->isCreate=false;
  	  $this->problems=array();
  	  $this->urlObject=new surveyUrl();
  	  $this->id=0;
  	  $this->sTable="survey";
  	  $this->surveyUser=new user();
  	}
  	public function setUser($_name,$_passwd){
  	  $this->surveyUser->setName($_name);
  	  $this->surveyUser->setPasswd($_passwd);
  	  $this->owner=$this->surveyUser->getId();
  	}
  	public function setUserById($id){
  	  $this->surveyUser->setIdbyHand($id);
  	  $this->surveyUser->getNameAndPasswdById();
  	  $this->owner=$id;
  	}
  	public function setPublishToDb(){
  	  $tmpstr="isrelease=$this->isRelease";
  	  $wherestr="id=$this->id";
  	  $this->sDb->update($this->sTable, $tmpstr);
  	  $this->sDb->where($wherestr);
  	  $this->sDb->query();
  	}
  	public function setCloseToDb(){
      $tmpstr="close=\"$this->close\"";
      $wherestr="id=$this->id";
      $this->sDb->update($this->sTable, $tmpstr);
      $this->sDb->where($wherestr);
      $this->sDb->query();
  	}
  	public function removeSurveyById($_id){
  	  $str="id=$_id";
  	  $this->sDb->deleteData("survey");
  	  $this->sDb->where($str);
  	  $this->sDb->query();
  	}
  	public function setIdByHand($_id){
  	  $this->id=$_id;
  	}
  	public function AddProblemById(){
  	  if($this->id==0){
  	    return false;
  	  }
  	  else{
  	  	$this->sDb->select("problem");
  	  	$this->sDb->where("surveyid=$this->id");
  	  	$this->sDb->query();
  	  	$res=$this->sDb->getResultArray(1);
  	  	foreach ($res as $_arr){
  	  	  $tmpProblem=new problem();
  	  	  $tmpProblem->setIdByHand((int)$_arr["id"]);
  	  	  $tmpProblem->setSid((int)$this->id);
  	  	  $tmpProblem->setType((int)$_arr["ptype"]);
  	  	  $tmpProblem->setDescript($_arr["description"]);
  	  	  $tmpProblem->setIsEassy((int)$_arr["isEassy"]);
  	  	  $tmpProblem->setOrder((int)$_arr["num"]);
  	  	  $tmpProblem->AddOptionById();
  	  	  $this->addProblem($tmpProblem);
  	  	}
  	  }
  	}
  	public function getSurveyById(){
  	  if($this->id==0){
  	  	return false;
  	  }
  	  else{
  	    $this->sDb->select($this->sTable);
  	    $this->sDb->where("id=$this->id");
  	    $this->sDb->query();
  	    $res=$this->sDb->getResultArray();
  	    if(empty($res)){
  	      return false;
  	    }
  	    $this->setBegin($res["begin"]);
  	    $this->setClose($res["close"]);
  	    $this->setDescript($res["descript"]);
  	    $this->setOwner($res["owner"]);
  	    $this->setRelease($res["isrelease"]);
  	    $this->setTitle($res["title"]);
  	    $this->setSubject($res["subject"]);
  	    return true;
  	  }
  	}
  	public function getSurveyByBegin(){
  	  $this->sDb->select($this->sTable);
  	  $this->sDb->where("begin=\"$this->begin\"");
  	  $this->sDb->query();
  	  $res=$this->sDb->getResultArray();
  	  if(empty($res)){
  		return false;
  	  }
  	  $this->id=$res['id'];
  	  $this->setBegin($res["begin"]);
  	  $this->setClose($res["close"]);
  	  $this->setDescript($res["descript"]);
  	  $this->setOwner($res["owner"]);
  	  $this->setRelease($res["isrelease"]);
  	  $this->setTitle($res["title"]);
  	  $this->setSubject($res["subject"]);
  	  return true;
  	}
  	public function getProblems(){
  	  return $this->problems;
  	}
  	public function getProblemsCount(){
  	  return count($this->problems);
  	}
  	public function setRelease($isre){
  	  $this->isRelease=$isre;
  	}
  	public function getRelease(){
  	  return (int)$this->isRelease;
  	}
  	/*you can addProblem(new problem());
  	*  also you can use problem's params;
  	*
  	*/
  	public function addProblem($problem){
  	  if($problem instanceof problem){
  	  	$this->problems[]=$problem;
  	  }
  	  else{
  	  	if(is_array($problem)){
  	      if(count($problem)==3){
  	        $this->problems[]=new problem($problem[0],$problem[1],$problem[2]);
  	      }
  	  	}
  	  }
  	}
  	public function getMD5url(){
  	  return myUlrmd5(''.$this->id);
  	}
  	public function putUrlById(){
  	  $id=$this->getSid();
  	  $this->urlObject->setSurveyId($id);
  	  $this->setUrlByid();
  	  $this->urlObject->setUrl($this->url);
  	  $this->urlObject->insertUrl();
  	}
  	public function setUrlById(){
  	  $this->url=$this->getMD5url();
  	}
  	public function MkFile(){
  	  $myfile = fopen("../s/".$this->url.".php", "w");
  	  fwrite($myfile,
  	   '<?php $fatherFile=__FILE__;
  	   	  require_once "../_core/_main.inc.php";
  	   	  require_once "../_core/packData.inc.php";
  	  	  require_once "../_core/createHtml.inc.php";
  	   		
  	   	  $myPackData= new packData($fatherFile);
  	   	  $dataSet=$myPackData->getDataSet();
  	   	  $myHtml=new createHtml($dataSet,0);
  	  ?>');
  	  $this->fileUrl="../s/".$this->url.".php";
  	}
  	public function getFileUrl(){
  	  return $this->fileUrl;
  	}
  	public function selectIdByTitleSubject(){
  	  if($this->owner==0){
  	    $this->owner=$this->surveyUser->getId();
  	    //echo $this->owner."the owner id before";
  	  }
  	  $this->sDb->select("survey","id");
  	  $this->sDb->where("title=\"$this->title\" AND owner=$this->owner AND subject=\"$this->subject\" AND begin=\"$this->begin\"");
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
  	  	$this->setSid();
  	  }
  	  return $this->id;
  	}
  	public function setTitle($_title){
  	  $this->title=$_title;
  	}
  	public function getTitle(){
  	  return $this->title;
  	}
  	public function setSubject($_subject){
  	  $this->subject=$_subject;
  	}
  	public function getSubject(){
  	  return $this->subject;
  	}
  	public function getDescript(){
  	  return $this->descript;
  	}
  	public function setDescript($_descript){
  	  $this->descript=$_descript;
  	}
  	public function setOwner($_owner){
  	  $this->owner=$_owner;
  	}
  	public function getOwner(){
  	  return $this->owner;
  	}
  	public function setBegin($_begin){
  	  $this->begin=$_begin;
  	}
  	public function getBegin(){
  	  return $this->begin;
  	}
  	public function setClose($_close){
  	  $this->close=$_close;
  	}
  	public function getClose(){
      return $this->close;
  	}
  	public function __destruct(){
  	}
  	/***
  	 * this function is to check all the field are filled;
  	 */
  	public function checkSurvey(){
  	  $flag=!empty($this->title)&&!empty($this->subject)&&!empty($this->descript)&&!empty($this->close);
  	  $anotherFlag=!($this->owner==0)&&!empty($this->begin);
  	  return $flag&&$anotherFlag;
  	}
  	public function sortProblems(){
  	  if(count($this->problems)==0) return;
  	  for($i=0;$i<count($this->problems);$i++){
  	    for($j=$i+1;$j<count($this->problems);$j++){
  	      if($this->problems[$i]->getOrder()>$this->problems[$j]->getOrder()){
  	        $tmpPro=clone $this->problems[$i];
  	        $this->problems[$i]=$this->problems[$j];
  	        $this->problems[$j]=$tmpPro;
  	      }
  	    }
  	  }
  	  for($i=0;$i<count($this->problems);$i++){
  	  	$this->problems[$i]->sortOptions();
  	  }
  	}
  	public function createSurvey(){
  	  if($this->checkSurvey()){
  	  	if($this->isCreate) return;
	    $arr=array();
	  	$arr["title"]=$this->title;
	  	$arr["subject"]=$this->subject;
	    $arr["descript"]=$this->descript;
	  	$arr["owner"]=$this->owner;
	  	$arr["begin"]=$this->begin;
	  	$arr["close"]=$this->close;
	  	$arr["isrelease"]=$this->isRelease;
	  	$this->sDb->insert($this->sTable,$arr);
	  	$this->sDb->query();
	  	$this->isCreate=true;
	  	$i=0;
	  	$this->setSid();
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
  