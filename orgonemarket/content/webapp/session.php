<?php
$valid_sites = array("login.php", "register.php");
session_start();
if (!in_array(basename($_SERVER['SCRIPT_FILENAME'], ""), $valid_sites)) {
    if (!isset($_SESSION['user_id'])) {
        header('Location: register.php');
        die();
    } 
}
?>
