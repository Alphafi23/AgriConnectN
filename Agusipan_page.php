<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Technician Page</title>

<style>
/* General reset and base styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body, html {
    height: 100%;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #f9f9f9;
}

/* Sidebar styles */
.sidebar {
    background-color: #006400; /* Dark green background */
    color: white;
    padding: 20px;
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    width: 200px; /* Sidebar width */
    box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
    z-index: 1000; /* Higher z-index to ensure sidebar is on top */
}

.sidebar a {
    color: white;
    padding: 10px;
    text-decoration: none;
    display: block;
    margin-bottom: 10px;
    text-align: center;
    border-radius: 4px;
    transition: background-color 0.3s;
}

.sidebar a:hover {
    background-color: #004d00;
}

.sidebar h2 {
    padding-bottom: 80px; /* Spacing below the Admin title */
}

/* Main content styles */
.main-content {
    margin-left: 200px; /* Equal to sidebar width */
    padding: 20px;
}

/* Table styles */
.table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
    background-color: white;
    box-shadow: 0 2px 3px rgba(0, 0, 0, 0.1);
}

.table, .table th, .table td {
    border: 1px solid #ddd;
}

.table th, .table td {
    text-align: left;
    padding: 8px;
}

.table th {
    background-color: #006400;
    color: white;
}

.table tr:nth-child(even) {
    background-color: #f2f2f2;
}

/* Buttons */
.btn {
    display: inline-block;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    background-color: #5cb85c; /* Bootstrap's btn-success color */
    color: white;
    text-decoration: none;
    transition: background-color 0.3s ease;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .sidebar {
        width: 100%;
        position: static;
        display: flex;
        overflow-x: auto;
        white-space: nowrap;
        z-index: 1000;
    }

    .main-content {
        margin-left: 0;
        padding-top: 20px;
    }
}


</style>
</head>
<body>
    <div class="container my-5">
        <h2>List of Farmers in Agusipan</h2>
        <br>
        <a href="Agusipan_report.php" class="btn"> Create Report </a>
        <table class="table">
        <table class="table" border="1">
            <thead>
                <tr>
                    <th>FARMER NAME</th>
                    <th>AGE</th>
                    <th>SEX</th>
                    <th>FARM NAME</th>
                    <th>BARANGAY</th>
                    <th>CONTACT</th>
                    <th>CROP NAME</th>
                    <th>CROP STATUS</th>
                    <th>ACTION</th>
                </tr>  
            </thead> 
            <tbody>
                <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "faccount";

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Only fetch records with barangay = 'Agusipan'
                    $sql = "SELECT * FROM farmer_acc WHERE barangay = 'Agusipan'";
                    $result = $conn->query($sql);

                    if(!$result) {
                        die("Invalid query: " . $conn->error);
                    }

                    while($row = $result->fetch_assoc()) {
                        echo "
                        <tr>
                            <td>{$row['farmer_n']}</td>
                            <td>{$row['age']}</td>
                            <td>{$row['sex']}</td>
                            <td>{$row['farm_n']}</td>
                            <td>{$row['barangay']}</td>
                            <td>{$row['fcontact']}</td>
                            <td>{$row['crop_name']}</td>
                            <td>{$row['crop_status']}</td>
                            <td>
                                <a class='btn btn-primary btn-sm' href='/AgriConnectN/Agusipan_update.php?ID={$row['ID']}'>Update</a>
                            </td>
                        </tr>
                        ";
                    }
                ?>
            </tbody>
        </table>
    </div>
    <a href="logout_form.php" class="btn">Logout</a>  
</body>
</html>
