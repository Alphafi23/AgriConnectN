<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "faccount";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(['status' => 'error', 'message' => 'Connection failed: ' . $conn->connect_error]));
}

$sql = "SELECT farmer_acc.farmer_n, farmer_acc.sex, farmer_acc.age, farmer_acc.farm_n, farmer_acc.area, farmer_acc.fcontact, farmer_acc.crop_name, farmer_acc.crop_status, farmer_acc.barangay, farmer_acc.ID, brgy_location.lat, brgy_location.lng FROM farmer_acc INNER JOIN brgy_location ON farmer_acc.barangay = brgy_location.barangay_location";
$result = $conn->query($sql);
$data = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

echo json_encode(['status' => 'success', 'data' => $data]);

$conn->close();

?>

