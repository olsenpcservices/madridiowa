$(document).ready(function() {	
	$("#ourlistings-table tr td").hover(function(){
		$(this).addClass('hover');
		}, function() {
		$(this).removeClass('hover');
	});
});