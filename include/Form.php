<?php

/**
 * Created by PhpStorm.
 * User: Abdulkadir
 * Date: 20.11.2016
 * Time: 00:50
 */
class Form 
{

    public static $Default = ['labelClass'=>'col-md-3','divClass'=>'col-md-9','div'=>false];


    public function __construct($param)
    {

    }

    public static function Open($data=array())
    {

        if(isset($data['token']) and $data['token'])
        {
            $token = md5(uniqid(rand(), TRUE));
            $_SESSION[((isset($data['name'])) ? $data['name'].'_':null).'token'] = $token;
            $_SESSION[((isset($data['name'])) ? $data['name'].'_':null).'token_time'] = time();
            setcookie(((isset($data['name'])) ? $data['name'].'_':null).'token', $token, time() + (86400 * 30), "/");
            setcookie(((isset($data['name'])) ? $data['name'].'_':null).'token_time', time(), time() + (86400 * 30), "/");
            $data['token_value'] =  $token;
        }

        if (isset($data["message"]) and is_array($data["message"])){
            $data["hidden_msg"] = "";
            foreach ($data["message"] as $key=>$item){
                $data["hidden_msg"].="<input type='hidden' class='mesaj".$item["no"]."' data-mesaj='".$item["title"]."' data-durum='".$item["status"]."'>";
            }
        }



        echo self::inc('Form/formOpen',$data);

    }


    public static function Input($name='',$data=array())
    {

        $data['name'] = $name;
        echo self::inc('Form/input',$data);
    }

    public static function Textarea($name='',$data=array())
    {

        $data['name'] = $name;
        echo self::inc('Form/textarea',$data);
    }

    public static function openRow()
    {

        echo "<div class='row'>";
    }

    public static function openColumn($col)
    {

        echo "<div class='".$col."'>";
    }

    public static function closeColumn()
    {

        echo "</div>";
    }

    public static function closeRow()
    {

        echo "</div>";
    }


    public static function openDiv($param = array())
    {

        $text = "<div ";
        if (isset($param["class"])){
            $text.= ' class="'.$param["class"].'" ';
        }
        if (isset($param["id"])){
            $text.= ' id="'.$param["id"].'" ';
        }
        if (isset($param["style"])){
            $text.= ' style="'.$param["style"].'" ';
        }

        if (isset($param["attr"]) && is_array($param["attr"])){
            foreach ($param["attr"] as $key=>$item){
                echo $key."='".$item."'";
            }
        }
        $text.=">";

        echo $text;
    }


    public static function closeDiv()
    {

        echo "</div>";
    }

    public static function File($name="", $data = array())
    {
        $data['name'] = $name;
        echo self::inc('Form/file',$data);
    }

    public static function checkbox($name='',$data=array())
    {

        $data['name'] = $name;
        echo self::inc('Form/checkbox',$data);
    }

    public static function Hidden($name=null,$data=array())
    {
        $data['name'] = $name;
        $data['type'] = 'hidden';
        echo self::inc('Form/input',$data);
    }
    public static function Email($name=null,$data=array())
    {
        $data['name'] = $name;
        $data['type'] = 'email';
        echo self::inc('Form/input',$data);
    }
    public static function Text($name=null,$data=array())
    {
        $data['name'] = $name;
        if (!isset($data["type"])){
            $data['type'] = 'text';
        }
        echo self::inc('Form/input',$data);
    }

    public static function Color($name=null,$data=array())
    {
        $data['name'] = $name;
        echo self::inc('Form/color',$data);
    }

    public static function Password($name=null,$data=array())
    {
        $data['name'] = $name;
        $data['type'] = 'password';
        echo self::inc('Form/input',$data);
    }

    public static function Button($data=array())
    {
        echo self::inc('Form/button',$data);
    }

    public static function Label($title, $info=null, $class=null)
    {
        echo "<div class='col-md-12'><label class='".$class."'>".$title;
        if (!empty($info) && !is_array($info)){
            echo '<i class="badge badge-dark" data-toggle="tooltip" data-placement="top" title="'.$info.'">i</i>';
        }
        echo "</label></div>";
    }


    public static function Captcha($key=null)
    {
        if(!is_array($key))
            $data['key'] = $key;
        else
            $data = $key;
        echo self::inc('Form/captcha',$data);
    }

    public static function Select($name=null,$data=array()){
        $data['name'] = $name;
        echo self::inc('Form/select',$data);
    }
    public static function Helper($data=array()) {  echo self::inc('Form/helper',$data);}
    public static function Close(){
        echo "</form>";
    }

    public  static  function inc($file,$data=array())
    {
        $data = array_merge(Form::$Default,$data);
        if($file and file_exists(__DIR__.'/'.$file.'.php')):
            ob_start();
            if($data) extract($data);
            include(__DIR__.'/'.$file.'.php');
            return ob_get_clean();
        else:
            return null;
        endif;
    }


}