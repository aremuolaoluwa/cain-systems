console.log('locationFileActive')
function calculateDistance(lat1, lon1, lat2, lon2) {
  const R = 6371; // Radius of the Earth in kilometers
  const dLat = ((lat2 - lat1) * Math.PI) / 180; // Convert degrees to radians
  const dLon = ((lon2 - lon1) * Math.PI) / 180; // Convert degrees to radians
  const a =
    Math.sin(dLat / 2) * Math.sin(dLat / 2) +
    Math.cos((lat1 * Math.PI) / 180) *
      Math.cos((lat2 * Math.PI) / 180) *
      Math.sin(dLon / 2) *
      Math.sin(dLon / 2);
  const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
  const distance = R * c; // Distance in kilometers
  return distance;
}

function getLocation(callback, WORKPLACE_LONGITUDE, WORKPLACE_LATITUDE, state) {
  if ("geolocation" in navigator) {
    navigator.geolocation.getCurrentPosition(
      function (position) {
        const latitude = position.coords.latitude;
        const longitude = position.coords.longitude;

        const distance = calculateDistance(
          latitude,
          longitude,
          WORKPLACE_LATITUDE,
          WORKPLACE_LONGITUDE
        );

        if (distance * 1000 < 50) {
          document.getElementById(state+'-latitude').value=latitude
          document.getElementById(state+'-longitude').value=longitude
          callback();
          console.log('callbackActive')
        } else {
          console.log(latitude,
            longitude)
        }
      },
      function (error) {
        switch (error.code) {
          case error.PERMISSION_DENIED:
            alert("User denied the request for Geolocation.");
            break;
          case error.POSITION_UNAVAILABLE:
            alert("Location information is unavailable.");
            break;
          case error.TIMEOUT:
            alert("The request to get user location timed out.");
            break;
          case error.UNKNOWN_ERROR:
            alert("An unknown error occurred.");
            break;
        }
      }
    );
  } else {
    alert("Geolocation is not supported by this browser.");
  }
}
