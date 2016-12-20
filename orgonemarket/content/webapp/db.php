<?php
$servername = "localhost";
$username = "orgone_market";
$password = "W4PeV6EGmElBBpZz";
$dbname = "orgone_market";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

function getUser($conn, $user_id) {
    $sql = "SELECT * FROM users WHERE id=" .  $conn->real_escape_string((int)$user_id);
    $result = $conn->query($sql);

    return $result->fetch_assoc();
}
?>
