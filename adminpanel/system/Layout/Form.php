<?php
/**
 * Created by PhpStorm.
 * User: VEMEDYA
 * Date: 02.03.2016
 * Time: 18:44
 */

namespace AdminPanel;




class Form  extends Settings{

    public $settings;
    public $baseURL;

    public function __construct($settings)
    {
        parent::__construct($settings);
      $this->settings = $settings;

      $this->baseURL = $this->BaseURL();
    }
	
	 public function hidden($param=array())
   {
       return self::_inc('Form/input',$param);
   }

   public function slayt($param=array())
   {
       return self::_inc('Form/slayt',$param);
   }

    public function selectmulti($a=array())
    {
       return self::_inc('Form/selectmulti',$a);
    }

    public function harita($param = array())
    {
        return self::_inc('Form/harita',$param);
    }

   public function input($param=array())
   {
       return self::_inc('Form/input',$param);
   }

    public function tags($param=array())
    {
        return self::_inc('Form/tags',$param);
    }

    public function inputOzellik($param=array())
    {
        return self::_inc('Form/ozellik',$param);
    }


   public function color($param=array())
   {
       return self::_inc('Form/color',$param);
   }

    public function date($param=array())
    {
        return self::_inc('Form/date',$param);
    }
    public function link($param=array())
    {
        $param['type'] = 'link';
        return self::_inc('Form/input',$param);
    }

    public function fiyatekle($param=array())
    {
        return self::_inc('Form/fiyatekle',$param);
    }

    public function textarea($param=array())
    {
        return self::_inc('Form/textarea',$param);
    }


    public  function checkbox($param=array())
    {
        $param['type'] = 'checkbox';
        return self::_inc('Form/checkbox',$param);
    }


    public  function radio($param=array())
    {
        $param['type'] = 'radio';
        return self::_inc('Form/radio',$param);
    }


    public  function select($param=array())
    {
       return self::_inc('Form/select',$param);
    }

    public  function filter($param=array())
    {
        return self::_inc('Form/filter',$param);
    }

    public  function select2($param=array())
    {
       return self::_inc('Form/select2',$param);
    }

    public  function selectAjax($param=array())
    {
        return self::_inc('Form/selectAjax',$param);
    }


    public function  textEditor($param=array())
    {
        return self::_inc('Form/textEditor', $param);
    }

    public  function file($param=array())
    {
        return self::_inc('Form/file',$param);
    }

    public  function file2($param=array())
    {
        return self::_inc('Form/file2_',$param);
    }

    public   function submitButton($param=array())
   {
       return self::_inc('Form/submit',$param);
   }

    public function imageUpload($param=array())
    {
      //  return self::_inc('Form/imageUpload',$param);
    }

    public function formOpen($param=array())
    {
        return self::_inc('Form/FormOpen',$param);
    }

    public function formClose($param=array())
    {
        return self::_inc('Form/FormClose',$param);
    }

    public function openColumn($width)
    {
        return "<div class='col-sm-".$width."'>";
    }


    public function openBox($class=""){
        return "<div class='box $class'>";
    }

    public function openBoxBody($class=""){
        return "<div class='box-body $class'>";
    }


    public function closeBox(){
        return "</div>";
    }

    public  function closeBoxBody(){
        return "</div>";
    }

    public function closeDiv(){
        return "</div>";
    }

    public function openRow(){
        return "<div class='row'>";
    }

    public function closeRow(){
        return "</div>";
    }



    //$sql,$id,$ek,$kat,

    /**
     * @param array $param
     * @param $ek
     * @param $id
     * @return string
     */
    public  function parent($param=array(), $ek, $id)
    {

        //echo $param['selected'];

        $text ='';


        if(isset($param['sql'])):
            $selected = (isset($param['selected'])) ? $param['selected']:null;
            //$param['sql']." where $kat = '$id'";
            $kid = ((isset($param['kat']) and $param['kat']) ?  $kid= $param['kat']."='$id'":null);
            $data =  $this->dbConn->sorgu($param['sql'].$kid);
            if(is_array($data))
                foreach($data as $dt):
                    $text .= '<option value="'.$dt[$param['option']['value']].'" '.((is_array($selected)) ?((in_array($dt[$param['option']['value']],$selected)) ? 'selected="selected"':null):(($dt[$param['option']['value']]==$selected) ? 'selected="selected"':null ) ).'>'.str_repeat('- ',$ek).$dt[$param['option']['title']].(isset($param["option"]["ek"]) ? " - ". $dt[$param["option"]["ek"]] : '').'</option>';
                    if(isset($param['kat']) and $param['kat'])    $text .=  $this->parent($param,$ek+1,$dt['id']);
                endforeach;
        endif;


        if(isset($param['array']) and is_array($param['array'])):
            if (isset($param["multiple"]) && $param["multiple"]){
                $select = (isset($param["selected"])) ? json_decode($param["selected"],JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES):0;
            }

            foreach ($param['array'] as $item):
                if (isset($param["multiple"]) && $param["multiple"]){
                    $text .= '<option value="'.$item[$param['option']['value']].'" '.((isset($select) && is_array($select)) ?((in_array($item[$param['option']['value']], $select)) ? 'selected="selected"':null):null).'>'.$item[$param['option']['title']].'</option>';
                }else {
                    $text .= '<option value="'.$item[$param['option']['value']].'" '.((isset($param['selected'])) ?(($item[$param['option']['value']] == $param['selected']) ? 'selected="selected"':null):null).'>'.$item[$param['option']['title']].'</option>';
                }

            endforeach;

        endif;


        return $text;
    }


    public  function urunMarkaFilter($param=array(), $ek, $id)
    {

        // echo $param['selected'];

        $text ='';

        if(isset($param['sql'])):
                $selected = (isset($param['selected'])) ? json_decode($param['selected'],JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES):0;
            //$param['sql']." where $kat = '$id'";

            $kid = ((isset($param['kat']) and $param['kat']) ?  $kid= $param['kat']."='$id'":null);
            $data =  $this->dbConn->sorgu($param['sql'].$kid);
            $markalar = $this->dbConn->sorgu("SELECT * FROM markalar");
            if (is_array($markalar)) {
                foreach ($markalar as $marka) {
                    $text.= "<optgroup label='".$marka["baslik"]."'>";
                        $kat = $this->dbConn->sorgu("SELECT * FROM kategoriler WHERE marka = ".$marka["id"]);
                        if (is_array($kat)){
                            foreach ($kat as $veri) {
                                $text .= '<option value="'.$veri["id"].'"'.(($veri["id"] == $selected) ? 'selected' : '').'>'.(($veri["ustu"] != 0) ? '- ': '').$veri["kategori"].'</option>';
                                
                            }
                        }
                    $text.= "</optgroup>";
                }
            }

        endif;
        if(isset($param['array']) and is_array($param['array'])):

            foreach ($param['array'] as $item):
                $text .= '<option value="'.$item[$param['option']['value']].'" '.((isset($param['selected'])) ?(($item[$param['option']['value']] == $param['selected']) ? 'selected="selected"':null):null).'>'.$item[$param['option']['title']].'</option>';
            endforeach;


        endif;


        return $text;
    }


    public  function kategoriFilter($param=array(), $ek, $id)
    {

        // echo $param['selected'];

        $text ='';

        if(isset($param['sql'])):
            $selected = (isset($param['selected'])) ? json_decode($param['selected'],JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES):0;
            //$param['sql']." where $kat = '$id'";

            $kid = ((isset($param['kat']) and $param['kat']) ?  $kid= $param['kat']."='$id'":null);
            $data =  $this->dbConn->sorgu($param['sql'].$kid);
            $markalar = $this->dbConn->sorgu("SELECT * FROM kategoriler WHERE ustu = 0");
            if (is_array($markalar)) {
                foreach ($markalar as $marka) {
                    $text.= "<optgroup label='".$marka["baslik"]."'>";
                    $kat = $this->dbConn->sorgu("SELECT * FROM kategoriler WHERE ustu = ".$marka["id"]);
                    if (is_array($kat)){
                        foreach ($kat as $veri) {
                            $text .= '<option value="'.$veri["id"].'"'.(($veri["id"] == $selected) ? 'selected' : '').'>'.$veri["baslik"].'</option>';
                        }
                    }
                    $text.= "</optgroup>";
                }
            }

        endif;
        if(isset($param['array']) and is_array($param['array'])):

            foreach ($param['array'] as $item):
                $text .= '<option value="'.$item[$param['option']['value']].'" '.((isset($param['selected'])) ?(($item[$param['option']['value']] == $param['selected']) ? 'selected="selected"':null):null).'>'.$item[$param['option']['title']].'</option>';
            endforeach;


        endif;


        return $text;
    }

/*
    public function _inc($file,$data=null)
    {

        $data = array_merge($data);
        if($data) extract($data);
        if($file and file_exists('theme/'.$this->settings->config('adminTheme').'/layout/Form/'.$file.'.php')):
            ob_start();
            include 'theme/'.$this->settings->config('adminTheme').'/layout/Form/'.$file.'.php';
            return ob_get_clean();
        else:
            if($file and file_exists('theme/admin/layout/Form/'.$file.'.php')):
                ob_start();
                include 'theme/admin/layout/Form/'.$file.'.php';
                return ob_get_clean();
            else:
                return null;
            endif;
        endif;

    }

*/
} 