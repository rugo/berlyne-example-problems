<?php
require_once('template.php');
require_once('db.php');
require_once('session.php');
$template = $twig->loadTemplate('start.phtml');
$template->display(array(
    'title' => 'The Orgone Market',
    'subtitle' => 'Where you can buy the truth',
    'headline' => 'What we do',
    'user' => getUser($conn, $_SESSION['user_id'])
));
?>
