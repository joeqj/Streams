'use strict';

var input = document.getElementById('gLoc');
var options = {
  types: ['(cities)']
};

var autocomplete = new google.maps.places.Autocomplete(input, options);

var componentForm = {
  route: 'long_name',
  locality: 'long_name',
  city: 'long_name',
  country: 'short_name'
};

google.maps.event.addListener(autocomplete, 'place_changed', function () {
  var place = autocomplete.getPlace();
  for (var i = 0; i < place.address_components.length; i++) {
    var addressType = place.address_components[i].types[0];
    if (componentForm[addressType]) {
      var val = place.address_components[i][componentForm[addressType]];
      console.log(val);
    }
  }
  console.log(place.utc_offset_minutes);
});