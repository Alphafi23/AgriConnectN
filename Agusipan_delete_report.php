<?php

if ( isset($_GET["ID"])) {
    $ID = $_GET["ID"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "faccount";

                    $conn = new mysqli($servername, $username, $password, $dbname);

    $sql = "DELETE FROM agusipan_report WHERE ID=$ID";
    $conn->query($sql);
}

header("location: Agusipan_report.php");
exit;
?>