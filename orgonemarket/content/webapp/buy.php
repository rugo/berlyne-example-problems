<?php
require_once('template.php');
require_once('db.php');
require_once('session.php');

if (!$_POST) {
    header("Location: products.php");
    die("Error in form submission");
}
$product_id = (int) $_POST['product_id'];
$sql = "SELECT coins FROM users WHERE id=" . (int) $_SESSION["user_id"]; 
$user_coins = (int)($conn->query($sql)->fetch_assoc()["coins"]);

$sql = "SELECT price FROM products WHERE id=" . (int) $product_id; 
$price_coins = (int)($conn->query($sql)->fetch_assoc()["price"]);
 
if ($price_coins == 0) {
    die("Error finding product.");
}

if ($user_coins >= $price_coins) {
    $sql = "UPDATE users SET coins=" . ($user_coins - $price_coins) . " WHERE id=" . (int) $_SESSION["user_id"];
    if ($conn->query($sql) === TRUE) {
        $msg = "Here is your secret: " . file_get_contents("/opt/flag.txt");
        $imageurl = "images/borat.jpg";
    } else {
        $msg = "Something, somewhere went terribly wrong";
        $imageurl = "http://s2.quickmeme.com/img/d0/d0374478557798edfc964afd006512de457207f70346d8e2ef524a98afd73578.jpg";
    }

} else {
    $msg = "Unfortunately, you can't afford this. <a href='javascript:history.back()'>Go Back</a>";
    $imageurl = "images/stupid_poor_people_stupid_poor_people.jpg";
}

$template = $twig->loadTemplate('buy.phtml');
$template->display(array(
    'title' => 'The Market Products',
    'subtitle' => 'Everything you need for a energetic life',
    'headline' => 'Payment',
    'msg' => $msg,
    'imageurl' => $imageurl,
    'user' => getUser($conn, $_SESSION['user_id'])
));
?>
