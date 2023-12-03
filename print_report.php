<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "faccount";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM distribute";
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
        @media print {
            .no-print {
                display: none; /* Hide elements with 'no-print' class during printing */
            }
            body {
                margin: 0;
                padding: 0;
                font-size: 12px; /* Adjust font size for print, if necessary */
            }
            table {
                width: 100%; /* Ensure table takes full width */
                border-collapse: collapse; /* Optional: Makes the table more compact */
            }
            th, td {
                border: 1px solid black; /* Add borders to table cells */
                padding: 5px; /* Optional: Adjust padding for table cells */
            }
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <h2>Inventory Report</h2>
        <a href="inventory.php" class="btn no-print"> Back to Inventory </a>
        <button class="no-print" onclick="window.print()">Print Report</button>
        <br>
        <table class="table" border="1">
            <thead>
                <tr>
                    <th>FARMER NAME</th>
                    <th>CROP / SEED NAME</th>
                    <th>QUANTITY</th>
                    <th>DATE RECEIVED</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                        <td>$row[fname]</td>
                        <td>$row[cropseed_n]</td>
                        <td>$row[quantity]</td>
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
