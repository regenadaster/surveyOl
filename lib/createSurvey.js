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
	    title:""
	  };
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
  sy.setMarginTopAndBottom=function(_block){
   _block.setStyle("margin-top","10px");
   _block.setStyle("margin-bottom","10px");
  }
  sy.createOptDiv=function(_opt){
	  childOpt=$('<div class="col-md-7 option"></div>');
	  childOpt.attr('id',_opt.getId());
	  if(_opt.getType()==0){
	    childOpt.html('<input type="radio" '+'name="'+_opt.getId()+'_optname">'+'<span contentEditable="true">'+_opt.getDescript()+'</span>');
	  }
	  if(_opt.getType()==1){
		childOpt.html('<input type="checkbox" '+'name="'+_opt.getId()+'_optname">'+'<span contentEditable="true">'+_opt.getDescript()+'</span>');
	  }
	  if(_opt.getType()==2){
		childOpt.html('<input type="radio" '+'name="'+_opt.getId()+'_optname">'+'<span contentEditable="true">'+_opt.getDescript()+'</span>');
	  }
	  if(_opt.getType()==3){
		childOpt.html('<input type="radio">'+'<span contentEditable="true">'+_opt.getDescript()+'</span>');  
	  }
	  return childOpt;
  }
  sy.appendBlock=function(_block){
	var i,j,k,parentDiv,child,_father,tmpObject,childOpt,addTag,num;
	_father=$("#BlockContainer");
	if(!_block.getDraw()){
	  parentDiv=$('<div class="row"></div>');
      parentDiv.attr('id',_block.getId());
      num="";
      if(!_block.getIsTitle()&&!_block.getIsDescript()) num+=(sy.getBlockNumInStr(_block.getId())-2)+".";
	  childDiv=$('<div class="col-md-8 block col-md-offset-1"></div>');
	  childDiv.html('<div  contentEditable="true">'+num+_block.getTitle()+'</div>');
      childBr=$('</br>');
      styleArr=_block.getStyle();
	  if(styleArr.length==0){
		tmpObject={};
	    tmpObject=sy.arrToObject(styleArr);
	  }
	  for(j=0;j<_block.getOptionLen();j++){
		tmpOpt=sy.getOption(_block,j);
		if(!tmpOpt.getDraw()){
		  childOpt=sy.createOptDiv(tmpOpt);
		  childOpt.appendTo(childDiv);
		 } 
	   }
	   if(!_block.getIsTitle()&&!_block.getIsDescript()){
	     addTagDiv=$('<div class="col-md-8 addTAG"'+' id="'+_block.getId()+'_'+tmpOpt.getId()+'_'+'addTag"></div>');
	     addTag=$('<span class="glyphicon glyphicon-plus-sign"></span>');
	     addTag.appendTo(addTagDiv);
	     addTagDiv.appendTo(childDiv);
	   }
	   childDiv.css(tmpObject);	  
	   childDiv.appendTo(parentDiv);
	   parentDiv.appendTo(_father);
	   childBr.appendTo(_father);
	   _block.setDraw(true);
	}	
  }
  sy.drawBlocks=function(){
	var i;
	for(i=0;i<Blocks.length;i++){
	  sy.appendBlock(Blocks[i]);
	}
  }
  sy.drawLastBlock=function(){
	sy.appendBlock(sy.getLastBlock());
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
  sy.drawOpt=function(_opt,_brother){
	var optDiv;
	optDiv=sy.createOptDiv(_opt);
	optDiv.insertBefore(_brother);
  }
  sy.clickAddOpt=function(){
	var opt;
    idStr=$(this)[0].id;
    bFatherId=sy.getFirstDivId(idStr);
    blockNum=sy.getBlockNumInStr(bFatherId);
    _block=Blocks[blockNum-1];
    options=sy.getOptions(_block);
    _childrens=$('#'+bFatherId).children().children();
    len=_childrens.length;
    lastchild=_childrens[len-1];
    opt=sy.createOption();
    opt.setDescript("选项");
    opt.setType(options[0].getType());
    options.push(opt);
    opt.setId("div"+bFatherId+'_'+"opt"+len);
    sy.drawOpt(opt,lastchild);
  }
  sy.changeTitle=function(){
	alert("good");
  }
  sy.createFun=function(){
	sy.setTitle();
	$("#titleRowSet").show();
	$("#editButton").show();
	$("#createRow").hide();
	$("#titleRow").hide();
    sy.createTitleBlock();
    sy.createDescriptBlock();
	sy.drawBlocks();
	$(document).on("mouseenter",".block",sy.hoverShow);
	$(document).on("mouseleave",".block",sy.hoverHide);
	$(document).on("click",".addTAG",sy.clickAddOpt);
	$("#div1 .block").bind("onchange",sy.changeTitle);
  }
  sy.hoverShow=function(){
	$("#div1 .block").bind("onchange",sy.changeTitle);
	$(document).on("change","#div1 .block",sy.changeTitle);
	if($(this)[0].lastChild.id=="undefined"){
	}
	else{
	  idStr=$(this)[0].lastChild.id;
	  $("#"+idStr).show();
	}
  }
  sy.hoverHide=function(){
	idStr=$(this)[0].lastChild.id;
	$("#"+idStr).hide();
  }
  sy.bindFun=function(){
    $("#createBtn").click(sy.createFun);
    $("#choice").click(sy.appendSQ);
    $("#multiplechoice").click(sy.appendMQ);
    $("#judge").click(sy.appendJQ);
    $("#preview").click(sy.preview);
    $("#publish").click(sy.publish);
    $("#eassyQuestion").click(sy.appendEAQ);
  }
  $(document).ready(sy.bindFun);
  
})()