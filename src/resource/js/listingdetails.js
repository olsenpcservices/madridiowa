  $(document).ready(function(){
	  var geocoder = new GClientGeocoder();
	
	  var map = new GMap2(document.getElementById('map'),{size:new GSize(404,303)});
	  map.addControl(new GMapTypeControl());
	
	  geocoder.getLatLng(
		    "2187 Sw Mills Ext Greenfield, Iowa 50849",
		    function(point) {
		        var marker = new GMarker(point);
		        map.addOverlay(marker);
		        map.setCenter(point, 15);
		        map.addControl(new GLargeMapControl())  
		    }
		  );
	      
	  	$("table#images tr td .thumbnails a").click(function(){ 
			//Set Variables
	  		var imgAlt = $(this).find("img").attr("alt"); //Get Main Image URL	
			var imgURL = $(this).attr("href"); //Get Main Image URL	
			
			if ($(this).is(".active")) {  //If it's already active, then...
				return false; // Don't click through
			} else {
				//Animate the Teaser				
					$("img#large-image").attr({ src: imgURL });
			}
			
			$("table#images tr td .thumbnails a").removeClass('active'); //Remove class of 'active' on all lists
			$(this).addClass('active');  //add class of 'active' on this list only
			return false;
			
		});
  	
  });
  
  