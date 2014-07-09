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
  sy.createPublishOption=function(_isPublish,_isSelect){
	var _tmpOption;
	_tmpOption=new sy.tag();
	_tmpOption.setDefaultTag("option");
	if(_isSelect==1){
	  _tmpOption.setAttrInStr("selected","selected");
	}
	if(_isPublish==1){
	  _tmpOption.addContent("发布"); 
	}
	else{
      _tmpOption.addContent("未发布"); 	
	}
	return _tmpOption.changeToObject();
  }
  sy.createSelect=function(_isPublish){
	var tmpSelect,selectObject,_optOne,_optTwo;
	tmpSelect=new sy.tag();
	tmpSelect.setDefaultTag("select");
	tmpSelect.setAttrInStr("class","selectpicker btn btn-default  btn-sm");
	selectObject=tmpSelect.changeToObject();
	if(_isPublish==1){
	  _optOne=sy.createPublishOption(1,1);
	  _optTwo=sy.createPublishOption(0,0);
	}
	else{
      _optOne=sy.createPublishOption(1,0);
      _optTwo=sy.createPublishOption(0,1);	  
	}
	_optOne.appendTo(selectObject);
	_optTwo.appendTo(selectObject);
	return selectObject;
  }
  sy.createUserTr=function(title,cTime,isPublish,answerNum){
	var tmpTr,tmpTrObject,tmpTitle,tmpCtime,tmpPublish,tmpNum,tmpAction,tmpTd,tmpTdObject;
	tmpTr=new sy.tag();
	tmpTd=new sy.tag();
	tmpTd.setDefaultTag("td");
	tmpTr.setDefaultTag("tr");
    tmpTitle=sy.createUserTd(title);
    tmpCtime=sy.createUserTd(cTime);
    tmpPublish=sy.createSelect(isPublish);
    tmpTdObject=tmpTd.changeToObject();
    tmpPublish.appendTo(tmpTdObject);
    tmpNum=sy.createUserTd(answerNum);
    tmpTrObject=tmpTr.changeToObject();
    tmpTitle.appendTo(tmpTrObject);
    tmpCtime.appendTo(tmpTrObject);
    tmpTdObject.appendTo(tmpTrObject);
    tmpNum.appendTo(tmpTrObject);
    tmpAction=sy.createUserTd("action");
    tmpAction.appendTo(tmpTrObject);
    return tmpTrObject;
  }
  sy.createUserTable=function(data){
	var trfather,tmptr,tmptd,i,j,tmpData;
	trfather=$("#userTable");
	for(i=0;i<data.length;i++){
	  tmpData=data[i];
	  tmptr=sy.createUserTr(tmpData["title"],tmpData["createTime"],tmpData["isPublish"],tmpData["answerNum"]);
	  tmptr.appendTo(trfather);
	}
  }
  sy.getDataSet=function(){
	$.ajax({
	  type:'GET',
	  url:"http://127.0.0.1:8081/surveyOI/_core/server.php?query=userSurvey",
	  success:function(data){
	    var mydata=eval('('+decodeURI(data)+')');
	    sy.createUserTable(mydata);
	  }
	});
  }
  sy.goToCreate=function(){
	window.location="http://127.0.0.1:8081/surveyOI/doc/newCreateSurvey.php";
  }
  sy.binFun=function(){
	$("#createBtn").click(sy.goToCreate);
  }
  sy.startFun=function(){
	sy.getDataSet();
	sy.binFun();
  }
  $(document).ready(sy.startFun);
})()