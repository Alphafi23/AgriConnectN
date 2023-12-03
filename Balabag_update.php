<?php
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "faccount";
  
      $conn = new mysqli($servername, $username, $password, $dbname);

    $ID = "";
    $crop_name="";
    $crop_status="";

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {

        if (!isset($_GET["ID"])) {
            header('location:Balabag_page.php');
            exit;
        }

        $ID = $_GET['ID'];

        $sql = "SELECT * FROM farmer_acc WHERE ID = $ID";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

        if (!$row) {
            header('location:Balabag_page.php');
            exit;
        }
        $farm_n= $row["farm_n"];
        $crop_name= $row["crop_name"];
        $crop_status= $row["crop_status"];
    }
    else {

        $ID = $_POST["ID"];
        $farm_n= $_POST["farm_n"];
        $crop_name= $_POST["crop_name"];
        $crop_status= $_POST["crop_status"];

        do {
            if ( empty($ID) || empty($crop_name) || empty($crop_status)){
                $errorMessage = "ALL the fields are required";
                break;
            }

            $sql = "UPDATE farmer_acc " . 
            "SET crop_name = '$crop_name', crop_status = '$crop_status'" . 
            "WHERE ID = $ID";

            $result = $conn->query($sql);

            if (!$result) {
                echo 'invalid query' . $conn->error;
                break;
            }
            header('location:Balabag_page.php');
            exit;


        } while (true);
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register farm</title>
</head>
<body>
    <div class="container my-5">
        <h2>Update FARM & FARMER</h2>


        <form method="POST">
            <input type="hidden" name="ID" value="<?php echo $ID; ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Farm Name</label>
                <div class="col-sm-6">
                <input type="text" class="form-control" name="farm_n" value="<?php echo $farm_n; ?>">
                </div> 
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Crop Name</label>
                <div class="col-sm-6">
                <input type="text" class="form-control" name="crop_name" value="<?php echo $crop_name; ?>">
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
            <br><br>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                <input type="submit" name="submit" value="update" class="form-btn">
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/AgriConnectN/Balabag_page.php" role="button"> Cancel </a>
                </div>
            </div>
        </form>
    </div>

</body>
</html>