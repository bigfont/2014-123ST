 var ext_markers = [];
var map2;

function startMap() {
//<![CDATA[
if (GBrowserIsCompatible()) {
	
   
      
      	
 function createMarker(point, id, name, address, phone, email, craft, tour_number, grid_photo, grid_thumb,hours) {
 	  iconSheep.image = 'images/sheep/' + tour_number + '.png';
      var marker = new GMarker(point, {icon:iconSheep, draggable:false});

       	   
       	 var html = "<table width='300' height='300'>";
       	 html += "<tr><td><img src='artists/" + grid_photo + "' width='300' height='200' alt='' /></td></tr>";
		 html += "<tr><td class='zoom_title'>" + name + "</td></tr>";
		 html += "<tr><td class='zoom_craft'>" + craft + "</td></tr>";
		 html += "<tr><td class='zoom_link'><a href='view.php?artist=" + id + "' target='_top'><img src='images/meetlarge.jpg' alt='Meet the artist' /></td></tr>"
		 html += "</table>";
       
       
 
    
      GEvent.addListener(marker, 'click', function() {
  				  marker.openInfoWindowHtml(html);
      });
      	ext_markers[tour_number] = marker;
      	
        return marker;
    }

      // Display the map, with some controls and set the initial location 
      var map = new GMap2(document.getElementById("map"));

   //   map.addControl(new GSmallMapControl() );
      map.setCenter(new GLatLng(48.825235,-123.492165), 11);
      map.enableContinuousZoom();
      map.enableScrollWheelZoom();
    
        
var iconSheep = new GIcon();
iconSheep.image = 'images/sheepMarker/image.png';
iconSheep.printImage = 'images/sheepMarker/printImage.gif';
iconSheep.mozPrintImage = 'images/sheepMarker/mozPrintImage.gif';
iconSheep.iconSize = new GSize(32,26);
iconSheep.shadow = 'images/sheepMarker/shadow.png';
iconSheep.transparent = 'images/sheepMarker/transparent.png';
iconSheep.shadowSize = new GSize(45,26);
iconSheep.printShadow = 'images/sheepMarker/printShadow.gif';
iconSheep.iconAnchor = new GPoint(12,22);
iconSheep.infoWindowAnchor = new GPoint(16,0);
iconSheep.imageMap = [27,0,26,1,28,2,29,3,30,4,30,5,31,6,31,7,31,8,26,9,26,10,26,11,26,12,26,13,25,14,25,15,25,16,24,17,23,18,22,19,22,20,22,21,22,22,22,23,22,24,22,25,2,25,2,24,2,23,2,22,2,21,2,20,2,19,2,18,2,17,3,16,2,15,0,14,0,13,0,12,0,11,0,10,0,9,1,8,2,7,2,6,5,5,6,4,20,3,21,2,23,1,25,0];


   
	    


      map.addControl(new GLargeMapControl3D());
      map2 = map;
      GDownloadUrl("inc/map_data.php", function(data) {
      	  var hours = new Array();
          var xml = GXml.parse(data);
          var markers = xml.documentElement.getElementsByTagName("marker");
          for (var i = 0; i < markers.length; i++) {
            var id = markers[i].getAttribute("id");
            var name = markers[i].getAttribute("name");
            var address = markers[i].getAttribute("address");
            var phone = markers[i].getAttribute("phone");
            var email = markers[i].getAttribute("email");
            var lat = markers[i].getAttribute("lat");
            var lng = markers[i].getAttribute("lng");
            var craft = markers[i].getAttribute("craft");
            hours['sun'] = markers[i].getAttribute("hours_sun");
            hours['mon'] = markers[i].getAttribute("hours_mon");
            hours['tue'] = markers[i].getAttribute("hours_tue");
            hours['wed'] = markers[i].getAttribute("hours_wed");
            hours['thu'] = markers[i].getAttribute("hours_thu");
            hours['fri'] = markers[i].getAttribute("hours_fri");
            hours['sat'] = markers[i].getAttribute("hours_sat");
            var tour_number = markers[i].getAttribute("tour_number");
            var grid_thumb = markers[i].getAttribute("grid_thumb");
            var grid_photo = markers[i].getAttribute("grid_photo");
            var point = new GLatLng(parseFloat(markers[i].getAttribute("lat")),
                                    parseFloat(markers[i].getAttribute("lng"))
                                    );
            var marker = createMarker(point, id, name, address, phone, email, craft, tour_number, grid_photo, grid_thumb, hours);
			 map.addOverlay(marker);
          }


      })
    // display a warning if the browser was not compatible
} else {
      alert("Sorry, the Google Maps API is not compatible with this browser");
    }
    

  //]]>
  

}