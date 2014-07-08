(function(){
  sy=window.sy||{};
  sy.surveyNav=["surveyPublish","surveyUrl","surveyTake","surveyStatic","surveyEmail"];
  sy.setActive=function(_index){
    var i;
    for(i=0;i<sy.surveyNav.length;i++){
      if(_index==i){
    	$("#"+sy.surveyNav[i]).addClass('active');
      }
      else{
    	$("#"+sy.surveyNav[i]).removeClass('active');
      }
    }
  }
  sy.getUrl=function(_str){
	var arr,queryArr;
	arr=_str.split("?");
	queryArr=arr[1].split("=");
	return queryArr[1];
  }
  sy.binFun=function(){
	$("#surveyPublish").click();
  }
  sy.startFun=function(){
	sy.binFun();
	var surveyUrl,sUrl;
	sy.url=window.location.href;
	surveyUrl=sy.getUrl(sy.url);
	sUrl="http://127.0.0.1:8081/surveyOI"+surveyUrl;
	$("#urlSpanVal").html(sUrl);
	sy.setActive(1);
  }
  $(document).ready(sy.startFun);
})()