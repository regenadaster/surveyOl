(function(){
  sy=window.sy||{};
  sy.createSyFun=function(){
  }
  sy.binFun=function(){
	$("#questionnaire").click(sy.createSyFun);
  }	
	
  sy.startFun=function(){
	sy.binFun();
  }	

 $(document).ready(sy.startFun);
})()