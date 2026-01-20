<?php


namespace AdminPanel;


class Ogretmen  extends Settings{


    public  $modulName = 'ogretmen';

    private $table;
    private $tablelang;



    public function __construct($settings)
    {
        parent::__construct($settings);
        $this->AuthCheck();
        $this->table = $this->modulName;
        $this->tablelang = $this->modulName."_lang";
    }


    public function index($id)
    {
        return $this->liste($id);
    }

    public function liste($id=null)
    {


        list($sql, $showing, $toplamVeri) = $this->sayfalama(array(
            "table"=>$this->table,
            "search"=>array("baslik"),
        ));

        $this->SayfaBaslik = 'Eğitmenler';

        $pagelist = new PageList($this->settings);

        $filterURL = "/?cmd=".$this->modulName."/".__FUNCTION__;

        return $pagelist->PageList(array(
            'id'=>$id,
            'page'=>$this->table,
            "place"=>"ad soyad",
            "showing"=>$showing,
            "toplamVeri"=>$toplamVeri,
            "search"=>true,
            'button' => array(array('title'=>'Eğitmen Ekle','href'=>$this->BaseAdminURL($this->modulName.'/ekle'),"class"=>"btn btn-success")),
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
        $this->SayfaBaslik = 'Eğitmen '.(($id) ? "Düzenle" : "Ekle");
        $text = '';
        $tabForm = array();
        $form = new Form($this->settings);
        $tabs = new Tabs($this->settings);

        $text .= $form->formOpen(array('method'=>'POST','action'=> $this->BaseAdminURL($this->modulName.'/kaydet'.((isset($id)) ? '/'.$id :'')),'fileUpload'=>true,'id'=>'form_sample_3','class'=>''));
        $text .= $form->openColumn(8);

        if($id) $data = $tabs->tabData($this->table,$id);

        foreach ($this->settings->lang('lang') as $dil=>$title):
            $tabForm[$dil]['text']  = $form->input(array("required"=>array("tr"),'value'=>((isset($data[$dil]['baslik']) ? $this->temizle($data[$dil]['baslik']) :'')),'title'=>'Adı Soyadı','lang'=>$dil,'name'=>'baslik'));
            $tabForm[$dil]['text']  .= $form->input(array('value'=>((isset($data[$dil]['brans']) ? $this->temizle($data[$dil]['brans']) :'')),'title'=>'Branş','lang'=>$dil,'name'=>'brans'));
            $tabForm[$dil]['text'] .= $form->textEditor(array('value'=>((isset($data[$dil]['detay']) ? $this->temizle($data[$dil]['detay']) :'')),'title'=>'Biyoğrafi','name'=>'detay','lang'=>$dil,'height' => '150'));
        endforeach;

        $text .= $tabs->tabContent($tabForm);
        $text.=$form->openBox().$form->openBoxBody();
        $text .= $form->input(array("mask"=>"(999) 999 99 99", "icon"=>"fa  fa-phone", 'value'=>((isset($data["tr"]['telefon']) ? $this->temizle($data["tr"]['telefon']) :'')),'title'=>'Telefon Numarası','name'=>'telefon'));
        $text .= $form->input(array("icon"=>"fa  fa-envelope", 'value'=>((isset($data["tr"]['email']) ? $this->temizle($data["tr"]['email']) :'')),'title'=>'Email Adresi','name'=>'email'));
        $text .= $form->input(array("icon"=>"fa  fa-home", 'value'=>((isset($data["tr"]['adres']) ? $this->temizle($data["tr"]['adres']) :'')),'title'=>'Adres','name'=>'adres'));

        $text.= $form->closeDiv();
        $text.= $form->closeDiv();


        $text.= $form->closeDiv();

        $text.=$form->openColumn(4);
        $text.= $form->file(array("required"=>true, 'url'=>$this->BaseURL('upload')."/".$this->modulName,'folder'=>$this->modulName,'title'=>'Profil Resmi','name'=>'resim','resimBoyut'=>$this->settings->boyut($this->modulName),'src'=>((isset($data['tr']['resim'])) ? $data['tr']['resim'] :'')));
        $text.=$form->openBox().$form->openBoxBody();
        $text .= $form->input(array("icon"=>"fa  fa-facebook", 'value'=>((isset($data["tr"]['facebook']) ? $this->temizle($data["tr"]['facebook']) :'')),'title'=>'Facebook Profili','name'=>'facebook'));
        $text .= $form->input(array("icon"=>"fa  fa-twitter", 'value'=>((isset($data["tr"]['twitter']) ? $this->temizle($data["tr"]['twitter']) :'')),'title'=>'Twitter Profili','name'=>'twitter'));
        $text .= $form->input(array("icon"=>"fa  fa-instagram", 'value'=>((isset($data["tr"]['instagram']) ? $this->temizle($data["tr"]['instagram']) :'')),'title'=>'Instagram Profili','name'=>'instagram'));
        $text .= $form->checkbox(array('value'=>((isset($data["tr"]['aktif'])) ? $this->temizle($data["tr"]['aktif']) :''),'title'=>'Aktif','name'=>'aktif','help'=>'Onay Durumu', "checked"=>((isset($data["tr"]["aktif"])) ? "" : "checked")));
        $text.= $form->closeDiv();

        $text .= $form->submitButton(array("color"=>"btn-success btn-block btn-lg","icon"=>"fa fa-check", 'submit'=>($id) ? 'Güncelle':'Kaydet'));
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
                    'brans'=> $this->kirlet($this->_POST('brans',$dil)),
                    'detay'=>$this->kirlet($this->_POST('detay',$dil)),
                    'telefon'=>$this->kirlet($this->_POST('telefon')),
                    'email'=>$this->kirlet($this->_POST('email')),
                    'adres'=>$this->kirlet($this->_POST('adres')),
                    'facebook'=>$this->kirlet($this->_POST('facebook')),
                    'twitter'=>$this->kirlet($this->_POST('twitter')),
                    'instagram'=>$this->kirlet($this->_POST('instagram')),
                    'resim' => $this->_RESIM_BASE64('resim', $this->modulName),
                    'aktif'=> ($this->_POST('aktif')) ? $this->_POST('aktif'):0,
                    'dil' => $dil
                );
            else:
                $post[$dil] = array(
                    'baslik'=> $this->kirlet($this->_POST('baslik',$dil)),
                    'brans'=> $this->kirlet($this->_POST('brans',$dil)),
                    'detay'=>$this->kirlet($this->_POST('detay',$dil)),
                    'telefon'=>$this->kirlet($this->_POST('telefon')),
                    'email'=>$this->kirlet($this->_POST('email')),
                    'adres'=>$this->kirlet($this->_POST('adres')),
                    'facebook'=>$this->kirlet($this->_POST('facebook')),
                    'twitter'=>$this->kirlet($this->_POST('twitter')),
                    'instagram'=>$this->kirlet($this->_POST('instagram')),
                    'aktif'=> ($this->_POST('aktif')) ? $this->_POST('aktif'):0,
                    'dil' => $dil
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
        if ($id){
            $date = date("Y-m-d H:i:s");
            $this->dbConn->update($this->table, array("sil"=>1, "silme_tarihi"=>$date), array("id"=>$id));
            $this->dbConn->langUpdate($this->tablelang, array("sil"=>1, "silme_tarihi"=>$date), array("master_id"=>$id));
        }
        $this->RedirectURL($this->BaseAdminURL($this->modulName.'/liste'));
    }







    public function fotoekle($id=0)
    {


       $kat = $this->dbConn->tekSorgu("SELECT * FROM $this->table WHERE id = $id");

        if(isset($id) and $id) $urun = $this->dbConn->tekSorgu('select * from '.$this->table.' WHERE id='.$id);

        $baslik = $this->permalink($this->temizle($urun["baslik"]));

        $this->SayfaBaslik = $kat["baslik"].' / Resim Ekle';

        $pagelist = new Pagelist($this->settings);

        return $pagelist->Fotolist(array(
            'title'=> 'Resim Listesi',
            'id'=>$id,
            'page'=>'dosyalar',
            'pfolder'=>'../'.$this->settings->config('folder').$this->modulName."/",
            'p'=>array(
                array('class'=>'sort text-center','tabindex'=>0,'dataTitle'=>'sira'),
                array('dataTitle'=>'dosya', 'class'=>'sort'),
                array('dataTitle'=>'baslik', 'class'=>'sort')
            ),
            'tools' =>array(   array('title'=>'Düzenle','icon'=>'ti-pencil','url'=>$this->BaseAdminURL($this->modulName.'/fotoduzenle/'),'color'=>'btn-primary'),
                array("disable_delete"=>true,'title'=>'Sil','icon'=>'ti-close','url'=>$this->BaseAdminURL($this->modulName.'/fotosil/'),'color'=>'bg-maroon silButon')
            ),
            'yukle'=> array('type'=>'button','title'=>'Resim Ekle','class'=>'btn-primary btn-block btn-lg','modul'=>$this->modulName,'folder'=>'../'.$this->settings->config('folder').$this->modulName."/",'name'=>((isset($baslik)) ? $baslik:null)),

            'buton'=> array(
                array('type'=>'radio','dataname'=>'aktif','url'=>$this->BaseAdminURL($this->modulName.'/dosyaDurum/')),
            ),
            'pdata' => $this->dosyaAl(array(
                "type"=>$this->modulName,
                "data_id"=>$id,
            )),

            'baslik'=>array(
                array('title'=>'Sıra No','width'=>'8%'),
                array('title'=>'Resim','width'=>'10%'),
                array('title'=>'Başlık','width'=>'50%'),
                array('title'=>'Aktif','width'=>'5%'),

            )

        ));

    }

    public function fotosil($id=null)
    {
        $rec2 = $this->dbConn->tekSorgu("SELECT * FROM dosyalar WHERE id='$id'");

        $kid = $rec2['data_id'];
        $date = date("Y-m-d H:i:s");

        if($id) $this->dbConn->update("dosyalar", array("sil"=>1, "silme_tarihi"=>$date), array("id"=>$id));
        $this->RedirectURL($this->BaseAdminURL($this->modulName.'/fotoekle/'.$kid));
    }


    public function fotoduzenle($id=null)
    {
       
        if(isset($id) and $id) $urun = $this->dbConn->tekSorgu('select *, baslik as baslik_tr from dosyalar WHERE id='.$id);
        $text = '';
        $this->sayfaBaslik = 'Resim Düzenle';
        $form = new Form($this->settings);
        $text .= $form->formOpen(array('method'=>'POST','action'=>  $this->BaseAdminURL($this->modulName.'/fotokaydet'.((isset($id)) ? '/'.$id :'')),'fileUpload'=>true,'id'=>'form_sample_3','class'=>''));

        $text .= $form->openColumn(8);
        $text.=$form->openBox().$form->openBoxBody();

        foreach ($this->settings->lang('lang') as $dil=>$title):
            $text .= $form->input(array('value'=>((isset($urun['baslik_'.$dil]) ? $urun['baslik_'.$dil] :'')),'lang'=>$dil,'title'=>' <img src="'.$this->ThemeFile().'/assets/flags/'.$dil.'.png" width="25px" style="margin-right:10px;">Başlık','name'=>'baslik','id'=>'baslik'));
        endforeach;

        $text .= $form->submitButton(array("color"=>"btn-success btn-lg","icon"=>"fa fa-check", 'submit'=>($id) ? 'Güncelle':'Kaydet'));


        $text.="</div></div></div>";

        $text.= $form->openColumn(4);

        $text .= $form->file(array('url'=>$this->BaseURL('upload')."/".$this->modulName,'folder'=>$this->modulName,'title'=>'Resim','name'=>'fotoResim','resimBoyut'=>$this->settings->boyut($this->modulName."_foto"),'src'=>((isset($urun['dosya'])) ? $urun['dosya'] :'')));
        $text.= "</div>";

        $text .= $form->formClose();
        return $text;
    }

    public  function fotokaydet($id=null)
    {
        $post = array(
            'baslik'=> $this->_POST('baslik_tr'),
            'baslik_en'=> $this->_POST('baslik_en'),
            'baslik_ru'=> $this->_POST('baslik_ru'),
            'baslik_ar'=> $this->_POST('baslik_ar'),
            'dosya' => $this->_RESIM_BASE64('fotoResim', $this->modulName),
            'duzenleme_tarihi'=>date("Y-m-d H:i:s")
        );
        // Güncelle
        if(isset($id) and $id):
            $this->dbConn->update('dosyalar',$post,$id);
        endif;

        $fotoid = $this->dbConn->tekSorgu("select * from dosyalar where id='$id'");
        $this->RedirectURL($this->BaseAdminURL($this->modulName.'/fotoekle/'.$fotoid['data_id']));
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


    public function dosyaDurum($id=null)
    {
        $durum = ((isset($_GET['durum'])) ? $_GET['durum'] : null);

        $id = ((isset($_GET['id'])) ? $_GET['id'] : null);

        $tr_duzenle = $this->dbConn->update("dosyalar",array('aktif'=>$durum),$id);

        if($tr_duzenle) echo 1; else echo 0;

        exit();
    }




}