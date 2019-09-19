<?php 


session_start();

unset($_SESSION["auth"]);


$_SESSION['flash']['success'] = "Logout success";
header('location: login.php');