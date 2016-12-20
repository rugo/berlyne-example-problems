<?php
$file = "songs/" . $_GET['file'];

if (file_exists($file)) {
    header('Content-Type: audio/mpeg3');
    header('Content-Length: ' . filesize($file));
    readfile($file);
    exit;
}
?>