<?php
require_once('db_config.php');
$conn = new mysqli($servername, $username, $password, $dbname);
unset($password);