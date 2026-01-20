<?php


namespace AdminPanel;


class Slayt  extends Settings{


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
            array("title" => "Slayt Listesi", "href" => "liste", "icon" => "mdi mdi-view-sequential"),
            array("title" => "Slayt Modül Ayarları", "href" => "settings", "icon" => "mdi mdi-settings")
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

        list($sql, $showing, $toplamVeri) = $this->sayfalama(array(
            "table"=>$this->table,
            "search"=>array("baslik", "ozet", "baslik2"),
        ));

        $this->SayfaBaslik = $this->modul_info["baslik"];

        $pagelist = new PageList($this->settings);

        $filterURL = "/?cmd=".$this->modulName."/".__FUNCTION__;


        $text = $pagelist->Tablist($this->tablist);

        $text .= $pagelist->PageList(array(
            'id'=>$id,
            'modul_id'=>$this->modul_info["id"],
            'modul_name'=>$this->modulName,
            'page'=>$this->table,
            "place"=>"slayt başlığı",
            "showing"=>$showing,
            "toplamVeri"=>$toplamVeri,
            'resim'=>true,
            "search"=>true,
            'button' => array(array('title'=>'Slayt Ekle','href'=>$this->BaseAdminURL($this->modulName.'/ekle'),"class"=>"btn btn-success")),
            'p'=>array(
                array('dataTitle'=>'link', 'class'=>'sort'),
            ),
            'tools' =>array(   array('title'=>'Düzenle','icon'=>'ti-pencil','url'=>$this->BaseAdminURL($this->modulName.'/ekle/'),'color'=>'btn-primary'),
                array("disable_delete"=>true,'title'=>'Sil','icon'=>'ti-close','url'=>$this->BaseAdminURL($this->modulName.'/sil/'),'color'=>'bg-maroon silButon')
            ),
            'buton'=> array(
                //array("disable_delete"=>true,'type'=>'button2','align'=>"center", 'title'=>'Ek Resimler','class'=>'btn bg-olive','dataname'=>'fotoekle','url'=>$this->BaseAdminURL('Resim/fotoekle/'), "data-icon"=>"ti-camera", "modul"=>$this->table),
                array('type'=>'radio','dataname'=>'aktif','url'=>$this->BaseAdminURL($this->modulName.'/durum/')),
            ),

            'pdata' => $this->dbConn->sorgu($sql),
            'baslik'=>array(
                array('title'=>'URL','width'=>'20%'),
                array('title'=>'Durum','width'=>'4%', "align"=>"center"),
            )
        ));

        return $text;

    }



    public function ekle($id=null)
    {
        $this->SayfaBaslik = 'Slayt'.(($id) ? " Düzenle" : " Ekle");
        $text = '';
        $tabForm = array();
        $form = new Form($this->settings);
        $tabs = new Tabs($this->settings);

        $text .= $form->formOpen(array('method'=>'POST','action'=> $this->BaseAdminURL($this->modulName.'/kaydet'.((isset($id)) ? '/'.$id :'')),'fileUpload'=>true,'id'=>'form_sample_3','class'=>''));
        $text .= $form->openColumn(8);

        if($id) $data = $tabs->tabData($this->table,$id);

        foreach ($this->settings->lang('lang') as $dil=>$title):
            $tabForm[$dil]['text']  = $form->input(array('yardim'=>"1. Satır Slogan", 'value'=>((isset($data[$dil]['baslik']) ? $this->temizle($data[$dil]['baslik']) :'')),'title'=>'1. Satır Slogan','lang'=>$dil,'name'=>'baslik'));

            $tabForm[$dil]['text']  .= $form->input(array('yardim'=>"2. Satır Slogan", 'value'=>((isset($data[$dil]['baslik2']) ? $this->temizle($data[$dil]['baslik2']) :'')),'title'=>'2. Satır Slogan','lang'=>$dil,'name'=>'baslik2'));

            $tabForm[$dil]['text'] .= $form->textarea(array('value'=>((isset($data[$dil]['ozet']) ? $this->temizle($data[$dil]['ozet']) :'')),'title'=>'3. Satır Slogan','name'=>'ozet','lang'=>$dil));

            //$tabForm[$dil]['text'] .= $form->textarea(array('value'=>((isset($data[$dil]['baslik2']) ? $this->temizle($data[$dil]['baslik2']) :'')),'title'=>'Detay','lang'=>$dil,'name'=>'baslik2', "max"=>500));
            //$tabForm[$dil]['text'] .= $form->openRow();
            //$tabForm[$dil]['text'] .= $form->closeRow();

            //$tabForm[$dil]['text']  .= $form->input(array('help'=>"Button üzerinde gözükecek yazı", 'value'=>((isset($data[$dil]['button']) ? $this->temizle($data[$dil]['button']) :'')),'title'=>'Button Yazısı','lang'=>$dil,'name'=>'button'));
            $tabForm[$dil]['text'] .= $form->input(array('yardim'=>"", 'icon'=>'fa fa-unlink','value'=>((isset($data[$dil]['link']) ? $this->temizle($data[$dil]['link']) :'')),'title'=>'Buton URL','lang'=>$dil,'name'=>'link', 'help'=>"Http dahil full url giriniz. Örneğin: ".$this->baseURL("iletisim.html")));
        endforeach;

        $text .= $tabs->tabContent($tabForm);


/*
        $text.=$form->openBox().$form->openBoxBody();

        $text.= $form->openRow();
        $text .= $form->color(array('value'=>((isset($data["tr"]['color1']) ? $this->temizle($data["tr"]['color1']) :'')),'title'=>'Yazı Rengi ','name'=>'color1','col'=>"6"));
        $text .= $form->color(array('value'=>((isset($data["tr"]['color2']) ? $this->temizle($data["tr"]['color2']) :'')),'title'=>'Yazı Rengi (2. Satır)','name'=>'color2','col'=>"6"));
        //$text .= $form->color(array('value'=>((isset($data["tr"]['color3']) ? $this->temizle($data["tr"]['color3']) :'')),'title'=>'Yazı Rengi (3. Satır)','name'=>'color3','col'=>"4"));

        $text.= $form->closeRow();
        $text .= $form->closeDiv();
        $text .= $form->closeDiv();*/

        $text .= $form->closeDiv();

        $text.=$form->openColumn(4);
        $text.= $form->file(array('url'=>$this->BaseURL('upload')."/".$this->modulName,'folder'=>$this->modulName,'title'=>'Slayt Resmi','name'=>'resim','resimBoyut'=>$this->modul_image_size($this->modul_info["id"]),'src'=>((isset($data['tr']['resim'])) ? $data['tr']['resim'] :'')));
        $text.=$form->openBox().$form->openBoxBody();

        $text .= $form->checkbox(array('value'=>((isset($data["tr"]['aktif'])) ? $this->temizle($data["tr"]['aktif']) :''),'title'=>'Aktif','name'=>'aktif','help'=>'Onay Durumu', "checked"=>((isset($data["tr"]["aktif"])) ? "" : "checked")));
        $text.= $form->closeDiv();

        $text .= $form->submitButton(array("color"=>"btn-success btn-block btn-lg","icon"=>"fa fa-check", 'submit'=>($id) ? 'Güncelle':'Kaydet'));
        $text .= $form->closeDiv();

        $text .=  $form->closeDiv();
        $text .= $form->formClose();


        return $text;
    }

    public function kaydet($id=null)
    {

        foreach ($this->settings->lang('lang') as $dil=>$title):

            if($dil == "tr"):
                $post[$dil] = array(
                    'baslik'=> $this->kirlet($this->_POST('baslik',$dil)),
                    'baslik2'=> $this->kirlet($this->_POST('baslik2',$dil)),
                    'button'=> $this->kirlet($this->_POST('button',$dil)),
                    'link'=> $this->kirlet($this->_POST('link',$dil)),
                    'ozet'=>$this->kirlet($this->_POST('ozet',$dil)),
                    'color1'=>$this->kirlet($this->_POST('color1')),
                    'color2'=>$this->kirlet($this->_POST('color2')),
                    'color3'=>$this->kirlet($this->_POST('color3')),
                    'detay'=>$this->kirlet($this->_POST('detay',$dil)),
                    'resim' => $this->_RESIM_BASE64('resim', $this->modulName, "","jpg",""),
                    'aktif'=> ($this->_POST('aktif')) ? $this->_POST('aktif'):0,
                    'dil' => $dil
                );
            else:
                $post[$dil] = array(
                    'baslik'=> $this->kirlet($this->_POST('baslik',$dil)),
                    'baslik2'=> $this->kirlet($this->_POST('baslik2',$dil)),
                    'ozet'=> $this->kirlet($this->_POST('ozet',$dil)),
                    'link'=> $this->kirlet($this->_POST('link',$dil)),
                    'detay'=> $this->kirlet($this->_POST('detay',$dil)),
                    'color1'=>$this->kirlet($this->_POST('color1')),
                    'color2'=>$this->kirlet($this->_POST('color2')),
                    'color3'=>$this->kirlet($this->_POST('color3')),
                    'aktif'=> ($this->_POST('aktif')) ? $this->_POST('aktif'):0,
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




}