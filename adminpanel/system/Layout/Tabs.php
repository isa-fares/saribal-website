<?php
/**
 * Created by PhpStorm.
 * User: VEMEDYA
 * Date: 6.10.2016
 * Time: 17:07
 */

namespace AdminPanel;


class Tabs extends Settings{

    public $tabs = array();
    public $totalLanguage;

    public function __construct($settings,$tablist=null)
    {
        parent::__construct($settings);
        $this->tabs = $tablist;
        $this->totalLanguage = count($this->settings->lang('lang'));
    }


    public function tabBaslik()
    {

        if ($this->totalLanguage > 1){
            $text = '  <ul class="nav nav-tabs">';
            foreach ($this->settings->lang('lang') as $dil=>$title):

            $text .=' <li ><a class="'.(($this->settings->lang()['defaultLang']==$dil) ? 'active':null).'" href="#'.$dil.'" data-toggle="tab" aria-expanded="true"><img src="'.$this->ThemeFile().'/assets/flags/'.$dil.'.png" width="25px" style="margin-right:10px;">'.$title.'</a></li>';
            endforeach;
            $text .='</ul>';
            return $text;
        }
    }

    public function tabBaslikArray()
    {
        $x = 0;
        if(is_array($this->tabs) && count($this->tabs) > 1){


        $text = '  <ul class="nav nav-tabs">';

        foreach ($this->tabs as $name=>$title):
            $x++;

            $text .=' <li><a  class="'.(($x==1) ? 'active':'').'" href="#'.$name.'" data-toggle="tab" aria-expanded="true">'.$title.'</a></li>';
        endforeach;
        $text .='</ul>';
        }
        return $text;
    }



    public  function tabContent($content=array())
    {



        $text ='<div class="nav-tabs-custom">
                '.$this->tabBaslik().'
                 <div class="tab-content">';

        foreach ($this->settings->lang('lang') as $dil=>$title):
         $text .='<div class="tab-pane '.(($this->settings->lang('defaultLang')==$dil) ? 'active':null).'" id="'.$dil.'">';
         $text .= $content[$dil]['text'];
         $text .='</div>';
        endforeach;

        $text.='</div></div>';


        return $text;
    }


    public  function tabContentArray($content=array(), $class = "")
    {
        $x = 0;
        $text = '<div class="nav-tabs-custom '.$class.' ">
                '. $this->tabBaslikArray().'
                 <div class="tab-content">';
        if(is_array($this->tabs))
        foreach ($this->tabs as $name=>$title):
            $x++;
            $text .='<div class="tab-pane '.(($x==1) ? 'active':'').'" id="'.$name.'">';
            $text .= $content[$name]['text'];
            $text .='</div>';


        endforeach;


        $text.='</div></div>';


        return $text;
    }



    public  function tabData($sql,$id)
    {
        $data = array();
        $data['tr'] = $this->dbConn->tekSorgu("select * from $sql where id='$id'");
        foreach ($this->settings->lang('lang') as $dil=>$title):
            if($dil!='tr') {
                $data[$dil] = $this->dbConn->tekSorgu("select * from ".$sql."_lang where dil='$dil' and master_id='$id' limit 1");
            }
        endforeach;

        return $data;
    }










}