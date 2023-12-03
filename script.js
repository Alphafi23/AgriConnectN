// Initialize the Google Map
var map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: 10.8062, lng: 122.5841},
    zoom: 12
});

// Global variables to store various data
var farmersByBarangay = {}; // Object to group farmers by their barangay
var allFarmers = []; // Array to store all farmer data for filtering
var markers = []; // Array to store map markers
var statusIcons = {}; // Object to store icons based on crop status

// Fetches icon data from the server
function fetchStatusIcons() {
    fetch('get_icons.php')
    .then(response => response.json())
    .then(data => {
        statusIcons = data; // Assign fetched data to statusIcons object
        setFarmersOnMap(); // Call to display farmers on the map after fetching icon data
    })
    .catch(error => console.error('Error fetching status icons:', error));
}

// Function to display farmers on the map
function setFarmersOnMap() {
    fetch('get_farmer_locations.php')
    .then(response => response.json())
    .then(data => {
        if(data.status === 'success') {
            allFarmers = data.data; // Store all farmer data
            displayFarmers(data.data); // Call to display farmers on the map
        } else {
            console.error("API returned an error:", data.message);
        }
    })
    .catch(error => {
        console.error("There was a problem fetching farmer locations:", error.message);
    });
}

// Function to display farmers as markers on the map
function displayFarmers(farmers) {
    markers.forEach(marker => marker.setMap(null)); // Clear existing markers
    markers = [];
    farmersByBarangay = {}; // Reset grouping

    farmers.forEach(farmer => {
        var position = new google.maps.LatLng(farmer.lat, farmer.lng);
        var marker = new google.maps.Marker({
            position: position,
            map: map,
            title: farmer.farm_n || 'Unknown Farm',
            label: { // Label settings for each marker
                text: farmer.barangay, // Barangay name as label
                color: 'black',
                fontSize: '12px'
            }
        });

        markers.push(marker); // Add marker to the markers array

        // Group farmers by barangay
        if (!farmersByBarangay[farmer.barangay]) {
            farmersByBarangay[farmer.barangay] = [];
        }
        farmersByBarangay[farmer.barangay].push(farmer);

        // Event listener for each marker
        google.maps.event.addListener(marker, 'click', (function(barangayKey) {
            return function() {
                showFarmsInBarangay(barangayKey);
            };
        })(farmer.barangay));
    });
}

// Function to show farms in a specific barangay in the info panel
function showFarmsInBarangay(barangay) {
    var farms = farmersByBarangay[barangay];
    var infoPanel = document.getElementById('info-panel');
    infoPanel.innerHTML = `<h4>Farms in ${barangay}</h4><ul>`;
    farms.forEach(farmer => {
        infoPanel.innerHTML += `<li><a href="#" onclick="showFarmerDetails('${farmer.ID}'); return false;">${farmer.farm_n || 'Unknown Farm'}</a></li>`;
    });
    infoPanel.innerHTML += `</ul>`;
}

// Function to show detailed information of a selected farmer
function showFarmerDetails(farmerID) {
    var farmerDetails = Object.values(farmersByBarangay).flatMap(barangay => barangay).find(f => f.ID == farmerID);

    if (farmerDetails) {
        var infoPanel = document.getElementById('info-panel');
        infoPanel.innerHTML = `
            <h4>${farmerDetails.farm_n || 'Unknown Farm'}</h4>
            <p>
                <strong>Farmer Name:</strong> ${farmerDetails.farmer_n || 'Unknown'}<br>
                <strong>Contact:</strong> ${farmerDetails.fcontact || 'Unknown'}<br>
                <strong>Age:</strong> ${farmerDetails.age || 'Unknown'}<br>
                <strong>Sex:</strong> ${farmerDetails.sex || 'Unknown'}<br>
                <strong>Area (hectars):</strong> ${farmerDetails.area || 'Unknown'}<br>
                <strong>Barangay:</strong> ${farmerDetails.barangay || 'Unknown'}<br>
                <strong>Crop Name:</strong> ${farmerDetails.crop_name || 'Unknown'}<br>
                <strong>Crop Status:</strong> ${farmerDetails.crop_status || 'Unknown'}
            </p>
        `;
    }
}

// Function to filter farmers based on crop name and crop status
function filterFarms() {
    var cropName = document.getElementById('crop-name').value.toLowerCase();
    var cropStatus = document.getElementById('crop-status').value.toLowerCase();

    var filteredFarmers = allFarmers.filter(farmer => 
        farmer.crop_name.toLowerCase().includes(cropName) && 
        farmer.crop_status.toLowerCase().includes(cropStatus)
    );

    displayFarmers(filteredFarmers);
}

// Load the map when the window loads and fetch status icons
window.onload = fetchStatusIcons;
