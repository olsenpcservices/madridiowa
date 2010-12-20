$(document).ready(function() {
	$(".link").hover(function() {
		var dropDown = "#" + $(this).attr("id") + "Dropdown";
		$(dropDown).toggle();
	}, function() {
		var dropDown = "#" + $(this).attr("id") + "Dropdown";
		$(dropDown).toggle();
	});

});