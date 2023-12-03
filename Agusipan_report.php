<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>report Page</title>
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

/* Container for the report */
.report-container {
    width: 80%;
    margin: 20px auto;
    padding: 20px;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

/* Table styles */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
    background-color: white;
    box-shadow: 0 2px 3px rgba(0, 0, 0, 0.1);
}

table, th, td {
    border: 1px solid #ddd;
}

th, td {
    text-align: left;
    padding: 8px;
}

th {
    background-color: #006400;
    color: white;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

/* Button styles */
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

.btn-danger {
    background-color: #d9534f; /* Bootstrap's btn-danger color */
}

.btn-danger:hover {
    background-color: #c9302c; /* Darker red on hover */
}

.btn:hover {
    opacity: 0.9;
}

/* Form styles */
.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
}

.form-group input[type="text"],
.form-group select,
.form-group input[type="date"] {
    width: 100%;
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

/* Submit button specific styles */
.submit-btn {
    background-color: #5cb85c;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.submit-btn:hover {
    background-color: #4cae4c;
}

/* Cancel button specific styles */
.cancel-btn {
    background-color: #f0ad4e;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.cancel-btn:hover {
    background-color: #ec971f;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .report-container {
        width: 95%;
    }
}

    </style>
</head>
<body>
    <div class="container my-5">
        <h2></h2>
        <a href="Agusipan_print_report.php" class="btn"> Print Report </a>

        <br>
        <table class="table">
        <table class="table" border="1">
            <thead>
                <tr>
                    <th>FARM NAME</th>
                    <th>WEEK REPORT</th>
                    <th>DATE REPORTED</th>
             
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

                    $sql = "SELECT * FROM agusipan_report";
                    $result = $conn->query($sql);

                    if(!$result) {
                        die("invalid query: " . $conn->error);
                    }

                    while($row = $result->fetch_assoc()) {
                        echo "
                        <tr>
                            
                        <td>$row[farm_name]</td>
                        <td>$row[week_report]</td>
                        <td>$row[date]</td>
                        <td>
                        <a class='btn btn-primary btn-sm' href='/AgriConnectN/Agusipan_delete_report.php?ID=$row[ID]'> delete </a>
                        </td>
                    </tr>
                        ";
                    }
                    
                    ?>

            </tbody>
        </table>
    </div>  
    <br><br><br> 
</body>
</html>

<?php
     $servername = "localhost";
     $username = "root";
     $password = "";
     $dbname = "faccount";
 
     $conn = new mysqli($servername, $username, $password, $dbname);

    $ID="";
    $farm_name="";
    $week_report="";
    $date="";

    $errorMessage = "";
    $successMasage = "";

    // ... (previous code)

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $farm_name= $_POST["farm_name"];
    $week_report= $_POST["week_report"];
    $date= $_POST["date"];


            $query = "SELECT farm_name FROM agusipan_report"; // Adjust the column name if different
            $result = $conn->query($query);
            if ($result) {
            while($row = $result->fetch_assoc()) {
                $farm_name = $row['farm_name'];
            }
        }

    if ( empty($farm_name) || empty($week_report) || empty($date))  {
        echo "ALL the fields are required";
    } else {

        $stmt = $conn->prepare("INSERT INTO agusipan_report (farm_name, week_report, date) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $farm_name, $week_report, $date);


        if ($stmt->execute()) {
            header('location:Agusipan_report.php');
            exit;
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }
    }

$conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add to week report</title>

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

/* Container for the report */
.report-container {
    width: 80%;
    margin: 20px auto;
    padding: 20px;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

/* Table styles */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
    background-color: white;
    box-shadow: 0 2px 3px rgba(0, 0, 0, 0.1);
}

table, th, td {
    border: 1px solid #ddd;
}

th, td {
    text-align: left;
    padding: 8px;
}

th {
    background-color: #006400;
    color: white;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

/* Button styles */
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

.btn-danger {
    background-color: #d9534f; /* Bootstrap's btn-danger color */
}

.btn-danger:hover {
    background-color: #c9302c; /* Darker red on hover */
}

.btn:hover {
    opacity: 0.9;
}

/* Form styles */
.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
}

.form-group input[type="text"],
.form-group select,
.form-group input[type="date"] {
    width: 100%;
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

/* Submit button specific styles */
.submit-btn {
    background-color: #5cb85c;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.submit-btn:hover {
    background-color: #4cae4c;
}

/* Cancel button specific styles */
.cancel-btn {
    background-color: #f0ad4e;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.cancel-btn:hover {
    background-color: #ec971f;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .report-container {
        width: 95%;
    }
}
    </style>
</head>
<body>
    <div class="container my-5">
        <h2>Add Weekly Report</h2>


        <form method="POST">
        <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Farm Name</label>
                <div class="col-sm-6">
                <input type="text" class="form-control" name="farm_name" required placeholder="" value="<?php echo $farm_name; ?>">
                </div> 
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Week Report</label>
                <div class="col-sm-6">
                <input type="text" class="form-control" name="week_report" required placeholder="" value="<?php echo $week_report; ?>">
                </div> 
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Date Reported</label>
                <div class="col-sm-6">
                <input type="date" class="form-control" name="date" required placeholder="" value="<?php echo $date; ?>">
                </div> 
            </div>
            <br><br>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                <input type="submit" name="submit" value="submit" class="form-btn">
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/AgriConnectN/Agusipan_page.php" role="button"> Cancel </a>
                </div>
            </div>
        </form>
    </div>

</body>
</html>

