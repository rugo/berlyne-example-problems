<?php
require_once('template.php');
require_once('db.php');
require_once('session.php');

$msg = "Please Create a user account or <a href='login.php'>login</a>";

if ($_POST) {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);
    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    if ($conn->query($sql) === TRUE) {
        $msg = "Registered succefully, you can now <a href='login.php'>login</a>.";
    } else {
        $msg = "Error creating user. User may already exist.";
    }
}

$template = $twig->loadTemplate('register.phtml');
$template->display(array(
    'title' => 'The Market Products',
    'subtitle' => 'Everything you need for a energetic life',
    'headline' => 'Register a User',
    'msg' => $msg
));
?>
