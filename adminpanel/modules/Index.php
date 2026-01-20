<?php
/**
 * Created by PhpStorm.
 * User: VEMEDYA
 * Date: 03.03.2016
 * Time: 12:45
 */

namespace AdminPanel;


class Index extends Settings {

    public $SayfaBaslik = 'Anasayfa';

    public function __construct($settings)
    {
        parent::__construct($settings);
        $this->AuthCheck();

    }


    public function index()
    {

        $yetkiler = json_decode($this->getUserInfo("yetkiler"));
        $tur = $this->getUserInfo("tur");
        if ($tur != 1) {
            $first = implode("," ,$yetkiler);
            $modul = $this->dbConn->tekSorgu("SELECT * FROM moduller WHERE id IN ($first) ORDER BY sira ASC");
            $this->redirectURL($this->BaseAdminURL($modul["modul"]));
        }
        else {
            $modul = $this->dbConn->tekSorgu("SELECT * FROM moduller WHERE aktif = 1 ORDER BY sira ASC");
            $this->redirectURL($this->BaseAdminURL($modul["modul"]));
        }


    }




} 