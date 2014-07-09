(function(){
  sy=window.sy||{};
  sy.timeArr=["day","week","month","all"];
  sy.syBase="http://127.0.0.1:8081/surveyOI/s/";
  sy.createTitleTd=function(_title,url){
	var tmpTd,tmpA,objA,tdObj;
	tmpTd=new sy.tag();
	tmpA=new sy.tag();
	tmpA.setDefaultTag("a");
	tmpTd.setDefaultTag("td");
	tmpA.addContent(_title);
	if(typeof url === "undefined"){
	  tmpA.setAttrInStr("href","#");
	}
	else{
	  tmpA.setAttrInStr("href", sy.syBase+url+'.php');
	}
	objA=tmpA.changeToObject();
	tdObj=tmpTd.changeToObject();
	objA.appendTo(tdObj);
	return tdObj;
  }
  sy.createSyTd=function(_descript){
	var tmpTd,tmpObj;
	tmpTd=new sy.tag();
	tmpTd.setDefaultTag('td');
	tmpTd.addContent(_descript);
	tmpObj=tmpTd.changeToObject();
	return tmpObj;
  }
  sy.createSurveyTr=function(title,owner,cTime,url,aNum){
	var tmpTr,tmpOwn,tmpTime,tmpNum,tmpAction,tmptitle,trObj;
	tmptitle=sy.createTitleTd(title,url);
	tmpOwn=sy.createSyTd(owner);
	tmpTime=sy.createSyTd(cTime);
	tmpNum=sy.createSyTd(aNum);
	tmpAction=sy.createSyTd('action');
	tmpTr=new sy.tag();
	tmpTr.setDefaultTag("tr");
	trObj=tmpTr.changeToObject();
	tmptitle.appendTo(trObj);
	tmpOwn.appendTo(trObj);
	tmpTime.appendTo(trObj);
	tmpNum.appendTo(trObj);
	tmpAction.appendTo(trObj);
	return trObj;
  }
  sy.createSurveyTable=function(data,start){
	var _children,_last,trfather,tmptr,tmpTd,i,j,tmpData,tmp;
	trfather=$("#surveyTable");
	if(start==0){
	  _children=trfather.children();
	  _last=_children[_children.length-1];
	  _last.remove();
	}
	for(i=0;i<data.length;i++){
	  tmp=data[i];
	  if(sy.isNull(tmp["title"])||sy.isNull(tmp["name"])||sy.isNull(tmp['createTime'])||sy.isNull(tmp['url'])||sy.isNull(tmp['answerNum'])) continue;
	  tmptr=sy.createSurveyTr(tmp["title"],tmp["name"],tmp['createTime'],tmp['url'],tmp['answerNum']);
	  tmptr.appendTo(trfather);
	}  
  }
  sy.getDataSet=function(type,start){
	var timeStr;
	timeStr=sy.timeArr[type];
	$.ajax({
	  type:'GET',
	  url:"http://127.0.0.1:8081/surveyOI/_core/server.php?query=adminData&time="+timeStr,
	  success:function(data){
		var mydata=eval('('+decodeURI(data)+')');
		sy.createSurveyTable(mydata,start);
	  }
	});
  }
  sy.addToday=function(){
	sy.getDataSet(0,0);
  }
  sy.addWeek=function(){
	sy.getDataSet(1,0);  
  }
  sy.addMonth=function(){
	sy.getDataSet(2,0);  
  }
  sy.addAll=function(){
	sy.getDataSet(3,0);  
  }
  sy.binFun=function(){
	$("#today").click(sy.addToday);
	$("#thisWeek").click(sy.addWeek);
	$("#thisMonth").click(sy.addMonth);
	$("#all").click(sy.addAll);
  }
  sy.startFun=function(){
	sy.getDataSet(0,1);
    sy.binFun();
  }
  $(document).ready(sy.startFun);
})()