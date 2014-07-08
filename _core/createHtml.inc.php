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
  	  $this->addAttr("http-equiv","Content-Type")->addAttr('content',"text/html; charset=utf-8");
  	}
  }
  class divTag extends tag{
  	public function __construct(){
  	  parent::__construct();
      $this->setDefaultTag("div");
  	}
  }
  class labelTag extends tag{
    public function __construct(){
      parent::__construct();
      $this->setDefaultTag("label");    	
    }
    public function setFor($val){
      $this->addAttr("for",$val);
    }
  }
  class inputTag extends tag{
  	public function __construct(){
  	  parent::__construct();
  	  $this->setIsOne(1);
  	  $this->setSlash(1);
  	  $this->setDefaultTag("input");
  	}
  	public function setInputAttr($type=0,$id,$name,$value){
  	  if($type==0){
  	  	$this->addAttr("type","radio");
  	  }
  	  if($type==1){
  	    $this->addAttr("type","checkbox");
  	  }
  	  if($type==2){
  	  	$this->addAttr("type","radio");
  	  }
  	  if($type==3){
  	  	
  	  }
  	  $this->addAttr("id",$id)->addAttr("name",$name)->addAttr("value",$value);
  	}
  }
  class htmlTag extends tag{
  	private $head;
  	private $body;
  	private $isTest;
  	private $dataSet;
  	public function __construct($dataSet,$test=0){
  	  $this->isTest=$test;
  	  $this->dataSet=$dataSet;
  	  $this->setDefaultTag("html");
  	  $this->head=new commonTag();
  	  $this->body=new commonTag();
  	  $this->head->setDefaultTag("head");
  	  $this->body->setDefaultTag("body");
  	  //$this->body->addContent("hello");
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
  	public function addBootstrap(){
  	  $bootstrap=$this->createStyle(BootstrapUrl);
      $bootstrap->appendTo($this->head);
  	}
  	public function addJquery(){
  	  $Jquery=$this->createJs(Jquery);
  	  $Jquery->appendTo($this->head); 		
  	}
  	public function addPicker(){
  	  $pickerJs=$this->createJs(PickerJs);
      $pickerJs->appendTo($this->head);
      $pickerCss=$this->createStyle(PickerCss);
      $pickerCss->appendTo($this->head);
  	}
  	public function addBaseJs(){
  	  $basejs=$this->createJs(BaseJs);
  	  $basejs->appendTo($this->head);
  	}
  	public function addDataCollectionJs(){
      $dataCollectionJs=$this->createJs(DataCollectionJs);
      $dataCollectionJs->appendTo($this->head);
  	}
  	public function setCommonHead(){
  	  $meta=new commonTag();
  	  $meta->setDefaultMeta();
  	  $meta->appendTo($this->head);
  	  $title=new commonTag();
  	  $title->setDefaultTag("title");
  	  $title->appendTo($this->head);
  	  $this->addJquery();
  	  $this->addBootstrap();
  	  $this->addPicker();
  	  $this->addBaseJs();
  	  $baseCss=$this->createStyle(BaseCss);
  	  $baseCss->appendTo($this->head);
  	  $this->addDataCollectionJs();
  	}
  	public function packChildren(){
  	  $this->setCommonHead();
  	  $this->createBody();
      $this->addChild($this->head);
      $this->addChild($this->body);
  	}
  	public function createNullRow(){
  	  $row=new divTag();
  	  $row->addAttr("class","row")->addAttr("style","height:30px");
  	  return $row;
  	}
  	public function createBaseRow(){
  	  $row=new divTag();
  	  $row->addAttr("class","row");
  	  return $row;
  	}
  	public function createSyHeader(){
  	  $row=$this->createBaseRow();
  	  $smallNull=$this->createSmallNullRow();
  	  $childRow=new divTag();
  	  $childRow->addAttr("id","syHeader")->addAttr("class","col-md-8 col-md-offset-2");
  	  $childRow->addContent("当前为预览页面，回答将不记入结果");
  	  $childRow->appendTo($row);
  	  return $row;
  	}
  	public function createBlueLineRow(){
      $row=$this->createBaseRow();
      $blueLine=new divTag();
      $blueLine->addAttr("id","blueLine")->addAttr("class","margin_top col-md-offset-1 col-md-10");
      $row->addChild($blueLine);
      return $row;
  	}
  	public function createQuestionRow($qDescript,$countNum){
  	  $row=$this->createBaseRow();
  	  $questionRow=new divTag();
  	  $questionRow->addAttr("class","margin_top col-md-offset-1 col-md-10");
  	  $questionRow->addAttr("id","q".$countNum);
  	  $questionRow->addContent($countNum.".".$qDescript);
  	  $questionRow->appendTo($row);
  	  return $row;
  	}
  	public function createOptionRow($oNum,$qNum){
  	  $optionRow=new divTag();
  	  $optionRow->addAttr("class","question marg_top col-md-offset-1");
  	  $optionRow->addAttr("id","q".$qNum."o".$oNum);
  	  return $optionRow;
  	}
  	public function createSmallNullRow(){
  	  $row=$this->createBaseRow();
  	  $row->addAttr("class","smallNullRow");
  	  return $row;
  	}
  	public function createSybodyRow(){
  	  $row=$this->createBaseRow();
  	  $sybody=new divTag();
  	  $sybody->addAttr("id","syBody")->addAttr("class","col-md-8 col-md-offset-2");
  	  $title=new divTag();
  	  $title->addAttr(id,"sytitle")->addAttr("class","margin_top");
  	  $title->addContent($this->dataSet["title"]);
  	  $descript=new divTag();
  	  $descript->addAttr("id","sydescript")->addAttr("class","margin_top col-md-offset-1");
  	  $descript->addContent($this->dataSet["descript"]);
  	  $blueLine=$this->createBlueLineRow();
  	  $title->appendTo($sybody);
  	  $descript->appendTo($sybody);
  	  $blueLine->appendTo($sybody);
  	  for($i=0;$i<count($this->dataSet["questions"]);$i++){
  	  	$quData=$this->dataSet["questions"][$i];
  	  	$que=$this->createQuestionRow($quData[descript],$i+1);
  	  	$que->appendTo($sybody);
  	  	$small=$this->createSmallNullRow();
  	  	$small->appendTo($sybody);
  	  	for($j=0;$j<count($quData["options"]);$j++){
  	  	  $optData=$quData["options"][$j];
  	  	  $quFather=$this->createBaseRow();
  	  	  $optionFather=$this->createOptionRow($j+1, $i+1);
          $opt=new inputTag();
          $idStr="q".($i+1)."o".($j+1);
          $opt->setInputAttr($optData["type"],$idStr."input", "q".($i+1)."name", "q".($i+1)."value");
          $optLabel=new labelTag();
          $optLabel->setFor($idStr."input");
          $optLabel->addContent($optData["descript"]);
          $opt->appendTo($optionFather);
          $optLabel->appendTo($optionFather);
          $optionFather->appendTo($quFather);
          $quFather->appendTo($sybody);
  	  	}
  	  }
  	  $_tmpRow=new divTag();
  	  $_tmpRow->addAttr("class","row col-md-offset-2")->addAttr("id","commitRow");
  	  $_cButton=$this->createCommitButton();
  	  $_cButton->appendTo($_tmpRow);
  	  $_tmpRow->appendTo($sybody);
  	  $anotherNullRow=$this->createSmallNullRow();
  	  $anotherNullRow->appendTo($sybody);
  	  $sybody->appendTo($row);
  	  return $row;
  	}
  	public function createCommitButton(){
  	  $cButton=new commonTag();
  	  $cButton->setDefaultTag("button");
  	  $cButton->addContent("commit");
  	  $cButton->addAttr("type","button")->addAttr("class","btn btn-primary")->addAttr("id","commitBtn");
  	  return $cButton;
  	}
  	public function createBody(){
  	  $container=new divTag();
  	  $container->addAttr("class","container");
  	  if($this->isTest==1){
  	  	$syheader=$this->createSyHeader();
  	  	$syheader->appendTo($container);
  	  }
  	  $nullDiv=$this->createNullRow();
  	  $nullDiv->appendTo($container);
  	  $sybody=$this->createSybodyRow();
  	  $sybody->appendTo($container);
  	  $container->appendTo($this->body);
  	}
  }
  class createHtml{
  	private $html;
    public function __construct($dataSet,$test){
      $this->html=new htmlTag($dataSet,$test);
      $this->html->packChildren();
      $this->html->getAllContent();
      $this->html->echoHtml();
    }
  }
?>