<?php


namespace AdminPanel;


class Urun  extends Settings{


    public  $modulName;
    private $ktable = "kategori";
    private $ktablelang = "kategori_lang";
    private $table;
    private $tablelang;
    public  $tablist;
    public $modul_info;


    public function __construct($settings)
    {
        parent::__construct($settings);

        $this->AuthCheck();

        $cmd = strtolower($this->getParameter()["modul"]);
        $this->modul_info = $this->dbConn->tekSorgu("SELECT * FROM moduller WHERE modul = '$cmd'");

        $this->modulName = $cmd;
        $this->table = $this->modulName;
        $this->tablelang = $this->modulName."_lang";

        $this->tablist = array(
            array("title" => "Ürünlerimiz", "href" => "liste", "icon" => "mdi mdi-view-sequential"),
            array("title" => "Kategoriler", "href" => "kategoriler", "icon" => "mdi mdi-ungroup"),
            // /array("title" => "Yardım", "href" => "help", "icon" => "mdi mdi-comment-question-outline"),
            array("title" => $this->modul_info["baslik"]." Modül Ayarları", "href" => "settings", "icon" => "mdi mdi-settings"),
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
        $this->SayfaBaslik = $this->modul_info["baslik"]." Modül Ayarları";

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


        $marka = (isset($_GET["marka"])) ? $_GET["marka"] : 0;


        $kosul = "";

        if (!empty($id)){
            $kosul.=" kid = ".$id;
            if (!empty($marka)){
                $kosul.=" and marka = ".$marka;
            }
        }else {
            if (!empty($marka)){
                $kosul.=" marka = ".$marka;
            }
        }


        list($sql, $showing, $toplamVeri) = $this->sayfalama(array(
            "table"=>$this->table,
            "kosul"=>$kosul,
            "search"=>array("baslik", "detay"),
            //"sqlEk"=>"(SELECT baslik FROM $this->ktable WHERE $this->ktable.id = ".$this->table.".kid) as kat_baslik, (SELECT baslik FROM marka WHERE marka.id = ".$this->table.".marka) as marka_baslik"
        ));



        $this->SayfaBaslik = "Ürünler Listesi";

        $pagelist = new PageList($this->settings);

        $filterURL = "/?cmd=".$this->modulName."/".__FUNCTION__;


        $text = $pagelist->Tablist($this->tablist);

        $text .= $pagelist->PageList(array(
            'flitpage' => array("url"=>$filterURL,"title"=>"Kategori Seçiniz",'sql'=>"select * from $this->ktable WHERE sil <> 1 and  ",'option'=>array('value'=>'id','title'=>'baslik'), "name"=>"katFilter", "class"=>"kat_filter", "kat"=>"ustu"),
            //'markaFilter' => array("url"=>$filterURL,"title"=>"Marka Seçiniz",'sql'=>"select * from marka WHERE sil <> 1  ",'option'=>array('value'=>'id','title'=>'baslik'), "name"=>"markaFilter", "class"=>"marka_filter"),
            'id'=>$id,
            'marka'=>$marka,
            'modul_id'=>$this->modul_info["id"],
            'modul_name'=>$this->modulName,
            'page'=>$this->table,
            "place"=>"ürünlerde ara",
            "showing"=>$showing,
            "resim"=>true,
            "toplamVeri"=>$toplamVeri,
            "search"=>true,
            'button' => array(array('title'=>'Ürün Ekle','href'=>$this->BaseAdminURL($this->modulName.'/ekle&kid='.$id),"class"=>"btn btn-success")),
            'p'=>array(
                array('dataTitle'=>'baslik', 'class'=>'sort'),
                //array('dataTitle'=>'kat_baslik', 'class'=>'sort'),
                //array('dataTitle'=>'detay', 'class'=>'sort'),
            ),
            'tools' =>array(   array('title'=>'Düzenle','icon'=>'ti-pencil','url'=>$this->BaseAdminURL($this->modulName.'/ekle/'),'color'=>'btn-primary'),
                               array("disable_delete"=>true,'title'=>'Sil','icon'=>'ti-close','url'=>$this->BaseAdminURL($this->modulName.'/sil/'),'color'=>'bg-maroon silButon')
            ),
            'buton'=> array(
                // array("disable_delete"=>true,'type'=>'button2','align'=>"center", 'title'=>'Resim Ekle','class'=>'btn bg-olive','dataname'=>'fotoekle','url'=>$this->BaseAdminURL('Resim/fotoekle/'), "data-icon"=>"ti-camera", "modul"=>$this->table),
                //array("disable_delete"=>true,'type'=>'button2','align'=>"center", 'title'=>'Kat Planı Ekle','class'=>'btn btn-success','dataname'=>'fotoekle','url'=>$this->BaseAdminURL('Resim/fotoekle/'), "data-icon"=>" ti-layout", "modul"=>$this->modulName, "file_type"=>"kat_plan"),
                //array("disable_delete"=>true,'type'=>'button2','align'=>"center", 'title'=>'Daire Planı Ekle','class'=>'btn btn-warning','dataname'=>'fotoekle','url'=>$this->BaseAdminURL('Resim/fotoekle/'), "data-icon"=>" ti-layout", "modul"=>$this->modulName, "file_type"=>"daire_plan"),
                array('type'=>'radio','dataname'=>'yeni','url'=>$this->BaseAdminURL($this->modulName.'/yeniDurum/')),
                array('type'=>'radio','dataname'=>'aktif','url'=>$this->BaseAdminURL($this->modulName.'/durum/')),
            ),
            'pdata' => $this->dbConn->sorgu($sql),
            'baslik'=>array(
                array('title'=>'Ürün Kodu','width'=>'10%'),
                //array('title'=>'Kategori','width'=>'10%'),
                array('title'=>'Yeni','width'=>'5%', "align"=>"center"),
                //array('title'=>'Kat Planları','width'=>'5%', "align"=>"center"),
                //array('title'=>'Daire Planları','width'=>'5%', "align"=>"center"),
                array('title'=>'Durum','width'=>'4%', "align"=>"center"),
            )
        ));

        return $text;

    }



    public function ekle($id=null)
    {


        $request_kid = (isset($_GET["kid"]) ? $_GET["kid"] : 0);

        $this->SayfaBaslik = 'Ürün '.(($id) ? "Düzenle" : "Ekle");
        $text = '';
        $tabForm = array();
        $form = new Form($this->settings);
        $tabs = new Tabs($this->settings);

        $text .= $form->formOpen(array('method'=>'POST','action'=> $this->BaseAdminURL($this->modulName.'/kaydet'.((isset($id)) ? '/'.$id :'')),'fileUpload'=>true,'id'=>'form_sample_3','class'=>''));
        $text .= $form->openColumn(8);

        if($id) $data = $tabs->tabData($this->table,$id);

        foreach ($this->settings->lang('lang') as $dil=>$title):
            $tabForm[$dil]['text']  = $form->input(array("required"=>array("tr"),'value'=>((isset($data[$dil]['baslik']) ? $this->temizle($data[$dil]['baslik']) :'')),'title'=>'Ürün Kodu','lang'=>$dil,'name'=>'baslik'));

            //$tabForm[$dil]['text']  .= $form->input(array('value'=>((isset($data[$dil]['kisi']) ? $this->temizle($data[$dil]['kisi']) :'')),'title'=>'Kaç Kişilik','lang'=>$dil,'name'=>'kisi'));
            // $tabForm[$dil]['text'] .= $form->textarea(array('value'=>((isset($data[$dil]['ozet']) ? $this->temizle($data[$dil]['ozet']) :'')),'title'=>'Özet Açıklama','name'=>'ozet','lang'=>$dil));

            // $tabForm[$dil]['text'] .= $form->textEditor(array('value'=>((isset($data[$dil]['icindekiler']) ? $this->temizle($data[$dil]['icindekiler']) :'')),'title'=>'İçindekiler','name'=>'icindekiler','lang'=>$dil,'height' => '250'));


            // $tabForm[$dil]['text'] .= $form->textEditor(array('value'=>((isset($data[$dil]['detay']) ? $this->temizle($data[$dil]['detay']) :'')),'title'=>'Besin Değerleri','name'=>'detay','lang'=>$dil,'height' => '250'));

            //$tabForm[$dil]['text'] .= $form->textEditor(array('value'=>((isset($data[$dil]['video']) ? $this->temizle($data[$dil]['video']) :'')),'title'=>'Tanıtım Videosu','name'=>'video','lang'=>$dil,'height' => '250'));

            // Dinamik Özellikler Tablosu - Her dil için
            // Her dil için verileri yükle
            $ozellikler_data = '';
            if($id) {
                if($dil == 'tr') {
                    // Türkçe için ana tablodan
                    if(isset($data['tr']['ozellikler']) && !empty($data['tr']['ozellikler'])) {
                        $ozellikler_data = $data['tr']['ozellikler'];
                    } else {
                        $urun_data = $this->dbConn->tekSorgu("SELECT ozellikler FROM ".$this->table." WHERE id = ".$id);
                        if($urun_data && isset($urun_data['ozellikler']) && !empty($urun_data['ozellikler']) && $urun_data['ozellikler'] != 'null') {
                            $ozellikler_data = $urun_data['ozellikler'];
                        }
                    }
                } else {
                    // Diğer diller için lang tablosundan
                    if(isset($data[$dil]['ozellikler']) && !empty($data[$dil]['ozellikler'])) {
                        $ozellikler_data = $data[$dil]['ozellikler'];
                    } else {
                        $lang_data = $this->dbConn->tekSorgu("SELECT ozellikler FROM ".$this->tablelang." WHERE master_id = ".$id." AND dil = '".$dil."' LIMIT 1");
                        if($lang_data && isset($lang_data['ozellikler']) && !empty($lang_data['ozellikler']) && $lang_data['ozellikler'] != 'null') {
                            $ozellikler_data = $lang_data['ozellikler'];
                        }
                    }
                }
            }
            
            $ozellikler_data = html_entity_decode($ozellikler_data, ENT_QUOTES, 'UTF-8');
            
            $tabForm[$dil]['text'] .= $form->openBox();
            $tabForm[$dil]['text'] .= $form->openBoxBody();
            $tabForm[$dil]['text'] .= '<h4>Ürün Özellikleri ('.$title.')</h4>';
            
            $tabForm[$dil]['text'] .= '<div id="ozellikler-container-'.$dil.'" class="ozellikler-container" data-lang="'.$dil.'">';
            $json_escaped = htmlspecialchars($ozellikler_data, ENT_QUOTES, 'UTF-8');
            $tabForm[$dil]['text'] .= '<input type="hidden" name="ozellikler_json_'.$dil.'" id="ozellikler_json_'.$dil.'" value="'.$json_escaped.'">';
            
            $tabForm[$dil]['text'] .= '<div class="row mb-4">
                    <div class="col-md-12">
                        <label>Sütun Yönetimi</label>
                        <div class="input-group">
                            <input type="text" class="form-control yeni_kolon_adi" data-lang="'.$dil.'" placeholder="Yeni sütun adı (Örn: Kod, Çap, Boy, Genişlik)">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-info ekle_kolon" data-lang="'.$dil.'">
                                    <i class="fa fa-plus"></i> Sütun Ekle
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="table-responsive" style="margin-top: 20px;">
                    <table class="table table-bordered table-striped ozellikler_table" id="ozellikler_table_'.$dil.'">
                        <thead class="ozellikler_thead" id="ozellikler_thead_'.$dil.'">
                            <tr>
                                <th style="width: 50px;">#</th>
                                <th class="kolonlar_container" id="kolonlar_container_'.$dil.'">
                                    <!-- Sütunlar buraya dinamik olarak eklenecek -->
                                </th>
                            </tr>
                        </thead>
                        <tbody class="ozellikler_tbody" id="ozellikler_tbody_'.$dil.'" data-repeater-list="ozellikler_rows_'.$dil.'">
                            <!-- Satırlar buraya dinamik olarak eklenecek -->
                        </tbody>
                    </table>
                </div>
                
                <button type="button" class="btn btn-success ekle_satir" data-lang="'.$dil.'">
                    <i class="fa fa-plus"></i> Yeni Satır Ekle
                </button>
            </div>';
            
            $tabForm[$dil]['text'] .= $form->closeBoxBody();
            $tabForm[$dil]['text'] .= $form->closeBox();

        endforeach;

        $text .= $tabs->tabContent($tabForm);

        $text.= $form->closeDiv();




        $text.=$form->openColumn(4);


        $text.= $form->file2(array('url'=>$this->BaseURL('upload')."/".$this->modulName,'folder'=>$this->modulName,'title'=>'Ürün Resmi','name'=>'resim','resimBoyut'=>"600x400",'src'=>((isset($data['tr']['resim'])) ? $data['tr']['resim'] :'')));


        $text.=$form->openBox().$form->openBoxBody();

        // Kategori seçimi
        $selected_kid = 0;
        if($id && isset($data['tr']['kid'])) {
            $selected_kid = $data['tr']['kid'];
        } elseif($request_kid) {
            $selected_kid = $request_kid;
        }
        
        $text .= $form->select(array('required'=>true,'title'=>'Kategori', 'name'=>'kid','data'=> $form->parent(array('sql'=>"select * from $this->ktable WHERE sil <> 1 and ",'option'=>array('value'=>'id','title'=>'baslik'),"kat"=>"ustu", 'selected'=>$selected_kid),0,0)));
        $text .= $form->checkbox(array('value'=>((isset($data["tr"]['yeni'])) ? $this->temizle($data["tr"]['yeni']) :''),'title'=>'Yeni','name'=>'yeni','help'=>'Yeni Ürün', "checked"=>((isset($data["tr"]["yeni"]) && $data["tr"]["yeni"] == 1) ? "checked" : "")));
        $text .= $form->checkbox(array('value'=>((isset($data["tr"]['aktif'])) ? $this->temizle($data["tr"]['aktif']) :''),'title'=>'Aktif','name'=>'aktif','help'=>'Onay Durumu', "checked"=>((isset($data["tr"]["aktif"])) ? "" : "checked")));
        $text.= $form->closeDiv();

        $text .= $form->submitButton(array("color"=>"btn-success  btn-lg","icon"=>"fa fa-check", 'submit'=>($id) ? 'Güncelle':'Kaydet'));
        $text.= $form->closeDiv();
        $text.= $form->closeDiv();






        $text .= $form->formClose();

        return $text;
    }

    public function kaydet($id=null)
    {
        try {
            $dbname = $this->dbConn->dbName;
            
            // Ana tablo için ozellikler sütunu kontrolü
            $knt = $this->dbConn->tekSorgu("SELECT COUNT(*) as tp FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '" . $this->table . "' AND COLUMN_NAME = 'ozellikler' AND table_schema = '" . $dbname . "'");
            if (isset($knt["tp"]) && $knt["tp"] == 0) {
                try {
                    $this->dbConn->manualSql("ALTER TABLE " . $this->table . " ADD COLUMN ozellikler TEXT NULL");
                } catch (\Exception $e) {
                    // Sütun zaten varsa hata verme
                }
            }
            
            // Lang tablosu için ozellikler sütunu kontrolü
            $knt_lang = $this->dbConn->tekSorgu("SELECT COUNT(*) as tp FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '" . $this->tablelang . "' AND COLUMN_NAME = 'ozellikler' AND table_schema = '" . $dbname . "'");
            if (isset($knt_lang["tp"]) && $knt_lang["tp"] == 0) {
                try {
                    $this->dbConn->manualSql("ALTER TABLE " . $this->tablelang . " ADD COLUMN ozellikler TEXT NULL");
                } catch (\Exception $e) {
                    // Sütun zaten varsa hata verme
                }
            }
            
            // Yeni alanı kontrol et ve ekle - Ana tablo
            try {
                $knt_yeni = $this->dbConn->tekSorgu("SELECT COUNT(*) as tp FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '" . $this->table . "' AND COLUMN_NAME = 'yeni' AND table_schema = '" . $dbname . "'");
                $yeni_var = false;
                if (isset($knt_yeni["tp"]) && $knt_yeni["tp"] > 0) {
                    $yeni_var = true;
                }
                
                if (!$yeni_var) {
                    // Sütun yoksa ekle
                    $this->dbConn->manualSql("ALTER TABLE " . $this->table . " ADD COLUMN yeni TINYINT(1) DEFAULT 0");
                }
            } catch (\Exception $e) {
                // Hata durumunda manuel eklemeyi dene
                try {
                    $this->dbConn->manualSql("ALTER TABLE " . $this->table . " ADD COLUMN yeni TINYINT(1) DEFAULT 0");
                } catch (\Exception $e2) {
                    // Sütun zaten varsa hata verme, devam et
                }
            }
            
            // Yeni alanı kontrol et ve ekle - Lang tablosu
            try {
                $knt_yeni_lang = $this->dbConn->tekSorgu("SELECT COUNT(*) as tp FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '" . $this->tablelang . "' AND COLUMN_NAME = 'yeni' AND table_schema = '" . $dbname . "'");
                $yeni_var_lang = false;
                if (isset($knt_yeni_lang["tp"]) && $knt_yeni_lang["tp"] > 0) {
                    $yeni_var_lang = true;
                }
                
                if (!$yeni_var_lang) {
                    // Sütun yoksa ekle
                    $this->dbConn->manualSql("ALTER TABLE " . $this->tablelang . " ADD COLUMN yeni TINYINT(1) DEFAULT 0");
                }
            } catch (\Exception $e) {
                // Hata durumunda manuel eklemeyi dene
                try {
                    $this->dbConn->manualSql("ALTER TABLE " . $this->tablelang . " ADD COLUMN yeni TINYINT(1) DEFAULT 0");
                } catch (\Exception $e2) {
                    // Sütun zaten varsa hata verme, devam et
                }
            }
        } catch (\Exception $e) {
            // Hata durumunda devam et
        }

        foreach ($this->settings->lang('lang') as $dil => $title):

            // Her dil için ozellikler verisini al
            $ozellikler_json = '';
            $post_field_name = 'ozellikler_json_'.$dil;
            if(isset($_POST[$post_field_name]) && !empty($_POST[$post_field_name])) {
                $ozellikler_json = html_entity_decode($_POST[$post_field_name], ENT_QUOTES, 'UTF-8');
                // Veriyi temizle
                $ozellikler_json = $this->kirlet($ozellikler_json);
            }
            
            if($dil == "tr"):
                $post[$dil] = array(
                    'baslik'=> $this->kirlet($this->_POST('baslik',$dil)),
                    //'kisi'=> $this->kirlet($this->_POST('kisi',$dil)),
                    'ozet'=> $this->kirlet($this->_POST('ozet',$dil)),
                    'icindekiler'=> $this->kirlet($this->_POST('icindekiler',$dil)),
                    'detay'=>$this->kirlet($this->_POST('detay',$dil)),
                    'link'=>$this->kirlet($this->_POST('link',$dil)),
                    'video'=>$this->kirlet($this->_POST('video',$dil)),
                    'koordinat'=>$this->kirlet($this->_POST('koordinat')),
                    'resim' => $this->_RESIM_BASE64('resim', $this->modulName,"","jpg",""),
                    //'detay_resim' => $this->_RESIM_BASE64('detay_resim', $this->modulName),
                    //'logo' => $this->_RESIM_BASE64('logo', $this->modulName),
                    'yeni'=> ($this->_POST('yeni')) ? $this->_POST('yeni'):0,
                    'aktif'=> ($this->_POST('aktif')) ? $this->_POST('aktif'):0,
                    'kid'=> ($this->_POST('kid')) ? $this->_POST('kid'):0,
                    'ozellikler' => $ozellikler_json,
                    'dil' => $dil
                );
            else:
                $post[$dil] = array(
                    'baslik'=> $this->kirlet($this->_POST('baslik',$dil)),
                    'link'=>$this->kirlet($this->_POST('link',$dil)),
                    'ozet'=> $this->kirlet($this->_POST('ozet',$dil)),
                    'slogan'=> $this->kirlet($this->_POST('slogan',$dil)),
                    'video'=>$this->kirlet($this->_POST('video',$dil)),
                    //'teknik'=>$this->kirlet($this->_POST('teknik',$dil)),
                    'kid'=> ($this->_POST('kid')) ? $this->_POST('kid'):0,
                    //'kod'=>$this->kirlet($this->_POST('kod')),
                    'detay'=>$this->kirlet($this->_POST('detay',$dil)),
                    'yeni'=> ($this->_POST('yeni')) ? $this->_POST('yeni'):0,
                    'ozellikler' => $ozellikler_json,
                    'dil' => $dil
                );
            endif;



        endforeach;




        if(isset($id) and $id):
            //Güncelle

            foreach ($this->settings->lang('lang') as $dil=>$title){
                $post[$dil]["duzenleme_tarihi"] = date("Y-m-d H:i:s");
                $post[$dil]["duzenleyen"] = $this->getUserInfo("adi");
            }

            $post["tr"]["url"] = strtolower($this->permalink($post["tr"]["baslik"]))."-".$id;

            $this->dbConn->update($this->table,$post['tr'],$id);
            foreach ($this->settings->lang('lang') as $dil=>$title):
                if($dil!='tr') {
                    $post[$dil]["url"] = strtolower($this->permalink($post[$dil]["baslik"]))."-".$id;

                    if (isset($post["ar"])){
                        $post["ar"]["url"] = isset($post["en"]) ? $post["en"]["url"] : $post["tr"]["url"];
                    }

                    if(count($this->dbConn->sorgu("select lang_id from ".$this->tablelang." where dil='$dil'  and master_id='$id' "))==1)
                        $this->dbConn->update($this->tablelang, $post[$dil], array('master_id' => $id,'dil'=>$dil));
                    else
                        $this->dbConn->insert($this->tablelang,array_merge($post[$dil],array('master_id'=>$id)));
                }
            endforeach;


        else:

            // kaydet
            foreach ($this->settings->lang('lang') as $dil=>$title){
                $post[$dil]["eklenme_tarihi"] = date("Y-m-d H:i:s");
                $post[$dil]["ekleyen"] = $this->getUserInfo("adi");
            }

            $post["tr"]["sira"] = $this->Order($this->table);
            $this->dbConn->insert($this->table,$post['tr'],$id);
            $lastid = $this->dbConn->lastid();

            $this->dbConn->update($this->table, array(
                "url"=>strtolower($this->permalink($post["tr"]["baslik"]))."-".$lastid
            ),$lastid);

            $this->FileSessionSave($lastid,$this->modulName);

            foreach ($this->settings->lang('lang') as $dil=>$title):
                $post[$dil]["url"] = strtolower($this->permalink($post[$dil]["baslik"]))."-".$lastid;
                if (isset($post["ar"])){
                    $post["ar"]["url"] = isset($post["en"]) ? $post["en"]["url"] : $post["tr"]["url"];
                }
                if($dil!='tr') $this->dbConn->insert($this->tablelang,array_merge($post[$dil],array('dil'=>$dil,'master_id'=>$lastid)));
            endforeach;
        endif;
        $this->RedirectURL($this->BaseAdminURL($this->modulName.'/liste'.(($this->_POST('kid')) ? "/".$this->_POST('kid'):'')));
    }


    public function sil($id=null)
    {
        if ($id){
            $date = date("Y-m-d H:i:s");
            $this->dbConn->update($this->table, array("sil"=>1, "silme_tarihi"=>$date), array("id"=>$id));
            $this->dbConn->langUpdate($this->tablelang, array("sil"=>1, "silme_tarihi"=>$date), array("master_id"=>$id));
        }
        $this->RedirectURL($this->BaseAdminURL($this->modulName.'/liste'));
    }


    public function durum($id=null)
    {
        $durum = ((isset($_GET['durum'])) ? $_GET['durum'] : null);
        $id = ((isset($_GET['id'])) ? $_GET['id'] : null);
        $tr_duzenle = $this->dbConn->update($this->table,array('aktif'=>$durum),$id);
        $lang_duzenle = $this->dbConn->langUpdate($this->tablelang,array('aktif'=>$durum),$id);

        if($tr_duzenle && $lang_duzenle) echo 1; else echo 0;
        exit();

    }

    public function yeniDurum($id=null)
    {
        $durum = ((isset($_GET['durum'])) ? $_GET['durum'] : null);
        $id = ((isset($_GET['id'])) ? $_GET['id'] : null);
        $tr_duzenle = $this->dbConn->update($this->table,array('yeni'=>$durum),$id);
        $lang_duzenle = $this->dbConn->langUpdate($this->tablelang,array('yeni'=>$durum),$id);

        if($tr_duzenle && $lang_duzenle) echo 1; else echo 0;
        exit();

    }



    public function kategoriler($id=null)
    {
        list($sql, $showing, $toplamVeri) = $this->sayfalama(array(
            "table"=>$this->ktable,
            "kosul"=>(isset($id)) ? "ustu = ".$id : ((!empty($_GET["kelime"])) ? "" : " ustu = 0"),
            "search"=>array("baslik"),
        ));

        $this->SayfaBaslik = "Kategori Listesi";

        $pagelist = new PageList($this->settings);

        $filterURL = "/?cmd=".$this->modulName."/".__FUNCTION__;

        $text = $pagelist->Tablist($this->tablist);

        $text .= $pagelist->KategoriList(array(
            'flitpage' => array("url"=>$filterURL,"title"=>"Kategori Seçiniz",'sql'=>"select * from $this->ktable WHERE sil <> 1 and ",'option'=>array('value'=>'id','title'=>'baslik'), "name"=>"kategoriFilter", "class"=>"flit_filter", "kat"=>"ustu"),
            'id'=>$id,
            'modul_id'=>$this->modul_info["id"],
            'modul_name'=>$this->modulName,
            'page'=>$this->ktable,
            "place"=>"kategorilerde ara",
            "showing"=>$showing,
            "resim"=>false,
            "toplamVeri"=>$toplamVeri,
            "search"=>true,
            'button' => array(array('title'=>'Kategori Ekle','href'=>$this->BaseAdminURL($this->modulName.'/kategoriEkle'),"class"=>"btn btn-success")),
            'p'=>array(
                array('dataTitle'=>'baslik', 'class'=>'sort'),
            ),

            'tools' =>array(
                array('title'=>'Düzenle','icon'=>'ti-pencil','url'=>$this->BaseAdminURL($this->modulName.'/kategoriEkle/'),'color'=>'btn-primary'),
                array("disable_delete"=>true,'title'=>'Sil','icon'=>'ti-close','url'=>$this->BaseAdminURL($this->modulName.'/kategoriSil/'),'color'=>'bg-maroon silButon')
            ),
            'buton'=> array(
                //array("disable_delete"=>true,'type'=>'button2','align'=>"center", 'title'=>'Video Ekle','class'=>'btn bg-olive','dataname'=>'fotoekle','url'=>$this->BaseAdminURL('video/liste/'), "data-icon"=>"mdi mdi-video"),
                //array("disable_delete"=>true,'type'=>'button2','align'=>"center", 'title'=>'3D Modeller','class'=>'btn btn-success','dataname'=>'fotoekle','url'=>$this->BaseAdminURL('Dosyalar/fotoekle/'), "data-icon"=>" ti-envelope", "modul"=>"kategori", "file_type"=>"3d"),
                array('type'=>'radio','dataname'=>'aktif','url'=>$this->BaseAdminURL($this->modulName.'/kategoriDurum/')),
            ),

            'pdata' => $this->dbConn->sorgu($sql),
            'baslik'=>array(
                array('title'=>'Kategori Adı','width'=>'25%'),
                //array('title'=>'Videolar','width'=>'5%'),
                //array('title'=>'3D Modeller','width'=>'5%'),
                array('title'=>'Durum','width'=>'3%', "align"=>"center"),
            )
        ));

        return $text;

    }


    public function kategoriEkle($id=null)
    {
        $this->SayfaBaslik = 'Kategori '.(($id) ? "Düzenle" : "Ekle");
        $text = '';
        $tabForm = array();
        $form = new Form($this->settings);
        $tabs = new Tabs($this->settings);

        $text .= $form->formOpen(array('method'=>'POST','action'=> $this->BaseAdminURL($this->modulName.'/kategoriKaydet'.((isset($id)) ? '/'.$id :'')),'fileUpload'=>true,'id'=>'form_sample_3','class'=>''));
        $text .= $form->openColumn(5);

        if($id) $data = $tabs->tabData($this->ktable,$id);

        foreach ($this->settings->lang('lang') as $dil=>$title):
            $tabForm[$dil]['text']  = $form->input(array("required"=>array("tr"),'value'=>((isset($data[$dil]['baslik']) ? $this->temizle($data[$dil]['baslik']) :'')),'title'=>'Kategori Adı','lang'=>$dil,'name'=>'baslik'));
            //$tabForm[$dil]['text'] .= $form->textarea(array('value'=>((isset($data[$dil]['ozet']) ? $this->temizle($data[$dil]['ozet']) :'')),'title'=>'Açıklama','name'=>'ozet','lang'=>$dil));
            //$tabForm[$dil]['text']  .= $form->input(array('value'=>((isset($data[$dil]['link']) ? $this->temizle($data[$dil]['link']) :'')),'title'=>'Dışarı Link','lang'=>$dil,'name'=>'link'));

        endforeach;

        $text .= $tabs->tabContent($tabForm);

        $text.=$form->openBox().$form->openBoxBody();

        $text .= $form->select(array('title'=>'Üst Kategori', 'name'=>'ustu','data'=> $form->parent(array('sql'=>"select * from $this->ktable WHERE sil <> 1 AND (ustu = 0 OR ustu IS NULL)",'option'=>array('value'=>'id','title'=>'baslik'),'selected'=>((isset($data['tr']['ustu'])) ? $data['tr']['ustu'] :'')),0,0)));
        $text .= $form->checkbox(array('value'=>((isset($data["tr"]['aktif'])) ? $this->temizle($data["tr"]['aktif']) :''),'title'=>'Aktif','name'=>'aktif','help'=>'Onay Durumu', "checked"=>((isset($data["tr"]["aktif"])) ? "" : "checked")));
        $text.= $form->closeDiv();

        $text .= $form->submitButton(array("color"=>"btn-success  btn-lg","icon"=>"fa fa-check", 'submit'=>($id) ? 'Güncelle':'Kaydet'));
        $text.= $form->closeDiv();

        $text.= $form->closeDiv();


       /* $text .= $form->openColumn(4);

            $text.= $form->file(array('url'=>$this->BaseURL('upload')."/".$this->ktable,'folder'=>$this->ktable,'title'=>'Sayfa Banner Resmi','name'=>'banner_resim','resimBoyut'=>"1920x900",'src'=>((isset($data['tr']['resim'])) ? $data['tr']['resim'] :'')));



        $text.= $form->closeDiv();*/

        $text .= $form->formClose();



        return $text;
    }



    public function kategoriKaydet($id=null)
    {

        foreach ($this->settings->lang('lang') as $dil=>$title):

            if($dil == "tr"):
                $post[$dil] = array(
                    'baslik'=> $this->kirlet($this->_POST('baslik',$dil)),
                    //'ozet'=> $this->kirlet($this->_POST('ozet',$dil)),
                    //'link'=> $this->kirlet($this->_POST('link',$dil)),
                    'aktif'=> ($this->_POST('aktif')) ? $this->_POST('aktif'):0,
                    'ustu'=>($this->_POST('ustu')) ? $this->_POST('ustu'):0,
                    'resim' => $this->_RESIM_BASE64('banner_resim', $this->ktable),
                    'banner' => $this->_RESIM_BASE64('banner', $this->ktable),
                    'dil' => $dil
                );
            else:
                $post[$dil] = array(
                    'baslik'=> $this->kirlet($this->_POST('baslik',$dil)),
                    //'link'=> $this->kirlet($this->_POST('link',$dil)),
                    //'ozet'=> $this->kirlet($this->_POST('ozet',$dil)),
                    'aktif'=> ($this->_POST('aktif')) ? $this->_POST('aktif'):0,
                    'ustu'=>($this->_POST('ustu')) ? $this->_POST('ustu'):0,
                    'dil' => $dil
                );
            endif;


        endforeach;




        if(isset($id) and $id):
            //Güncelle

            foreach ($this->settings->lang('lang') as $dil=>$title){
                $post[$dil]["duzenleme_tarihi"] = date("Y-m-d H:i:s");
                $post[$dil]["duzenleyen"] = $this->getUserInfo("adi");
            }

            $post["tr"]["url"] = strtolower($this->permalink($post["tr"]["baslik"]))."-".$id;


            $this->dbConn->update($this->ktable,$post['tr'],$id);
            foreach ($this->settings->lang('lang') as $dil=>$title):
                if($dil!='tr') {
                    $post[$dil]["url"] = strtolower($this->permalink($post[$dil]["baslik"]))."-".$id;

                    if (isset($post["ar"])){
                        $post["ar"]["url"] = isset($post["en"]) ? $post["en"]["url"] : $post["tr"]["url"];
                    }

                    if(count($this->dbConn->sorgu("select lang_id from ".$this->ktablelang." where dil='$dil'  and master_id='$id' "))==1)
                        $this->dbConn->update($this->ktablelang, $post[$dil], array('master_id' => $id,'dil'=>$dil));
                    else
                        $this->dbConn->insert($this->ktablelang,array_merge($post[$dil],array('master_id'=>$id)));
                }
            endforeach;

        else:

            // kaydet
            foreach ($this->settings->lang('lang') as $dil=>$title){
                $post[$dil]["eklenme_tarihi"] = date("Y-m-d H:i:s");
                $post[$dil]["ekleyen"] = $this->getUserInfo("adi");
            }

            $post["tr"]["sira"] = $this->Order($this->ktable);
            $this->dbConn->insert($this->ktable,$post['tr'],$id);
            $lastid = $this->dbConn->lastid();

            $this->dbConn->update($this->ktable, array(
                "url"=>strtolower($this->permalink($post["tr"]["baslik"]))."-".$lastid
            ),$lastid);

            foreach ($this->settings->lang('lang') as $dil=>$title):

                $post[$dil]["url"] = strtolower($this->permalink($post[$dil]["baslik"]))."-".$lastid;

                if (isset($post["ar"])){
                    $post["ar"]["url"] = isset($post["en"]) ? $post["en"]["url"] : $post["tr"]["url"];
                }

                if($dil!='tr') $this->dbConn->insert($this->ktablelang,array_merge($post[$dil],array('dil'=>$dil,'master_id'=>$lastid)));

            endforeach;
        endif;
        $this->RedirectURL($this->BaseAdminURL($this->modulName.'/kategoriler'.(($this->_POST('ustu')) ? "/".$this->_POST('ustu'):'')));
    }





    public function kategoriSil($id=null)
    {
        if ($id){
            $date = date("Y-m-d H:i:s");
            $this->dbConn->update($this->ktable, array("sil"=>1, "silme_tarihi"=>$date, "silen"=>$this->getUserInfo("adi")), array("id"=>$id));
            $this->dbConn->langUpdate($this->ktablelang, array("sil"=>1, "silme_tarihi"=>$date, "silen"=>$this->getUserInfo("adi")), array("master_id"=>$id));
        }
        $this->RedirectURL($this->BaseAdminURL($this->modulName.'/kategoriler'));
    }




    public function kategoriDurum($id=null)
    {
        $durum = ((isset($_GET['durum'])) ? $_GET['durum'] : null);
        $id = ((isset($_GET['id'])) ? $_GET['id'] : null);
        $tr_duzenle = $this->dbConn->update($this->ktable,array('aktif'=>$durum),$id);
        $lang_duzenle = $this->dbConn->langUpdate($this->ktablelang,array('aktif'=>$durum),$id);

        if($tr_duzenle && $lang_duzenle) echo 1; else echo 0;
        exit();
    }

    public function ajaxKategoriBilgi($id=null)
    {
        header('Content-Type: application/json');
        
        // Tüm kategorileri getir (id ve ustu bilgisi)
        $kategoriler = $this->dbConn->sorgu("SELECT id, ustu FROM $this->ktable WHERE sil <> 1");
        
        $kategori_bilgi = array();
        if($kategoriler && count($kategoriler) > 0) {
            foreach($kategoriler as $kat) {
                $kategori_bilgi[$kat['id']] = array(
                    'ustu' => isset($kat['ustu']) ? intval($kat['ustu']) : 0
                );
            }
        }
        
        echo json_encode(array(
            'success' => true,
            'kategoriler' => $kategori_bilgi
        ));
        exit();
    }



    public function customPageCss(){
        echo "<style type='text/css'>";
        echo ".img-prev{ max-height:120px !important;}";
        echo "select[name='kid'] option[disabled] { font-weight: bold; color: #999 !important; background-color: #f5f5f5 !important; font-style: italic; }";
        echo ".ozellikler_table th, .ozellikler_table td { vertical-align: middle; }";
        echo ".kolon-header { position: relative; padding-right: 30px !important; }";
        echo ".kolon-remove { position: absolute; right: 5px; top: 50%; transform: translateY(-50%); cursor: pointer; color: #666; }";
        echo ".kolon-remove:hover { color: #dc3545 !important; }";
        echo ".ozellikler-thead { background-color: #f8f9fa; }";
        echo ".ozellikler-thead th { background-color: #f8f9fa !important; color: #495057 !important; font-weight: 600; border-color: #dee2e6 !important; padding: 12px 15px; }";
        echo ".ozellikler-thead th.kolon-header { color: #495057 !important; }";
        echo ".ozellikler-thead th:first-child { background-color: #e9ecef !important; color: #495057 !important; }";
        echo ".ozellikler_table { border-collapse: separate; border-spacing: 0; }";
        echo ".ozellikler_table thead th:first-child { border-top-left-radius: 4px; }";
        echo ".ozellikler_table thead th:last-child { border-top-right-radius: 4px; }";
        echo "</style>";
    }

    public function CustomPageJs($url){
        $text = "<script type='text/javascript'>";
        $text .= "
        jQuery(document).ready(function($) {
            // Ana kategorileri devre dışı bırak (sadece alt kategoriler seçilebilir)
            setTimeout(function() {
                var kategoriSelect = $('select[name=\"kid\"]');
                if(kategoriSelect.length > 0) {
                    // AJAX ile tüm kategorileri getir ve ana kategorileri işaretle
                    $.ajax({
                        url: '".$this->BaseAdminURL($this->modulName."/ajaxKategoriBilgi")."',
                        type: 'POST',
                        dataType: 'json',
                        success: function(response) {
                            if(response.success && response.kategoriler) {
                                kategoriSelect.find('option').each(function() {
                                    var optionValue = $(this).val();
                                    if(optionValue && response.kategoriler[optionValue] && response.kategoriler[optionValue].ustu == 0) {
                                        // Ana kategori - devre dışı bırak ve stil ekle
                                        $(this).prop('disabled', true);
                                        $(this).css({
                                            'font-weight': 'bold',
                                            'color': '#999',
                                            'background-color': '#f5f5f5'
                                        });
                                        // Eğer seçili değilse, metni güncelle
                                        if(!$(this).is(':selected')) {
                                            var originalText = $(this).text();
                                            $(this).text('📁 ' + originalText + ' (Ana Kategori)');
                                        }
                                    }
                                });
                            }
                        },
                        error: function() {
                            console.log('Kategori bilgileri yüklenemedi');
                        }
                    });
                }
            }, 500);
            
            // Her dil için ayrı veri yapısı
            var ozelliklerData = {};
            
            // Tüm dilleri yükle
            $('.ozellikler-container').each(function() {
                var dil = $(this).data('lang');
                ozelliklerData[dil] = {
                    kolonlar: [],
                    satirSayaci: 0
                };
                
                // Her dil için verileri yükle
                var ozelliklerDataRaw = $('#ozellikler_json_' + dil).val();
                console.log('Yüklenen veri (' + dil + ') (raw):', ozelliklerDataRaw);
                
                // HTML entities'i decode et
                if(ozelliklerDataRaw) {
                    var tempDiv = document.createElement('div');
                    tempDiv.innerHTML = ozelliklerDataRaw;
                    ozelliklerDataRaw = tempDiv.textContent || tempDiv.innerText || ozelliklerDataRaw;
                }
                
                console.log('Yüklenen veri (' + dil + ') (decoded):', ozelliklerDataRaw);
                
                if(ozelliklerDataRaw && ozelliklerDataRaw != '' && ozelliklerDataRaw != 'null') {
                    try {
                        var data = JSON.parse(ozelliklerDataRaw);
                        console.log('Parse edilmiş veri (' + dil + '):', data);
                        if(data.kolonlar && data.kolonlar.length > 0) {
                            ozelliklerData[dil].kolonlar = data.kolonlar;
                            kolonlariYukle(dil);
                        }
                        if(data.satirlar && data.satirlar.length > 0) {
                            data.satirlar.forEach(function(satir) {
                                satirEkle(dil, satir);
                            });
                        }
                    } catch(e) {
                        console.error('Veri yükleme hatası (' + dil + '):', e);
                        console.error('Hatalı veri:', ozelliklerDataRaw);
                    }
                }
            });
            
            // Yeni sütun ekle - her dil için
            $(document).on('click', '.ekle_kolon', function() {
                var dil = $(this).data('lang');
                var kolonAdi = $('.yeni_kolon_adi[data-lang=\"' + dil + '\"]').val().trim();
                if(kolonAdi == '') {
                    alert('Lütfen sütun adı giriniz');
                    return;
                }
                if(ozelliklerData[dil].kolonlar.indexOf(kolonAdi) !== -1) {
                    alert('Bu sütun zaten mevcut');
                    return;
                }
                ozelliklerData[dil].kolonlar.push(kolonAdi);
                kolonEkle(dil, kolonAdi);
                $('.yeni_kolon_adi[data-lang=\"' + dil + '\"]').val('');
                verileriGuncelle(dil);
            });
            
            // Enter tuşu ile sütun ekleme
            $(document).on('keypress', '.yeni_kolon_adi', function(e) {
                if(e.which == 13) {
                    e.preventDefault();
                    $(this).closest('.input-group').find('.ekle_kolon').click();
                }
            });
            
            // Yeni satır ekle - her dil için
            $(document).on('click', '.ekle_satir', function() {
                var dil = $(this).data('lang');
                satirEkle(dil);
            });
            
            // Sütun ekleme fonksiyonu
            function kolonEkle(dil, kolonAdi) {
                var th = $('<th class=\"kolon-header\">' + kolonAdi + 
                    '<span class=\"kolon-remove\" data-kolon=\"' + kolonAdi + '\" data-lang=\"' + dil + '\" title=\"Sütunu Sil\">' +
                    '<i class=\"fa fa-times\"></i></span></th>');
                $('#ozellikler_thead_' + dil + ' tr').eq(0).find('#kolonlar_container_' + dil).before(th);
                
                // Mevcut her satıra hücre ekle
                $('#ozellikler_tbody_' + dil + ' tr').each(function() {
                    var td = $('<td><input type=\"text\" class=\"form-control\" name=\"ozellikler_rows_' + dil + '[' + $(this).data('index') + '][' + kolonAdi + ']\" value=\"\"></td>');
                    $(this).find('td').eq(-1).before(td);
                });
                
                // Sütun silme olayı
                th.find('.kolon-remove').on('click', function() {
                    if(confirm('Bu sütunu silmek istediğinizden emin misiniz? Bu sütundaki tüm veriler silinecektir.')) {
                        var kolon = $(this).data('kolon');
                        var lang = $(this).data('lang');
                        kolonlariSil(lang, kolon);
                        verileriGuncelle(lang);
                    }
                });
            }
            
            // Sütun silme fonksiyonu
            function kolonlariSil(dil, kolonAdi) {
                var index = ozelliklerData[dil].kolonlar.indexOf(kolonAdi);
                if(index !== -1) {
                    ozelliklerData[dil].kolonlar.splice(index, 1);
                }
                // Sütun başlığını sil
                $('#ozellikler_thead_' + dil + ' tr th').each(function() {
                    if($(this).find('.kolon-remove').data('kolon') == kolonAdi) {
                        $(this).remove();
                    }
                });
                // Tüm satırlardan hücreleri sil
                $('#ozellikler_tbody_' + dil + ' tr').each(function() {
                    $(this).find('td').each(function() {
                        var input = $(this).find('input');
                        if(input.length && input.attr('name') && input.attr('name').indexOf('[' + kolonAdi + ']') !== -1) {
                            $(this).remove();
                        }
                    });
                });
            }
            
            // Sütunları yükleme fonksiyonu
            function kolonlariYukle(dil) {
                ozelliklerData[dil].kolonlar.forEach(function(kolon) {
                    kolonEkle(dil, kolon);
                });
            }
            
            // Yeni satır ekleme fonksiyonu
            function satirEkle(dil, satirData) {
                ozelliklerData[dil].satirSayaci++;
                var tr = $('<tr data-index=\"' + ozelliklerData[dil].satirSayaci + '\"></tr>');
                
                // Satır numarası
                tr.append('<td>' + ozelliklerData[dil].satirSayaci + '</td>');
                
                // Sütun hücreleri
                ozelliklerData[dil].kolonlar.forEach(function(kolon) {
                    var deger = (satirData && satirData[kolon]) ? satirData[kolon] : '';
                    var td = $('<td><input type=\"text\" class=\"form-control\" name=\"ozellikler_rows_' + dil + '[' + ozelliklerData[dil].satirSayaci + '][' + kolon + ']\" value=\"' + deger + '\"></td>');
                    tr.append(td);
                });
                
                // Silme butonu
                tr.append('<td><button type=\"button\" class=\"btn btn-danger btn-sm satir-sil\" data-lang=\"' + dil + '\"><i class=\"fa fa-trash\"></i></button></td>');
                
                $('#ozellikler_tbody_' + dil).append(tr);
                
                // Satır silme olayı
                tr.find('.satir-sil').on('click', function() {
                    if(confirm('Bu satırı silmek istediğinizden emin misiniz?')) {
                        $(this).closest('tr').remove();
                        satirlariRenumber(dil);
                        verileriGuncelle(dil);
                    }
                });
                
                verileriGuncelle(dil);
            }
            
            // Satırları yeniden numaralandır
            function satirlariRenumber(dil) {
                $('#ozellikler_tbody_' + dil + ' tr').each(function(index) {
                    var newIndex = index + 1;
                    $(this).data('index', newIndex);
                    $(this).find('td').first().text(newIndex);
                    $(this).find('input').each(function() {
                        var name = $(this).attr('name');
                        if(name) {
                            var newName = name.replace(/ozellikler_rows_\w+\[\d+\]/, 'ozellikler_rows_' + dil + '[' + newIndex + ']');
                            $(this).attr('name', newName);
                        }
                    });
                });
            }
            
            // Hidden input'taki verileri güncelleme fonksiyonu
            function verileriGuncelle(dil) {
                var data = {
                    kolonlar: ozelliklerData[dil].kolonlar,
                    satirlar: []
                };
                
                $('#ozellikler_tbody_' + dil + ' tr').each(function() {
                    var satir = {};
                    $(this).find('input').each(function() {
                        var name = $(this).attr('name');
                        if(name) {
                            var match = name.match(/ozellikler_rows_\w+\[\d+\]\[(.+?)\]/);
                            if(match && match[1]) {
                                satir[match[1]] = $(this).val();
                            }
                        }
                    });
                    if(Object.keys(satir).length > 0) {
                        data.satirlar.push(satir);
                    }
                });
                
                $('#ozellikler_json_' + dil).val(JSON.stringify(data));
            }
            
            // Herhangi bir alan değiştiğinde verileri güncelle
            $(document).on('input', '.ozellikler_table input', function() {
                var dil = $(this).closest('.ozellikler-container').data('lang');
                verileriGuncelle(dil);
            });
        });
        ";
        $text .= "</script>";
        return $text;
    }



}