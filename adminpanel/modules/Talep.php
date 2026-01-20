<?php


namespace AdminPanel;


class Talep  extends Settings{


    public  $modulName;
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
            //array("title" => $this->modul_info["baslik"]." Listesi", "href" => "liste", "icon" => "mdi mdi-view-sequential"),
            array("title" => "Başvuru Listesi", "href" => "liste", "icon" => "mdi mdi-view-sequential"),
            //array("title" => $this->modul_info["baslik"]." Modül Ayarları", "href" => "settings", "icon" => "mdi mdi-settings"),
            //array("title" => "Yardım", "href" => "help", "icon" => "mdi mdi-comment-question-outline"),
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

        list($sql, $showing, $toplamVeri) = $this->sayfalama(array(
            "table"=>$this->table,
            "order"=>"ORDER BY goruldu ASC, tarih DESC",
            //"kosul"=>(isset($id)) ? "kid = ".$id : "",
            "search"=>array("adi", "email"),
            //"sqlEk"=>"(SELECT baslik FROM sayfakategori WHERE sayfakategori.id = ".$this->table.".kid) as kat_baslik"
        ));

        //$this->SayfaBaslik = $this->modul_info["baslik"]."  Listesi";
        $this->SayfaBaslik = "Üyelik Ön Başvuruları";

        $pagelist = new PageList($this->settings);

        $filterURL = "/?cmd=".$this->modulName."/".__FUNCTION__;


        $text = $pagelist->Tablist($this->tablist);

        $text .= $pagelist->PageList(array(
            //'flitpage' => array("url"=>$filterURL,"title"=>"Sayfa Kategorisi Seçiniz",'sql'=>"select * from sayfakategori ",'option'=>array('value'=>'id','title'=>'baslik'), "name"=>"sayfaFilter", "class"=>"flit_filter"),
            'id'=>$id,
            'modul_id'=>$this->modul_info["id"],
            'modul_name'=>$this->modulName,
            'page'=>$this->table,
            "place"=>"isim veya email adresi giriniz",
            "showing"=>$showing,
            "toplamVeri"=>$toplamVeri,
            "search"=>true,
            "goruldu"=>true,
            "disableSortable"=>true,
            //'button' => array(array('title'=>'Sayfa Ekle','href'=>$this->BaseAdminURL($this->modulName.'/ekle'),"class"=>"btn btn-success")),
            'p'=>array(
                array('dataTitle'=>'adi', 'class'=>'sort position-relative', "new"=>array("text"=>"Yeni", "badgeClass"=>"badge-danger", "kosul"=>"0", "sutun"=>"goruldu")),
                array('dataTitle'=>'telefon', 'class'=>'sort', "align"=>"center", "filter"=>"select"),
                array('dataTitle'=>'tarih', 'class'=>'sort', "type"=>"date", "dateFormat"=>"d.m.Y H:i"),
                array('dataTitle'=>'ip'),
            ),
            'tools' =>array(   array('title'=>'Gözat','icon'=>'ti-eye','url'=>$this->BaseAdminURL($this->modulName.'/ekle/'),'color'=>'btn-primary'),
                //array("disable_delete"=>true,'title'=>'Sil','icon'=>'ti-close','url'=>$this->BaseAdminURL($this->modulName.'/sil/'),'color'=>'bg-maroon silButon')
            ),
            'buton'=> array(
                //array("disable_delete"=>true,'type'=>'button2','align'=>"center", 'title'=>'Resim Ekle','class'=>'btn bg-olive','dataname'=>'fotoekle','url'=>$this->BaseAdminURL('Resim/fotoekle/'), "data-icon"=>"ti-camera", "modul"=>$this->table),
                //array('type'=>'radio','dataname'=>'aktif','url'=>$this->BaseAdminURL($this->modulName.'/durum/')),
            ),

            'pdata' => $this->dbConn->sorgu($sql),
            'baslik'=>array(
                array('title'=>'Adı Soyadı','width'=>'10%'),
                array('title'=>'Telefon','width'=>'10%'),
                array('title'=>'Başvuru Tarihi','width'=>'5%', ),
                array('title'=>'İp Adresi','width'=>'5%', ),
                //array('title'=>'Durum','width'=>'4%', "align"=>"center"),
            )
        ));

        return $text;

    }



    public function ekle($id=null)
    {
        $this->SayfaBaslik = 'Üyelik '.(($id) ? "Başvuru Detayı" : "Ekle");
        $text = '';


        if (empty($id)){
            $this->RedirectURL($this->BaseAdminURL("talep"));
        }
        $data = $this->dbConn->tekSorgu("SELECT * FROM $this->table WHERE id = $id");
        $this->dbConn->update($this->table, array("goruldu"=>1), $id);

        $form = new Form($this->settings);

        $text .= $form->formOpen(array('method'=>'POST','action'=> $this->BaseAdminURL($this->modulName.'/kaydet'.((isset($id)) ? '/'.$id :'')),'fileUpload'=>true,'id'=>'form_sample_3','class'=>''));
        $text .= $form->openColumn(6);

        $text.=$form->openBox().$form->openBoxBody();

        $text.='<table class="table table-striped table-bordered sorted_table ui-sortable">
                    <tbody>
                        <tr>
                            <th colspan="3" class="font-size-16">Başvuru Detayları  <a class="btn btn-primary pull-right" href="'.$this->BaseAdminURL("talep").'"><i class="fa fa-angle-left"></i> Geri Dön</a></th>
                        </tr>';

        $text.='<tr>
                    <td width="20%"><strong>Adı Soyadı</strong></td>
                    <td width="2%">:</td>
                    <td>'.$this->temizle($data["adi"]).'</td>
                </tr>';

        $text.='
                <tr>
                    <td width="20%"><strong>T.C. Kimlik No</strong></td>
                    <td width="2%">:</td>
                    <td>'.$this->temizle($data["tc"]).'</td>
                </tr>
                <tr>
                    <td width="20%"><strong>Telefon Numarası</strong></td>
                    <td width="2%">:</td>
                    <td>'.$this->temizle($data["telefon"]).'</td>
                </tr>
                <tr>
                    <td width="20%"><strong>Engellilik Oranı</strong></td>
                    <td width="2%">:</td>
                    <td>%'.$this->temizle($data["engellilik_orani"]).'</td>
                </tr>
                <tr>
                    <td width="20%"><strong>Mesajı</strong></td>
                    <td width="2%">:</td>
                    <td>'.$this->temizle($data["mesaj"]).'</td>
                </tr>
                <tr>
                    <td width="20%"><strong>Başvuru Tarihi</strong></td>
                    <td width="2%">:</td>
                    <td >'.$this->temizle($data["tarih"]).'</td>
                </tr>
                <tr>
                    <td width="20%"><strong>İp Adresi</strong></td>
                    <td width="2%">:</td>
                    <td>'.$data["ip"].'</td>
                </tr>';

        $text.='</tbody>
                </table>';


        $text.=$form->closeBoxBody();
        $text .="<div class='box-footer'>";
        $text.="<a class='btn btn-lg btn-success' href='".$this->BaseAdminURL("talep")."'><i class='fa fa-angle-left'></i> Geri Dön</a>";
        $text.="</div>";
        $text.=$form->closeBox();



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
                    'detay'=>$this->kirlet($this->_POST('detay',$dil)),
                    'resim' => $this->_RESIM_BASE64('SayfaResim', $this->modulName),
                    'aktif'=> ($this->_POST('aktif')) ? $this->_POST('aktif'):0,
                    'kid'=>($this->_POST('kid')) ? $this->_POST('kid'):0,
                    'dil' => $dil
                );
            else:
                $post[$dil] = array(
                    'baslik'=> $this->kirlet($this->_POST('baslik',$dil)),
                    'ozet'=>$this->kirlet($this->_POST('ozet',$dil)),
                    'detay'=>$this->kirlet($this->_POST('detay',$dil)),
                    'aktif'=> ($this->_POST('aktif')) ? $this->_POST('aktif'):0,
                    'kid'=>($this->_POST('kid')) ? $this->_POST('kid'):0,
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