<?php
/**
 * Created by PhpStorm.
 * User: VEMEDYA
 * Date: 03.03.2016
 * Time: 14:12
 */

namespace AdminPanel;


class Pagelist extends  Settings {


      public function __construct($settings=null)
      {
          parent::__construct($settings);
      }


    public function Pagelist($param=array())
    {
        return $this->_inc('Pagelist',array('param'=>$param));
    }

    public function KategoriList($param=array())
    {
        return $this->_inc('KategoriList',array('param'=>$param));
    }

    public function Iconlist($param=array())
    {
        return $this->_inc('Iconlist',array('param'=>$param));
    }

    public function MaterialIconlist($param=array())
    {
        return $this->_inc('MaterialIconlist',array('param'=>$param));
    }

    public function KursPagelist($param=array())
    {
        return $this->_inc('KursPagelist',array('param'=>$param));
    }

    public function Tablist($param=array())
    {
        //return $this->_inc_module_settings("Tablist",array('param'=>$param));
        return $this->_inc("Tablist",array('param'=>$param));
    }

    public function TablistKariyer($param=array())
    {
        //return $this->_inc_module_settings("Tablist",array('param'=>$param));
        return $this->_inc("TablistKariyer",array('param'=>$param));
    }

    public function module_settings($module, $param=array())
    {
        return $this->_inc_module_settings($module,array('param'=>$param));
    }


    public function SiparisPagelist($param=array())
    {
        return $this->_inc('SiparisPagelist',array('param'=>$param));
    }

    public function DataTable($param=array())
    {
        return $this->_inc('DataTable',array('param'=>$param));
    }

    public function Dosyalist($param=array())
    {
        return $this->_inc('Dosyalist',array('param'=>$param));
    }

    public function Destekpagelist($param=array())
    {
        return $this->_inc('Destekpagelist',array('param'=>$param));
    }


    public function Fotolist($param=array())
    {
        return $this->_inc('Fotolist',array('param'=>$param));
    }

    public function yazdir($param=array())
    {
        return $this->_inc('yazdir',array('param'=>$param));
    }


}