<?php
session_start(); 

function generateCaptcha($captcha_text) {
    
    $font = './fonts/open_sans.ttf'; 
    $captcha_text = str_split($captcha_text);

    $image = imagecreate(16 + 15 * sizeof($captcha_text), 30); 
    imagecolorallocate($image, 0, 0, 0); 
    
    $left = 5; 
    
    
    for($i=0; $i < sizeof($captcha_text); $i++) 
    {
        imagettftext($image, 16, rand(-15, 15), $left + (15 * $i), 25, imagecolorallocate($image, 69, 103, 137), $font, $captcha_text[$i]);
    }
    
    header("Content-type: image/png"); 
    imagepng($image); 
    imagedestroy($image); 
    
}



if(isset($_SESSION['user_id']))
{
    // As in HTTP: Mon, 08 Aug 2016 13:21:13 GMT
    // $date_str = "D, d M Y H:i:s T";
    // TODO: Evtl. adden hinter proxy?
    //header("X-Script-Time: " . gmdate($date_str, $t), true);
    include('base_calc.php');
    $t = (int)time();
    $c = $_SESSION['captcha'] = Base32::encode("$t");
    generateCaptcha($c); 
} else {
    generateCaptcha("Penis");
}
?>
