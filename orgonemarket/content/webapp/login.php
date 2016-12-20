<?php
require_once('template.php');
require_once('db.php');
require_once('session.php');

$msg = "Please login";

if ($_POST) {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);
    $sql = "SELECT id FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $msg = "You logged-in succefully.";
        session_start();
        $_SESSION['user_id'] = $result->fetch_assoc()["id"];
        header("Location: index.php");
    } else {
        $msg = "Could not login, please check your credentials.";
    }
}

$template = $twig->loadTemplate('login.phtml');
$template->display(array(
    'title' => 'The Market Products',
    'subtitle' => 'Everything you need for a energetic life',
    'headline' => 'Login',
    'msg' => $msg
));
?>
