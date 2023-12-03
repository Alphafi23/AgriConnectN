<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "faccount";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT *FROM balabag_report";

$result = $conn->query($sql);
if(!$result) {
    die("invalid query: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Printable Weekly Report</title>
    <style>
       /* Base styles */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin: 0;
    padding: 20px;
    background-color: #f9f9f9;
}

/* Header styles */
h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #333;
}

/* Table styles */
table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

table, th, td {
    border: 1px solid #ddd;
}

th {
    background-color: #4CAF50;
    color: white;
    padding: 10px;
}

td {
    padding: 8px;
    text-align: left;
}

/* Button styles */
.btn {
    padding: 8px 16px;
    background-color: #5cb85c;
    color: white;
    text-decoration: none;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    margin-right: 8px;
}

.btn-print {
    background-color: #4CAF50;
}

.btn-print:hover {
    background-color: #449d44;
}

.btn:hover {
    opacity: 0.9;
}

/* Print styles */
@media print {
    body {
        background-color: #fff;
    }

    .btn, .no-print {
        display: none;
    }

    h2 {
        color: #000;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        border: 1px solid #000;
        padding: 10px;
    }

    th {
        background-color: #fff;
        color: #000;
    }
}

    </style>
</head>
<body>
    <div class="container my-5">
        <h2>Balabag Report</h2>
        <a href="Balabag_report.php" class="btn no-print"> Back </a>
        <button class="no-print" onclick="window.print()">Print Report</button>
        <br>
        <table class="table" border="1">
            <thead>
                <tr>
                    <th>FARM NAME</th>
                    <th>WEEKLY REPORT</th>
                    <th>DATE REPORTED</th>
                </tr>
            </thead>
            <tbody>
            <?php
                while($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                        <td>$row[farm_name]</td>
                        <td>$row[week_report]</td>
                        <td>$row[date]</td>
                    </tr>
                    ";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<?php
$conn->close();
?>
