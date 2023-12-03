<?php
    include_once("conn.php");


if(isset($_POST['submit'])){

    $tech_username = mysqli_real_escape_string($conn, $_POST['tech_username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $tdesignation = mysqli_real_escape_string($conn, $_POST['tdesignation']);

    $select = "SELECT * FROM tech_acc WHERE tech_username = '$tech_username' && password = '$password' && tdesignation = '$tdesignation'";

    $result = mysqli_query($conn, $select);

    if(mysqli_num_rows($result) > 0 ){
        
            $row = mysqli_fetch_array($result);

        if($row['role'] =='admin'){
            $_SESSION['admin_name'] = $row['tech_username'];
            header('location:admin_page.php');
        }
        elseif ($row['role'] =='technician'){
            $_SESSION['tech_username'] = $row['tech_username'];
            header('location:tech_page.php');
             
        if ($row['tdesignation'] == 'Agusipan'){
            $_SESSION['brgy'] = $row['tdesignation'];
            header('location:Agusipan_page.php');
        }
        elseif ($row['tdesignation'] == 'Agutayan'){
            $_SESSION['brgy'] = $row['tdesignation'];
            header('location:Agutayan_page.php');
        }
        elseif ($row['tdesignation'] == 'Bagumbayan'){
            $_SESSION['brgy'] = $row['tdesignation'];
            header('location:Bagumbayan_page.php');
        }
        elseif ($row['tdesignation'] == 'Balabag'){
            $_SESSION['brgy'] = $row['tdesignation'];
            header('location:Balabag_page.php');
        }
        elseif ($row['tdesignation'] == 'Ban-ag'){
            $_SESSION['brgy'] = $row['tdesignation'];
            header('location:Ban-ag_page.php');
        }
        else{
            echo"invalid account";
        }
        } else {
            echo"invalid account";
        }
        }    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login form</title>
    <style>
        /* General reset */
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

        /* Centering the form on the page */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Form container styling */
        .form-container {
            background: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        /* Header image styling */
        /* #header-image {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            display: block;
            margin: 0 auto 30px;
        } */

        /* Styling for headings and paragraphs */
        h1, p {
            text-align: center;
            margin-bottom: 20px;
        }

        h1 {
            color: #4CAF50;
        }

        p {
            color: #666;
        }

        /* Label and input field styling */
        label {
            color: #333;
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="password"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box; /* Add box-sizing */
        }

        /* Button and link styling */
        .form-btns {
            display: flex;
            justify-content: space-between;
        }

        .form-btn {
            padding: 10px 0; /* Change to padding top and bottom only */
            flex-grow: 1; /* Make buttons fill the space */
            text-align: center;
            border-radius: 4px;
            border: none;
            color: white;
            font-weight: bold;
            cursor: pointer;
            margin-right: 10px; /* Add right margin to first button */
        }

        .form-btn:last-child {
            margin-right: 0; /* Remove right margin from last button */
        }

        .cancel-btn {
            background-color: #d9534f;
        }

        .login-btn {
            background-color: #5cb85c;
        }

        .form-btn:hover {
            opacity: 0.9; /* Add hover effect */
        }

        /* Error message styling */
        .error-msg {
            color: red;
            text-align: center;
            margin-bottom: 20px;
        }

        /* Responsive design adjustments */
        @media (max-width: 768px) {
            .form-container {
                width: 90%;
                margin: 0 auto;
            }
        }
    </style>
</head>
<body>
    <div class="form-container">
        <!-- Header image -->
        <!-- <img id="header-image" src="path_to_your_image.jpg" alt="Header Image"> -->

        <!-- Main form starts here -->
        <form action="" method="POST">
            <h1>AgriConnect</h1>
            <p>Connecting Farmers and Buyers</p>

            <!-- Display error message -->
            <?php 
            if(isset($error)){
                foreach($error as $error){
                    echo '<span class="error-msg">'. $error. '</span>';
                };
            };
            ?>
            
            <label for="tech_username">USER NAME:</label>
            <input type="text" id="tech_username" name="tech_username" required placeholder="enter username">
            
            <label for="password">PASSWORD:</label>
            <input type="password" id="password" name="password" required placeholder="enter password">
            
            <label for="tdesignation">Barangay:</label>
            <select id="tdesignation" name="tdesignation" required>
            <option value="Agusipan">Agusipan</option>
            <option value="Agutayan">Agutayan</option>
            <option value="Bagumbayan">Bagumbayan</option>
            <option value="Balabag">Balabag</option>
            <option value="Ban-ag">Ban-ag</option>
                <!-- Other options here -->
            </select>

            <!-- Buttons -->
            <div class="form-btns">
                <a href="front_page.html" class="form-btn cancel-btn">Cancel</a>
                <button type="submit" name="submit" class="form-btn login-btn">Login now</button>
            </div>
        </form>
    </div>
</body>
</html>
