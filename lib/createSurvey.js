(function(){
  sy=window.sy||{};
  sy.survey=sy.survey||{};
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
	return new sy.survey.block("div"+len+1);
  }
  sy.createOption=function(){
	return new sy.survey.option();
  }
  sy.addOptionToBlocks=function(_block,_opt){
	 _block.content.options.push(_opt);
  }
  sy.addToBlocks=function(_block){
	Blocks.push(_block);
  }
  sy.getOption=function(_block,_index){
	return _block.content.options[_index];
  }
  sy.createTitleBlock=function(){
	titleBlock=sy.createBlock();
	titleBlock.setTitle(sy.getTitle());
	sy.addToBlocks(titleBlock);
	titleBlock.setStyle("text-align","center");
	//sy.setMarginTopAndBottom(titleBlock);
  }
  sy.createDescriptBlock=function(){
    descriptBlock=sy.createBlock();
    descriptBlock.setTitle(sy.survey.getDescript());
    sy.addToBlocks(descriptBlock);
	//sy.setMarginTopAndBottom(titleBlock);
  }
  sy.addTwoOptionToBlock=function(_block,optOne,optTwo,type){
	optOne.setDescript("选项1");
	optTwo.setDescript("选项2");
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
  sy.appendBlock=function(_block){
	var i,j,k,parentDiv,child,_father,tmpObject,childOpt;
	_father=$("#BlockContainer");
	if(!_block.getDraw()){
	  parentDiv=$('<div class="row"></div>');
      parentDiv.attr('id',_block.getId());
	  childDiv=$('<div class="col-md-8 block col-md-offset-1"></div>');
	  childDiv.html('<div  contentEditable="true">'+_block.getTitle()+'</div>');
      childBr=$('</br>');
      styleArr=_block.getStyle();
	  if(styleArr.length==0){
		tmpObject={};
	    tmpObject=sy.arrToObject(styleArr);
	  }
	  for(j=0;j<_block.getOptionLen();j++){
		tmpOpt=sy.getOption(_block,j);
		if(!tmpOpt.getDraw()){
		  childOpt=$('<div class="col-md-7 option"></div>');
		  if(tmpOpt.getType()==0){
		    childOpt.html('<input type="radio">'+'<span contentEditable="true">'+tmpOpt.getDescript()+'</span>');
		  }
		  if(tmpOpt.getType()==1){
			childOpt.html('<input type="checkbox">'+'<span contentEditable="true">'+tmpOpt.getDescript()+'</span>');
		  }
		  if(tmpOpt.getType()==2){
			childOpt.html('<input type="radio">'+'<span contentEditable="true">'+tmpOpt.getDescript()+'</span>');
		  }
		  if(tmpOpt.getType()==3){
			childOpt.html('<input type="radio">'+'<span contentEditable="true">'+tmpOpt.getDescript()+'</span>');  
		  }
		  childOpt.appendTo(childDiv);
		 } 
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
  sy.createFun=function(){
	sy.setTitle();
	$("#titleRowSet").show();
	$("#editButton").show();
	$("#createRow").hide();
	$("#titleRow").hide();
    sy.createTitleBlock();
    sy.createDescriptBlock();
	sy.drawBlocks();
  }
  sy.bindFun=function(){
    $("#createBtn").click(sy.createFun);
    $("#choice").click(sy.appendSQ);
    $("#multiplechoice").click(sy.appendMQ);
    $("#judge").click(sy.appendJQ);
    $("#eassyQuestion").click(sy.appendEAQ);
  }
  $(document).ready(sy.bindFun);
  
})()