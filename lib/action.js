(function(){
  sy=window.sy||{};
  sy.dragBin=function(){
	$(function(){
	  $("#blocksContent").sortable({
		revert: true,
		stop:function(event,ui){
		  sy.ChangeBlocks(event,ui);
		}
	  });
	});
  }
})()