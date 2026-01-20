<?php


namespace AdminPanel;


class Sirala extends Settings
{

    public $settings;
    public $SayfaBaslik = 'Sıralama';

    public function __construct($settings)
    {
        parent::__construct($settings);
        $this->settings = $settings;
    }

    public function index()
    {
        return 'Sıralama';
    }


    public  function VeriSirala()
    {
        $sirala = (isset($_GET['sirala'])) ? $_GET['sirala']:0;
        $table = (isset($_GET['table'])) ? $_GET['table']:"";
        $reload = (isset($_GET['reload'])) ? $_GET['reload']:"";

        if($this->sirala($sirala,$table)){
            if ($reload == "undefined"){
                echo "Sıralama İşlemi Başarılı";
            }else {
                $this->setPanelMessage("success", "Sıralama İşlemi Başarılı");
            }

        }
    }



} 