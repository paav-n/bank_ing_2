<?php

session_start();
header ('Content-Type:image/png');
$font = "LaBelleAurore.ttf";

$im = imagecreatetruecolor (180, 100);

$grey = imagecolorallocate ($im, 215, 215, 215);
$orange = imagecolorallocate ($im, 255, 130, 0);
$black = imagecolorallocate ($im, 255, 255, 255);

imagefilledrectangle($im, 3, 3, 155, 100, $grey);
$length = 8;
$text1 = substr(str_shuffle(md5(time())), 0, $length);
$text2 = substr(str_shuffle(md5(time())), 0, $length);
$text = $text1.$text2;
$_SESSION["captcha"]=$text;

imagettftext($im, 20, 14, 40, 70, $orange, $font, $text1);
imagettftext($im, 20, 30, 80, 100, $black, $font, $text2);

imagepng($im);

imagedestroy($im);

?>