(function(){
  sy=window.sy||{};
  sy.getDataSet=function(){
	$.ajax({
	  type:'GET',
	  url:"http://127.0.0.1:8081/surveyOI/_core/server.php?query=userSurvey",
	  success:function(data){
		alert(data);
	  }
	});
  }
  sy.startFun=function(){
	sy.getDataSet();
	  
  }
  $(document).ready(sy.startFun);
})()