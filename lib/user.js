(function(){
  sy=window.sy||{};
  sy.createUserTd=function(_descript){
	var tmpTd,tmpTdObject;
	tmpTd=new sy.tag();
	tmpTd.setDefaultTag('td');
	tmpTd.addContent(_descript);
	tmpTdObject=tmpTd.changeToObject();
	return tmpTdObject;
  }
  sy.curPage=1;
  sy.createPublishOption=function(_isPublish,_isUnpublish,_isSelect,_iscollection,_isclose){
	var _tmpOption;
	_tmpOption=new sy.tag();
	_tmpOption.setDefaultTag("option");
	if(_isSelect==1){
	  _tmpOption.setAttrInStr("selected","selected");
	}
	if(_isPublish==1){
	  _tmpOption.addContent("发布"); 
	}
	if(_isUnpublish==1){
      _tmpOption.addContent("未发布");	
	}
	if(_iscollection==1){
	  _tmpOption.addContent("收集中");
	}
	if(_isclose==1){
	  _tmpOption.addContent("已关闭");
	}
	return _tmpOption.changeToObject();
  }
  sy.createSelect=function(_isPublish,isClose){
	var tmpSelect,selectObject,_optOne,_optTwo;
	tmpSelect=new sy.tag();
	tmpSelect.setDefaultTag("select");
	tmpSelect.setAttrInStr("class","selectpicker btn btn-default  btn-sm");
	selectObject=tmpSelect.changeToObject();
	if(isClose==1&&_isPublish==1){
	  _optOne=sy.createPublishOption(0,0,0,1,0);
	  _optTwo=sy.createPublishOption(0,0,1,0,1)
	}
	else{
	  if(_isPublish==1&&isClose==0){
	    _optOne=sy.createPublishOption(0,0,1,1,0);
	    _optTwo=sy.createPublishOption(0,0,0,0,1);
	  }
	  else{
        _optOne=sy.createPublishOption(0,1,1,0,0);
        _optTwo=sy.createPublishOption(1,0,0,0,0);	  
	  }
	}
	_optOne.appendTo(selectObject);
	_optTwo.appendTo(selectObject);
	return selectObject;
  }
  sy.createTitleTd=function(title,_url){
    return $('<td><a href="http://127.0.0.1:8081/surveyOI/doc/newCreateSurvey.php?url='+_url+'">'+title+'</a></td>');
  }
  sy.createUserTr=function(title,cTime,isPublish,answerNum,_url,isClose){
	var tmpTr,tmpTrObject,tmpTitle,tmpCtime,tmpPublish,tmpNum,tmpAction,tmpTd,tmpTdObject;
	tmpTr=new sy.tag();
	tmpTd=new sy.tag();
	tmpTd.setDefaultTag("td");
	tmpTr.setDefaultTag("tr");
    tmpTitle=sy.createTitleTd(title,_url);
    tmpCtime=sy.createUserTd(cTime);
    tmpPublish=sy.createSelect(isPublish,isClose);
    tmpTdObject=tmpTd.changeToObject();
    tmpPublish.appendTo(tmpTdObject);
    tmpNum=sy.createUserTd(answerNum);
    tmpTrObject=tmpTr.changeToObject();
    tmpTitle.appendTo(tmpTrObject);
    tmpCtime.appendTo(tmpTrObject);
    tmpTdObject.appendTo(tmpTrObject);
    tmpNum.appendTo(tmpTrObject);
    tmpAction=sy.createActionTd(_url);
    tmpAction.appendTo(tmpTrObject);
    return tmpTrObject;
  }
  sy.mydata={};
  sy.selectchange=function(){
    var _children,first,firstchild,_html,pos,sec,father,_begin,set;
    set=0;
    if($(this).val()=="已关闭"){
      set=2;
    }
    if($(this).val()=="发布"){
      set=1;
    }
	_begin=$(this).parent().parent()[0].children[1].innerText;
	//pos=_html.indexOf("url=");
	if(set!=0){
	  sy.setSurvey(set,_begin);
	}
  }
  sy.setSurvey=function(set,_surveyid){
	$.ajax({
	  type:"POST",
	  data:{
		set:set,
		begin:_surveyid
	  },
	  url:"http://127.0.0.1:8081/surveyOI/_core/server.php?query=set",
	  success:function(data){
        alert(data);
        sy.getDataSet();
	  }
    });
  }
  sy.createUserTable=function(data,start,end){
	var trfather,_children,tmptr,tmptd,i,j,tmpData;
	trfather=$("#userTable");
	_children=trfather.children();
	if(_children.length>1){
	  _children[_children.length-1].remove();
	}
	for(i=start;i<data.length&&i<end;i++){
	  tmpData=data[i];
	  tmptr=sy.createUserTr(tmpData["title"],tmpData["createTime"],tmpData["isPublish"],tmpData["answerNum"],tmpData["url"],tmpData["isClose"]);
	  tmptr.appendTo(trfather);
	  $("#"+tmpData['url']).click(sy.removeSurvey);
	}
	$("select").change(sy.selectchange);
  }
  sy.pageliclick=function(){
	var idstr,ppos,apos,num;
	idstr=$(this)[0].id;
	ppos=idstr.indexOf("pre");
	apos=idstr.indexOf("aft");
	if(ppos==-1 && apos==-1){
	  num=sy.getPageNum(idstr);
	  sy.createUserTable(sy.mydata,(num-1)*10,num*10);
	  sy.curPage=num;
	  return;
	}
    if(ppos!=-1){
	  if(sy.curPage>1) sy.curPage--;
	}
	if(apos!=-1){
	  if(sy.curPage<(sy.mydata.length/10)) sy.curPage++;
	}
	sy.createUserTable(sy.mydata,(sy.curPage-1)*10,sy.curPage*10);
  }
  sy.getDataSet=function(){
	$.ajax({
	  type:'GET',
	  url:"http://127.0.0.1:8081/surveyOI/_core/server.php?query=userSurvey",
	  success:function(data){
		sy.mydata=[];
	    sy.mydata=eval('('+decodeURI(data)+')');
	    sy.createUserTable(sy.mydata,0,10);
		sy.removePage();
		sy.createPageUl(parseInt(sy.mydata.length/10)+1);
		sy.curPage=1;
		$(".pageli").click(sy.pageliclick);
	  }
	});
  }
  sy.getSearch=function(_val){
	$.ajax({
	  type:"POST",
	  data:{data:_val},
	  url:"http://127.0.0.1:8081/surveyOI/_core/server.php?query=search",
	  success:function(data){
		sy.mydata=[];
		sy.mydata=eval('('+decodeURI(data)+')');
		sy.createUserTable(sy.mydata,0,10);
		sy.removePage();
		sy.createPageUl(parseInt(sy.mydata.length/10)+1);
		sy.curPage=1;
	  }
	});
  }
  sy.searchBtnClick=function(){
	sy.getSearch($("#searchInput").val());
  }
  sy.goToCreate=function(){
	window.location="http://127.0.0.1:8081/surveyOI/doc/newCreateSurvey.php";
  }
  sy.inputChange=function(){
	sy.getSearch($(this).val());
  }
  sy.binFun=function(){
	$("#first").click(function(){alert("good");});
	$("#searchButton").click(sy.searchBtnClick);
	$("#searchInput").change(sy.inputChange);
	$("#createBtn").click(sy.goToCreate);
	$("#removeButton").click(sy.btnRemove);
  }
  sy.startFun=function(){
	sy.getDataSet();
	sy.binFun();
  }
  $(document).ready(sy.startFun);
})()