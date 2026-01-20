<?php


namespace AdminPanel;


class Anket  extends Settings{


    public  $modulName;
    public  $tablist;
    public  $modul_info;
    public $table;


    public function __construct($settings)
    {
        parent::__construct($settings);

        $this->AuthCheck();

        $this->table = "anket";

        $cmd = strtolower($this->getParameter()["modul"]);
        $this->modul_info = $this->dbConn->tekSorgu("SELECT * FROM moduller WHERE modul = '$cmd'");
        $this->modulName = $cmd;
        $this->tablist = array(
            array("title" => "Anket Sonuçları", "href" => "liste", "icon" => "mdi mdi-view-sequential"),
        );


    }


    public function index($id)
    {
        $function = $this->getParameter()["function"];
        if (empty($function)){
            header("Location:".$this->baseAdminURL($this->modulName."/liste"));
        }
    }


    public function settings($id=null)
    {
        $this->SayfaBaslik = "Modül Ayarları";

        $pagelist = new Pagelist($this->settings);
        $text = $pagelist->Tablist($this->tablist);
        if ($this->exits_module_settings($this->modulName))
            $text .= $this->_inc_module_settings($this->modulName, array("modul"=>$this->modulName));
        else
            $text .= "Ayar Dosyası Bulunamadı.";

        return $text;

    }


    public function help($id=null)
    {
        $this->SayfaBaslik = $this->modul_info["baslik"]." / Yardım";

        $pagelist = new Pagelist($this->settings);
        $text = $pagelist->Tablist($this->tablist);
        if ($this->exits_module_help($this->modulName))
            $text .= $this->_inc_module_help($this->modulName, array("modul"=>$this->modulName));
        else
            $text .= "Yardım Dosyası Bulunamadı.";

        return $text;

    }


    public function liste($id=null)
    {


        $sql = "SElECT * FROM anket_cevap ORDER BY id ASC";

        $this->SayfaBaslik = "Anket Sonuçları";

        $pagelist = new PageList($this->settings);

        $filterURL = "/?cmd=".$this->modulName."/".__FUNCTION__;
        $p = array(
            array('dataTitle'=>'tarih', 'class'=>'sort'),
        );

        $baslik = array(
            array("title"=>"Tarih", "width"=>'3%')
        );

        foreach ($this->dbConn->sorgu("SELECT * FROM anket ORDER BY id ASC") as $soru){
            $baslik[] = array('title'=>$soru["question_tr"],'width'=>'4%', "align"=>"center") ;
        }

        for ($i=1; $i<=6; $i++){
            $p[] = array('dataTitle'=>'question_'.$i, 'class'=>'sort');
        }



        $text = $pagelist->Tablist($this->tablist);

        $text .= $pagelist->PageList(array(
            //'flitpage' => array("url"=>$filterURL,"title"=>"Haber Kategorisi Seçiniz",'sql'=>"select * from haber_kategori",'option'=>array('value'=>'id','title'=>'baslik'), "name"=>"kategoriFilter", "class"=>"flit_filter"),
            'id'=>$id,
            'modul_id'=>$this->modul_info["id"],
            'modul_name'=>$this->modulName,
            'page'=>$this->table,
            "place"=>"kelime giriniz",
            //"showing"=>$showing,
            //'resim'=>true,
            //"toplamVeri"=>$toplamVeri,
            "disableSortable"=>true,

            'button' => array(
                array('title'=>'Excele Aktar '.'<img style="height:20px;margin-left:5px" src="'.$this->ThemeFile("assets/flags/tr.png").'">', 'icon'=>'fa fa-file-excel-o', 'href'=>$this->BaseAdminURL('Ajax/anketExcel&dil=tr'),"class"=>"btn btn-success "),
                array('title'=>'Excele Aktar '.'<img style="height:20px;margin-left:5px" src="'.$this->ThemeFile("assets/flags/en.png").'">', 'icon'=>'fa fa-file-excel-o', 'href'=>$this->BaseAdminURL('Ajax/anketExcel&dil=en'),"class"=>"btn btn-primary  mr-10"),
                array('title'=>'Excele Aktar '.'<img style="height:20px;margin-left:5px" src="'.$this->ThemeFile("assets/flags/ar.png").'">', 'icon'=>'fa fa-file-excel-o', 'href'=>$this->BaseAdminURL('Ajax/anketExcel&dil=ar'),"class"=>"btn btn-warning  mr-10")
            ),
            'p'=>$p,
            /*'tools' =>array(   array('title'=>'Düzenle','icon'=>'ti-pencil','url'=>$this->BaseAdminURL($this->modulName.'/ekle/'),'color'=>'btn-primary'),
                array("disable_delete"=>true,'title'=>'Sil','icon'=>'ti-close','url'=>$this->BaseAdminURL($this->modulName.'/sil/'),'color'=>'bg-maroon silButon')
            ),*/
            'buton'=> array(
                //array("disable_delete"=>true,'type'=>'button2','align'=>"center", 'title'=>'Ek Resimler','class'=>'btn bg-olive','dataname'=>'fotoekle','url'=>$this->BaseAdminURL('Resim/fotoekle/'), "data-icon"=>"ti-camera", "modul"=>$this->table),
                //array("disable_delete"=>true,'type'=>'button2','align'=>"center", 'title'=>'Dosya Yükle','class'=>'btn btn-dark','dataname'=>'dosyaekle','url'=>$this->BaseAdminURL('Dosyalar/ekle/'), "data-icon"=>"ti-file", "modul"=>$this->table),
                //array('type'=>'radio','dataname'=>'aktif','url'=>$this->BaseAdminURL($this->modulName.'/durum/')),
            ),

            'pdata' => $this->dbConn->sorgu($sql),
            'baslik'=>$baslik
        ));

        return $text;

    }



}