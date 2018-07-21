var map;
var marker;

function initMap() {                            
    var latitude = 1.0968061; // YOUR LATITUDE VALUE
    var longitude = 36.692892; // YOUR LONGITUDE VALUE
    
    //Set the latitude and longitude values to default (Maralal)
    document.getElementById('latitude').value = latitude;
    document.getElementById('longitude').value =  longitude;

    var myLatLng = {lat: latitude, lng: longitude};
    
    map = new google.maps.Map(document.getElementById('map'), {
        center: myLatLng,
        zoom: 9,
        disableDoubleClickZoom: true, // disable the default map zoom on double click
    });
    
    // Update lat/long value of div when anywhere in the map is clicked    
    google.maps.event.addListener(map,'click',function(event) {                
        document.getElementById('latitude').value = event.latLng.lat();
        document.getElementById('longitude').value =  event.latLng.lng();
    });
            
    marker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        title: 'Map of Samburu County',
        
        // setting latitude & longitude as title of the marker
        // title is shown when you hover over the marker
        title: latitude + ', ' + longitude 
    });    
    
    // Update lat/long value of div when the marker is clicked
    marker.addListener('click', function(event) {              
        document.getElementById('latitude').value = event.latLng.lat();
        document.getElementById('longitude').value =  event.latLng.lng();
    });
    
    // Create new marker on double click event on the map
    google.maps.event.addListener(map,'dblclick',function(event) {
        if(marker){
            marker.setMap(null);
        }
        marker = new google.maps.Marker({
            position: event.latLng, 
            map: map, 
            title: event.latLng.lat()+', '+event.latLng.lng()
        });
        
        // Update lat/long value of div when the marker is clicked
        marker.addListener('click', function() {
            document.getElementById('latitude').value = event.latLng.lat();
            document.getElementById('longitude').value =  event.latLng.lng();
        });            
    });
    
    // Create new marker on single click event on the map
    google.maps.event.addListener(map,'click',function(event) {
        if(marker){
            marker.setMap(null);
        }
        
        marker = new google.maps.Marker({
            position: event.latLng, 
            map: map, 
            title: event.latLng.lat()+', '+event.latLng.lng()
        });                
    });
}