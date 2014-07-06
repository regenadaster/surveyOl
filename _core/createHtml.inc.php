<?php
  require_once "../_core/_main.inc.php";
  /***********************
   * the tag class is the base class for all the htmltag;
   */
  class tag{
  	private $tagStr;
  	private $father;
  	private $children;
  	private $isOne;
  	private $withSlash;
  	public function __construct($one=0){
  	  $this->children=array();
  	  $this->isOne=$one;
  	  $this->withSlash=1;
  	}
  	public function setIsOne($one=1){
  	  $this->isOne=$one;
  	}
  	public function setSlash($slash=0){
  	  $this->withSlash=$slash;
  	}
  	public function setDefaultTag($_tag){
  	  if(!$this->isOne){
  	    $this->tagStr="<".$_tag.">"."</".$_tag.">";
  	  }
  	  else{
  	    if(!$this->withSlash){
  	      $this->tagStr="<".$_tag.">";
  	    }
  	    else{
  	      $this->tagStr="<".$_tag."/>";
  	    }
  	  }
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
  	public function appendTo($_father){
  	  if($_father instanceof tag){
  	    $_father->addChild($this);
  	  }
  	}
  	public function getAllContent(){
  	  $tmpStr=$this->addAllContent();
  	  $this->setTagStr($tmpStr);
  	}
  	/*****
  	 * addAllcontent() return all the content in the tag;
  	*/
  	public function addAllContent(){
  	  $tmpStr="";
  	  if(count($this->children)==0){
  	    $tmpStr.=$this->getTagStr();
  	    return $tmpStr;
  	  }
  	  for($i=0;$i<count($this->children);$i++){
  	  	$tmpStr.=$this->children[$i]->addAllContent();
  	  }
  	  $_pos=strrpos($this->getTagStr(),"<");
  	  $firPart=substr($this->getTagStr(), 0,$_pos);
  	  $secPart=subStr($this->getTagStr(),$_pos);
  	  return $firPart.$tmpStr.$secPart;
  	}
  	public function addContent($str){
  	  $tmpStr=$this->getTagStr();
  	  $_first=strpos($tmpStr, '>');
  	  $firPart=substr($tmpStr, 0,$_first+1);
  	  $secPart=substr($tmpStr, $_first+1);
  	  $this->setTagStr($firPart.$str.$secPart);
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
  class commonTag extends tag{
    private $isJsScript;
    private $jsSet;
    private $isStyle;
    private $styleSet;
    public function __construct(){
  	  parent::__construct();
  	  $this->isJsScript=0;
  	  $this->isStyle=0;
  	  $this->jsSet=0;
  	  $this->styleSet=0;
  	}
  	public function setJs(){
  	  $this->setDefaultTag("script");
  	  $this->addAttr("type","text/javascript");
  	  $this->jsSet=1;
  	}
  	public function setStyle(){
  	  $this->setIsOne(1);
  	  $this->setSlash(0);
  	  $this->setDefaultTag("link");
      $this->addAttr("rel","stylesheet")->addAttr("type","text/css");
  	}
  	public function setIsJs($_js=0){
  	  $this->isJsScript=$_js;
  	}
  	public function getIsJs(){
  	  return $this->isJsScript;
  	}
  	public function getIsStyle(){
  	  return $this->isStyle;
  	}
  	public function setIsStyle($_style=0){
  	  $this->isStyle=$_style;
  	}
  	public function setJsUrl($_url){
  	  if($this->jsSet==0){
  	  	$this->setJs();
  	  }
  	  $this->addAttr("src",$_url);
  	}
  	public function setStyleUrl($_url){
  	  if($this->styleSet==0){
  	    $this->setStyle();
  	  }
  	  $this->addAttr("href",$_url);
  	}
  	public function setDefaultMeta(){
  	  $this->setIsOne(1);
  	  $this->setSlash(0);
  	  $this->setDefaultTag("meta");
  	  $this->addAttr("http-equiv","Content-Type")->addAttr('content',"text/html; charset=gb2312");
  	}
  }
  class divTag extends tag{
  	public function __construct(){
  	  parent::__construct();
      $this->setDefaultTag("div");
  	}
  }
  class htmlTag extends tag{
  	private $head;
  	private $body;
  	public function __construct(){
  	  $this->setDefaultTag("html");
  	  $this->head=new commonTag();
  	  $this->body=new commonTag();
  	  $this->head->setDefaultTag("head");
  	  $this->body->setDefaultTag("body");
  	  $this->body->addContent("hello");
  	}
  	public function createStyle($_url){
  	  $css=new commonTag();
  	  $css->setIsStyle(1);
  	  $css->setStyle();
  	  $css->setStyleUrl($_url);
  	  return $css;
  	}
  	public function createJs($_url){
  	  $js=new commonTag();
  	  $js->setIsJs(1);
  	  $js->setJs();
  	  $js->setJsUrl($_url);
  	  return $js;
  	}
  	public function setCommonHead(){
  	  $meta=new commonTag();
  	  $meta->setDefaultMeta();
  	  $meta->appendTo($this->head);
  	  $title=new commonTag();
  	  $title->setDefaultTag("title");
  	  $title->appendTo($this->head);
  	  $bootstrap=$this->createStyle(BootstrapUrl);
  	  $bootstrap->appendTo($this->head);
  	  $baseCss=$this->createStyle(BaseCss);
  	  $baseCss->appendTo($this->head);
  	  $Jquery=$this->createJs(Jquery);
  	  $Jquery->appendTo($this->head);
  	}
  	public function packChildren(){
      $this->addChild($this->head);
      $this->addChild($this->body);
  	}
  }
  class createHtml{
  	private $html;
    public function __construct(){
      $this->html=new htmlTag();
      $this->html->setCommonHead();
      $this->html->packChildren();
      $this->html->getAllContent();
      $this->html->echoHtml();
    }
  }
?>