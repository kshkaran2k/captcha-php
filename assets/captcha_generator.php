<?php

// This script is a part of @kshkaran2k/captcha-php (a php-based captcha generator).
// Be cautious while editing this file.

//worked only if requested from 127.0.0.1 to prevent unauthorized accesse
if($_SERVER['REMOTE_ADDR'] == '127.0.0.1'){


    // captcha configurations
    $captcha_len = 5; //defining the length of the captcha
    $font_width = 32; //define the font width
    $img_height = 30; //define the image height
    $img_width = $font_width*($captcha_len); //calculating the captcha image width


    $string = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefhijklmnopqrstuvwxyz1234567890'; //string for creating captcha
    $string_shuffled = str_shuffle($string); //shuffling the string
    $pos = strlen($string) - $captcha_len; //defining the end position till which the string can be consider
    $start_pos = rand(0,$pos); //defining the starting position
    $captcha = substr($string_shuffled,$start_pos,$captcha_len); //getting the captcha character

    // starting session as storing captcha in session
    session_start();
    $_SESSION['captcha'] = $captcha;

    $img = imagecreate($img_width, $img_height);
    $img_bgcolor = imagecolorallocate($img, 255, 255, 255); //setting the image background

    // looping to set different colour and font for the captcha
    for ($i=0; $i<$captcha_len; $i++){
        $font_color = imagecolorallocate($img, rand(0,200), rand(0,200), rand(0,200)); //not using 255 as font may becomes white
        $font_size = rand(3,12); //defining the font size of the captcha
        $x = $font_width * (0.5 + $i); //x value where the captcha letter is placed
        $y = 5; //y value where the captcha letter is placed
        imagestring($img, $font_size, $x, $y, $captcha[$i], $font_color);
    }

    $filename = $captcha.".png"; //the filename with which the captcha is saved
    imagepng($img,"captcha_img/".$filename);
    imagedestroy($img);

    header("Content-Type: application/json"); //setting the content type for response
    echo '{"result": "'.$filename.'"}'; //the output will be name of the captcha file
}
else
{
    // if not requested from local machine
    header("HTTP/1.1 401 Unauthorized");
}


?>
