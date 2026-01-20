<?php
/**
 * Created by PhpStorm.
 * User: VEMEDYA
 * Date: 19.05.2016
 * Time: 17:18
 */

namespace AdminPanel;


class Widget extends  Settings
{
    public  $sidebar;
    public   $settings;

    public  function __construct($settings)
    {

        parent::__construct($settings);


        $this->settings = $settings;

    }


    public function bulten($data,$id)
    {
        return $this->_inc('Modal/bulten',array_merge(array('data'=>$data,'id'=>$id)));
    }

    public function userDetay($user_id, $id)
    {
        return $this->_inc('Modal/userDetay',array_merge(array('user_id'=>$user_id, "id"=>$id)));
    }



    public function errorDetail($data, $id, $param)
    {
        return $this->_inc('Modal/errorDetail',array_merge(array('data'=>$data, "id"=>$id, "param"=>$param)));
    }


    public function modal($data,$id,$title)
    {
        return $this->_inc('Modal/modal',array_merge(array('data'=>$data,'id'=>$id, "title"=>$title)));
    }

    public function KariyerModal($id)
    {
        return $this->_inc('Modal/KariyerModal',array_merge(array('id'=>$id)));
    }


    public function userModal($data,$id,$title)
    {
        return $this->_inc('Modal/userModal',array_merge(array('data'=>$data,'id'=>$id, "title"=>$title)));
    }


    public function siparis($data,$id)
    {
        return $this->_inc('Modal/siparis',array_merge(array('data'=>$data,'id'=>$id)));
    }


    public function yorum($data,$id)
    {
        return $this->_inc('Modal/yorum',array_merge(array('data'=>$data,'id'=>$id)));
    }

    public function fileLoad($data)
    {
        return $this->_inc('Modal/fileupload',$data);
    }


    public function teknik($id)
    {
        return $this->_inc('Modal/teknik',array('id'=>$id));
    }


    public function infoBox($data)
    {
        return $this->_inc('Modal/infobox',$data);
    }

    public function smalbox($data)
    {
        return $this->_inc('Modal/smalbox',$data);
    }


    public function report($data)
    {
        return $this->_inc('Modal/report',$data);
    }

    public function infoform($data)
    {
        return $this->_inc('Modal/infoform',$data);
    }

} 