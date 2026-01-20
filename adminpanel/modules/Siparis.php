<?php


namespace AdminPanel;


class Siparis  extends Settings{


    public  $modulName = 'siparis';
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

        $this->tablist = array(
            //array("title" => $this->modul_info["baslik"]." Listesi", "href" => "liste", "icon" => "mdi mdi-view-sequential"),
            //array("title" => "Sipariş Listesi", "href" => "liste", "icon" => "mdi mdi-view-sequential"),
            //array("title" => $this->modul_info["baslik"]." Modül Ayarları", "href" => "settings", "icon" => "mdi mdi-settings"),
            //array("title" => "Yardım", "href" => "help", "icon" => "mdi mdi-comment-question-outline"),
        );

    }


    public function index($id)
    {
        return $this->liste($id);
    }

    public function liste($id=null)
    {

        $kosul = "";

        if (isset($_GET["filter"])){
            $kosul = " 1 = 1";

            if (isset($_GET["user_id"]) && $_GET["user_id"] != ""){
                $kosul.=" and user_id = ".$_GET["user_id"];
            }

            if (isset($_GET["tur"]) && $_GET["tur"] != ""){
                $kosul.=" and tur = ".$_GET["tur"];
            }

            if (isset($_GET["islem"]) && $_GET["islem"] != 0){
                $kosul.=" and islem = ".$_GET["islem"];
            }

            if (isset($_GET["tema"]) && $_GET["tema"] != 0){
                $kosul.=" and tema = ".$_GET["tema"];
            }

            if (isset($_GET["iptal"]) && $_GET["iptal"] != 0){
                $kosul.=" and iptal = ".$_GET["iptal"];
            }

        }

        list($sql, $showing, $toplamVeri) = $this->sayfalama(array(
            "table"=>$this->table,
            "kosul"=>$kosul,
            "disable_delete"=>true,
            "order"=>"ORDER BY goruldu asc, id desc",
            "sqlEk"=>"(SELECT adi FROM uyeler WHERE uyeler.id = ".$this->table.".user_id ) as kullanici, (SELECT firma_adi FROM uyeler WHERE uyeler.id = ".$this->table.".user_id ) as firma_adi"
        ));

        $this->SayfaBaslik = 'Satışlar';

        $pagelist = new PageList($this->settings);

        $filterURL    = "/?cmd=".$this->modulName."/".__FUNCTION__;
        $katFilterUrl = "/?cmd=".$this->modulName."/".__FUNCTION__.((isset($id)) ? "/".$id : "");


        $text =  $pagelist->SiparisPageList(array(
            'id'=>$id,
            'disableSortable'=>true,
            'page'=>$this->table,
            'flitpageCustom' => array("url"=>$filterURL,"title"=>"Seçiniz",   'data'=>array(array("value"=>1, "title"=>"Onay Bekliyor"), array("value"=>2, "title"=>"Onaylandı"),array("value"=>3, "title"=>"İptal Edildi")),"name"=>"durumFilter", "class"=>"flit_filter"),


            //"place"=>"sipariş no",
            "showing"=>$showing,
            "toplamVeri"=>$toplamVeri,
            //"search"=>true,
            //'button' => array(array('title'=>'Satış Oluştur','href'=>$this->BaseAdminURL($this->modulName.'/olustur'),"class"=>"btn btn-success")),
            'p'=>array(
                array('class'=>'sort text-center position-relative','tabindex'=>0,'dataTitle'=>'tarih', "badge"=>"Yeni", "badgeClass"=>"badge-danger"),
                array('dataTitle'=>'firma_adi', 'class'=>'sort', "type"=>"kullanici", "ek"=>"kullanici"),
                array('dataTitle'=>'genel_toplam', 'class'=>'sort', "labelClass"=>"font-size-16 font-weight-700 text-info", "type"=>"fiyat"),
                array('dataTitle'=>'islem', 'class'=>'sort', "type"=>"odeme"),
            ),
            'tools' =>array(   array('title'=>'Satış Detayları','icon'=>'ti-eye','url'=>$this->BaseAdminURL($this->modulName.'/ekle/'),'color'=>'btn-primary'),
                //array("disable_delete"=>true,'title'=>'Sil','icon'=>'ti-close','url'=>$this->BaseAdminURL($this->modulName.'/sil/'),'color'=>'bg-maroon silButon')
            ),


            'pdata' => $this->dbConn->sorgu($sql),
            'baslik'=>array(
                array('title'=>'Tarih / Saat','width'=>'2%', "align"=>"center"),
                array('title'=>'Siparişi Veren','width'=>'10%'),
                array('title'=>'Satış Tutarı', 'width'=>"5%"),
                array('title'=>'Ödeme / İptal', 'width'=>"5%"),
            )

        ));


        $modal = new Widget($this->settings);
        $text .=  $modal->userModal(array(),"infoModal","Üye Bilgileri");
        return $text;



    }



    public function ekle($id=null)
    {
        $this->SayfaBaslik = "Satış Detayları";
        $text = '';
        $tabForm = array();
        $form = new Form($this->settings);

        $data = $this->dbConn->tekSorgu("SELECT * FROM siparis WHERE id = $id");

        $user = $this->dbConn->tekSorgu("SELECT * FROM uyeler WHERE id = {$data['user_id']}");



        $update = $this->dbConn->update("siparis", array("goruldu"=>1), $id);

        $text.="<div class='row'>";
        $text .= $form->openColumn(8);
        $text.=$form->openBox().$form->openBoxBody();
        $text.='<table class="table table-striped table-bordered sorted_table ui-sortable">
                    <tbody>
                        <tr>
                            <th colspan="3" class="font-size-16">
                            Sipariş Detayları
                            <a data-toggle="modal" data-target="#userDetay" class="btn btn-primary pull-right" href="#">
                            <i class="fa fa-users"></i> Kullanıcı Bilgileri</a></th>
                        </tr>';


            $text.='<tr>
                        <td width="15%"><strong>Firma Unvanı </strong></td>
                        <td width="2%">:</td>
                        <td width="width:83%">'.$this->temizle($user["firma_adi"]).' </td>
                    </tr>
                <tr>
                    <td width="15%"><strong>Adı Soyadı</strong></td>
                    <td width="2%">:</td>
                    <td width="width:83%">'.$this->temizle($user["adi"]).'</td>
                </tr>
                ';

        $text.='<tr>
                    <td width="15%"><strong>Telefon</strong></td>
                    <td width="2%">:</td>
                    <td width="width:83%">'.$this->temizle($user["telefon"]).'</td>
                </tr>';


        $text.= $this->temizle($data["detaylar"]);
        $text.='</tbody>
                </table>';


        $modal = new Widget($this->settings);
        $text .=  $modal->userDetay($data['user_id'], "userDetay");
        $text.= $form->closeDiv();
        $text.= $form->closeDiv();
        $text.= $form->closeDiv();

        $text.= $form->openColumn(4);
        $text.='<div class="box">
            <div class="box-header with-border">
                <h5 class="box-title" style="margin-bottom: 0px;">Ödeme Bilgileri</h5>';
            $text .= '<div class="box-controls pull-right">
                   <a href="#" data-toggle="modal" data-target="#errorDetail"  class="btn btn-sm btn-info">POS DETAYLARI</a>
                </div>';

        $text.='</div>
                <div class="box-content">
                    <div class="box-body">';

        $text.= '<table class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <th width="40%"><i class="fa fa-money"></i> Ödeme İşlemi</th>
                                <td>
                                <input type="hidden" name="eski_durum" value="'.$data["islem"].'">
                                <input type="hidden" name="eski_fiyat" value="'.$this->fiyatAl($data["genel_toplam"]).'">
                                <input type="hidden" name="siparisNo" value="'.$data["id"].'">
                                    <select name="islem" class="select2 islemDurum">
                                        <option value="1" '.(($data["islem"] == 1) ? "selected" : "").'>Ödeme Bekliyor</option>
                                        <option value="2" '.(($data["islem"] == 2) ? "selected" : "").'>Başarılı</option>
                                        <option value="3" '.(($data["islem"] == 3) ? "selected" : "").'>Hata</option>
                                    </select>
                                </td>
                            </tr>';


        $text.='<tr>
                    <th><i class="fa fa-try"></i> Tutar</th>
                    <td><input type="text"  class="form-control fiyatDurum" name="genel_toplam" value="'.$this->fiyatAl($data["genel_toplam"]).'"> </td>
                </tr>';


        $text.='<tr><td colspan="2">
                        <label class="font-size-16 font-weight-500">Satış Özeti</label><textarea style="resize:none" class="form-control mb-10" rows="5" name="siparis_ozet">'.$this->temizle($data["tarihce"]).'</textarea><button type="button" class="btn btn-primary pull-right siparisDurumGuncelle">Güncelle <i class="fa fa-refresh"></i></button>
                    </td></tr>';




        $text.= '</tbody></table>';

        if ($data["islem"] == 3){
            $text.= '<table class="table table-bordered table-striped">
                            <thead>
                                <tr><th colspan="2" class="text-center bg-pale-brown">Hata Detayları</th></tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th width="30%">Hata Mesajı</th>
                                    <td>'.$data["donen_baslik"].'</td>
                                </tr>
                                <tr>
                                    <th>Detay</th>
                                    <td>'.$data["donen_mesaj"].'</td>
                                </tr>
                            </tbody>
                        </table>';
        }







        $text.='</div></div></div>';

        $text.='<div class="box">
            <div class="box-header with-border">
                <h5 style="margin-bottom: 0px;">Satış İptali</h5>
                        </div>
                <div class="box-content">
                    <div class="box-body">';

        $text.="<table class='table table-striped table-bordered'>";
        $text.='<tr><td><input type="checkbox" '.(($data["iptal"] == 1) ? "checked" : "").' name="iptal" id="basic_checkbox_2" value="1" class="filled-in"/>
                            <label for="basic_checkbox_2" style="line-height: 20px;font-weight: 400;margin-bottom:0px;font-size: 15px;">Bu Satışı İptal Et</label>
                            <button type="button" class="ml-35 btn btn-primary iptalDurum">Güncelle <i class="fa fa-refresh"></i></button>
                            </td></tr>';
        $text.="</table>";

        $text.="</div></div></div>";


        $text .=  $modal->errorDetail(array("3d_sonuc"=>$data["3d_sonuc"], "pos_sonuc"=>$data["pos_sonuc"]), "errorDetail", array(""));


        $text.= $form->closeDiv();
        $text.= $form->closeDiv(); //CLOSE ROW
        return $text;
    }


    public function olustur($id=null)
    {
        $this->SayfaBaslik = 'Satış Oluştur';
        $text = '';

        $form = new Form($this->settings);


        $text .= $form->formOpen(array('method'=>'POST','action'=> $this->BaseAdminURL($this->modulName.'/kaydet'.((isset($id)) ? '/'.$id :'')),'fileUpload'=>false,'id'=>'form_sample_3','class'=>''));
        $text .= $form->openColumn(8);
        $text.=$form->openBox();
        $text.="<div class=\"box-header with-border\">
            <h5 style=\"margin-bottom: 0px;\">Satış Oluştur</h5>
                    </div>";
        $text.=$form->openBoxBody();

        $text .= $form->selectAjax(array('title'=>'Kullanıcı','name'=>'user_id', "place"=>"Kullanıcı Ara", "type"=>"search_user"));
        $text .= $form->selectAjax(array('title'=>'Eğitim','name'=>'kurs_id', "place"=>"Eğitim Ara", "type"=>"search_egitim"));
        $text .= $form->input(array("required"=>array("tr"),"icon" => "fa fa-try",'title'=>'Satış Tutarı','name'=>'genel_tutar'));
        $text.= $form->textarea(array('title'=>'Satış Özeti','name'=>'ozet'));

        $text.= $form->closeDiv();
        $text .= $form->submitButton(array("color"=>"btn-success  btn-lg","icon"=>"fa fa-check", 'submit'=>($id) ? 'Güncelle':'Kaydet'));
        $text.= $form->closeDiv();

        $text.= $form->closeDiv();
        $text .= $form->formClose();


        return $text;
    }

    public function kaydet($id=null)
    {

        $table = "siparis";

        $user_id = $this->_POST("user_id");

        $user = $this->dbConn->tekSorgu("SELECT * FROM uyeler WHERE id = $user_id");

        if (empty($user_id)){
            $this->setPanelMessage("error", "Kullanıcı Seçilmedi");
            $this->RedirectURL($this->BaseAdminURL($this->modulName.'/liste'));
            exit();
        }

        $post = array(
            'user_id'=> $user_id,
            "tarih"=>date("Y-m-d H:i:s"),
            "ip"=>$_SERVER["REMOTE_ADDR"],
            "tutar"=>$kurs["fiyat"],
            "kisi_sayisi"=>0,
            "tarihce"=>$this->kirlet($this->_POST("ozet")),
            "goruldu"=>0,
            'genel_tutar'=>0,
            "kurs_id"=>$kurs_id,
            "user_type"=>$user["tur"],
            "islem"=>2,
            "type"=>"success",
            "tur"=>2,
            'genel_tutar'=>$this->returnDecimal($this->_POST('genel_tutar')),
        );


        $last_id = $this->dbConn->insert($table, $post, true);

        $duzen = $this->dbConn->update($table,array("siparis_no"=>$this->siparisNo($last_id)), array("id"=>$last_id));

        if ($duzen){
            $this->setPanelMessage("success", "Manüel Satış Başarıyla Oluşturuldu");
            $this->RedirectURL($this->BaseAdminURL($this->modulName.'/liste'));
        }



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



    public function saveStudent()
    {


        if (isset($_POST["adi"])){

            $siparis_id = $this->_POST("siparis_id");
            $user_id    = $this->_POST("user_id");
            $kurs_id    = $this->_POST("kurs_id");
            $simdi =  date("Y-m-d H:i:s");


            $adi     = $this->_POST("adi");
            $telefon = $this->_POST("telefon");
            $email   = $this->_POST("email");
            $toplam  = count($adi);

            for ($i=0; $i<=$toplam; $i++){
                if ($adi[$i] != "" && $telefon[$i] != "" && $email[$i] != ""){
                    $this->dbConn->insert("kursiyerler",  array(
                        "adi_soyadi"=>$adi[$i],
                        "telefon"=>$telefon[$i],
                        "email"=>$email[$i],
                        "kurs_id"=>$kurs_id,
                        "user_id"=>$user_id,
                        "siparis_id"=>$siparis_id,
                        "islem_tarihi"=>$simdi
                    ));


                    $logText = "(Adı : $adi[$i], Telefon: $telefon[$i], Email: $email[$i]) katılımcı eklendi. Kurs ID: $kurs_id";

                    $this->islemLog($siparis_id, $logText);

                }
            }

            $this->setPanelMessage("success", "Katılımcılar Başarıyla Güncellendi");
            $this->satisGuncelle($kurs_id);

            $this->dbConn->update("siparis", array("kisi_sayisi"=>$this->toplamKursiyer($siparis_id)), $siparis_id); //SİPARİŞ TABLOSUNDAKİ KİŞİ SAYISINI GÜNCELLE

            $this->RedirectURL($this->BaseAdminURL($this->modulName.'/ekle/'.$siparis_id));

        }

        else{
            $this->RedirectURL($this->BaseAdminURL($this->modulName.'/liste'));
        }


    }




}