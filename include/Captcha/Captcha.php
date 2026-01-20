<?php
/**
 * @var $this FrontClass|Loader object
 * @var $lang string
 * @var $assetURL string
 * @var $page string
 */

class Captcha
{

    function getCaptchaCode($length)
    {
        $random_alpha = md5(random_bytes(64));
        $captcha_code = substr($random_alpha, 0, $length);
        return $captcha_code;
    }
    
    function setSession($key, $value) {
        $_SESSION["$key"] = $value;
    }
    
    function getSession($key) {
        if(session_id() === "") session_start();
        $value = "";
        if(!empty($key) && !empty($_SESSION["$key"]))
        {            
            $value = $_SESSION["$key"];
        }
        return $value;
    }

    function createCaptchaImage($captcha_code)
    {
        $image_width = 90;
        $image_height = 42;
        $font_size = 18;
        $font =  __DIR__.'/fonts/StayPuft.ttf';
        $target_layer = imagecreatetruecolor($image_width, $image_height);
        $captcha_background = imagecolorallocate($target_layer, 232, 232, 232);
        imagefill($target_layer,0,0,$captcha_background);
        $captcha_text_color = imagecolorallocate($target_layer, 213, 35, 57);
        $text_box = imagettfbbox($font_size,0,$font,$captcha_code);
        $text_width = $text_box[2]-$text_box[0];
        $text_height = $text_box[7]-$text_box[1];
        $x = ($image_width/2) - ($text_width/2);
        $y = ($image_height/2) - ($text_height/2);
        imagettftext($target_layer, $font_size, 0, $x, $y, $captcha_text_color, $font, $captcha_code);
        return $target_layer;
    }

    function renderCaptchaImage($imageData)
    {
        header("Content-type: image/jpeg");
        imagejpeg($imageData, null, 100);
        imagedestroy($imageData);
    }
    
    function validateCaptcha($formData) {
        $isValid = false;
        $capchaSessionData = $this-> getSession("captcha_code");
        
        if($capchaSessionData == $formData) 
        {
            $isValid = true;
        }
        return $isValid;
    }
}