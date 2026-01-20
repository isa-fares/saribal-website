<?php


namespace AdminPanel;


class Kurslar  extends Settings{


    public  $modulName = 'kurslar';
    private $table;
    private $tablelang;
    private $ktable = "kurskategori";



    public function __construct($settings)
    {
        parent::__construct($settings);
        $this->AuthCheck();
        $this->table = $this->modulName;
        $this->tablelang = $this->modulName."_lang";
        $this->SayfaBaslik = 'Eğitimler';

    }


    public function index($id)
    {
        return $this->liste($id);
    }

    public function liste($id=null)
    {

        $totalSql = array();
        $type = (isset($_GET["type"])) ? $_GET["type"] : "";
        $kosul = "";

        switch ($type):
            case 1:
                $kosul = "(baslangic <= NOW() and bitis >= NOW())"; //SÜREN EĞİTİMLER
                $ek = "";
                break;
            case 2:
                $kosul = "(NOW() >= satis_baslangic and NOW() <= baslangic)"; //SATIŞI BAŞLAYAN EĞİTİMLER
                $ek = "(if (ilk_satis > 0, DATE_SUB(baslangic, INTERVAL ilk_satis DAY),'0')) as satis_baslangic";
                break;
            case 3:
                $kosul = "NOW() <= satis_baslangic"; //PLANLANAN EĞİTİMLER
                $ek = "(if (ilk_satis > 0, DATE_SUB(baslangic, INTERVAL ilk_satis DAY), baslangic)) as satis_baslangic";
                break;
            case 4:
                $kosul = "(NOW() >= bitis)"; //TAMAMLANAN EĞİTİMLER
                $ek = "";
                break;
        endswitch;


        list($sql, $showing, $toplamVeri) = $this->sayfalama(array(
            "table"=>$this->table,
            "kosulTur"=>" HAVING ",
            "kosul"=>$kosul.((isset($id)) ? "kid = ".$id : ""),
            "search"=>array("baslik"),
            'order'=>"ORDER BY baslangic ASC",
            "sqlEk"=>$ek,
        ));




        $pagelist = new PageList($this->settings);

        $filterURL = "/?cmd=".$this->modulName."/".__FUNCTION__;

        return $pagelist->KursPagelist(array(
            'flitpage' => array("url"=>$filterURL,"title"=>"Eğitim Kategorisi Seçiniz",'sql'=>"select * from $this->ktable WHERE sil <> 1",'option'=>array('value'=>'id','title'=>'baslik'), "name"=>"kursFilter", "class"=>"flit_filter"),
            'id'=>$id,
            'page'=>$this->table,
            "place"=>"eğitim başlığı",
            "showing"=>$showing,
            "toplamVeri"=>$toplamVeri,
            "search"=>true,
            'button' => array(array('title'=>'Eğitim Ekle','href'=>$this->BaseAdminURL($this->modulName.'/ekle'),"class"=>"btn btn-success")),
            'p'=>array(
                array('class'=>'sort text-center','tabindex'=>0,'dataTitle'=>'id'),
                array('dataTitle'=>'baslik', 'class'=>'sort'),
                array('dataTitle'=>'kat_baslik', 'class'=>'sort', "align"=>"center", "filter"=>"select"),
                array('dataTitle'=>'baslangic', 'class'=>'sort', "align"=>"center", "type"=>"date", "dateFormat"=>"d.m.Y H:i", "labelClass"=>"btn btn-light"),
                array('dataTitle'=>'fiyat', 'class'=>'sort', "align"=>"center", "type"=>"fiyat", "labelClass"=>"badge-lg badge-info"),
                array("dataTitle"=>'kontenjan', "class"=>"sort", "align"=>"center", "type"=>"kontenjan", "labelClass"=>"badge-lg badge-secondary", "ek"=>array("data"=>"satis", "seperator"=>" / "))
            ),
            'tools' =>array(   array('title'=>'Düzenle','icon'=>'ti-pencil','url'=>$this->BaseAdminURL($this->modulName.'/ekle/'),'color'=>'btn-primary'),
                               array("disable_delete"=>true,'title'=>'Sil','icon'=>'ti-close','url'=>'#','color'=>'bg-maroon silButon')
            ),

            'buton'=> array(
                array("disable_delete"=>true,'type'=>'button2','align'=>"center", 'title'=>'Ek Resimler','class'=>'btn bg-olive','dataname'=>'fotoekle','url'=>$this->BaseAdminURL('Resim/fotoekle/'), "data-icon"=>"ti-camera", "modul"=>$this->table),
                array('type'=>'radio','dataname'=>'aktif','url'=>$this->BaseAdminURL($this->modulName.'/durum/')),
            ),

            'pdata' => $this->dbConn->sorgu($sql),
            'baslik'=>array(
                array('title'=>'ID','width'=>'2%', "align"=>"center"),
                array('title'=>'Başlık','width'=>'15%'),
                array('title'=>'Kategori','width'=>'15%'),
                array('title'=>'Başlangıç Tarihi','width'=>'7%'),
                array('title'=>'Fiyat','width'=>'5%'),
                array('title'=>'Kontenjan','width'=>'5%'),
                array('title'=>'Resim','width'=>'5%', "align"=>"center"),
                array('title'=>'Durum','width'=>'4%', "align"=>"center"),
            )

        ));

    }



    public function ekle($id=null)
    {



        $text = '';
        $tabForm = array();
        $form = new Form($this->settings);
        $tabs = new Tabs($this->settings);

        $text .= $form->formOpen(array('method'=>'POST','action'=> $this->BaseAdminURL($this->modulName.'/kaydet'.((isset($id)) ? '/'.$id :'')),'fileUpload'=>true,'id'=>'form_sample_3','class'=>'form-valid'));
        $text .= $form->openColumn(9);

        if (isset($id)) $data = $this->dbConn->tekSorgu("SELECT * FROM kurslar WHERE id = $id");

        $text.=$form->openBox();
        $text.="<div class='box-header with-border'><h4 class='box-title'>Eğitim ".(($id) ? "Düzenle" : "Ekle")."</h4></div>";
        $text.=$form->openBoxBody();

        $text.="<div class='row'>";
            $text .= "<div class='col-md-4'>".$form->select(array("required"=>true, 'title'=>'Eğitim Kategorisi','name'=>'kid','data'=> $form->parent(array('sql'=>"select * from $this->ktable WHERE sil <> 1",'option'=>array('value'=>'id','title'=>'baslik'),'selected'=>((isset($data['kid'])) ? $data['kid'] :'')),0,0)))."</div>";
            $text .= "<div class='col-md-4'>".$form->date(array("format"=>"DD.MM.YYYY HH:mm","required"=>"true", 'value'=>((isset($data['baslangic']) ? date("d.m.Y H:i",strtotime($data['baslangic'])) : date('d.m.Y H:i'))),'title'=>'Başlangıç Tarihi','name'=>'baslangic'))."</div>";
            $text .= "<div class='col-md-4'>".$form->date(array("format"=>"DD.MM.YYYY HH:mm","required"=>"true", 'value'=>((isset($data['bitis']) ? date("d.m.Y H:i",strtotime($data['bitis'])) : date('d.m.Y H:i'))),'title'=>'Bitiş Tarihi','name'=>'bitis'))."</div>";
            $text .= "<div class='col-md-4'>".$form->input(array("icon"=>"mdi mdi-account-plus", "min"=>"1", "type"=>"number", "required"=>true,'value'=>((isset($data['kontenjan']) ? $this->temizle($data['kontenjan']) :'1')),'title'=>'Kontenjan','name'=>'kontenjan'))."</div>";
            $text .= "<div class='col-md-4'>".$form->input(array("icon"=>"mdi mdi-account-plus", "min"=>"1", "type"=>"number", "required"=>true,'value'=>((isset($data['maksimum_alma']) ? $this->temizle($data['maksimum_alma']) :'1')),'title'=>'Maksimum Satın Alma','name'=>'maksimum_alma'))."</div>";
            $text .= "<div class='col-md-2'>".$form->input(array("icon"=>"mdi mdi-calendar", "required"=>true,'value'=>((isset($data['sure']) ? $this->temizle($data['sure']) :'')),'title'=>'Eğitim Süresi','name'=>'sure'))."</div>";
            $text .= "<div class='col-md-2'>".$form->input(array("icon"=>"mdi mdi-timer","required"=>true,'value'=>((isset($data['saat']) ? $this->temizle($data['saat']) :'')),'title'=>'Eğitim Saati','name'=>'saat'))."</div>";
            $text .= "<div class='col-md-3'>".$form->input(array("icon"=>"mdi mdi-calendar-question", 'value'=>((isset($data['ilk_satis']) ? $data['ilk_satis'] :'')),'title'=>'İlk Satış Zamanı','name'=>'ilk_satis', "help"=>"Sadece Rakam, Satış kaç gün önce başlayacak"))."</div>";
            $text .= "<div class='col-md-3'>".$form->input(array("icon"=>"mdi mdi-calendar-clock", 'value'=>((isset($data['egitim_gunleri']) ? $data['egitim_gunleri'] :'')),'title'=>'Eğitim Günleri','name'=>'egitim_gunleri'))."</div>";
            $text .= "<div class='col-md-3'>".$form->input(array("icon"=>"fa fa-try", "required"=>true,'value'=>((isset($data['fiyat']) ? $this->moneyFormat($data['fiyat']) :'')),'title'=>'Fiyatı','name'=>'fiyat'))."</div>";
            $text .= "<div class='col-md-3'>".$form->input(array("icon"=>"fa fa-map-marker", "required"=>true,'value'=>((isset($data['yer']) ? $this->temizle($data['yer']) :'')),'title'=>'Yer','name'=>'yer'))."</div>";
        $text.="</div>";

        $text.=$form->selectmulti(array('title'=>'Eğitmenler','name'=>'ogretmenler','data'=> $form->parent(array('sql'=>"select * from ogretmen WHERE sil <> 1",'option'=>array('value'=>'id','title'=>'baslik'),'selected'=> ((isset($data['ogretmenler']) ? $data['ogretmenler'] :'')) ),0,0)));



        $text.= $form->closeBoxBody();
        $text.= $form->closeBox();

        $text.=$form->openBox().$form->openBoxBody();

        $text .= $form->input(array("required"=>true,'value'=>((isset($data['baslik']) ? $this->temizle($data['baslik']) :'')),'title'=>'Eğitim Adı','name'=>'baslik'));
        $text .= $form->input(array("required"=>true,'value'=>((isset($data['kod']) ? $this->temizle($data['kod']) :'')),'title'=>'Eğitim Kodu','name'=>'kod',"help"=>"Örneğin : DTK19-1"));
        $text .= $form->textEditor(array('value'=>((isset($data['detay']) ? $this->temizle($data['detay']) :'')),'title'=>'Detay','name'=>'detay','height' => '250'));
        $text.= $form->closeBoxBody();
        $text.= $form->closeBox();


        $text.= $form->closeDiv();

        $text.=$form->openColumn(3);
        $text.= $form->file(array('url'=>$this->BaseURL('upload')."/".$this->modulName,'folder'=>$this->modulName,'title'=>'Eğitim Resmi','name'=>'resim','resimBoyut'=>$this->settings->boyut($this->modulName),'src'=>((isset($data['resim'])) ? $data['resim'] :'')));

        $text.=$form->openBox().$form->openBoxBody();

        $text .= $form->checkbox(array('value'=>((isset($data['aktif'])) ? $this->temizle($data['aktif']) :''),'title'=>'Aktif','name'=>'aktif','help'=>'Onay Durumu', "checked"=>((isset($data["aktif"])) ? "" : "checked")));
        $text.= $form->closeBoxBody();

        $text .= $form->submitButton(array("color"=>"btn-success btn-block  btn-lg","icon"=>"fa fa-check", 'submit'=>($id) ? 'Güncelle':'Kaydet'));
        $text.= $form->closeBox();
        $text.= $form->closeDiv();
        $text .= $form->formClose();
        return $text;
    }

    public function kaydet($id=null)
    {



        foreach ($this->settings->lang('lang') as $dil=>$title):

            if($dil == "tr"):
                $post[$dil] = array(
                    'baslik'=> $this->kirlet($this->_POST('baslik')),
                    'kod'=> $this->kirlet($this->_POST('kod')),
                    'ozet'=>$this->kirlet($this->_POST('ozet')),
                    'detay'=>$this->kirlet($this->_POST('detay')),
                    'kontenjan'=>$this->_POST('kontenjan'),
                    'sure'=>$this->kirlet($this->_POST('sure')),
                    'egitim_gunleri'=>$this->kirlet($this->_POST('egitim_gunleri')),
                    'saat'=>$this->kirlet($this->_POST('saat')),
                    'yer'=>$this->kirlet($this->_POST('yer')),
                    'bitis'=>date('Y-m-d H:i', strtotime($this->_POST("bitis"))),
                    'baslangic'=>date('Y-m-d H:i', strtotime($this->_POST("baslangic"))),
                    'aktif'=> ($this->_POST('aktif')) ? $this->_POST('aktif'):0,
                    'ogretmenler'=>$this->arraytojson($this->_POST('ogretmenler')),
                    'fiyat'=>$this->returnDecimal($this->_POST('fiyat')),
                    'resim' => $this->_RESIM_BASE64('resim', $this->modulName),
                    'kid'=>($this->_POST('kid')) ? $this->_POST('kid'):0,
                    'ilk_satis'=>($this->_POST('ilk_satis')) ? $this->_POST('ilk_satis'):0,
                    'dil' => $dil,
                    'maksimum_alma'=>($this->_POST('maksimum_alma')) ? $this->_POST('maksimum_alma'):1
                );
            else:
                $post[$dil] = array(

                );
            endif;



        endforeach;




        if(isset($id) and $id):
            //Güncelle

            foreach ($this->settings->lang('lang') as $dil=>$title){
                $post[$dil]["duzenleme_tarihi"] = date("Y-m-d H:i:s");
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
            }

            $post["tr"]["sira"] = $this->Order($this->table);
            $this->dbConn->insert($this->table,$post['tr'],$id);
            $lastid = $this->dbConn->lastid();

            $this->dbConn->update($this->table, array(
                "url"=>strtolower($this->permalink($post["tr"]["baslik"]))."-".$lastid
            ),$lastid);

            foreach ($this->settings->lang('lang') as $dil=>$title):

                $post[$dil]["url"] = strtolower($this->permalink($post[$dil]["baslik"]))."-".$lastid;

                if (isset($post["ar"])){
                    $post["ar"]["url"] = isset($post["en"]) ? $post["en"]["url"] : $post["tr"]["url"];
                }

                if($dil!='tr') $this->dbConn->insert($this->tablelang,array_merge($post[$dil],array('dil'=>$dil,'master_id'=>$lastid)));

            endforeach;
        endif;
        $this->RedirectURL($this->BaseAdminURL($this->modulName.'/liste'.(($this->_POST('kid_tr')) ? "/".$this->_POST('kid_tr'):'')));
    }


    public function sil($id=null)
    {
        $this->RedirectURL($this->BaseAdminURL($this->modulName.'/liste'));
    }



    public function durum($id=null)
    {
        $durum = ((isset($_GET['durum'])) ? $_GET['durum'] : null);
        $id = ((isset($_GET['id'])) ? $_GET['id'] : null);
        $tr_duzenle = $this->dbConn->update($this->table,array('aktif'=>$durum),$id);
        //$lang_duzenle = $this->dbConn->langUpdate($this->tablelang,array('aktif'=>$durum),$id);

        if($tr_duzenle) echo 1; else echo 0;
        exit();
    }




}