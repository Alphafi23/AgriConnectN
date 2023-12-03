
<!DOCTYPE html>
<html lang="en">

<?php
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "faccount";
  
      $conn = new mysqli($servername, $username, $password, $dbname);

    $ID = "";
    $tname="";
    $age="";
    $sex="";
    $tcontact="";
    $tdesignation="";
    $role="";
    $tech_username="";
    $password="";
    $confirm_pass="";

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {

        if (!isset($_GET["ID"])) {
            header('location:user_profile.php');
            exit;
        }

        $ID = $_GET['ID'];

        $sql = "SELECT * FROM tech_acc WHERE ID = $ID";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

        if (!$row) {
            header('location:user_profile.php');
            exit;
        }

        $tname= $row["tname"];
        $age= $row["age"];
        $sex= $row["sex"];
        $tcontact= $row["tcontact"];
        $tdesignation= $row["tdesignation"];
        $role= $row["role"];
        $tech_username= $row["tech_username"];
        $password= $row["password"];
        $confirm_pass= $row["confirm_pass"];
    }
    else {

        $ID = $_POST["ID"];
        $tname= $_POST["tname"];
        $age= $_POST["age"];
        $sex= $_POST["sex"];
        $tcontact= $_POST["tcontact"];
        $tdesignation= $_POST["tdesignation"];
        $role= $_POST["role"];
        $tech_username= $_POST["tech_username"];
        $password= $_POST["password"];
        $confirm_pass= $_POST["confirm_pass"];

        do {
            if ( empty($ID) || empty($tname) || empty($age) || empty($sex) || empty($tcontact) || empty($tdesignation) || empty($role) || empty($tech_username) || empty($password) || empty($confirm_pass)){
                $errorMessage = "ALL the fields are required";
                break;
            }

            $sql = "UPDATE tech_acc " . 
            "SET tname = '$tname', age = '$age', sex = '$sex', tcontact = '$tcontact', tdesignation = '$tdesignation', role = '$role', tech_username = '$tech_username', password = '$password', confirm_pass = '$confirm_pass'" . 
            "WHERE ID = $ID";

            $result = $conn->query($sql);

            if (!$result) {
                echo 'invalid query' . $conn->error;
                break;
            }
            header('location:user_profile.php');
            exit;


        } while (true);
    }
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Technician</title>
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
    margin: 2rem auto;
    padding: 2rem;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
    color: #333;
    margin-bottom: 1rem;
}

.form-control {
    width: 100%;
    padding: 10px;
    margin-bottom: 1rem;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 16px;
}

select.form-control {
    -webkit-appearance: none; /* Removes default Chrome and Safari style */
    -moz-appearance: none; /* Removes default style Firefox */
    appearance: none; /* Removes default style for IE */
    display: block;
    width: 100%;
    padding: 10px;
    margin-bottom: 1rem;
    font-size: 16px;
    line-height: 1.25;
    color: #444;
    background-color: #fff;
    background-image: url('data:image/svg+xml;charset=US-ASCII,<svg width="12px" height="12px" viewBox="0 0 4 5" xmlns="http://www.w3.org/2000/svg" fill="%23aaa"><path d="M2 0L0 2h4zm0 5L0 3h4z"/></svg>'); /* Custom arrow */
    background-repeat: no-repeat;
    background-position: right 10px center;
    border: 1px solid #ccc;
    border-radius: 4px;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}

select.form-control:focus {
    border-color: #66afe9;
    outline: 0;
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102,175,233,.6);
}

.select-wrapper {
    position: relative;
    display: block;
    width: 100%;
    margin-bottom: 1rem;
}

.select-wrapper::after {
    content: "";
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    border-left: 5px solid transparent;
    border-right: 5px solid transparent;
    border-top: 5px solid #888;
    pointer-events: none;
}

select.form-control {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    padding-right: 30px; /* Make space for the arrow */
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 4px;
    padding: 10px 15px;
    font-size: 16px;
    line-height: 1.5;
    color: #444;
    background-repeat: no-repeat;
    background-position: right 10px center;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
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
    padding: 10px 0;
    text-decoration: none;
    text-align: center;
    display: block;
    transition: all 0.2s ease-in-out;
}

.btn.btn-outline-primary:hover {
    background-color: #008cba;
    color: white;
}

.row {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.col-sm-3, .col-sm-6 {
    flex-basis: 100%;
}

@media screen and (min-width: 768px) {
    .col-sm-3, .col-sm-6 {
        flex-basis: calc(50% - 20px);
    }

    .col-sm-3 {
        flex-basis: 25%;
    }

    .offset-sm-3 {
        margin-left: 25%;
    }
}

.d-grid {
    display: grid;
    gap: 10px;
}

@media screen and (min-width: 576px) {
    .d-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }
}

    </style>
</head>
<body>
    <div class="container my-5">
        <h2>Update Technician</h2>


        <form method="POST">
        <div class="row mb-3">
        <input type="hidden" name="ID" value="<?php echo $ID; ?>">
                <label class="col-sm-3 col-form-label">Technician Name</label>
                <div class="col-sm-6">
                <input type="text" class="form-control" name="tname" required placeholder="Last, First, Initial" value="<?php echo $tname; ?>">
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
                <div class="select-wrapper">
                <select name="sex" class="form=control" required value="<?php echo $sex; ?>"><br>
                    <option value=""> choose sex </option>
                    <option value="male"> male </option>
                    <option value="female"> female </option>
                        </select><br>
                </div> 
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Contact Number</label>
                <div class="col-sm-6">
                <input type="number" class="form-control" name="tcontact" required placeholder=" +63" value="<?php echo $tcontact; ?>">
                </div> 
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Barangay Designation</label>
                <div class="select-wrapper">
                <select name="tdesignation" class="form=control"  required value="<?php echo $tdesignation; ?>"><br>
                    <option value=""> choose barangay </option>
                    <option value="Agusipan"> Agusipan </option>
                    <option value="Agutayan"> Agutayan </option>
                    <option value="Bagumbayan"> Bagumbayan </option>
                    <option value="Balabag"> Balabag </option>
                    <option value="Ban-ag"> Ban-ag </option>
                        </select><br>
                </div> 
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Role</label>
                <div class="select-wrapper">
                <select name="role" class="form=control"  required value="<?php echo $role; ?>"><br>
                    <option value=""> choose role </option>
                    <option value="admin"> Admin </option>
                    <option value="technician"> Technician </option>
                        </select><br>
                </div> 
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">User Name</label>
                <div class="col-sm-6">
                <input type="text" class="form-control" name="tech_username" required  value="<?php echo $tech_username; ?>">
                </div> 
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Password</label>
                <div class="col-sm-6">
                <input type="text" class="form-control" name="password" required value="<?php echo $password; ?>">
                </div> 
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Confirm Password</label>
                <div class="col-sm-6">
                <input type="text" class="form-control" name="confirm_pass" required value="<?php echo $confirm_pass; ?>">
                </div> 
            </div>
            <br>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                <input type="submit" name="submit" value="submit" class="form-btn">
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/AgriConnectN/user_profile.php" role="button"> Cancel </a>
                </div>
            </div>
        </form>
    </div>

</body>
</html>