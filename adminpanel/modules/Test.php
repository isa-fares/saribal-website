<?php


namespace AdminPanel;


class Test  extends Settings{


    public  $modulName;
    private $stable = "sorular";
    private $stablelang = "sorular_lang";
    private $table;
    private $tablelang;
    public  $tablist;
    public  $modul_info;



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
            array("title" => "Test Listesi", "href" => "liste", "icon" => "mdi mdi-view-sequential"),
            //array("title" => "Haberler Modül Ayarları", "href" => "settings", "icon" => "mdi mdi-settings")
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

        if (!empty($id)){
            $kosul = " kid = ".$id;
        }

        list($sql, $showing, $toplamVeri) = $this->sayfalama(array(
            "table"=>$this->table,
            "search"=>array("baslik", "ozet"),
            "kosul"=>$kosul,
            "order"=>"ORDER BY eklenme_tarihi DESC"
        ));

        $this->SayfaBaslik = $this->modul_info["baslik"];

        $pagelist = new PageList($this->settings);

        $filterURL = "/?cmd=".$this->modulName."/".__FUNCTION__;


        $text = $pagelist->Tablist($this->tablist);

        $text .= $pagelist->PageList(array(
            //'flitpage' => array("url"=>$filterURL,"title"=>"Test Kategorisi Seçiniz",'sql'=>"select * from haber_kategori",'option'=>array('value'=>'id','title'=>'baslik'), "name"=>"kategoriFilter", "class"=>"flit_filter"),
            'id'=>$id,
            'modul_id'=>$this->modul_info["id"],
            'modul_name'=>$this->modulName,
            'page'=>$this->table,
            "place"=>"kelime giriniz",
            "showing"=>$showing,
            //'resim'=>true,
            "toplamVeri"=>$toplamVeri,
            "disableSortable"=>true,
            "search"=>true,
            'button' => array(array('title'=>'Test Ekle','href'=>$this->BaseAdminURL($this->modulName.'/ekle'),"class"=>"btn btn-success")),
            'p'=>array(
                array('dataTitle'=>'baslik', 'class'=>'sort'),
            ),
            'tools' =>array(   array('title'=>'Düzenle','icon'=>'ti-pencil','url'=>$this->BaseAdminURL($this->modulName.'/ekle/'),'color'=>'btn-primary'),
                array("disable_delete"=>true,'title'=>'Sil','icon'=>'ti-close','url'=>$this->BaseAdminURL($this->modulName.'/sil/'),'color'=>'bg-maroon silButon')
            ),
            'buton'=> array(
                array("disable_delete"=>true,'type'=>'button2','align'=>"center", 'title'=>'Sorular','class'=>'btn bg-olive','url'=>$this->BaseAdminURL($this->modulName.'/Sorular/'), "data-icon"=>"fa fa-question"),
                //array("disable_delete"=>true,'type'=>'button2','align'=>"center", 'title'=>'Dosya Yükle','class'=>'btn btn-dark','dataname'=>'dosyaekle','url'=>$this->BaseAdminURL('Dosyalar/ekle/'), "data-icon"=>"ti-file", "modul"=>$this->table),
                array('type'=>'radio','dataname'=>'aktif','url'=>$this->BaseAdminURL($this->modulName.'/durum/')),
            ),

            'pdata' => $this->dbConn->sorgu($sql),
            'baslik'=>array(
                array('title'=>'Başlık','width'=>'20%'),
                array('title'=>'Sorular','width'=>'5%', "align"=>"center"),
                //array('title'=>'Dosyalar','width'=>'5%', "align"=>"center"),
                array('title'=>'Durum','width'=>'4%', "align"=>"center"),
            )
        ));

        return $text;

    }



    public function ekle($id=null)
    {
        $this->SayfaBaslik = 'Test '.(($id) ? "Düzenle" : "Ekle");
        $text = '';
        $tabForm = array();
        $form = new Form($this->settings);
        $tabs = new Tabs($this->settings);

        $text .= $form->formOpen(array('method'=>'POST','action'=> $this->BaseAdminURL($this->modulName.'/kaydet'.((isset($id)) ? '/'.$id :'')),'fileUpload'=>true,'id'=>'form_sample_3','class'=>''));

        $text .= $form->openColumn(8);

        if($id) $data = $tabs->tabData($this->table,$id);

        foreach ($this->settings->lang('lang') as $dil=>$title):
            $tabForm[$dil]['text']  = $form->input(array("required"=>array("tr"),'value'=>((isset($data[$dil]['baslik']) ? $this->temizle($data[$dil]['baslik']) :'')),'title'=>'Test Başlığı','lang'=>$dil,'name'=>'baslik'));
            //$tabForm[$dil]['text'] .= $form->input(array('yardim'=>"Markaya tıklanınca açılacak sayfanın urlsi", 'icon'=>'fa fa-unlink','value'=>((isset($data[$dil]['link']) ? $this->temizle($data[$dil]['link']) :'')),'title'=>'URL','lang'=>$dil,'name'=>'link', 'help'=>"Örneğin: ".$this->baseURL("iletisim.html")));
            //$tabForm[$dil]['text'] .= $form->textarea(array('value'=>((isset($data[$dil]['ozet']) ? $this->temizle($data[$dil]['ozet']) :'')),'title'=>'Özet','name'=>'ozet','lang'=>$dil));
            $tabForm[$dil]['text'] .= $form->textEditor(array('value'=>((isset($data[$dil]['detay']) ? $this->temizle($data[$dil]['detay']) :'')),'title'=>'Test Açıklamaları','name'=>'detay','lang'=>$dil,'height' => '183'));

        endforeach;

        $text .= $tabs->tabContent($tabForm);

        $text.=$form->openBox().$form->openBoxBody();
        $text.= $form->closeDiv();
        $text .= $form->submitButton(array("color"=>"btn-success  btn-lg","icon"=>"fa fa-check", 'submit'=>($id) ? 'Güncelle':'Kaydet'));
        $text.= $form->closeDiv();

        $text.= $form->closeDiv();


        $text .= $form->formClose();


        return $text;
    }

    public function kaydet($id=null)
    {

        foreach ($this->settings->lang('lang') as $dil=>$title):

            if($dil == "tr"):
                $post[$dil] = array(
                    'baslik'=> $this->kirlet($this->_POST('baslik',$dil)),
                    'ozet'=>$this->kirlet($this->_POST('ozet',$dil)),
                    //'link'=>$this->kirlet($this->_POST('link',$dil)),
                    'detay'=>$this->kirlet($this->_POST('detay',$dil)),
                    //'kurumlar' => $this->arraytojson($this->_POST('kurumlar')),
                    'tarih'=>date('Y-m-d', strtotime($this->_POST("tarih"))),
                    'resim' => $this->_RESIM_BASE64('resim', $this->modulName),
                    'aktif'=> ($this->_POST('aktif')) ? $this->_POST('aktif'):1,
                    'kid'=> ($this->_POST('kid')) ? $this->_POST('kid'):1,
                    'dil' => $dil
                );
            else:
                $post[$dil] = array(
                    'baslik'=> $this->kirlet($this->_POST('baslik',$dil)),
                    //'link'=>$this->kirlet($this->_POST('link',$dil)),
                    'tarih'=>date('Y-m-d', strtotime($this->_POST("tarih"))),
                    'ozet'=>$this->kirlet($this->_POST('ozet',$dil)),
                    'detay'=>$this->kirlet($this->_POST('detay',$dil)),
                    'aktif'=> ($this->_POST('aktif')) ? $this->_POST('aktif'):1,
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





    public function Sorular($id=null)
    {

        list($sql, $showing, $toplamVeri) = $this->sayfalama(array(
            "table"=>$this->stable,
            "kosul"=>(isset($id)) ? "parent_id = ".$id : "",
            "search"=>array("baslik"),
            "sqlEk"=>"(SELECT baslik FROM $this->table WHERE $this->table.id = ".$this->stable.".parent_id) as kat_baslik"
        ));

        //$this->SayfaBaslik = $this->modul_info["baslik"]."  Listesi";
        $this->SayfaBaslik = "Sorular Listesi";

        $pagelist = new PageList($this->settings);

        $filterURL = "/?cmd=".$this->modulName."/".__FUNCTION__;


        $text = $pagelist->Tablist($this->tablist);

        $text .= $pagelist->PageList(array(
            'flitpage' => array("url"=>$filterURL,"title"=>"Test Seçiniz",'sql'=>"select * from $this->table WHERE sil <> 1",'option'=>array('value'=>'id','title'=>'baslik'), "name"=>"sayfaFilter", "class"=>"flit_filter"),
            'id'=>$id,
            'modul_id'=>$this->modul_info["id"],
            'modul_name'=>$this->modulName,
            'page'=>$this->stable,
            "place"=>"sorularda ara",
            "showing"=>$showing,
            "toplamVeri"=>$toplamVeri,
            "search"=>true,
            'button' => array(array('id_enable'=>true,"id_name"=>"parent_id",'title'=>'Soru Ekle','href'=>$this->BaseAdminURL($this->modulName.'/Soruekle'),"class"=>"btn btn-success")),
            'p'=>array(
                array('dataTitle'=>'sira', 'class'=>'sort'),
                array('dataTitle'=>'baslik', 'class'=>'sort'),
                array('dataTitle'=>'kat_baslik', 'class'=>'sort', "align"=>"center", "filter"=>"select")
            ),
            'tools' =>array(   array('title'=>'Düzenle','icon'=>'ti-pencil','url'=>$this->BaseAdminURL($this->modulName.'/Soruekle/'),'color'=>'btn-primary'),
                array("disable_delete"=>true,'title'=>'Sil','icon'=>'ti-close','url'=>$this->BaseAdminURL($this->modulName.'/Sorusil/'),'color'=>'bg-maroon silButon')
            ),
            'buton'=> array(
                //array("disable_delete"=>true,'type'=>'button2','align'=>"center", 'title'=>'Resim Ekle','class'=>'btn bg-olive','dataname'=>'fotoekle','url'=>$this->BaseAdminURL('Resim/fotoekle/'), "data-icon"=>"ti-camera", "modul"=>$this->stable),
                //array("disable_delete"=>true,'type'=>'button2','align'=>"center", 'title'=>'Dosya Ekle','class'=>'btn btn-dark','dataname'=>'dosyaekle','url'=>$this->BaseAdminURL('Dosyalar/fotoekle/'), "data-icon"=>"ti-file", "modul"=>$this->stable),
                array('type'=>'radio','dataname'=>'aktif','url'=>$this->BaseAdminURL($this->modulName.'/Sorudurum/')),
            ),

            'pdata' => $this->dbConn->sorgu($sql),
            'baslik'=>array(
                array('title'=>'Sıra','width'=>'3%'),
                array('title'=>'Soru Adı','width'=>'20%'),
                array('title'=>'Bağlı Test','width'=>'20%'),
                //array('title'=>'Çoklu Resim','width'=>'5%', "align"=>"center"),
                //array('title'=>'Dosyalar','width'=>'5%', "align"=>"center"),
                array('title'=>'Durum','width'=>'4%', "align"=>"center"),
            )
        ));

        return $text;

    }




    public function Soruekle($id=null)
    {

        $parent_id = (isset($_GET["parent_id"])) ? $_GET["parent_id"] : null;


        $this->SayfaBaslik = 'Soru '.(($id) ? "Düzenle" : "Ekle");
        $text = '';
        $tabForm = array();
        $form = new Form($this->settings);
        $tabs = new Tabs($this->settings);

        $text .= $form->formOpen(array('method'=>'POST','action'=> $this->BaseAdminURL($this->modulName.'/Sorukaydet'.((isset($id)) ? '/'.$id :'')),'fileUpload'=>true,'id'=>'form_sample_3','class'=>''));
        $text .= $form->openColumn(8);

        if($id) $data = $tabs->tabData($this->stable,$id);

        foreach ($this->settings->lang('lang') as $dil=>$title):
            $tabForm[$dil]['text']  = $form->input(array("required"=>array("tr"),'value'=>((isset($data[$dil]['baslik']) ? $this->temizle($data[$dil]['baslik']) :'')),'title'=>'Soru','lang'=>$dil,'name'=>'baslik'));
            //$tabForm[$dil]['text'] .= $form->textarea(array('value'=>((isset($data[$dil]['ozet']) ? $this->temizle($data[$dil]['ozet']) :'')),'title'=>'Özet','name'=>'ozet','lang'=>$dil));
            $tabForm[$dil]['text'] .= $form->textEditor(array('value'=>((isset($data[$dil]['detay']) ? $this->temizle($data[$dil]['detay']) :'')),'title'=>'Soru Detayı','name'=>'detay','lang'=>$dil,'height' => '150'));


            $tabForm[$dil]['text'] .="<table class='table table-bordered'>";
            $tabForm[$dil]['text'] .="<thead><tr class='bg-pale-info'><th width='7%'>Şık</th><th width='80%'>Cevap</th><th>Doğru Cevap</th></tr></thead>";
            $tabForm[$dil]['text'] .="<tbody>";
            foreach ($this->settings->config("answers_options") as $option){
                $tabForm[$dil]['text'] .="<tr><td>".strtoupper($option)."</td><td><input type='text' value='".((isset($data[$dil]['cevap'.$option]) ? $this->temizle($data[$dil]['cevap'.$option]) :''))."' class='form-control' name='cevap".$option."_".$dil."'></td><td><input ".((isset($data[$dil]["dogru_cevap"]) && $data[$dil]["dogru_cevap"] == $option) ? "checked" : '')." name='dogru_cevap_".$dil."' type='radio' id='radio_d_".$option."_".$dil."' class='radio-col-blue with-gap' value='".$option."' required /><label for='radio_d_".$option."_".$dil."'>Evet</label></td></tr>";
            }

            $tabForm[$dil]['text'] .="</tbody>";
            $tabForm[$dil]['text'] .="</table>";

        endforeach;



        $text .= $tabs->tabContent($tabForm);

        $text.=$form->openBox().$form->openBoxBody();

        $text.= "<input type='hidden' name='parent_id' value='".$parent_id."'>";

        $text .= $form->checkbox(array('value'=>((isset($data["tr"]['aktif'])) ? $this->temizle($data["tr"]['aktif']) :''),'title'=>'Aktif','name'=>'aktif','help'=>'Onay Durumu', "checked"=>((isset($data["tr"]["aktif"])) ? "" : "checked")));
        $text.= $form->closeDiv();

        $text .= $form->submitButton(array("color"=>"btn-success  btn-lg","icon"=>"fa fa-check", 'submit'=>($id) ? 'Güncelle':'Kaydet'));
        $text.= $form->closeDiv();

        $text.= $form->closeDiv();
        $text .= $form->formClose();


        return $text;
    }





    public function Sorukaydet($id=null)
    {

        foreach ($this->settings->lang('lang') as $dil=>$title):

            if($dil == "tr"):
                $post[$dil] = array(
                    'baslik'=> $this->kirlet($this->_POST('baslik',$dil)),
                    'detay'=>$this->kirlet($this->_POST('detay',$dil)),
                    'parent_id'=> ($this->_POST('parent_id')) ? $this->_POST('parent_id'):1,
                    'cevapa'=> $this->kirlet($this->_POST('cevapa',$dil)),
                    'cevapb'=> $this->kirlet($this->_POST('cevapb',$dil)),
                    'cevapc'=> $this->kirlet($this->_POST('cevapc',$dil)),
                    'cevapd'=> $this->kirlet($this->_POST('cevapd',$dil)),
                    'dogru_cevap'=> $this->kirlet($this->_POST('dogru_cevap',$dil)),
                    'aktif'=> ($this->_POST('aktif')) ? $this->_POST('aktif'):0,
                    'dil' => $dil
                );
            else:
                $post[$dil] = array(
                    'baslik'=> $this->kirlet($this->_POST('baslik',$dil)),
                    'detay'=>$this->kirlet($this->_POST('detay',$dil)),
                    'parent_id'=> ($this->_POST('parent_id')) ? $this->_POST('parent_id'):1,
                    'cevapa'=> $this->kirlet($this->_POST('cevapa',$dil)),
                    'cevapb'=> $this->kirlet($this->_POST('cevapb',$dil)),
                    'cevapc'=> $this->kirlet($this->_POST('cevapc',$dil)),
                    'cevapd'=> $this->kirlet($this->_POST('cevapd',$dil)),
                    'aktif'=> ($this->_POST('aktif')) ? $this->_POST('aktif'):0,
                    'dogru_cevap'=> $this->kirlet($this->_POST('dogru_cevap',$dil)),
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


            $this->dbConn->update($this->stable,$post['tr'],$id);
            foreach ($this->settings->lang('lang') as $dil=>$title):
                if($dil!='tr') {
                    $post[$dil]["url"] = strtolower($this->permalink($post[$dil]["baslik"]))."-".$id;

                    if (isset($post["ar"])){
                        $post["ar"]["url"] = isset($post["en"]) ? $post["en"]["url"] : $post["tr"]["url"];
                    }

                    if(count($this->dbConn->sorgu("select lang_id from ".$this->stablelang." where dil='$dil'  and master_id='$id' "))==1)
                        $this->dbConn->update($this->stablelang, $post[$dil], array('master_id' => $id,'dil'=>$dil));
                    else
                        $this->dbConn->insert($this->stablelang,array_merge($post[$dil],array('master_id'=>$id)));
                }
            endforeach;

        else:

            // kaydet
            foreach ($this->settings->lang('lang') as $dil=>$title){
                $post[$dil]["eklenme_tarihi"] = date("Y-m-d H:i:s");
                $post[$dil]["ekleyen"] = $this->getUserInfo("adi");
            }

            $post["tr"]["sira"] = $this->Order($this->stable);
            $this->dbConn->insert($this->stable,$post['tr'],$id);
            $lastid = $this->dbConn->lastid();

            $this->dbConn->update($this->stable, array(
                "url"=>strtolower($this->permalink($post["tr"]["baslik"]))."-".$lastid
            ),$lastid);

            foreach ($this->settings->lang('lang') as $dil=>$title):

                $post[$dil]["url"] = strtolower($this->permalink($post[$dil]["baslik"]))."-".$lastid;

                if (isset($post["ar"])){
                    $post["ar"]["url"] = isset($post["en"]) ? $post["en"]["url"] : $post["tr"]["url"];
                }

                if($dil!='tr') $this->dbConn->insert($this->stablelang,array_merge($post[$dil],array('dil'=>$dil,'master_id'=>$lastid)));

            endforeach;
        endif;
        $this->RedirectURL($this->BaseAdminURL($this->modulName.'/Sorular'.(($this->_POST('parent_id')) ? "/".$this->_POST('parent_id'):'')));
    }






    public function Sorudurum($id=null)
    {
        $durum = ((isset($_GET['durum'])) ? $_GET['durum'] : null);
        $id = ((isset($_GET['id'])) ? $_GET['id'] : null);
        $tr_duzenle = $this->dbConn->update($this->stable,array('aktif'=>$durum),$id);
        $lang_duzenle = $this->dbConn->langUpdate($this->stablelang,array('aktif'=>$durum),$id);

        if($tr_duzenle && $lang_duzenle) echo 1; else echo 0;
        exit();
    }



}