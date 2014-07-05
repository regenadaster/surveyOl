<?php
  require_once "../_core/_main.inc.php";
  /***********************
   * the tag class is the base class for all the htmltag;
   */
  class tag{
  	private $tagStr;
  	private $father;
  	private $children;
  	public function __construct(){
  	  $this->children=array();
  	}
  	public function setDefaultTag($_tag){
  	  $this->tagStr="<".$_tag.">"."</".$_tag.">";
  	}
  	public function setTagStr($_str){
  	  $this->tagStr=$_str;
  	}
  	public function getTagStr(){
  	  return $this->tagStr;
  	}
  	public function addChild($_child){
  	  if($_child instanceof tag){
  	    $this->children[]=$_child;
  	  }
  	}
  	public function echoHtml(){
  	  echo $this->getTagStr();
  	}
  	/********
  	 * you can use addAttr like this:
  	 *   $myTag=new tag();
  	 *   $myTag->addAttr("class","hello")->addAttr("class","myhtmltag");
  	 *   $myTag->addAttr("class",array("world","good"))->addAttr(array("id"=>"night"));
  	 */
  	public function addAttr($key,$val=0){
  	  if(is_string($key)&&is_string($val)){
	  	$tmpStr=$this->getTagStr();
	    $len=strlen($tmpStr);
	    $keylen=strlen($key);
	    if(preg_match("/$key=/",$tmpStr)){
	      $_first=strpos($tmpStr,$key."=");
	      $firPart=substr($tmpStr, 0,$_first+$keylen+2);
	      $secPart=subStr($tmpStr,$_first+$keylen+2);
	      $valStr=$val." ";
	      $this->setTagStr($firPart.$valStr.$secPart);
	    }
	    else{
	      $_first=strpos($tmpStr, ">");
	      $firPart=substr($tmpStr,0,$_first);
	      $secPart=subStr($tmpStr,$_first);
	      $valStr=$key."=\"".$val."\"";
	      $this->setTagStr($firPart." ".$valStr.$secPart);
	    }
  	  }
  	  else{
  	  	if(is_array($key)&&is_numeric($val)){
          foreach ($key as $_key=>$_val){
          	$this->addAttr($_key,$_val);
          }
  	  	}
  	  	else{
  	  	  if(is_string($key)&&is_array($val)){
  	  	  	for($i=0;$i<count($val);$i++){
  	  	  	  $this->addAttr($key,$val[$i]);
  	  	  	}
  	  	  }
  	  	}
  	  }
      return $this;
  	}
  }
  class divTag extends tag{
  	public function __construct(){
	  echo "come in";
  	  parent::__construct();
      $this->setDefaultTag("div");
  	}
  
  }
?>