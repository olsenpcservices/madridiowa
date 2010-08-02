$(document).ready(function() {	

	//Show Banner
	
	$(".main_image .block").animate({ opacity: 0.85 }, 1 ); //Set Opacity
	$(".main_image .desc").show(); //Show Banner
	//Click and Hover events for thumbnail list
	$(".image_thumb ul li:first").addClass('active'); 
	$(".image_thumb ul li.used").click(function(){ 
		//Set Variables
		var imgAlt = $(this).find('img').attr("alt"); //Get Alt Tag of Image
		var imgURL = $(this).find('a').attr("href"); //Get Main Image URL
		var imgTitle = $(this).find('.block h2').html(); 	//Get HTML of block
		var imgPrice = $(this).find('.block .price').html(); 	//Get HTML of block
		var imgDesc = $(this).find('.block .longdesc').html(); 	//Get HTML of block
		var imgId = $(this).find('.block .id').html(); 	//Get HTML of block
		var imgDescHeight = $(".main_image").find('.block').height();	//Calculate height of block	
		
		if ($(this).is(".active")) {  //If it's already active, then...
			return false; // Don't click through
		} else {
			//Animate the Teaser				
			$(".main_image .block").animate({ opacity: 0, marginBottom: -imgDescHeight }, 250 , function() {
				$(".main_image .block").animate({ opacity: 0.85,	marginBottom: "0" }, 250, function() {
					$(".main_image .block .holder h2").text(imgTitle);
					$(".main_image .block .holder h3").text(imgPrice);
					$(".main_image .block p").text(imgDesc);
					$(".main_image .block .listingdetails a").attr("href", "/listingdetails/"+imgId);
				});
				$(".main_image img").attr({ src: imgURL , alt: imgAlt});
			});
		}
		
		$(".image_thumb ul li").removeClass('active'); //Remove class of 'active' on all lists
		$(this).addClass('active');  //add class of 'active' on this list only
		return false;
		
	}) .hover(function(){
		$(this).addClass('hover');
		}, function() {
		$(this).removeClass('hover');
	});
			
	//Toggle Teaser
	$("a.collapse").click(function(){
		$(".main_image .block").slideToggle();
		$("a.collapse").toggleClass("show");
	});
	
});//Close Function