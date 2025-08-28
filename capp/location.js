console.log('locationFileActive');
function calculateDistance(lat1, lon1, lat2, lon2) {
  const R = 6371; // km
  const dLat = ((lat2 - lat1) * Math.PI) / 180;
  const dLon = ((lon2 - lon1) * Math.PI) / 180;
  const a = Math.sin(dLat/2)**2 + Math.cos(lat1*Math.PI/180) * Math.cos(lat2*Math.PI/180) * Math.sin(dLon/2)**2;
  const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
  return R * c; // km
}

function getLocation(callback, WORKPLACE_LATITUDE, WORKPLACE_LONGITUDE, state) {
  if (!('geolocation' in navigator)) { alert('Geolocation not supported'); return; }
  navigator.geolocation.getCurrentPosition(
    function (position) {
      const latitude = position.coords.latitude;
      const longitude = position.coords.longitude;
      const distanceKm = calculateDistance(latitude, longitude, WORKPLACE_LATITUDE, WORKPLACE_LONGITUDE);
      const distanceM = distanceKm * 1000;

      console.log("Office coords:", WORKPLACE_LATITUDE, WORKPLACE_LONGITUDE);
      console.log("Device coords:", latitude, longitude);
      console.log("Distance (m):", distanceM);
      console.log("Google Maps link (device): https://www.google.com/maps?q=" + latitude + "," + longitude);

      if (distanceM <= (window.APP_CONFIG?.GEOFENCE_RADIUS_M ?? 10)) {
        document.getElementById(state+'-latitude').value = latitude;
        document.getElementById(state+'-longitude').value = longitude;
        callback();
      } else {
        alert('You are outside the allowed area. Distance: ' + Math.round(distanceM) + 'm');
      }
    },
    function (error) {
      switch (error.code) {
        case error.PERMISSION_DENIED: alert('Location permission denied.'); break;
        case error.POSITION_UNAVAILABLE: alert('Location unavailable.'); break;
        case error.TIMEOUT: alert('Location request timed out.'); break;
        default: alert('Unknown geolocation error.');
      }
    },
    { enableHighAccuracy: true, timeout: 10000, maximumAge: 0 }
  );
}