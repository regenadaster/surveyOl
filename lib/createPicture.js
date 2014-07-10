(function(){
  sy=window.sy||{};
  sy.mydataSet=[];
  sy.name=[];
  sy.descript=[];
  sy.createStrip=function(_id,_dataSet,_name,_descript,isClick){
	var category,value,i,_children,_last;
	category=[];
	value=[];
	for(i=0;i<_dataSet.length;i++){
	  category.push(_dataSet[i]["name"]);
	  value.push(_dataSet[i]["y"]);
	}
	$(function () {
	  if(isClick){
	    _children=$('#'+_id).children();
	    _last=_children[_children.length-1];
	    if(typeof _last != "undeined"){
	      _last.remove();
	    }
	  }
      $('#'+_id).highcharts({                                           
		chart: {                                                           
		  type: 'bar'                                                    
		},                                                                 
		title: {                                                           
		  text: _descript                    
		},                                                               
		xAxis: {                                                           
		  categories: category,
		  title: {                                                       
		  text: null                                                 
		 }                                                              
		},                                                                 
		yAxis: {                                                           
		   min: 0,                                                        
		   title: {                                                       
		     text: '个数',                             
		       align: 'high'                                              
		     },                                                             
		   labels: {                                                      
		     overflow: 'justify'                                        
		   }                                                              
		},                                                            
		plotOptions: {                                                     
		  bar: {                                                         
		    dataLabels: {                                              
		      enabled: true                                          
		    }                                                          
		  }                                                              
		},                                                                 
		legend: {                                                          
		  layout: 'vertical',                                            
		  align: 'right',                                                
		  verticalAlign: 'top',                                          
		  x: -40,                                                        
		  y: 100,                                                        
		  floating: true,                                                
		  borderWidth: 1,                                                
		  backgroundColor: '#FFFFFF',                                    
		  shadow: true                                                   
		 },                                                                 
		 credits: {                                                         
		   enabled: false                                                 
		 },                                                                 
		 series: [{                                                         
		   name: _name,                                             
		   data: value                                  
		 }]                                                                 
	  });                                                                    
    });	
  }
  sy.createPie=function(_id,_dataSet,_name,_descript,isClick){
	var _children,_last;
	$(function(){
	  if(isClick){
        _children=$('#'+_id).children();
	    _last=_children[_children.length-1];
	    _last.remove();
	  }
	  $('#'+_id).highcharts({
	    chart: {
	      plotBackgroundColor: null,
	      plotBorderWidth: null,
	      plotShadow: false
	    },
	    title:{
	      text:_descript
	    },
	    tooltip: {
	      pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
	    },
	    plotOptions:{
	      pie:{
	        allowPointSelect:true,
	        cursor:'pointer',
	        dataLabels:{
	          enabled:true,
	      	  color:'#ffffff',
	      	  format:'<b>{point.name}</b>:{point.percentage:.1f} %'
	        }	 
	      }
	    },
	    series:[{
	      type:'pie',
	      name:_name,
	      data:_dataSet
	     }]
	  });
	});
  }
  sy.createSheadspan=function(_descript){
	var tmpspan;
	tmpspan=new sy.tag();
	tmpspan.setDefaultTag("span");
	tmpspan.setAttrInStr("style","float:left;margin-top:4px;");
	tmpspan.addContent(_descript);
	return tmpspan.changeToObject();
  }
  sy.createButtonTd=function(){
	var tmpTd;
	tmpTd=new sy.tag();
	tmpTd.setDefaultTag("td");
	return tmpTd.changeToObject();
  }
  sy.createNullTable=function(){
	var tmptable;
	tmptable=new sy.tag();
	tmptable.setDefaultTag("table");
	return tmptable.changeToObject();
  }
  sy.createNullTr=function(){
	var tmpTr;
	tmpTr=new sy.tag();
	tmpTr.setDefaultTag("tr");
	return tmpTr.changeToObject();
  }
  sy.createHButton=function(num,_index){
	var tmpButton;
	tmpButton=new sy.tag();
	tmpButton.setDefaultTag("button");
    tmpButton.setAttrInStr("class","btn btn-default btn-sm");
    if(_index==0){
      tmpButton.addContent("按时间排序");
      tmpButton.setAttrInStr("id","timebutton"+num);
    }
    if(_index==1){
      tmpButton.addContent("饼图");
      tmpButton.setAttrInStr("id","piebutton"+num);
    }
    if(_index==2){
      tmpButton.addContent("柱状图");
      tmpButton.setAttrInStr("id","zubutton"+num);
    }
    return tmpButton.changeToObject();
  }
  sy.createHeadTable=function(num){
	var tmpTable,tmpTr,tmpButton;
	tmpTable=sy.createNullTable();
	tmpTr=sy.createNullTr();
	for(i=0;i<3;i++){
      tmpButton=sy.createHButton(num,i);
      tmpButton.appendTo(tmpTr);
	}
	tmpTr.appendTo(tmpTable);
	return tmpTable;
  }
  sy.createHeadDiv=function(num,_descript){
	var headDiv,tmptable,tmpspan,headObj;
	headDiv=new sy.tag();
	headDiv.setDefaultTag("div");
	headDiv.setAttrInStr("style","float:right");
	tmptable=sy.createHeadTable(num);
	headObj=headDiv.changeToObject();
    tmptable.appendTo(headObj);
    return headObj;
  }
  sy.createQuesionHead=function(_descript,num){
	var tmpspan,tmpdiv,shead,sheadObj;
    tmpspan=sy.createSheadspan(_descript);
    tmpdiv=sy.createHeadDiv(num);
	shead=new sy.tag();
	shead.setDefaultTag("div");
	shead.setAttrInStr("class", "shead");
	sheadObj=shead.changeToObject();
	tmpspan.appendTo(sheadObj);
	tmpdiv.appendTo(sheadObj);
	return sheadObj;
  }
  sy.createShead=function(_descript,num){
	return sy.createQuesionHead(_descript,num);
  }
  sy.createTrHead=function(_first,_second){
	var tmpTr,tdone,tdtwo,tdoneOb,tdtwoOb;
	tmpTr=sy.createNullTr();
	tdone=new sy.tag();
	tdone.setDefaultTag("td");
	tdone.setAttrInStr("class", "col-md-4");
	tdone.addContent(_first);
	tdtwo=new sy.tag();
	tdtwo.setDefaultTag("td");
	tdtwo.setAttrInStr("class", "col-md-4");
	tdtwo.addContent(_second);
	tdoneOb=tdone.changeToObject();
	tdtwoOb=tdtwo.changeToObject();
	tdoneOb.appendTo(tmpTr);
	tdtwoOb.appendTo(tmpTr);
	return tmpTr;
  }
  sy.createSbodyTable=function(data){
	var tmpTable,tbObj,htd;
	tmpTable=new sy.tag();
	tmpTable.setDefaultTag("table");
	tmpTable.setAttrInStr("class","stable table table-condensed table-bordered")
    tbObj=tmpTable.changeToObject();
	htd=sy.createTrHead("答案选项","回复情况");
	htd.appendTo(tbObj);
	for(i=0;i<data.length;i++){
	  htd=sy.createTrHead(data[i][0],data[i][1]);
	  htd.appendTo(tbObj);
	}
    return tbObj;
  }
  sy.createSpic=function(num){
	var tmpDiv,ptmp,dobj,pobj;
	tmpDiv=new sy.tag();
	tmpDiv.setDefaultTag("div");
	tmpDiv.setAttrInStr("class","spic");
	ptmp=new sy.tag();
	ptmp.setDefaultTag("div");
	ptmp.setAttrInStr("id","Pcontainer"+num);
	ptmp.setAttrInStr("class","row");
	dobj=tmpDiv.changeToObject();
	pobj=ptmp.changeToObject();
	pobj.appendTo(dobj);
	return dobj;
  }
  sy.createSbody=function(num,data){
	var sbody,sobj,spic,tmptb;
	sbody=new sy.tag();
	sbody.setDefaultTag("div");
	sbody.setAttrInStr("class","sbody");	
	sobj=sbody.changeToObject();
	spic=sy.createSpic(num);
	tmptb=sy.createSbodyTable(data);
	spic.appendTo(sobj);
	tmptb.appendTo(sobj);
	return sobj;
  }
  sy.createSingle=function(_descript,num,data){
	var shead,sbody,single,sinobj;
	shead=sy.createShead(_descript,num);
	sbody=sy.createSbody(num,data);
	single=new sy.tag();
	single.setDefaultTag("div");
	single.setAttrInStr("class","single");
	sinobj=single.changeToObject();
	shead.appendTo(sinobj);
	sbody.appendTo(sinobj);
	return sinobj;
  }
  
  sy.createPicture=function(data){
    var fa,i,j,k,packedData,tmpArr,tmpsingle,tmpStr;
    var tmpanswer=data.answer;
    fa=$("#results");
    $("#title").html(data['title']);
    for(i=0;i<tmpanswer.length;i++){
      packedData=[];
      for(j=0;j<tmpanswer[i].optNum;j++){
    	tmpArr=[];
    	tmpArr.push("选项"+parseInt(j+1)+tmpanswer[i]["optDescript"][j]);
    	tmpArr.push(parseInt(tmpanswer[i]['optCount'][j]));
    	packedData.push(tmpArr);
      }
      tmpsingle=sy.createSingle(tmpanswer[i]["descript"],i+1,packedData);
      tmpsingle.appendTo(fa);
      tmpStr=parseInt(i+1);
      sy.mydataSet.push(packedData);
      sy.createPie("Pcontainer"+tmpStr,packedData,"问题"+tmpStr,tmpanswer[i]["descript"],0);
      sy.name.push("问题"+tmpStr);
      sy.descript.push(tmpanswer[i]["descript"]);
    }
  }
  sy.getButtonNum=function(idstr){
    var tmp,pos;
    pos=idstr.indexOf("button");
    if(pos!=-1){
      return parseInt(idstr.substr(pos+6,idstr.length-pos-6))-1;
    }
  }
  sy.getButtonType=function(idstr){
	var tmp,tpos,ppos,bpos,type;
	tpos=idstr.indexOf("timebutton");
	ppos=idstr.indexOf('piebutton');
	bpos=idstr.indexOf("zubutton");
	if(tpos!=-1){
	  return 1;
	}
	if(ppos!=-1){
      return 2;
	}
	if(bpos!=-1){
	  return 3;
	}
  }
  sy.buttonClick=function(){
	var idstr,btype,bnum;
	idstr=$(this)[0].id;
	btype=sy.getButtonType(idstr);
	bnum=parseInt(sy.getButtonNum(idstr));
	if(btype==2){
	  sy.createPie("Pcontainer"+parseInt(bnum+1),sy.mydataSet[bnum],sy.name[bnum],sy.descript[bnum],1);
	}
	if(btype==3){
	  sy.createStrip("Pcontainer"+parseInt(bnum+1),sy.mydataSet[bnum],sy.name[bnum],sy.descript[bnum],1);
	}
  }
  sy.binFun=function(){
	$(".btn").click(sy.buttonClick);
  }
  sy.getSurveyUrl=function(_url){
	var arr;
	arr=_url.split("?");
	queryArr=arr[1].split("=");
	return queryArr[1];
  }
  sy.getUrl=function(){
	sy.url=window.location.href;
	return sy.getSurveyUrl(sy.url);
  }
  sy.startFun=function(){
	var tmpUrl;
	tmpUrl=sy.getUrl();
	$.ajax({
	  type:"GET",
	  url:"http://127.0.0.1:8081/surveyOI/_core/server.php?query=statics&url="+tmpUrl,
	  success:function(data){
		var mydata=eval('('+decodeURI(data)+')');
		sy.createPicture(mydata);
		sy.binFun();
	  }
	});
  }
  $(document).ready(sy.startFun);
})()