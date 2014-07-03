(function(){
  sy=window.sy||{};
  sy.survey=sy.survey||{};
  sy.survey.init=function(){
	sy.survey.titleId="titleSet";
	sy.surver.defaultDescript="请输入您对调查表的描述";
	sy.survey.getDescript=function(){
      return sy.survey.defaultDescript;
	}
	sy.survey.blocks=[];
	Blocks=sy.survey.blocks;
	sy.survey.block=function(_id){
	  this.id=_id;
	  this.isHead=false;
	  this.isTitle=false;
	  this.style=[];
	  this.content={
	    isEditing:false,
	    option:[],
	    title:""
	  };
	  this.setId=function(_id){
	    this.id=_id;
	  }
	  this.getId=function(){
		return this.id;
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
  sy.addToBlocks=function(_block){
	Blocks.push(_block);
  }
  sy.createTitleBlock=function(){
	titleBlock=sy.createBlock();
	titleBlock.setTitle(sy.getTitle);
	sy.addToBlocks(titleBlock);
	titleBlock.setStyle("text-align","center");
  }
  sy.createDescriptBlock=function(){
    subjectBlock=sy.createBlock();
    subjectBlock.setTitle(sy.survey.getDescript);
    sy.addToBlocks(subjectBlock);
  }
  sy.drawBlocks=function(){
	var i,parentDiv,childDiv,_father,tmpObject;
	_father=$("#BlockContainer");
	for(i=0;i<Blocks.length;i++){
	  parentDiv=$('<div class="row"></div>');
	  parentDiv.attr('id',Blocks[i].getId());
	  childDiv=$('<div class="col-md-8 block col-md-offset-1"></div>');
	  childDiv.html(Blocks[i].getTitle());
	  styleArr=Blocks[i].getStyle();
	  if(styleArr.length==0){
		tmpObject={};
		tmpObject=sy.arrToObject(styleArr);
	  }
	  childDiv.css(tmpObject);
	  childDiv.appendTo(parentDiv);
	  parentDiv.appendTo(_father);
	}
  }
  sy.createFun=function(){
	sy.setTitle();
	$("#titleRowSet").show();
	$("#editButton").show();
	$("#createRow").hide();
	$("#titleRow").hide();
    sy.createTitleBlock();
	sy.drawBlocks();
  }
  sy.bindFun=function(){
    $("#createBtn").click(sy.createFun);
  }
  $(document).ready(sy.bindFun);

  
})()