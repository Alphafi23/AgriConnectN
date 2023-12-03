<?php
    include_once ('conn.php');

    session_start();
    session_unset();
    session_destroy();

    header('location:front_page.html');
?>