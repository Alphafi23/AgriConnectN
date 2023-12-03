<!DOCTYPE html>
<html lang="en">
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
    $tech_username="";
    $password="";
    $confirm_pass="";

    $errorMessage = "";
    $successMasage = "";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $tname= $_POST["tname"];
    $age= $_POST["age"];
    $sex= $_POST["sex"];
    $tcontact= $_POST["tcontact"];
    $tdesignation= $_POST["tdesignation"];
    $role= $_POST["role"];
    $tech_username= $_POST["tech_username"];
    $password= $_POST["password"];
    $confirm_pass= $_POST["confirm_pass"];



    if ( empty($tname) || empty($age) || empty($sex) || empty($tcontact) || empty($tdesignation) || empty($role)  || empty($tech_username)  || empty($password) || empty($confirm_pass))  {
        echo "ALL the fields are required";
    } else {
        if ($password != $confirm_pass){
            echo "password not matched";
         }
        else{
        $stmt = $conn->prepare("INSERT INTO tech_acc (tname, age, sex, tcontact, tdesignation, role, tech_username, password, confirm_pass) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssss", $tname, $age, $sex, $tcontact, $tdesignation, $role, $tech_username, $password, $confirm_pass);
    
        if ($stmt->execute()) {
            header('location:user_profile.php');
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

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Technician Profile Management</title>

<style>
    /* General Style Reset */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: #f9f9f9;
        padding: 20px;
    }

    .dashboard-container {
    display: flex;
    justify-content: flex-start; /* Align containers to the start of the flex container */
    gap: 10px; /* Reduce gap between containers */
}

    .form-container {
    background: #ffffff; /* A solid white background */
    padding: 40px; /* More padding for better spacing */
    border-radius: 10px; /* Rounded corners */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
    margin-right: 20px; /* Add some margin between the form and the list */
}

/* Input and Select Box Styles */
.form-control {
    width: 100%;
    padding: 15px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px; /* Increase font size for better readability */
}

select.form-control {
    appearance: none; /* Remove default styling */
    background-color: white;
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 10px 15px;
    background-image: url('path-to-your-dropdown-arrow-image');
    background-repeat: no-repeat;
    background-position: right 10px center;
    cursor: pointer;
}

/* Add focus styles for when the dropdown is clicked or tabbed into */
select.form-control:focus {
    outline: none;
    border-color: #006400;
    box-shadow: 0 0 5px rgba(0, 100, 0, 0.5);
}

/* Button Styles */
.form-btn {
    width: auto; /* To allow padding to define the size */
    padding: 15px 30px; /* Larger padding for a bigger button */
    background-color: #008CBA; /* A modern blue */
    color: white;
    font-size: 16px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s, box-shadow 0.3s;
}

.form-btn:hover {
    background-color: #005f73; /* A darker shade for hover state */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); /* Elevated shadow on hover */
}



    .table-container {
        width: calc(80% - 10px); /* Adjust width as needed */
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        overflow-x: auto; /* Make it scrollable horizontally */
    }
    

    .table {
    width: 100%;
    max-width: 100%;
    border-collapse: collapse;
    table-layout: fixed; /* Add this line */
}

.table th {
    background-color: #4CAF50; /* Green background for headers */
    color: white; /* White text for headers */
    padding: 10px; /* Spacing within header cells */
    border: 1px solid #ddd; /* Light border for definition */
}

/* Table Body */
.table td {
    padding: 10px; /* Spacing within cells */
    text-align: left; /* Align text to the left */
    border: 1px solid #ddd; /* Light border for definition */
}

.table tr:hover {
    background-color: #ddd; /* Lighter grey background when hovered */
}


.table tr:nth-child(even) {
    background-color: #f2f2f2; /* Light grey background for even rows */
}

.table-responsive {
    overflow-x: auto;
}

.button-container {
  display: flex; /* Use flexbox to lay out children side by side */
  justify-content: center; /* Center the buttons in the container */
  align-items: center; /* Align buttons vertically */
}

.btn {
  margin-right: 4px; /* Reduce space to the right of buttons if needed */
  padding: 4px 5px; /* Reduce padding to fit the content */
  /* Additional styles for the button */
  text-align: center;
  text-decoration: none;
  font-size: 13px; /* Reduce font size if necessary */
  border: none;
  border-radius: 4px;
  cursor: pointer;
  white-space: nowrap; /* Prevent wrapping of text inside buttons */
}

.btn-cancel {
    background-color: #f44336; /* Red */
  color: white;
}

.btn-back {
    background-color: #4CAF50; /* Green */
  color: white;
}

.btn-cancel, .btn-back {
    margin-right: 10px; /* Adjust the right margin to create space between buttons */
}

.d-grid {
    display: grid;
    grid-template-columns: 1fr 1fr; /* This will create two columns of equal width */
    gap: 10px; /* Adjust the gap to your preference */
    justify-content: start; /* Align grid items to the start of the grid area */
    align-items: center; /* Vertically center grid items */
}


/* Green Update Button */
.btn.update {
  background-color: #4CAF50; /* Green */
  color: white;
}

.btn.delete {
  background-color: #f44336; /* Red */
  color: white;
}

@media (max-width: 768px) {
.dashboard-container {
    flex-direction: column;
}

.form-container, .table-container {
    width: 100%;
    max-width: none; /* Allow containers to fill their parent */
}
}
</style>

</head>
<body>
<div class="dashboard-container">
<div class="form-container">
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
                <select name="sex" class="form-control" required value="<?php echo $sex; ?>"><br>
                    <option value=""> choose sex </option>
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
                <select name="tdesignation" class="form-control"  required value="<?php echo $tdesignation; ?>"><br>
                <option value=""> Choose Barangay </option>
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
                <select name="role" class="form-control" value="<?php echo $role; ?>"><br>
                <option value=""> Choose User Type </option>
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
                    <a class="btn btn-cancel" href="/AgriConnectN/user_profile.php" role="button"> Cancel </a>
                           <a class="btn btn-back" href="admin_page.php" class="btn"> Back to Admin page </a>
                </div>
            </div>
        </form>
    </div>

    <div class="table-container">
            <h2>List of Technician</h2>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>TECHNICIAN NAME</th>
                    <th>AGE</th>
                    <th>SEX</th>
                    <th>CONTACT NUMBER</th>
                    <th>DESIGNATED</th>
                    <th>ROLE</th>
                    <th>USER NAME</th>
                    <th>PASSWORD</th>
                    <th>ACTIONS</th>
             
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

  $sql = "SELECT * FROM tech_acc ORDER BY tdesignation ASC";

  $result = $conn->query($sql);

  if(!$result) {
    die("invalid query: " . $conn->error);
  }

  while($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($row['tname']) . "</td>";
    echo "<td>" . htmlspecialchars($row['age']) . "</td>";
    echo "<td>" . htmlspecialchars($row['sex']) . "</td>";
    echo "<td>" . htmlspecialchars($row['tcontact']) . "</td>";
    echo "<td>" . htmlspecialchars($row['tdesignation']) . "</td>";
    echo "<td>" . htmlspecialchars($row['role']) . "</td>";
    echo "<td>" . htmlspecialchars($row['tech_username']) . "</td>";
    echo "<td>" . htmlspecialchars($row['password']) . "</td>";   
    echo "<td>";
    echo "<div class=\"button-container\">";
    echo "<a class=\"btn update\" href=\"/AgriConnectN/update_user_profile.php?ID=" . htmlspecialchars($row['ID']) . "\">Update</a>";
    echo "<a class=\"btn delete\" href=\"/AgriConnectN/delete_tech_acc.php?ID=" . htmlspecialchars($row['ID']) . "\">Delete</a>";
    echo "</div>";
    echo "</td>";
    echo "</tr>";
  }

  $conn->close();
  ?>
</tbody>
        </table>
    </div>  
</body>
</html>


