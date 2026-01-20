<?php
/**
 * Created by PhpStorm.
 * User: VEMEDYA
 * Date: 30.12.2016
 * Time: 14:25
 */

namespace Snowsoft\Captcha;


class Captcha
{
    protected static $Defaultsettings = [
        'min_length' => 5,
        'max_length' => 5,
        'characters' => 'ABCDEFGHJKLMNPRSTUVWXYZabcdefghjkmnprstuvwxyz23456789',
        'min_font_size' => 28,
        'max_font_size' => 28,
        'color' => '#666',
        'angle_min' => 0,
        'angle_max' => 10,
        'shadow' => true,
        'shadow_color' => '#fff',
        'shadow_offset_x' => -1,
        'shadow_offset_y' => 1
    ];

    protected  static $settings;

    public  static $bg_path = '';

    public  static $font_path = '';

    public static $custom_bg = [];

    public static $custom_font = '';


    public function __construct($settings=array())
    {
        if(!isset($_SESSION)) {
            session_start();
        }

        if( !function_exists('gd_info') ) {
            throw new \Exception('Required GD library is missing');
        }

      self::$settings  = $settings;
      self::$bg_path   = dirname(__FILE__) . '/media/backgrounds/';
      self::$font_path = dirname(__FILE__) . '/media/fonts/';

    }

    public static function backgrounds()
    {
      $defaultbg = array(
          '45-degree-fabric.png',
          'cloth-alike.png',
          'grey-sandbag.png',
          'kinda-jean.png',
          'polyester-lite.png',
          'stitched-wool.png',
          'white-carbon.png',
          'white-wave.png'
      );

      return (isset(self::$custom_bg) and count(self::$custom_bg)>0) ? self::$custom_bg : $defaultbg;

    }

    public static function fonts()
    {
        $defaultFont = array(
            'times_new_yorker.ttf'
        );

     return (isset(self::$custom_font) and self::$custom_font) ? self::$custom_font : $defaultFont;
    }

    protected static function config()
    {
        $captcha_config = self::$Defaultsettings;

        if( is_array(self::$settings) ) {
            foreach(self::$settings as $key => $value ) $captcha_config[$key] = $value;
        }
        // Restrict certain values
        $captcha_config['backgrounds'] = self::backgrounds();
        $captcha_config['fonts'] = self::fonts();
        if( $captcha_config['min_length'] < 1 ) $captcha_config['min_length'] = 1;
        if( $captcha_config['angle_min'] < 0 ) $captcha_config['angle_min'] = 0;
        if( $captcha_config['angle_max'] > 10 ) $captcha_config['angle_max'] = 10;
        if( $captcha_config['angle_max'] < $captcha_config['angle_min'] ) $captcha_config['angle_max'] = $captcha_config['angle_min'];
        if( $captcha_config['min_font_size'] < 10 ) $captcha_config['min_font_size'] = 10;
        if( $captcha_config['max_font_size'] < $captcha_config['min_font_size'] ) $captcha_config['max_font_size'] = $captcha_config['min_font_size'];

        return $captcha_config;
    }


    public static function Create()
    {
        $captcha_config = self::config();

        if( empty($captcha_config['code']) ) {
            $captcha_config['code'] = '';
            $length = mt_rand($captcha_config['min_length'], $captcha_config['max_length']);
            while( strlen($captcha_config['code']) < $length ) {
                $captcha_config['code'] .= substr($captcha_config['characters'], mt_rand() % (strlen($captcha_config['characters'])), 1);
            }
        }

        // Generate HTML for image src
        if ( strpos($_SERVER['SCRIPT_FILENAME'], $_SERVER['DOCUMENT_ROOT']) ) {
            $image_src = substr(__FILE__, strlen( realpath($_SERVER['DOCUMENT_ROOT']) )) . '?_CAPTCHA&amp;t=' . urlencode(microtime());
            $image_src = '/' . ltrim(preg_replace('/\\\\/', '/', $image_src), '/');
        } else {
            $_SERVER['WEB_ROOT'] = str_replace($_SERVER['SCRIPT_NAME'], '', $_SERVER['SCRIPT_FILENAME']);
            $image_src = substr(__FILE__, strlen( realpath($_SERVER['WEB_ROOT']) )) . '?_CAPTCHA&amp;t=' . urlencode(microtime());
            $image_src = '/' . ltrim(preg_replace('/\\\\/', '/', $image_src), '/');
        }

        $_SESSION['_CAPTCHA']['config'] = serialize($captcha_config);



        return array(
            'code' => $captcha_config['code'],
            'image_src' => self::setImage()
        );

    }


      protected static function hex2rgb($hex_str, $return_string = false, $separator = ',') {
            $hex_str = preg_replace("/[^0-9A-Fa-f]/", '', $hex_str); // Gets a proper hex string
            $rgb_array = array();
            if( strlen($hex_str) == 6 ) {
                $color_val = hexdec($hex_str);
                $rgb_array['r'] = 0xFF & ($color_val >> 0x10);
                $rgb_array['g'] = 0xFF & ($color_val >> 0x8);
                $rgb_array['b'] = 0xFF & $color_val;
            } elseif( strlen($hex_str) == 3 ) {
          $rgb_array['r'] = hexdec(str_repeat(substr($hex_str, 0, 1), 2));
          $rgb_array['g'] = hexdec(str_repeat(substr($hex_str, 1, 1), 2));
          $rgb_array['b'] = hexdec(str_repeat(substr($hex_str, 2, 1), 2));
          } else {
              return false;
          }
          return $return_string ? implode($separator, $rgb_array) : $rgb_array;
          }


          public static  function setImage()
          {
                 if(isset($_SESSION['_CAPTCHA'])):
                  $captcha_config = unserialize($_SESSION['_CAPTCHA']['config']);
                  if(isset($captcha_config) and  !$captcha_config ) exit();

                  unset($_SESSION['_CAPTCHA']);

                  // Pick random background, get info, and start captcha
                  $background = $captcha_config['backgrounds'][mt_rand(0, count($captcha_config['backgrounds']) -1)];
                  list($bg_width, $bg_height) = getimagesize(self::$bg_path.$background);

                  $captcha = imagecreatefrompng(self::$bg_path.$background);

                  $color = self::hex2rgb($captcha_config['color']);
                  $color = imagecolorallocate($captcha, $color['r'], $color['g'], $color['b']);

                  // Determine text angle
                  $angle = mt_rand( $captcha_config['angle_min'], $captcha_config['angle_max'] ) * (mt_rand(0, 1) == 1 ? -1 : 1);

                  // Select font randomly
                  $font = $captcha_config['fonts'][mt_rand(0, count($captcha_config['fonts']) - 1)];

                  // Verify font file exists
                  if( !file_exists(self::$font_path.$font) ) throw new \Exception('Font file not found: ' . $font);

                  //Set the font size.
                  $font_size = mt_rand($captcha_config['min_font_size'], $captcha_config['max_font_size']);
                  $text_box_size = imagettfbbox($font_size, $angle, self::$font_path.$font, $captcha_config['code']);

                  // Determine text position
                  $box_width = abs($text_box_size[6] - $text_box_size[2]);
                  $box_height = abs($text_box_size[5] - $text_box_size[1]);
                  $text_pos_x_min = 0;
                  $text_pos_x_max = ($bg_width) - ($box_width);
                  $text_pos_x = mt_rand($text_pos_x_min, $text_pos_x_max);
                  $text_pos_y_min = $box_height;
                  $text_pos_y_max = ($bg_height) - ($box_height / 2);
                  if ($text_pos_y_min > $text_pos_y_max) {
                      $temp_text_pos_y = $text_pos_y_min;
                      $text_pos_y_min = $text_pos_y_max;
                      $text_pos_y_max = $temp_text_pos_y;
                  }
                  $text_pos_y = mt_rand($text_pos_y_min, $text_pos_y_max);

                  // Draw shadow
                  if( $captcha_config['shadow'] ){
                      $shadow_color = self::hex2rgb($captcha_config['shadow_color']);
                      $shadow_color = imagecolorallocate($captcha, $shadow_color['r'], $shadow_color['g'], $shadow_color['b']);
                      imagettftext($captcha, $font_size, $angle, $text_pos_x + $captcha_config['shadow_offset_x'], $text_pos_y + $captcha_config['shadow_offset_y'], $shadow_color, self::$font_path.$font, $captcha_config['code']);
                  }

                  // Draw text
                  imagettftext($captcha, $font_size, $angle, $text_pos_x, $text_pos_y, $color, self::$font_path.$font, $captcha_config['code']);

                  imagefilter($captcha, IMG_FILTER_PIXELATE, 1, true);
                  imagefilter($captcha, IMG_FILTER_MEAN_REMOVAL);

                  // Output image
                //  header("Content-type: image/png");
                  ob_start(); // Let's start output buffering.
                  imagepng($captcha);

                  $imagedata = ob_get_contents();
                  // Clear the output buffer
                  ob_end_clean();

                  return 'data:image/png;base64,'.base64_encode($imagedata);
                  endif;

          }


}