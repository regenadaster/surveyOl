(function(){
  sy=window.sy||{};
  sy.survey=sy.survey||{};
  sy.getFirstDivId=function(num){
    var arr=[];
    arr=num.split('_');
    return arr[0];
  }
  sy.getBlockNumInStr=function(str){
	var r;
	r=str.match(/\d+$/gi);
	return r[0];
  }
  sy.getTableAndId=function(str){
	var tmp,pos;
	pos=str.indexOf('opt');
	if(pos==-1){
	  if(str.length!=0){
		return str;
	  }
	}
	else{
      tmp=str.substr(0,pos);
      return tmp;
	}
  }
  sy.getOptAndNum=function(str){
	var tmpStr,pos,labelpos;
    pos=str.indexOf("opt");
    if(pos==-1){
      return false;
    }
    else{
      labelpos=str.indexOf("label");
      if(labelpos==-1){
    	return str.substr(pos,str.length-labelpos);
      }
      else{
    	return str.substr(pos,str.length-(pos)-(str.length-labelpos));
      }
    }
  }
  sy.getOptNum=function(str){
	var tmpstr;
	tmpstr=sy.getOptAndNum(str);
	return tmpstr.substr(3,tmpstr.length-3);
  }
  sy.getTableNum=function(str){
	var tmpStr;
	tmpStr=sy.getTableAndId(str);
	return tmpStr.substr(5,tmpStr.length-5);
  }
  sy.sliceBlock=function(_index){
	Blocks.splice(_index,_index);
  }
  sy.sliceBlockWithTwo=function(_start,_end){
	Blocks.slice(_start,_end);
  }
  sy.survey.getSubject=function(){
	return "subject";
  }
  sy.survey.init=function(){
	sy.survey.titleId="titleSet";
	sy.survey.defaultDescript="请输入您对调查表的描述";
	sy.survey.getDescript=function(){
      return sy.survey.defaultDescript;
	}
	sy.survey.blocks=[];
	Blocks=sy.survey.blocks;
	sy.getBlockLen=function(){
	  return Blocks.length;
	}
	sy.getLastBlock=function(){
      return Blocks[sy.getBlockLen()-1];
	}
	sy.insertBlock=function(_index,_block){
	  Blocks.splice(_index,0,_block);
	}
	sy.survey.block=function(_id){
	  this.id=_id;
	  this.isHead=false;
	  this.isTitle=false;
	  this.isDescript=false;
	  this.isDraw=false;
	  this.style=[];
	  this.content={
	    isEditing:false,
	    options:[],
	    title:"",
	    subject:""
	  };
	  this.getSubject=function(){
		return this.content.subject;
	  }
	  this.setSubject=function(_subject){
		this.content.subject=_subject;
	  }
	  this.setIsTitle=function(_flag){
		this.isTitle=_flag;
	  }
	  this.getIsTitle=function(){
		return this.isTitle;
	  }
	  this.setId=function(_id){
	    this.id=_id;
	  }
	  this.getId=function(){
		return this.id;
	  }
	  this.setDraw=function(_draw){
		this.isDraw=_draw;
	  }
	  this.getDraw=function(){
		return this.isDraw;
	  }
	  this.setTitle=function(_title){
	    this.content.title=_title;
	  }
	  this.getTitle=function(){
		return this.content.title;
	  }
	  this.optionLen=function(){
		return this.content.option.length;
	  }
	  this.setStyle=function(key,value){
		this.style[key]=value;
	  }
	  this.getStyle=function(){
		return this.style;
	  }
	  this.setIsDescript=function(_des){
	    this.isDescript=_des;
	  }
	  this.getIsDescript=function(){
		return this.isDescript;
	  }
	  this.getOptionLen=function(){
		return this.content.options.length;
	  }
	}
	/*******
	 * the oType is the type of the question
	 *   0 is single question 
	 *   1 is multiple
	 *   2 is judgement
	 *   3 is eassy question
	 */
	sy.survey.option=function(){
      this.descript="";
      this.oType=0;
      this.isDraw=false;
      this.setId=function(_id){
    	this.id=_id;
      }
      this.getId=function(){
    	return this.id;
      }
      this.setDescript=function(_descript){
    	this.descript=_descript; 
      }
      this.getDescript=function(){
    	return this.descript;
      }
      this.setType=function(_type){
    	this.oType=_type;
      }
      this.getType=function(){
    	return this.oType;
      }
      this.setDraw=function(_draw){
    	this.isDraw=_draw;
      }
      this.getDraw=function(){
    	return this.isDraw;
      }
	}
  }
  sy.survey.init();
  sy.setTitle=function(){
	syid=sy.survey.titleId;
	sy.survey.title=$("#titleVal").val();
	$("#titleSet").html(sy.survey.title);
	sy.becomeStrong(syid);
	sy.addLable(syid,"h2");
  }
  sy.getTitle=function(){
	return sy.survey.title;
  }
  sy.createBlock=function(){
    var len=Blocks.length;
    var tmp=len+1;
	return new sy.survey.block("div"+tmp);
  }
  sy.createOption=function(){
	return new sy.survey.option();
  }
  sy.addOptionToBlocks=function(_block,_opt){
	 var len,tmp;
	 len=_block.getOptionLen();
	 tmp=len+1;
	 _opt.setId(_block.getId()+'_'+"opt"+tmp);
	 _block.content.options.push(_opt);
  }
  sy.addToBlocks=function(_block){
	Blocks.push(_block);
  }
  sy.getOptions=function(_block){
	return _block.content.options;
  }
  sy.getOption=function(_block,_index){
	return _block.content.options[_index];
  }
  sy.dropBlock=function(_index){
    $("#"+"div"+_index).remove();
    sy.sliceBlock(_index);
  }
  sy.createTitleBlock=function(){
	titleBlock=sy.createBlock();
	titleBlock.setTitle(sy.getTitle());
	titleBlock.setIsTitle(1);
	sy.addToBlocks(titleBlock);
	titleBlock.setStyle("text-align","center");
		//sy.setMarginTopAndBottom(titleBlock);
  }
  sy.createDescriptBlock=function(){
    descriptBlock=sy.createBlock();
	descriptBlock.setIsDescript(1);
	descriptBlock.setTitle(sy.survey.getDescript());
	sy.addToBlocks(descriptBlock);
		//sy.setMarginTopAndBottom(titleBlock);
  }
  sy.createSubjectBlock=function(){
	subjectBlock=sy.createBlock();
	subjectBlock.setIsDescript(1);
	subjectBlock.setTitle(sy.survey.getSubject());
	sy.addToBlocks(subjectBlock);
  }
  sy.addTwoOptionToBlock=function(_block,optOne,optTwo,type){
	optOne.setDescript("选项");
	optTwo.setDescript("选项");
	optOne.setType(type);
	optTwo.setType(type);
	sy.addOptionToBlocks(_block,optOne);
	sy.addOptionToBlocks(_block,optTwo);
  }
  sy.addQuestion=function(_title,_type){
	if(_type!=3){
      tmpB=sy.createBlock();
	  tmpB.setTitle(_title);
	  sy.addToBlocks(tmpB);
	  tmpOptOne=sy.createOption();
	  tmpOptTwo=sy.createOption();
	  sy.addTwoOptionToBlock(tmpB,tmpOptOne,tmpOptTwo,_type);
	}
  }
  sy.addSQB=function(){
	sy.addQuestion("单选题",0);
  }
  sy.addMultQB=function(){
	sy.addQuestion("多选题",1);
  }
  sy.addJudgeQB=function(){
	sy.addQuestion("判断题",2);
  }
  sy.freshBlockContainer=function(){
    $("#BlockContainer").html("");
  }
  sy.createBaseTable=function(_descript,num){
    var tmpTable;
	tmpTable=sy.createTable(_descript,"table"+num);
	return tmpTable;
  }
  sy.createTitleTable=function(_title){
	var titleTable;
	titleTable=sy.createBaseTable(_title,1);
	return titleTable;
  }
  sy.createDescriptTable=function(_descript){
	var descriptTable;
	descriptTable=sy.createBaseTable(_descript,2);
	return descriptTable;
  }
  sy.createSubjectTable=function(_subject){
	var subjectTable;
	subjectTable=sy.createBaseTable(_subject,3);
	return subjectTable;
  }
  sy.getRemoveSpan=function(){
	return $('<span class="glyphicon glyphicon-remove"></span>');
  }
  sy.getAddSpan=function(){
	return $('<span class="glyphicon glyphicon-plus"></span>');  
  }
  sy.smallAddSpan=function(){
	return  $('<span class="glyphicon glyphicon-plus-sign"></span>');
  }
  sy.minusSpan=function(){
	return $('<span class="glyphicon glyphicon-minus-sign"></span>');  
  }
  sy.getBr=function(){
	return $("<br/>")
  }
  sy.getTdTag=function(){
    var tmpTd;
    tmpTd=new sy.tag();
    tmpTd.setDefaultTag("td");
    return tmpTd;
  }
  sy.getTrTag=function(){
	var tmpTr;
	tmpTr=new sy.tag();
	tmpTr.setDefaultTag("tr");
	return tmpTr;
  }
  sy.getInputTag=function(type,num,optNum){
	if(type==0){
	  return $('<input type="radio" id="table'+num+"opt"+optNum+'" '+'name="'+"table"+num+'name"'+'value="table'+num+'value">');
	}
	if(type==1){
	  return $('<input type="checkbox" id="table'+num+"opt"+optNum+'" '+' name="'+"table"+num+'name"'+'value="table'+num+'value">');
	}
	if(type==2){
	  return $('<input type="radio" id="table'+num+"opt"+optNum+'" '+'name="'+"table"+num+'name"'+'value="table'+num+'value">');
	}
	if(type==3){
		//return $('<input type="radio" name="'+"table"+num+'name"'+'value="table'+num+'value">');
	}
  }
  sy.createQuestionTable=function(_descript,num,options){
	var _table,TrTwo,tmpTdOne,tmpTdTwo,tmpTrOne,tmpTrTwo,Tdone,tdThree,tdFour,inputDiv,tmpLabel,TdFour;
	_table=new sy.tag();
	_table.setDefaultTag("table");
	_tmpTdOne=sy.getTdTag();
	_tmpTdTwo=sy.getTdTag();
	_tmpTrOne=sy.getTrTag();
	_tmpTrTwo=sy.getTrTag();
	_tmpTdOne.setAttrInStr("class","col-md-1 oneLimit");
	removeSpan=sy.getRemoveSpan();
	addSpan=sy.getAddSpan();
	Tdone=_tmpTdOne.changeToObject();
	removeSpan.appendTo(Tdone);
	_br=sy.getBr();
	_br.appendTo(Tdone);
	addSpan.appendTo(Tdone);
    _tmpTdTwo.setAttrInStr("class","limit").setAttrInStr("contentEditable","true");
    _tmpTdTwo.addContent(_descript);
    TrDiv=_tmpTrOne.changeToObject();
    Tdtwo=_tmpTdTwo.changeToObject();
    Tdone.appendTo(TrDiv);
    Tdtwo.appendTo(TrDiv);
    tdThree=sy.getTdTag();
    TdDivThree=tdThree.changeToObject();
    tdFour=sy.getTdTag();
    TdFour=tdFour.changeToObject();
    TrTwo=_tmpTrTwo.changeToObject();
    for(var i=0;i<options.length;i++){
      inputDiv=sy.getInputTag(options[i].getType(),num,i+1);
      tmpLabel=$('<label contentEditable="true" id="table'+num+"opt"+(i+1)+'label"for="table'+num+"opt"+(i+1)+'">'+options[i].getDescript()+"</label>");
      inputDiv.appendTo(TdFour);
      tmpLabel.appendTo(TdFour);
      _br=sy.getBr();
      _br.appendTo(TdFour);
    }
    smallAdd=sy.smallAddSpan();
    minusTag=sy.minusSpan();
    smallAdd.appendTo(TdFour);
    minusTag.appendTo(TdFour);
    TdDivThree.appendTo(TrTwo);
    TdFour.appendTo(TrTwo);
    _table.setAttrInStr('id',"table"+num).setAttrInStr("class","table table-bordered blocks");
	tableDiv=_table.changeToObject();
	TrDiv.appendTo(tableDiv);
	TrTwo.appendTo(tableDiv);
	return tableDiv;
  }
  sy.createOptDiv=function(_opt,_brother,_index,num){
	var inputDiv,tmpLabel;
    inputDiv=sy.getInputTag(_opt.getType(),num,_index);
    tmpLabel=$('<label contentEditable="true" id="table'+num+"opt"+_index+'label" for="table'+num+"opt"+_index+'">'+_opt.getDescript()+"</label>");
    _br=sy.getBr();
    inputDiv.insertBefore(_brother);
    tmpLabel.insertBefore(_brother);
    _br.insertBefore(_brother);
  }
  sy.createHtml=function(){
    
  }
  sy.drawBlock=function(_block,_index){
	var father,tmp_table,tableDiv,_children;
	father=$("#blocksContent");
	_children=father.children();
	childrenLen=_children.length;
	if(_block.getIsTitle()||_block.getIsDescript()){
	  if(_index==1){
		tmp_table=sy.createTitleTable(_block.getTitle());
	  }
	  if(_index==2){
		tmp_table=sy.createDescriptTable(_block.getTitle());
	  }
	  if(_index==3){
		tmp_table=sy.createSubjectTable(_block.getTitle());
	  }
	  tmp_table.appendTo(father);
	}
	else{
	  tableDiv=sy.createQuestionTable(_block.getTitle(),parseInt(_index)+1,sy.getOptions(_block));
	  tableDiv.insertAfter(_children[_index-1]);
	}
  }
  sy.drawBlocks=function(){
	var i;
	for(i=0;i<Blocks.length;i++){
	  sy.drawBlock(Blocks[i],i+1);
	}
  }
  sy.setIdAllofBlock=function(_block,idNum){
	var blockcontent,len,i,j,k;
	k=idNum+1;
	_block.setId("div"+k);
	blockOptions=sy.getOptions(_block);
	for(i=0;i<blockOptions.length;i++){
	  j=i+1;
	  blockOptions[i].setId("div"+k+"_opt"+j);
	}
  }
  sy.removeBlock=function(){
	var idstr,idNum;
	idstr=$(this).parent().parent().parent().parent()[0].id;
	idNum=idstr.substr(5,idstr.length-5);
	sy.sliceBlock(idNum-1);
	$("#"+idstr).remove();
  }
  sy.plusBlock=function(){
	var idstr,idNum,idlen;
	idstr=$(this).parent().parent().parent().parent()[0].id;
	idNum=idstr.substr(5,idstr.length-5);
	var newBlock=sy.deepCopy(Blocks[idNum-1]);
	idlen=Blocks.length;
	sy.setIdAllofBlock(newBlock,idlen);
	sy.insertBlock(idNum,newBlock);
	sy.drawBlock(newBlock,idNum);
  }
  sy.drawOpt=function(_opt,_brother,_index,idNum){
	var optDiv;
	optDiv=sy.createOptDiv(_opt,_brother,_index,idNum);
  }
  sy.addOptionClick=function(){
    var idStr,idNum,pos,len,_block,_children,childrenCount,brother,opt,lastchild;
    idStr=$(this).parent().parent().parent().parent()[0].id;
    pos=idStr.indexOf("table");
    if(pos==0){
      len=idStr.length;
      idNum=idStr.substr(5,len-5)-1;
      _block=Blocks[idNum];
      options=sy.getOptions(_block);
      _children=$(this).parent().children();
      childrenCount=_children.length;
      lastchild=_children[childrenCount-2];
      opt=sy.createOption();
      opt.setDescript("选项");
      opt.setType(options[0].getType());
      opt.setId("div"+idNum+'_'+"opt"+len);
      options.push(opt);
      sy.drawOpt(opt,lastchild,(childrenCount-2)/3+1,idNum+1);
    }
    
  }
  sy.minusOptionClick=function(){
	var idStr,idNum,pos,len,_block,_children,childrenCount,brother,opt,lastchild;
	idStr=$(this).parent().parent().parent().parent()[0].id;
	pos=idStr.indexOf("table");
	if(pos==0){
	  len=idStr.length;
	  idNum=idStr.substr(5,len-5)-1;
	  _block=Blocks[idNum];
	  options=sy.getOptions(_block);
      _children=$(this).parent().children();
      childrenCount=_children.length;
      if(childrenCount>8){
        options.pop();
	    last=_children[childrenCount-3];
        lastchild=_children[childrenCount-4];
        lastchildBrother=_children[childrenCount-5];
        last.remove();
        lastchildBrother.remove();
        lastchild.remove();
      }
	}
  }
  sy.labelChange=function(){
    var idStr,optandNum,optNum,idNum,tmpOptions;
    idStr=$(this)[0].id;
    tmpLabel=$("#"+idStr);
    optandNum=sy.getOptAndNum(idStr);
    optNum=sy.getOptNum(idStr);
    idNum=sy.getTableNum(idStr);
    tmpOptions=sy.getOptions(Blocks[idNum-1]);
    tmpOptions[optNum-1].setDescript(tmpLabel[0].innerText);
  }
  sy.changeContent=function(){
	var idStr,idNum;
	idStr=$(this)[0].id;
	idNum=sy.getTableNum(idStr);
	if(idNum<4&&idNum>0){
	  tmpTd=$("#"+idStr).children().children()[0];
	  if(idNum==1){
	    Blocks[idNum-1].setTitle(tmpTd.innetText);
	    $("#titleSet").children()[0].lastChild.innerText=tmpTd.innerText;
	  }
      if(idNum==2){
    	Blocks[idNum-1].setDescript(tmpTd.innerText);
      }
      if(idNum==3){
    	Blocks[idNum-1].setSubject(tmpTd.innerText); 
      }
	}
	if(idNum>3){
	  tmpTd=$('#'+idStr).children()[0].firstChild.lastChild;
	  Blocks[idNum-1].setTitle(tmpTd.innerText);
	}
  }
  sy.createFun=function(){
    sy.setTitle();
    $(".hideStyle").hide();
	$("#titleRowSet").show();
	$("#editButton").show();
	$("#createRow").hide();
	$("#titleRow").hide();
    sy.createTitleBlock();
    sy.createDescriptBlock();
    sy.createSubjectBlock();
	sy.drawBlocks();
	$(document).on("mouseenter",".table",sy.hoverShow);
	$(document).on("mouseleave",".table",sy.hoverHide);
	$(document).on("blur","label",sy.labelChange);
	$(document).on("blur","table",sy.changeContent);
	$(document).on("click",".glyphicon-remove",sy.removeBlock);
	$(document).on('click',".glyphicon-plus",sy.plusBlock);
	$(document).on("click",".glyphicon-plus-sign",sy.addOptionClick);
	$(document).on("click",".glyphicon-minus-sign",sy.minusOptionClick);
  }
  sy.hoverShow=function(){
	var idstr,idNum;
	if($(this)[0].id=="undefined") return;
	idstr=$(this)[0].id;
	$("#"+idstr+" .glyphicon").show();
  }
  sy.hoverHide=function(){
	var idstr;
	if($(this)[0].id=="undefined") return;
	idstr=$(this)[0].id;
	$("#"+idstr+" .glyphicon").hide();
  }
  sy.appendSQ=function(){
	sy.addSQB();
    sy.drawLastBlock();
  }
  sy.appendMQ=function(){
	sy.addMultQB();
    sy.drawLastBlock();
  }
  sy.appendJQ=function(){
    sy.addJudgeQB();
	sy.drawLastBlock();
  }
  sy.appendEAQ=function(){
		  
  }
  sy.drawLastBlock=function(){
	sy.drawBlock(sy.getLastBlock(),Blocks.length-1);
  }
  sy.saveSurvey=function(){
	sy.publish(0);
  }
  sy.bindFun=function(){
	$("input[type=radio], input[type=checkbox]").picker();
	$("#createBtn").click(sy.createFun);
    $("#choice").click(sy.appendSQ);
    $("#multiplechoice").click(sy.appendMQ);
    $("#judge").click(sy.appendJQ);
    $("#publish").click(sy.publish);
    $("#eassyQuestion").click(sy.appendEAQ);
    $("#saveSurvey").click(sy.saveSurvey);
  }
  $(document).ready(sy.bindFun);
})()