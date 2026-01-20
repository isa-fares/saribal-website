<?php


namespace AdminPanel;


class Kariyer  extends Settings{


    public  $modulName;
    private $table;
    private $tablelang;
    public  $tablist;
    public  $modul_info;
    private  $css = ["jquery_datatable/css/datatables.min.css", "jquery_datatable/css/buttons.bootstrap4.min.css"];
    private  $js = [
        "jquery_datatable/js/datatables.js",
        /*        "jquery_datatable/js/dataTables.buttons.js",
                "jquery_datatable/js/buttons.bootstrap4.js",
                "jquery_datatable/js/buttons.html5.min.js",
                "jquery_datatable/js/jszip.min.js",
                "jquery_datatable/js/pdfmake.min.js",
                "jquery_datatable/js/vfs_fonts.js",*/

    ];
    private $SayfaBaslik;


    public function __construct($settings)
    {
        parent::__construct($settings);

        $this->AuthCheck();

        $cmd = strtolower($this->getParameter()["modul"]);
        $this->modul_info = $this->dbConn->tekSorgu("SELECT * FROM moduller WHERE modul = '$cmd'");

        $this->modulName = $cmd;
        $this->table = $this->modulName;
        $this->tablelang = $this->modulName."_lang";
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

        $archive = (isset($_GET["archive"])) ? $_GET["archive"] : 0;

        $this->SayfaBaslik = $this->modul_info["baslik"];
        $pagelist = new PageList($this->settings);
        $text = $pagelist->TablistKariyer($this->tablist);
        $columns = array(
            ["title"=>"Id", "value"=>"id", "search"=>"textbox", "orderable"=>false], // Tablo sütun başlığı, tablodaki sütun adı
            ["title"=>"Adı Soyadı","value"=>"adi_soyadi", "search"=>"textbox", "orderable"=>false],
            ["title"=>"Cinsiyet", "orderable"=>false, "value"=>"cinsiyet", "search"=>"selectMenu", "selectMenuData"=>
                array(
                    ["title"=>"Bay", "value"=>"Bay"],
                    ["title"=>"Bayan", "value"=>"Bayan"],
                )
            ],
            ["title"=>"Engellilik Oranı","value"=>"engellilik", "search"=>"textbox", "orderable"=>false],
            ["title"=>"Meslek", "value"=>"meslek", "search"=>"textbox", "orderable"=>false],
            //["title"=>"Başvuru Tarihi", "value"=>"basvuru_tarihi", "search"=>"date", "orderable"=>false],
            ["title"=>"Tahsil", "orderable"=>false,  "value"=>"tahsil", "search"=>"selectMenu", "selectMenuData"=>
                array(
                    ["title"=>"İlköğretim", "value"=>"İlköğretim"],
                    ["title"=>"Lise", "value"=>"Lise"],
                    ["title"=>"Ön Lisans", "value"=>"Ön Lisans"],
                    ["title"=>"Lisans", "value"=>"Lisans"],
                )
            ],
            //["title"=>"Bölüm","value"=>"istenen_bolum", "search"=>"textbox", "orderable"=>false],
            /* ["title"=>"Çalışmak İstenen Yer", "orderable"=>false, "value"=>"calismak_istenen_yer", "search"=>"selectMenu", "selectMenuMysql"=>
                 array(
                     "table"=>"sube",
                     "settings"=>array("title"=>"baslik", "value"=>"id"),
                     "append"=>array(
                         array("title"=>"Herhangi Birisi Olabilir", "value"=>"1001")
                     ),
                 )
             ],*/
            ["title"=>"Durum", "orderable"=>false, "value"=>"durum", "search"=>"selectMenu", "selectMenuData"=>
                array(
                    ["title"=>"İşlem Yapılmadı", "value"=>"0"],
                    ["title"=>"Onaylandı", "value"=>"1"],
                    ["title"=>"Olumlu", "value"=>"2"],
                    ["title"=>"Olumsuz", "value"=>"3"],
                    ["title"=>"Reddedildi", "value"=>"4"],
                )
            ],
        );

        //$archiveButtonTitle = ($archive == 1) ? "Arşivden Çıkar" : "Arşive Ekle";
        //$archiveButtonClass = ($archive == 1) ? " btn-success" : " bg-blue";
        $tools = array(
            array('title'=>'Gözat','icon'=>'fa fa-info','url'=>$this->BaseAdminURL('AjaxPage/detail/'),'class'=>'btn btn-sm btn-primary KariyerModalDetail'),
            //array('title'=>$archiveButtonTitle,'icon'=>'fa fa-archive','url'=>$this->BaseAdminURL('AjaxPage/archive/'),'class'=>'btn btn-sm ml-1 AddArchive '.$archiveButtonClass),
            array('title'=>'Sil','icon'=>'ti-close','url'=>$this->BaseAdminURL('AjaxPage/sil/'),'class'=>'btn btn-sm  bg-maroon deletePerson ml-1'),
        );

        $text.= $pagelist->DataTable(array(
            "modul"=>$this->modulName,
            'modul_id'=>$this->modul_info["id"],
            "columns"=>$columns,
            "tools"=>$tools,
            "archive"=>$archive
        ));

        $modal = new Widget($this->settings);
        $text .=  $modal->KariyerModal('KariyerModal');

        return $text;

    }



    public function yazdir($id=null)
    {
        $al = $this->dbConn->teksorgu("select * from $this->table WHERE id = $id");
        echo "<script>document.title = '".$this->temizle($al["adi_soyadi"])." - ".$this->temizle($al["tc_kimlik"])."'</script>";
        $pagelist = new Pagelist($this->settings);
        $data = $this->dbConn->tekSorgu("select * from $this->table WHERE id = $id");
        if (isset($data["calismak_istenen_yer"])) {
            if ($data["calismak_istenen_yer"] == 1001) {
                $data["calismak_istenen_yer"] = "Herhangi birisi olabilir";
            } else {
                $sube_id = $data["calismak_istenen_yer"];
                $data["calismak_istenen_yer"] = $this->temizle($this->dbConn->tekSorgu("SELECT * FROM sube WHERE id = $sube_id")["baslik"]);
            }
        }
        return $pagelist->yazdir(array(
            'id'=>$id,
            'pdata' => $data
        ));
    }




    public function CustomPageCss($url)
    {
        // Sadece bu sayfa için gerekli Stil dosyaları eklenebilir
        $text = "";
        foreach ($this->css as $css){
            $text.="<link rel='stylesheet' type='text/css' href='".$this->ThemeFile("assets/".$css)."'>\n\t";
        }
        return $text;

    }


    public function CustomPageJs($url)
    {
        // Sadece bu sayfa için gerekli javascript dosyaları eklenebilir
        $text = "";
        foreach ($this->js as $js){
            $text.="<script type='text/javascript' src='".$this->ThemeFile("assets/".$js)."'></script>\n\t";
        }
        return $text;
    }




}