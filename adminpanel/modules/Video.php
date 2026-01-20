<?php


namespace AdminPanel;


class Video  extends Settings{


    public  $modulName;
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


    }


    public function index($id)
    {
        $function = $this->getParameter()["function"];
        if (empty($function)){
            header("Location:".$this->baseAdminURL($this->modulName."/liste"));
        }
    }

    public function liste($id=null)
    {


        $kosul = "";



        if (!empty($id)){
            $kosul.=" seri = ".$id;
        }


        list($sql, $showing, $toplamVeri) = $this->sayfalama(array(
            "table"=>$this->table,
            "kosul"=>$kosul,
            "search"=>array("baslik"),
            "sqlEk"=>"(SELECT baslik FROM kategori WHERE kategori.id = ".$this->table.".seri) as kat_baslik"
        ));

        if ($id){
            $al = $this->dbConn->tekSorgu("SELECT * FROM kategori WHERE id = $id and sil <> 1");
            $this->SayfaBaslik = $this->temizle($al["baslik"]). " / Video Listesi";
        }else {
            $this->SayfaBaslik = 'Video Galeri';
        }




        $pagelist = new PageList($this->settings);

        $filterURL = "/?cmd=".$this->modulName."/".__FUNCTION__;

        return $pagelist->PageList(array(
            'id'=>$id,
            //'flitpage' => array("url"=>$filterURL,"title"=>"Seri Seçiniz",'sql'=>"select * from kategori WHERE sil <> 1 ",'option'=>array('value'=>'id','title'=>'baslik'), "name"=>"kategoriFilter", "class"=>"flit_filter"),
            'page'=>$this->table,
            "place"=>"başlık",
            "showing"=>$showing,
            "toplamVeri"=>$toplamVeri,
            "search"=>true,
            "resim"=>true,
            'button' => array(array('title'=>'Video Ekle', 'href'=>$this->BaseAdminURL($this->modulName.'/ekle&data_id='.$id),"class"=>"btn btn-success")),
            'p'=>array(
                array('class'=>'sort text-center','tabindex'=>0,'dataTitle'=>'id'),
                array('dataTitle'=>'baslik', 'class'=>'sort'),
            ),
            'tools' =>array(   array('title'=>'Düzenle','icon'=>'ti-pencil','url'=>$this->BaseAdminURL($this->modulName.'/ekle/'),'color'=>'btn-primary'),
                               array("disable_delete"=>true,'title'=>'Sil','icon'=>'ti-close','url'=>$this->BaseAdminURL($this->modulName.'/sil/'),'color'=>'bg-maroon silButon')
            ),
            'buton'=> array(
                array('type'=>'radio','dataname'=>'aktif','url'=>$this->BaseAdminURL($this->modulName.'/durum/')),
            ),

            'pdata' => $this->dbConn->sorgu($sql),
            'baslik'=>array(
                array('title'=>'ID','width'=>'2%', "align"=>"center"),
                array('title'=>'Başlık','width'=>'20%'),
                array('title'=>'Durum','width'=>'4%', "align"=>"center"),
            )

        ));



    }



    public function ekle($id=null)
    {
        $this->SayfaBaslik = 'Video Galeri '.(($id) ? "Düzenle" : "Ekle");
        $text = '';
        $tabForm = array();
        $form = new Form($this->settings);
        $tabs = new Tabs($this->settings);

        $data_id = $this->_GET("data_id");

        $text .= $form->formOpen(array('method'=>'POST','action'=> $this->BaseAdminURL($this->modulName.'/kaydet'.((isset($id)) ? '/'.$id :'')),'fileUpload'=>true,'id'=>'form_sample_3','class'=>''));
        $text .= $form->openColumn(8);

        if($id) $data = $tabs->tabData($this->table,$id);

        foreach ($this->settings->lang('lang') as $dil=>$title):
            $tabForm[$dil]['text']  = $form->input(array("id"=>"adres", 'button'=>array('class'=>'btn bg-olive verial','text'=>'Veri Al'),"required"=>array("tr"),'value'=>((isset($data[$dil]['adres']) ? $this->temizle($data[$dil]['adres']) :'')),'title'=>'Video Adresi','lang'=>$dil,'name'=>'adres', "help"=>" Vimeo , Youtube , Dailymotion , İzlesene , Vidivodo, Metacafe , Facebook, Vine, Twitch, Hürriyet TV ,Milli Gazete, Haber 7, İzleyin.com ,Mynet , Sabah , Akşam , Habertürk, Sözcü, Sinemalar, Beyazperde  sitelerinden otomatik veri çekilebilmektedir"));
            $tabForm[$dil]['text'] .= $form->input(array("id"=>"baslik", "required"=>array("tr"),'value'=>((isset($data[$dil]['baslik']) ? $this->temizle($data[$dil]['baslik']) :'')),'title'=>'Başlık','lang'=>$dil,'name'=>'baslik'));
            //$tabForm[$dil]['text'] .= $form->textarea(array("id"=>"ozet", 'value'=>((isset($data[$dil]['detay']) ? $this->temizle($data[$dil]['detay']) :'')),'title'=>'Detay','name'=>'ozet','lang'=>$dil, "height"=>200));
            $tabForm[$dil]['text'] .= $form->textarea(array("id"=>"embed", 'value'=>((isset($data[$dil]['embed']) ? $this->temizle($data[$dil]['embed']) :'')),'title'=>'Embed','name'=>'embed','lang'=>$dil, "height"=>100));
            //$tabForm[$dil]['text'] .= $form->input(array("showVideoImage"=>true,"class"=>"videoResimUrl","id"=>"videoResim", 'value'=>((isset($data[$dil]['videoresim']) ? $this->temizle($data[$dil]['videoresim']) :'')),'title'=>'Video Resim','lang'=>$dil,'name'=>'videoResim'));
        endforeach;

        $text .= $tabs->tabContent($tabForm);



        $text.= $form->closeDiv();
        $text .= $form->openColumn(4);

        $text.= $form->file(array('url'=>$this->BaseURL('upload')."/".$this->modulName,'folder'=>$this->modulName,'title'=>'Resim','name'=>'resim','resimBoyut'=>$this->modul_image_size($this->modul_info["id"]),'src'=>((isset($data['tr']['resim'])) ? $data['tr']['resim'] :'')));

        $text.=$form->openBox().$form->openBoxBody();
        /*
        if ($id) {
            $text .= $form->select(array('title' => 'Seri Grubu', 'name' => 'seri', 'data' => $form->parent(array('sql' => "select * from kategori WHERE sil <> 1", 'option' => array('value' => 'id', 'title' => 'baslik'), 'selected' => ((isset($data['tr']['seri'])) ? $data['tr']['seri'] : '')), 0, 0)));
        }else {
            $text .= $form->select(array('title' => 'Seri Grubu', 'name' => 'seri', 'data' => $form->parent(array('sql' => "select * from kategori WHERE sil <> 1", 'option' => array('value' => 'id', 'title' => 'baslik'), 'selected' => $data_id), 0, 0)));
        }
        */

        $text .= $form->checkbox(array('value'=>((isset($data["tr"]['aktif'])) ? $this->temizle($data["tr"]['aktif']) :''),'title'=>'Aktif','name'=>'aktif','help'=>'Onay Durumu', "checked"=>((isset($data["tr"]["aktif"])) ? "" : "checked")));
        $text .= $form->submitButton(array("color"=>"btn-success btn-lg","icon"=>"fa fa-check", 'submit'=>($id) ? 'Güncelle':'Kaydet'));


        $text.= $form->closeDiv();
        $text.= $form->closeDiv();

        /*
        $modal = new Widget($this->settings);
        $fileUpload = $modal->fileLoad(['name'=>'files','params' => array("file_type"=>"video", 'modul'=>$this->modulName,'folder'=>'../'.$this->settings->config('folder').$this->modulName.'/','baslik'=>'baslik_tr','id'=>$id),'sql'=>(($id) ? $this->dbConn->sorgu("select * from dosyalar where type='{$this->modulName}' and data_id='$id' and tur = 'dosya' ORDER BY sira"):array())]);
        $text .= $modal->infoform(array('title'=>'İndirilebilir Video Dosyası','govde'=>$fileUpload));
        */


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
                    'adres'=> $this->_POST('adres',$dil),
                    'videoresim'=> $this->_POST('videoResim',$dil),
                    'detay'=>$this->kirlet($this->_POST('ozet',$dil)),
                    'embed'=>$this->kirlet($this->_POST('embed',$dil)),
                    'dil'=>$dil,
                    'seri'=> ($this->_POST('seri')) ? $this->_POST('seri'):0,
                    'aktif'=> ($this->_POST('aktif')) ? $this->_POST('aktif'):0,
                    'resim' => $this->_RESIM_BASE64('resim', $this->modulName)
                );
            else:
                $post[$dil] = array(
                    'baslik'=> $this->kirlet($this->_POST('baslik',$dil)),
                    'adres'=> $this->_POST('adres',$dil),
                    'videoresim'=> $this->_POST('videoResim',$dil),
                    'seri'=> ($this->_POST('seri')) ? $this->_POST('seri'):0,
                    'detay'=>$this->kirlet($this->_POST('ozet',$dil)),
                    'aktif'=> ($this->_POST('aktif')) ? $this->_POST('aktif'):0,
                    'embed'=>$this->kirlet($this->_POST('embed',$dil)),
                    'dil'=>$dil
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

            // EKLE
            foreach ($this->settings->lang('lang') as $dil=>$title){
                $post[$dil]["eklenme_tarihi"] = date("Y-m-d H:i:s");
            }

            $post["tr"]["sira"] = $this->Order($this->table);
            $this->dbConn->insert($this->table,$post['tr'],$id);
            $lastid = $this->dbConn->lastid();

            $this->FileSessionSave($lastid,$this->modulName, "video");

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
        $this->RedirectURL($this->BaseAdminURL($this->modulName.'/liste'.(($this->_POST('seri')) ? "/".$this->_POST('seri'):'')));
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