(function(){
  sy=window.sy||{};
  sy.init=function(){

  }
  sy.extend=function(child,parent){
	var F=function(){};
	F.prototype=parent.prototype;
	child.prototype=new F();
	child.prototype.constructor=child;
	child.uber=parent.prototype;
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
  $(document).ready(function(){
	sy.addLable("choice","strong");
  });
  
})()