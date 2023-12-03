<?php
     $servername = "localhost";
     $username = "root";
     $password = "";
     $dbname = "faccount";
 
     $conn = new mysqli($servername, $username, $password, $dbname);

    $ID="";
    $tname="";
    $age="";
    $sex="";
    $tcontact="";
    $tdesignation="";
    $role="";
    $user_name="";
    $password="";
    $confirm_pass="";

    $errorMessage = "";
    $successMasage = "";

    // ... (previous code)

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $tname= $_POST["tname"];
    $age= $_POST["age"];
    $sex= $_POST["sex"];
    $tcontact= $_POST["tcontact"];
    $tdesignation= $_POST["tdesignation"];
    $role= $_POST["role"];
    $user_name= $_POST["user_name"];
    $password= $_POST["password"];
    $confirm_pass= $_POST["confirm_pass"];

    // ... (rest of the POST data fetching)

    if ( empty($tname) || empty($age) || empty($sex) || empty($tcontact) || empty($tdesignation) || empty($role)  || empty($user_name)  || empty($password) || empty($confirm_pass))  {
        echo "ALL the fields are required";
    } else {
        if ($password != $confirm_pass){
            echo "password not matched";
         }
        else{
        $stmt = $conn->prepare("INSERT INTO tech_acc (tname, age, sex, tcontact, tdesignation, role, user_name, password, confirm_pass) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssss", $tname, $age, $sex, $tcontact, $tdesignation, $role, $user_name, $password, $confirm_pass);
    
        if ($stmt->execute()) {
            header('location:login_page.php');
            exit;
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }
    }
}

$conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register technician</title>
</head>
<body>
    <div class="container my-5">
        <h2>Register New Technician</h2>


        <form method="POST">
        <div class="row mb-3">
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
                <div class="col-sm-6">
                <select name="sex" class="form=control" required value="<?php echo $sex; ?>"><br>
                    <option value="male"> male </option>
                    <option value="female"> female </option>
                        </select><br>
                </div> 
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Contact Number</label>
                <div class="col-sm-6">
                <input type="text" class="form-control" name="tcontact" required placeholder="09*********" value="<?php echo $tcontact; ?>">
                </div> 
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Barangay Designation</label>
                <div class="col-sm-6">
                <select name="tdesignation" class="form=control"  required value="<?php echo $tdesignation; ?>"><br>
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
                <div class="col-sm-6">
                <select name="role" class="form=control" value="<?php echo $role; ?>"><br>
                    <option value="admin"> admin </option>
                    <option value="technician"> technician </option>
                        </select><br>
                </div> 
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">User Name</label>
                <div class="col-sm-6">
                <input type="text" class="form-control" name="user_name" required  value="<?php echo $user_name; ?>">
                </div> 
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Password</label>
                <div class="col-sm-6">
                <input type="password" class="form-control" name="password" required value="<?php echo $password; ?>">
                </div> 
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Confirm Password</label>
                <div class="col-sm-6">
                <input type="password" class="form-control" name="confirm_pass" required value="<?php echo $confirm_pass; ?>">
                </div> 
            </div>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                <input type="submit" name="submit" value="submit" class="form-btn">
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/Agri/admin_page.php" role="button"> Cancel </a>
                </div>
            </div>
        </form>
    </div>

</body>
</html>