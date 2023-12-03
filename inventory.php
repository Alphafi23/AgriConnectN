<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Page</title>

    <style>
/* General Style */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f9f9f9;
    padding: 20px;
}
.container {
    max-width: 1200px; /* or 90% as per your preference */
    margin: auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}
h2 {
    text-align: center;
    color: #333;
    margin-bottom: 20px;
}

/* Form Style */
.form-control {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 16px;
}
.select-wrapper {
    position: relative;
}
.select-wrapper:after {
    content: '▼';
    position: absolute;
    top: 0;
    right: 10px;
    bottom: 0;
    pointer-events: none;
    text-align: center;
    line-height: 2.5em;
    font-size: 1em;
    color: #888;
}
select.form-control {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    padding-right: 2.5em;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 4px;
    padding: 10px 15px;
    font-size: 16px;
    line-height: 1.5;
    color: #444;
    background-repeat: no-repeat;
    background-position: right 10px center;
}

/* Button Style */
.btn, .form-btn {
    padding: 10px 20px;
    border-radius: 4px;
    text-decoration: none;
    display: inline-block;
    margin-right: 10px;
    background-color: #4CAF50;
    color: white;
    text-align: center;
    cursor: pointer;
    transition: background-color 0.3s ease;
}
.btn:hover, .form-btn:hover {
    background-color: #45a049;
}

/* Responsive Layout Style */
@media (max-width: 768px) {
    .container {
        width: 95%;
    }
    .btn, .form-btn {
        display: block;
        width: 100%;
        margin-bottom: 10px;
    }
}

/* Layout for forms and tables side by side */
.dashboard-container {
    display: flex;
    justify-content: space-between;
    gap: 20px;
}
.form-container {
    flex: 1;
    padding: 20px;
}
.table-container {
    flex: 2;
    padding: 20px;
}
@media (max-width: 992px) {
    .dashboard-container {
        flex-direction: column;
    }
}
</style>

</head>
<body>
    <div class="container my-5">
        <h2></h2>
        <a href="admin_page.php" class="btn"> Back to admin page </a>
        <a href="print_report.php" class="btn"> Print Report </a>

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
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "faccount";

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT * FROM distribute ORDER BY fname ASC";
                    $result = $conn->query($sql);

                    if(!$result) {
                        die("invalid query: " . $conn->error);
                    }

                    while($row = $result->fetch_assoc()) {
                        echo "
                        <tr>

                        <td>$row[fname]</td>
                        <td>$row[cropseed_n]</td>
                        <td>$row[quantity]</td>
                        <td>$row[date]</td>
                        <td>
                        <a class='btn btn-primary btn-sm' href='/AgriConnectN/update_inventory.php?ID=$row[ID]'> update </a>
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
    $fname="";
    $cropseed_n="";
    $quantity="";
    $date="";

    $errorMessage = "";
    $successMasage = "";

    // ... (previous code)

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $fname= $_POST["fname"];
    $cropseed_n= $_POST["cropseed_n"];
    $quantity= $_POST["quantity"];
    $date= $_POST["date"];

    // ... (rest of the POST data fetching)

    if ( empty($fname) || empty($cropseed_n) || empty($quantity) || empty($date))  {
        echo "ALL the fields are required";
    } else {

        $stmt = $conn->prepare("INSERT INTO distribute (fname, cropseed_n, quantity, date) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $fname, $cropseed_n, $quantity, $date);
    
        if ($stmt->execute()) {
            header('location:inventory.php');
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
    <title>Add to inventory</title>
</head>
<body>
    <div class="container my-5">
        <h2>Add to Inventory</h2>


        <form method="POST">
        <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Farmer Name</label>
                <div class="col-sm-6">
                <input type="text" class="form-control" name="fname" required placeholder="Last, First, Initial" value="<?php echo $fname; ?>">
                </div> 
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Crop/Seed Name</label>
                <div class="col-sm-6">
                <select name="cropseed_n" class="form=control"  value="<?php echo $cropseed_n; ?>"><br>
                <option value=""> select crop name </option>
                    <option value="Eggplant"> Eggplant (Talong) </option>
                    <option value="Bitter Gourd"> Bitter Gourd (Ampalaya) </option>
                    <option value="Okra"> Okra </option>
                    <option value="Rice"> Rice (Bigas) </option>
                    <option value="Corn"> Corn (Mais)</option>
                    <option value="String Beans"> String Beans (Sitaw) </option>
                    <option value="Squash"> Squash (Kalabasa)</option>
                    <option value="Sweet Potato"> Sweet Potato (Kamote) </option>
                    <option value="Tomato"> Tomato </option>
                    <option value="Peppers"> Peppers (Sili) </option>
                    <option value="Cabbage"> Cabbage (Repolyo) </option>
                    <option value="Onion"> Onion (Sibuyas) </option>
                    <option value="Garlic">Garlic (bawang) </option>
                    <option value="Grapes"> Grapes (Ubas) </option>
                    <option value="Banana"> Banana (Saging)</option>
                    <option value="Papaya"> Papaya </option>
                    <option value="Strawberry"> Strawberry </option>
                    <option value="Melon"> Melon </option>
                        </select><br>
                </div> 
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Quantity</label>
                <div class="col-sm-6">
                <input type="number" class="form-control" name="quantity" required placeholder="ex. wheat" value="<?php echo $quantity; ?>">
                </div> 
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Date Process</label>
                <div class="col-sm-6">
                <input type="date" class="form-control" name="date" required value="<?php echo $date; ?>">
                </div> 
            </div><br><br>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                <input type="submit" name="submit" value="submit" class="form-btn">
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/AgriConnectN/inventory.php" role="button"> Cancel </a>
                </div>
            </div>
        </form>
    </div>

</body>
</html>

