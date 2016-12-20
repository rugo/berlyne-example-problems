<?php
require_once('template.php');
require_once('db.php');
require_once('session.php');

// Temporary code, until we got that payment stuff fixed
$msg = "Unfortunately our payment service is down for maintenance. <br />".
    "To make up for it you'll ".
    " get 300 Orgone Coins for free. <br /> ";
$show_form = true;

if ($_POST) {
    if ($_POST['captcha'] != $_SESSION['captcha']) {
        $msg = "Captcha was wrong!";
    } else {
        $user_id = (int) $_SESSION['user_id'];
        $sql = "SELECT COUNT(*) as had FROM had_free_orgone WHERE user_id=" . $user_id; 
        $result = $conn->query($sql);
        $user_had_free_orgone = $result->fetch_assoc()["had"];

        if (!$user_had_free_orgone) {
            $conn->query("INSERT INTO had_free_orgone (user_id) VALUES ($user_id)");

            if($conn->query("UPDATE users SET coins=coins+300 WHERE id=" . $user_id) === TRUE) {
                $msg = "Have fun with your Coins!";
                $show_form = false;
            }
        } else {
            $msg = "You already got your free Coins!";
        }    
    }
}

$template = $twig->loadTemplate('coins.phtml');
$template->display(array(
    'title' => 'The Orgone Market',
    'subtitle' => 'Everything you need for an energetic life',
    'headline' => 'Payment',
    'msg' => $msg,
    'show_form' => $show_form,
    'user' => getUser($conn, $_SESSION['user_id'])
));
?>
