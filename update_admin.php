<!DOCTYPE html>
<html lang="en">

<?php
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "faccount";
  
      $conn = new mysqli($servername, $username, $password, $dbname);

    $ID = "";
    $farmer_n="";
    $age="";
    $sex="";
    $farm_n="";
    $area="";
    $barangay="";
    $fcontact="";
    $crop_name="";
    $crop_status="";

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {

        if (!isset($_GET["ID"])) {
            header('location:admin_page.php');
            exit;
        }

        $ID = $_GET['ID'];

        $sql = "SELECT * FROM farmer_acc WHERE ID = $ID";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

        if (!$row) {
            header('location:admin_page.php');
            exit;
        }

        $farmer_n= $row["farmer_n"];
        $age= $row["age"];
        $sex= $row["sex"];
        $farm_n= $row["farm_n"];
        $area= $row["area"];
        $barangay= $row["barangay"];
        $fcontact= $row["fcontact"];
        $crop_name= $row["crop_name"];
        $crop_status= $row["crop_status"];
    }
    else {

        $ID = $_POST["ID"];
        $farmer_n= $_POST["farmer_n"];
        $age= $_POST["age"];
        $sex= $_POST["sex"];
        $farm_n= $_POST["farm_n"];
        $area= $_POST["area"];
        $barangay= $_POST["barangay"];
        $fcontact= $_POST["fcontact"];
        $crop_name= $_POST["crop_name"];
        $crop_status= $_POST["crop_status"];

        do {
            if ( empty($ID) || empty($farmer_n) || empty($age) || empty($sex) || empty($farm_n) || empty($area) || empty($barangay) || empty($fcontact) || empty($crop_name) || empty($crop_status)){
                $errorMessage = "ALL the fields are required";
                break;
            }

            $sql = "UPDATE farmer_acc " . 
            "SET farmer_n = '$farmer_n', age = '$age', sex = '$sex', farm_n = '$farm_n', area = '$area', barangay = '$barangay', fcontact = '$fcontact', crop_name = '$crop_name', crop_status = '$crop_status'" . 
            "WHERE ID = $ID";

            $result = $conn->query($sql);

            if (!$result) {
                echo 'invalid query' . $conn->error;
                break;
            }
            header('location:admin_page.php');
            exit;


        } while (true);
    }
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update farmer</title>
</head>
<style>
<style>
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
    max-width: 600px;
    margin: auto;
    padding: 2rem;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
    margin-bottom: 2rem;
    color: #333;
}

.form-control {
    width: 100%;
    padding: 10px;
    margin-bottom: 1rem;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 16px;
}

.select-wrapper {
    position: relative;
}

.select-wrapper select.form-control {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    padding-right: 2.5em; /* make room for the arrow */
    background: url('data:image/svg+xml;utf8,<svg fill="rgba(0,0,0,0.54)" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M7 10l5 5 5-5z"/></svg>') no-repeat;
    background-position: right 0.7em top 50%, 0 0;
    background-size: 1.25em auto, 100%;
}

.select-wrapper:after {
    content: '';
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    pointer-events: none;
}

.form-btn {
    width: 100%;
    padding: 10px 0;
    border: none;
    border-radius: 4px;
    background-color: #008cba;
    color: white;
    font-size: 18px;
    cursor: pointer;
    transition: background-color 0.2s ease-in-out;
}

.form-btn:hover {
    background-color: #007ba7;
}

.btn.btn-outline-primary {
    border: 1px solid #008cba;
    background-color: transparent;
    color: #008cba;
    padding: 10px 20px;
    text-decoration: none;
    text-align: center;
    display: block;
    transition: all 0.2s ease-in-out;
}

.btn.btn-outline-primary:hover {
    background-color: #008cba;
    color: white;
}

.d-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 10px;
}

@media screen and (min-width: 576px) {
    .d-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

.row.mb-3 {
    margin-bottom: 1rem;
}

.col-sm-3 {
    flex: 0 0 auto;
    width: 25%;
    max-width: 25%;
}

.col-sm-6 {
    flex: 0 0 auto;
    width: 75%;
    max-width: 75%;
}

.offset-sm-3 {
    margin-left: 25%;
}
</style>

</style>
<body>
    <div class="container my-5">
        <h2>Update Farmer</h2>


        <form method="POST">
        <div class="row mb-3">
        <input type="hidden" name="ID" value="<?php echo $ID; ?>">
                <label class="col-sm-3 col-form-label">Farmer Name</label>
                <div class="col-sm-6">
                <input type="text" class="form-control" name="farmer_n" required placeholder="Last, First, Initial" value="<?php echo $farmer_n; ?>">
                </div> 
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Age</label>
                <div class="col-sm-6">
                <input type="text" class="form-control" name="age" required placeholder="ex. 20" value="<?php echo $age; ?>">
                </div> 
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">sex</label>
                <div class="col-sm-6">
                <select name="sex" class="form=control" required value="<?php echo $sex; ?>"><br>
                    <option value="male"> male </option>
                    <option value="female"> female </option>
                        </select><br>
                </div> 
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Farm Name</label>
                <div class="col-sm-6">
                <input type="text" class="form-control" name="farm_n" required placeholder="ex. Green Hills" value="<?php echo $farm_n; ?>">
                </div> 
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Area (hectars)</label>
                <div class="col-sm-6">
                <input type="number" class="form-control" name="area" required placeholder="ex. 500" value="<?php echo $area; ?>">
                </div> 
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Barangay</label>
                <div class="col-sm-6">
                <select name="barangay" class="form=control"  required value="<?php echo $barangay; ?>"><br>
                    <option value="Agusipan"> Agusipan </option>
                    <option value="Agutayan"> Agutayan </option>
                    <option value="Bagumbayan"> Bagumbayan </option>
                    <option value="Balabag"> Balabag </option>
                    <option value="Ban-ag"> Ban-ag </option>
                        </select><br>
                </div> 
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Contact Number</label>
                <div class="col-sm-6">
                <input type="text" class="form-control" name="fcontact" required  value="<?php echo $fcontact; ?>">
                </div> 
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Crop Name</label>
                <div class="col-sm-6">
                <select name="crop_name" class="form=control"  value="<?php echo $crop_name; ?>"><br>
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
                <label class="col-sm-3 col-form-label">Crop Status</label>
                <div class="col-sm-6">
                <select name="crop_status" class="form=control"  value="<?php echo $crop_status; ?>"><br>
                    <option value="seedling"> seedling </option>
                    <option value="sprouting"> sprouting </option>
                    <option value="ripening"> ripening </option>
                    <option value="harvesting"> harvesting </option>
                    <option value="withered"> withered </option>
                        </select><br>
                </div> 
            </div>
            <br>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                <input type="submit" name="submit" value="submit" class="form-btn">
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/AgriConnectN/admin_page.php" role="button"> Cancel </a>
                </div>
            </div>
        </form>
    </div>

</body>
</html>