(function(){
  sy=window.sy||sy;
  sy.data={};
  sy.dataSet=[];
  sy.addToDataSet=function(_data){
	sy.dataSet.push(_data);
  }
  sy.getQuestionAndOption=function(_str){
	var pos,len;
	pos=_str.indexOf("input");
	if(pos==-1){
	  return false;
	}
	else{
      return _str.substr(0,_str.length-5);
	}
  }
  sy.splitUrl=function(_str){
	var arr,fileNameArr;
	arr=_str.split('/');
	fileNameArr=arr[arr.length-1].split('.');
    return fileNameArr[0];
  }
  sy.getUrl=function(){
	var surveyId;
	sy.url=window.location.href;
	surveyId=sy.splitUrl(sy.url);
	return surveyId;
  }
  sy.send=function(){
	sy.data.surveyId=sy.getUrl();
	sy.data.answer=sy.dataSet;
	$.ajax({
	  type:"post",
	  url:"http://127.0.0.1:8081/surveyOI/_core/server.php?query=dataCollection",
	  data:{dataSet:sy.data},
	  success:function(data){
		alert(data[0]);
		window.location="http://127.0.0.1:8081/surveyOI/doc/home.php"; 
	  }
	});
  }
  sy.dataCollectFun=function(){
	var tmpID;
	$(".question input").each(function(){
	  if($(this).prop("checked")==true){
	    tmpId=sy.getQuestionAndOption($(this)[0].id);
	    sy.dataSet.push(tmpId);
	  }
	});
    sy.send();
  }
  sy.binFun=function(){
	$("#commitBtn").click(sy.dataCollectFun);
  }
  sy.startFun=function(){
	sy.binFun();
  }
	
  $(document).ready(sy.startFun);
})()