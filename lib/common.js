(function(){
  sy=window.sy||{};
  sy.init=function(){

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
  $(document).ready(function(){
	sy.addLable("choice","strong");
  });
})()