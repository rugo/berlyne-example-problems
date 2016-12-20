<?php


function showSecretPanel() {
    $secret = file_get_contents("/opt/flag.txt");
    die("Well done: " .  $secret);
}
