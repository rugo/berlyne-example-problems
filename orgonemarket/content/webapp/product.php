<?php
require_once('template.php');
require_once('db.php');
require_once('session.php');

$sql = "SELECT * FROM products WHERE id=" .  (int) $_GET['id'];
$result = $conn->query($sql);

if (!$result) {
    header("Location: products.php");
    die();
}
$row = $result->fetch_assoc();


$template = $twig->loadTemplate('product.phtml');
$template->display(array(
    'title' => 'The Market Products',
    'subtitle' => 'Everything you need for an energetic life',
    'headline' => $row['name'],
    'product' => $row,
    'user' => getUser($conn, $_SESSION['user_id'])
));
?>
