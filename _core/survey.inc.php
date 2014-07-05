<?php
  require_once './_main.inc.php';
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
  	  $this->problems=array();
  	  $this->urlObject=new surveyUrl();
  	  $this->id=0;
  	  $this->sTable="survey";
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
  	  	$res=$this->sDb->getResultArray();
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
  	public function setRelease($isre){
  	  $this->isRelease=$isre;
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
  	  fwrite($myfile, '<?php $fatherFile=__FILE__; require_once "../_core/superSurvey.php";?>');
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
	  	//$this->MkFile();
	  	echo "before heerer";
	  	foreach($this->problems as $problem){
	  	  $i++;
	  	  echo "just befor sid";
	  	  $problem->setSid($this->getSid());
	  	  $problem->setOrder($i);
	  	  echo "heerer";
	  	  $problem->createProblem();
	  	}
  	  }
  	}
  }
  ?>
  