<?php


namespace AdminPanel;


class Icons  extends Settings{


    public  $modulName = 'icons';




    public function __construct($settings)
    {
        parent::__construct($settings);
        $this->AuthCheck();

    }


    public function index($id)
    {

        $this->SayfaBaslik = 'Adminpanel Icon Listesi';
        $pagelist = new PageList($this->settings);
        return $pagelist->Iconlist(array());
        
    }

    public function material()
    {

        $this->SayfaBaslik = 'Adminpanel Icon Listesi';
        $pagelist = new PageList($this->settings);
        return $pagelist->MaterialIconlist(array());

    }






}