
var google;

function init() {

    var mapElement = jQuery('#map');
    var mapElementjs = document.getElementById('map');

    var myLatlng = new google.maps.LatLng(parseFloat(mapElement.data('lat')), parseFloat(mapElement.data('lng')));

    var mapOptions = {
        zoom: parseFloat(mapElement.data('zoom')),
        center: myLatlng,
        scrollwheel: false,
        styles: [{"featureType":"administrative.land_parcel","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"landscape.man_made","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"simplified"},{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"hue":"#f49935"}]},{"featureType":"road.highway","elementType":"labels","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"hue":"#fad959"}]},{"featureType":"road.arterial","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"visibility":"simplified"}]},{"featureType":"road.local","elementType":"labels","stylers":[{"visibility":"simplified"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"hue":"#a1cdfc"},{"saturation":30},{"lightness":49}]}]
    };

    // Create the Google Map using out element and options defined above
    var map = new google.maps.Map(mapElementjs, mapOptions);
    
    var addresses = mapElement.data('address').split(',');

    for (var x = 0; x < addresses.length; x++) {
        jQuery.getJSON('http://maps.googleapis.com/maps/api/geocode/json?address='+addresses[x]+'&sensor=false', null, function (data) {
            var p = data.results[0].geometry.location
            var latlng = new google.maps.LatLng(p.lat, p.lng);
            new google.maps.Marker({
                position: latlng,
                map: map,
                icon: themedir + '/images/loc.png'
            });

        });
    }
    
}
if(jQuery('#map').length){
    google.maps.event.addDomListener(window, 'load', init);
}