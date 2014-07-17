(function(){
  sy=window.sy||{};
  sy.init=function(){

  }
  /********
   * this function is tring to get number
   *   from string like "table5" or "div4";
   *   return 5 or 4;
   */
  sy.getNumInStr=function(_str){
    return _str.match(/\d+/g);
  }
  sy.objRefresh=function(_obj){
	if(_obj instanceof Array){
	  _obj=[];
	}
	else{
	  if(typeof _obj == 'object'){
	    _obj={};
	  }
	}
  }
  sy.isNull=function($val){
	if(!$val&&typeof($val)!="undefined"&&$val!=0){
	  return true;
	}
	else{
	  return false;
	}
  }
  sy.deepCopy=function(p,c){
	var c=c||{};
	for(var i in p){
	  if(typeof p[i] === 'object'){
		c[i]=(p[i].constructor===Array)?[]:{};
		sy.deepCopy(p[i],c[i]);
	  }
	  else{
		c[i]=p[i];
	  }
	}
	return c;
  }
  sy.addLable=function(id,tag){
	var tmpHtml,appendHtml;
	appendHtml=tmpHtml="";
	tmpHtml=$("#"+id).html();
	appendHtml+="<"+tag+">"+tmpHtml+"</"+tag+">";
	$("#"+id).html(appendHtml);
  }
  sy.becomeStrong=function(id){
	sy.addLable(id,"strong");
  }
  //arr is a asoc arr;
  sy.arrToObject=function(arr){
	var tmpObject={};
	for(var key in arr){
	  tmpObject[key]=arr[key];
	}
	return tmpObject;
  }
  sy.getFirstDivId=function(num){
	var r=num.match(/^[a-zA-Z]+/gi);
	return r;
  }
  sy.tag=function(){
	this.tagStr="";
	this.isOne=0;
	this.withSlash=1;
	this.setDefaultTag=function(_str){
	  if(!this.getIsOne()){
	    this.tagStr="<"+_str+">"+"<"+"/"+_str+">";
	  }
	  else{
	    if(this.getWithSlash()){
	      this.tagStr="<"+_str+"/"+">";
	    }
	    else{
	      this.tagStr="<"+_str+">";
	    }
	  }
	}
	this.setIsOne=function(_one){
	  this.isOne=_one;	
	}
	this.getIsOne=function(){
	  return this.isOne;
	}
	this.setSlash=function(_slash){
	  this.withSlash=_slash;
	}
	this.getWithSlash=function(){
	  return this.withSlash;
	}
	this.setTagStr=function(_str){
	  this.tagStr=_str;
	}
	this.getTagStr=function(){
	  return this.tagStr;
	}
	this.changeToObject=function(){
	  return $(this.getTagStr());
	}
	this.setAttrInStr=function(_key,_val){
	  var pos,len,pointPos,firPar,secPar,keylen;
	  pos=this.tagStr.indexOf(_key);
	  if(pos==-1){
		len=this.tagStr.length;
	    pointPos=this.tagStr.indexOf('>');
	    firPar=this.tagStr.substr(0,pointPos);
	    tmpStr=" "+_key+"=\""+_val+"\"";
	    secPar=this.tagStr.substr(pointPos,len-pointPos);
	    this.setTagStr(firPar+tmpStr+secPar);
	  }
	  else{
        keylen=strlen(_key);
        len=this.tagStr.length;
        firPar=this.tagStr.substr(0,pos+keylen+2);
        tmpStr=""._val+" ";
        secPar=this.tagStr.substr(pos+keylen+2,len-(pos+keylen+2));
        this.setTagStr(firPar+tmpStr+secPar);
	  }
	  return this;
	}
	this.addContent=function(_content){
	  var len,pos,firPar,secPar,tmpStr;
	  len=this.tagStr.length;
	  pos=this.tagStr.indexOf(">");
	  firPar=this.tagStr.substr(0,pos+1);
	  tmpStr=""+_content;
	  secPar=this.tagStr.substr(pos+1,len-(pos+1));
	  this.setTagStr(firPar+tmpStr+secPar);
	}
  }
  sy.createTable=function(_descript,id){
	var _table,tmpTd,tmpTr;
	_table=new sy.tag();
	_table.setDefaultTag("table");
	tmpTd=new sy.tag();
	tmpTd.setDefaultTag("td");
	tmpTd.addContent(_descript);
	tmpTd.setAttrInStr("class","limit").setAttrInStr("contentEditable","true");
	tmpTr=new sy.tag();
	tmpTr.setDefaultTag("tr");
    trDiv=tmpTr.changeToObject();
    tdDiv=tmpTd.changeToObject();
	_table.setAttrInStr('id',id).setAttrInStr("class","table table-bordered blocks");
	tableDiv=_table.changeToObject();
	tdDiv.appendTo(trDiv);
	trDiv.appendTo(tableDiv);
	return tableDiv;
  }
  sy.createRemoveSpan=function(_url){
	return $('<span data-toggle="modal" data-target="#mymodal" class="glyphicon gspan glyphicon-remove-circle" id="'+_url+'"></span>');
  }
  sy.createStaticSpan=function(_url){
	return $('<a class="action" href="http://127.0.0.1:8081/surveyOI/doc/result.php?url='+_url+'"><span class="glyphicon gspan glyphicon-stats"></span></a>');
  }
  sy.createEditSpan=function(_url){
    return $('<a class="action" href="../s/'+_url+'.php"><span class="glyphicon glyphicon-edit gspan"></span></a>');
  }
  sy.createActionTd=function(_url){
    var tmpTd,tmpTdobj,editSpan,staticSpan,removeSpan;
    tmpTd=new sy.tag();
    tmpTd.setDefaultTag('td');
    tmpTdobj=tmpTd.changeToObject();
    editSpan=sy.createEditSpan(_url);
    editSpan.appendTo(tmpTdobj);
    staticSpan=sy.createStaticSpan(_url);
    staticSpan.appendTo(tmpTdobj);
    removeSpan=sy.createRemoveSpan(_url);
    removeSpan.appendTo(tmpTdobj);
    return tmpTdobj;
  }
  sy.removeSurvey=function(){
	var idstr;
	idstr=$(this)[0].id;
	$("#datahide").val(idstr);
  }
  sy.removeSurveyByUrl=function(_url){
	$.ajax({
	  type:'POST',
	  data:{url:_url},
	  url:"http://127.0.0.1:8081/surveyOI/_core/server.php?query=remove",
	  success:function(data){
		//var mydata=eval('('+decodeURI(data)+')');
		//sy.createSurveyTable(mydata,start);
		//$("#removeButton").click(sy.btnRemove);
		//alert(data);
      }
	});
  }
  sy.createPreli=function(){
	return $('<li class="pageli" id="pre"><a>&laquo;</a></li>');  
  }
  sy.createAftli=function(){
    return $('<li class="pageli" id="aft"><a>&raquo;</a></li>'); 
  }
  sy.createPageli=function(num){
	return $('<li class="pageli" id="page'+num+'"><a>'+num+'</a></li>');
  }
  sy.getPageNum=function(_str){
	return parseInt(_str.substr(4,_str.length-4));
  }
  sy.removePage=function(){
	var _children,i;
	_children=$("#pageul").children();
	if(_children.length>0){
	  for(i=0;i<_children.length;i++){
		_children[i].remove();
	  }
	}
  }
  sy.createPageUl=function(n){
	var tmp,i,pre,aft,tmpli;
	tmp=$("#pageul");
	pre=sy.createPreli();
	pre.appendTo(tmp);
	for(i=0;i<n;i++){
	  tmpli=sy.createPageli(i+1);
	  tmpli.appendTo(tmp);
	}
    aft=sy.createAftli();
	aft.appendTo(tmp);
  }
  sy.btnRemove=function(){
	var theid;
	theid=$("#datahide").val();
	$("#"+theid).parent().parent().remove();
	$("#mymodal").modal('hide');
	sy.removeSurveyByUrl(theid);
  }
  $(document).ready(function(){
	sy.addLable("choice","strong");
  });
})()