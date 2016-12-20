<?php
require_once('template.php');
require_once('db.php');
require_once('session.php');

$sql = "SELECT * FROM products";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
        $results[] = $row;
}

$template = $twig->loadTemplate('products.phtml');
$template->display(array(
    'title' => 'The Market Products',
    'subtitle' => 'Everything you need for an energetic life',
    'headline' => 'Products',
    'products' => $results,
    'user' => getUser($conn, $_SESSION['user_id']) 
));
?>
