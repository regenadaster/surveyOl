(function(){
  sy=window.sy||{};
  sy.dragBin=function(){
	$(function(){
	  $("#blocksContent").sortable({
		revert: true,
		helper: 'clone',
		items: ".sort",
		forcePlaceholderSize: true,
		placeholderType: 'sortable-placeholder',
		stop: function(event,ui){
		  sy.ChangeBlocks(event,ui);
		}
	  });
	});
  }
})()