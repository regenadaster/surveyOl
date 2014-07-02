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
  alert("good");
	
	
	
	
	
	
})()