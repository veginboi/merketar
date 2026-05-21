/////////////////////// 
//////////////////////.   Business Location with Form...
//////////////////////

let map;
let marker;
let userLatitude = null;
let userLongitude = null;

///////////////Initialize Map
function initMap(lat, lng) {
    if (map) {
        map.remove();
    }
    
    // Create map
    map = L.map('location-map').setView([lat, lng], 15);
    
    // Add OpenStreetMap tiles
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Create custom icon
    const customIcon = L.divIcon({
        html: `<div class="custom-marker pulse-marker">
                  <div style="width:40px;height:40px;border-radius:50%;border:3px solid #004494;background-color:#004494;display:flex;align-items:center;justify-content:center;color:white;font-weight:bold;">S</div>
               </div>`,
        iconSize: [50, 50],
        iconAnchor: [25, 50],
        popupAnchor: [0, -50]
    });
    
    // Add draggable marker
    marker = L.marker([lat, lng], {
        draggable: true,
        icon: customIcon
    }).addTo(map);

    // Update coordinates when marker is dragged
    marker.on('dragend', function(event) {
        const position = marker.getLatLng();
        userLatitude = position.lat;
        userLongitude = position.lng;
        updateFormInputs();
        updateMapInfo();
    });
    
    // Update coordinates when map is clicked
    map.on('click', function(event) {
        marker.setLatLng(event.latlng);
        userLatitude = event.latlng.lat;
        userLongitude = event.latlng.lng;
        updateFormInputs();
        updateMapInfo();
    });
    
    // Store coordinates
    userLatitude = lat;
    userLongitude = lng;
    updateFormInputs();
    updateMapInfo();
}

///////////////Update Map Info
function updateMapInfo() {
    const infoElement = document.getElementById('map-info');
    if (!infoElement) {
        const infoDiv = document.createElement('div');
        infoDiv.id = 'map-info';
        infoDiv.className = 'mt-2 p-3 bg-light rounded border';
        document.getElementById('map-container').appendChild(infoDiv);
    }
    
    const infoDiv = document.getElementById('map-info');
    infoDiv.innerHTML = `
        <div class="d-flex align-items-center">
            <div class="me-3">
                <div style="width:40px;height:40px;border-radius:50%;border:2px solid #004494;background-color:#004494;display:flex;align-items:center;justify-content:center;color:white;font-weight:bold;">S</div>
            </div>
            <div>
                <strong>Selected Location:</strong><br>
                Latitude: <span id="current-lat">${userLatitude?.toFixed(6) || '--'}</span><br>
                Longitude: <span id="current-lng">${userLongitude?.toFixed(6) || '--'}</span>
            </div>
        </div>
    `;
}

///////////////Update Form Inputs
function updateFormInputs() {
    const latInput = document.getElementById('location-lat');
    const lngInput = document.getElementById('location-lng');
    
    if (latInput && lngInput) {
        latInput.value = userLatitude?.toFixed(6) || '';
        lngInput.value = userLongitude?.toFixed(6) || '';
    }
}

///////////////Get Current Location
function getCurrentLocation() {
    return new Promise((resolve, reject) => {
        if (!navigator.geolocation) {
            reject(new Error("Geolocation not supported"));
            return;
        }
        
        navigator.geolocation.getCurrentPosition(
            (position) => {
                resolve({
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                });
            },
            (error) => {
                reject(new Error("Location access denied or unavailable"));
            },
            { 
                enableHighAccuracy: true,
                timeout: 10000,
                maximumAge: 0
            }
        );
    });
}

///////////////Open Map (Main Function)
async function openLocationMap() {
    const btn = document.getElementById('location-btn');
    
    if (!btn) return;
    
    btn.disabled = true;
    const originalText = btn.textContent;
    btn.textContent = 'Getting location...';

    
    // Show map container
    const mapContainer = document.getElementById('map-container');
    const mapLoct = document.getElementById('location-map');
    mapContainer.style.display = 'block';
    mapLoct.style.display = 'block';
    
    // Show confirm and cancel buttons
    document.getElementById('confirm-location-btn').style.display = 'inline-block';
    document.getElementById('cancel-map-btn').style.display = 'inline-block';
    
    try {
        // Try to get current location
        const location = await getCurrentLocation();
        
        // Initialize map with current location
        initMap(location.lat, location.lng);
        
        btn.textContent = 'Location detected!';
        setTimeout(() => {
            btn.textContent = originalText;
            btn.disabled = false;
        }, 1000);
        
    } catch (error) {
        console.log("Could not get location:", error.message);
        
        // Use default location if geolocation fails
        initMap(6.5244, 3.3792);
        
        btn.textContent = 'Manual mode - drag the marker';
        setTimeout(() => {
            btn.textContent = originalText;
            btn.disabled = false;
        }, 1000);
        
        alert("⚠️ Could not get your location automatically. Please drag the marker to your business location.");
    }
}

///////////////Create Location Form
function createLocationForm(lat, lng) {
    const locationDisplay = document.getElementById('location-display');
    
    if (locationDisplay) {
        locationDisplay.innerHTML = `
            <form id="location-form" action="" method="POST" class="w-100">
                <input type="hidden" name="form_submitted" value="1">
                
                <div class="mb-3">
                    <label for="location-lat" class="form-label">Latitude</label>
                    <input type="text" 
                           id="location-lat" 
                           name="latitude" 
                           class="form-control" 
                           value="${lat?.toFixed(6) || ''}" 
                           readonly
                           required
                           style="max-width:fit-content;"
                           >
                </div>
                
                <div class="mb-3">
                    <label for="location-lng" class="form-label">Longitude</label>
                    <input type="text" 
                           id="location-lng" 
                           name="longitude" 
                           class="form-control" 
                           value="${lng?.toFixed(6) || ''}" 
                           readonly
                           required
                           style="max-width:fit-content;"
                           >
                </div>
                
                <div class="mb-3 w-100">
                    <small class="text-muted">
                        ⚠️ These coordinates are automatically updated when you move the marker on the map.
                    </small>
                </div>
                
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary" name="submit_location">
                        ✅ Confirm & Save Location
                    </button>
                    <button type="button" class="btn btn-secondary" onclick="cancelForm()">
                        ❌ Cancel
                    </button>
                </div>
            </form>
        `;
        
        // Store coordinates
        userLatitude = lat;
        userLongitude = lng;
    }
}

///////////////Show Form with Current Location
function confirmLocation() {
    if (!userLatitude || !userLongitude) {
        alert("Please select a location on the map first.");
        return;
    }
    
    // Hide map container
    document.getElementById('map-container').style.display = 'none';
    
    // Create form with current coordinates
    createLocationForm(userLatitude, userLongitude);
}

///////////////Cancel Map
function cancelMap() {
    document.getElementById('map-container').style.display = 'none';
    userLatitude = null;
    userLongitude = null;
    
    // Hide buttons
    document.getElementById('confirm-location-btn').style.display = 'none';
    document.getElementById('cancel-map-btn').style.display = 'none';
}

///////////////Cancel Form
function cancelForm() {
    const locationDisplay = document.getElementById('location-display');
    if (locationDisplay) {
        locationDisplay.innerHTML = `
            <em style="color: #004494;">No location set yet. Click the button above to set your location.</em>
        `;
    }
    userLatitude = null;
    userLongitude = null;
}

///////////////Setup Event Listeners
document.addEventListener('DOMContentLoaded', function() {
    // Only run if location section exists
    if (!document.querySelector('.location-section')) {
        return;
    }
    
    // Set up button event listeners
    const locationBtn = document.getElementById('location-btn');
    if (locationBtn) {
        locationBtn.addEventListener('click', openLocationMap);
    }
    
    const confirmBtn = document.getElementById('confirm-location-btn');
    if (confirmBtn) {
        confirmBtn.addEventListener('click', confirmLocation);
    }
    
    const cancelBtn = document.getElementById('cancel-map-btn');
    if (cancelBtn) {
        cancelBtn.addEventListener('click', cancelMap);
    }
    
});