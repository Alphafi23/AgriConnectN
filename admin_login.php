<?php
    include_once("conn.php");
    $login_error = ''; // Initialize an error message variable

    if(isset($_POST['submit'])){
        $tech_username = mysqli_real_escape_string($conn, $_POST['tech_username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        $select = "SELECT * FROM tech_acc WHERE tech_username = '$tech_username' && password = '$password'";
        $result = mysqli_query($conn, $select);

        if(mysqli_num_rows($result) > 0 ){
            $row = mysqli_fetch_array($result);
            if($row['role'] =='admin'){
                $_SESSION['admin_name'] = $row['tech_username'];
                header('location:admin_page.php');
            }
        } else{
            $login_error = "invalid username or password!";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>

    <style>
        /* Style for header image */
        #header-image {
            width: 100px; /* Adjust as needed */
            height: 100px; /* Adjust as needed */
            border-radius: 50%; /* Circular shape */
            position: absolute;
            top: 40px; /* Adjust as needed */
            right: 50px; /* Adjust as needed */
        }

        /* General reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #f9f9f9; /* Light gray background */
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.form-container {
    background: #fff; /* White background for the form */
    padding: 40px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 400px;
}

h1 {
    color: #4CAF50; /* Green color for the main title */
    margin-bottom: 20px;
    text-align: center;
}

p {
    color: #666; /* Dark gray for text */
    text-align: center;
    margin-bottom: 30px;
}

label {
    color: #333; /* Darker gray for labels */
    display: block;
    margin-bottom: 5px;
}

input[type="text"],
input[type="password"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ddd; /* Light gray border */
    border-radius: 4px;
}

input[type="submit"] {
    width: 100%;
    padding: 10px;
    border: none;
    border-radius: 4px;
    background: #4CAF50; /* Green background for submit button */
    color: white;
    font-size: 16px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background: #45a049; /* Darker green on hover */
}

a {
    color: #4CAF50; /* Green color for links */
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}

.error-msg {
    color: red; /* Or any color you want for the text */
    text-align: center; /* Center the text */
    margin-top: -15px; /* Space above the error message */
    margin-bottom: 20px; /* Space below the error message */
    /* Add other styles as needed */
}

/* Additional styles for responsive design */
@media (max-width: 768px) {
    .form-container {
        width: 90%;
        margin: 0 auto;
    }
}

    </style>
</head>
<body>
    <div class = "form-container">
        <!-- Header Image -->
    <img id="header-image" src="https://www.dropbox.com/scl/fi/dtpki3lvopthxbikadj2i/agri_icon.jpg?rlkey=clwb9ju08mx3yu56ljhwixox5&dl=1" alt="Header Image">

    <form action="" method="POST">
         <h1> AgriConnect </h1>
            <p>Connecting Farmers and Buyers </p>

        <?php 
        if(isset($error)){
            foreach($error as $error){
                echo '<span class="error-msg">'. $error. '</span>';
            };
        };
        ?>
        
        <br>
        <label>USER NAME: </label><br>
        <input type="text" name="tech_username" required placeholder="enter username"><br>

        <label>PASSWORD: </label><br>
        <input type="password" name="password" required placeholder="enter password"><br>
        <div class="error-msg"><?php echo $login_error; ?></div> <!-- Display error message here -->

        <input type="submit" name="submit" value="Login now" class="form-btn"><br><br>
        <p>Login as Technician <a href="tech_login.php" class="btn">click here </a></p>
</body>
</html>