<?php
session_start();
header("Content-type: image/png");

// Generate a random string for the CAPTCHA
$_SESSION["Captcha"] = "";
$string = "abcdefghijklmnopqrstuvwxyz0123456789";
for($i=0; $i<5; $i++) {
    $_SESSION["Captcha"] .= substr($string, rand(0, strlen($string)-1), 1);
}

// Create the image
$gbr = imagecreate(100, 30);
$bg_color = imagecolorallocate($gbr, 125, 125, 125);
$text_color = imagecolorallocate($gbr, 255, 255, 0);

// Add the random string to the image
imagestring($gbr, 5, 10, 10, $_SESSION["Captcha"], $text_color);

// Output the image
imagepng($gbr);
imagedestroy($gbr);
?>
