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
  sy.mydata=[];
  sy.createSyTd=function(_descript){
	var tmpTd,tmpObj;
	tmpTd=new sy.tag();
	tmpTd.setDefaultTag('td');
	tmpTd.addContent(_descript);
	tmpObj=tmpTd.changeToObject();
	return tmpObj;
  }
  sy.curPage=1;
  sy.createSurveyTr=function(title,owner,cTime,url,aNum){
	var tmpTr,tmpOwn,tmpTime,tmpNum,tmpAction,tmptitle,trObj;
	tmptitle=sy.createTitleTd(title,url);
	tmpOwn=sy.createSyTd(owner);
	tmpTime=sy.createSyTd(cTime);
	tmpNum=sy.createSyTd(aNum);
	tmpAction=sy.createActionTd(url);
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
  sy.createSurveyTable=function(data,start,end){
	var _children,_last,trfather,tmptr,tmpTd,i,j,tmpData,tmp;
	trfather=$("#surveyTable");
	_children=trfather.children();
	if(_children.length>1){
	  _last=_children[_children.length-1];
       _last.remove();
	}
	for(i=start;i<data.length&&i<end;i++){
	  tmp=data[i];
	  //if(sy.isNull(tmp["title"])||sy.isNull(tmp["name"])||sy.isNull(tmp['createTime'])||sy.isNull(tmp['url'])||sy.isNull(tmp['answerNum'])) continue;
	  tmptr=sy.createSurveyTr(tmp["title"],tmp["name"],tmp['createTime'],tmp['url'],tmp['answerNum']);
	  tmptr.appendTo(trfather);
	  $("#"+tmp['url']).click(sy.removeSurvey);
	}  
  }
  sy.pageliclick=function(){
	var idstr,ppos,apos,num;
	idstr=$(this)[0].id;
	ppos=idstr.indexOf("pre");
	apos=idstr.indexOf("aft");
	if(ppos==-1 && apos==-1){
	  num=sy.getPageNum(idstr);
	  sy.createSurveyTable(sy.mydata,(num-1)*10,num*10);
	  sy.curPage=num;
	  return;
	}
	if(ppos!=-1){
	  if(sy.curPage>1) sy.curPage--;
	}
	if(apos!=-1){
	  if(sy.curPage<(sy.mydata.length/10)) sy.curPage++;
	}
	sy.createSurveyTable(sy.mydata,(sy.curPage-1)*10,sy.curPage*10);
  }
  sy.getDataSet=function(type,start){
	var timeStr;
	timeStr=sy.timeArr[type];
	$.ajax({
	  type:'GET',
	  url:"http://127.0.0.1:8081/surveyOI/_core/server.php?query=adminData&time="+timeStr,
	  success:function(data){
		sy.mydata=[];
		sy.mydata=eval('('+decodeURI(data)+')');
		sy.createSurveyTable(sy.mydata,0,10);
		sy.removePage();
		sy.createPageUl(parseInt(sy.mydata.length/10)+1);
		sy.curPage=1;
		$("#removeButton").click(sy.btnRemove);
		$(".pageli").click(sy.pageliclick);
	  }
	});
  }
  sy.removeFourButton=function(){
	sy.removeBtnClass("today");
	sy.removeBtnClass("thisWeek");
	sy.removeBtnClass("thisMonth");
	sy.removeBtnClass("all");
  }
  sy.removeBtnClass=function(_id){
	$('#'+_id).removeClass();
	$("#"+_id).addClass("btn btn-default");
  }
  sy.addPrimary=function(){
	sy.removeFourButton();
	$(this).addClass("btn-primary");	  
  }
  sy.addToday=function(){
	sy.getDataSet(0,0);
	sy.addPrimary();
  }
  sy.addWeek=function(){
	sy.getDataSet(1,0); 
	sy.addPrimary();
  }
  sy.addMonth=function(){
	sy.getDataSet(2,0);
	sy.addPrimary();;
  }
  sy.addAll=function(){
	sy.getDataSet(3,0); 
	sy.addPrimary();
  }
  sy.getSearch=function(_val){
	$.ajax({
	  type:"POST",
	  data:{data:_val},
	  url:"http://127.0.0.1:8081/surveyOI/_core/server.php?query=searchAdmin",
	  success:function(data){
		sy.mydata=[];
		sy.mydata=eval('('+decodeURI(data)+')');
		sy.createSurveyTable(sy.mydata,0,10);
		sy.removePage();
		sy.createPageUl(parseInt(sy.mydata.length/10)+1);
		sy.curPage=1;
		$(".pageli").click(sy.pageliclick);
	  }
	});
  }
  sy.searchBtnClick=function(){
	sy.getSearch($("#searchInput").val());
  }
  sy.inputChange=function(){
	sy.getSearch($(this).val());
  }
  sy.binFun=function(){
	$("#searchButton").click(sy.searchBtnClick);
	$("#searchInput").change(sy.inputChange);
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