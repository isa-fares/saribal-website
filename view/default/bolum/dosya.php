<?php
/* @var $this FrontClass object */
/* @var $param array */

list($genislik, $yukseklik) = explode(",", $param["boyutlar"]);
$type      =  $param["type"];
$data_id   =  $param["data_id"];
$katurl    =  (isset($param["katurl"])) ? $param["katurl"] : null;
$lang      =  $this->pageLang;

$klasor    =  (isset($param["klasor"])) ? $param["klasor"] : $param["type"];
$tur       =  (isset($param["tur"])) ? $param["tur"] : $param["type"];
$title     =  (isset($param["title"])) ? $param["title"] : "";
$grid_size =  (isset($param["grid_size"])) ? $param["grid_size"] : "col-lg-4";

$showSql   =  (isset($param["showSql"])) ? $param["showSql"] : "";

$pagination   =  (isset($param["pagination"])) ? $param["pagination"] : "";
$kayit        =  (isset($param["kayit"])) ? $param["kayit"] : "";
$pageUrl      =  (isset($param["pageUrl"])) ? $param["pageUrl"] : "";




$kosul     =  (isset($param["kosul"])) ? $param["kosul"] : '';
$hata      =  (isset($param["hata"])) ? $param["hata"] : '';
$limit     =  (isset($param["limit"])) ? "LIMIT ".$param["limit"] : '';


if (!stristr($katurl, strtolower("belge")) && !stristr($katurl, strtolower("certifi")) && !stristr($katurl, strtolower("sertifika"))  && !stristr($katurl, strtolower("document"))) {

$ek   =  ($kosul != "") ? "and $kosul" : '';
$query = "SELECT * FROM dosyalar WHERE type='$type' and data_id = {$data_id} and tur = 'resim' and lang = '".$lang."' and sil <> 1 $ek";

    if ($pagination){
        $toplam  = $this->sorgu($query);
        list($gecerli, $sayfaLimit, $toplamSayfa, $sayfa) = $this->sayfalama($toplam, $kayit);
        $resimSor  = $this->sorgu($query." ORDER BY sira ASC, id DESC LIMIT $gecerli, $sayfaLimit");
    }

    else {
        $resimSor = $this->sorgu($query." ORDER BY sira ASC, id DESC $limit");
    }

  if(is_array($resimSor)){
      $toplam = count($resimSor);
?>
      <div class="widget " style="padding: 0px 0px;">
<!--          <h4 class="widget-title widget-title-line-bottom line-bottom-theme-colored1">--><?//=$this->lang->genel("ekli_gorseller")?><!--</h4>-->
            <div class="row">





                              <?php
    $delay = 300;
    foreach ($resimSor as $veri):
    $resim  = $this->resimGet($veri['dosya']);
    if($resim and file_exists($this->settings->config('folder').$klasor."/".$resim)):
    $g_resim = $this->BaseURL($this->resimal($genislik,$yukseklik,$resim,$this->settings->config('folder').$klasor."/"));
    $b_resim = $this->BaseURL($this->resimal(0,1000,$resim,$this->settings->config('folder').$klasor."/"));
?>


<?php if ($tur == "sayfa"): ?>

        <div class="col-lg-6 col-md-4 col-6">
            <div class="project-item mrb-30 position-relative">
                <a href="<?=$b_resim?>" data-fancybox="gallery" data-src="<?=$b_resim?>" class="stretched-link"></a>
                <div class="project-thumb">
                    <img src="<?=$g_resim?>" alt="<?=$this->temizle($veri["baslik_$lang"])?>" class="img-full ">
                    <div class="link-single-page">
                        <span class="icon"><i class="ti-eye"></i></span>
                    </div>
                </div>
                <div class="project-content">
                    <h4><?=$this->temizle($veri["baslik_$lang"])?></h4>
                </div>
            </div>
        </div>



<?php endif; ?>



<?php if ($tur == "proje"): ?>

        <div class="col-lg-6 col-md-4 col-6">
            <div class="project-item mrb-30 position-relative">
                <a href="<?=$b_resim?>" data-fancybox="gallery" data-src="<?=$b_resim?>" class="stretched-link"></a>
                <div class="project-thumb">
                    <img src="<?=$g_resim?>" alt="<?=$this->temizle($veri["baslik_$lang"])?>" class="img-full ">
                    <div class="link-single-page">
                        <span class="icon"><i class="ti-eye"></i></span>
                    </div>
                </div>
                <div class="project-content">
                    <h4><?=$this->temizle($veri["baslik_$lang"])?></h4>
                </div>
            </div>
        </div>


<?php endif; ?>

<?php if ($tur == "etkinlik"): ?>
        <div class="col-lg-6 col-md-4 col-6">
            <div class="project-item mrb-30 position-relative">
                <a href="<?=$b_resim?>" data-fancybox="gallery" data-src="<?=$b_resim?>" class="stretched-link"></a>
                <div class="project-thumb">
                    <img src="<?=$g_resim?>" alt="<?=$this->temizle($veri["baslik_$lang"])?>" class="img-full ">
                    <div class="link-single-page">
                        <span class="icon"><i class="ti-eye"></i></span>
                    </div>
                </div>
                <div class="project-content">
                    <h4><?=$this->temizle($veri["baslik_$lang"])?></h4>
                </div>
            </div>
        </div>
<?php endif; ?>



        <?php if ($tur == "haber"): ?>
        <div class="col-lg-6 col-md-4 col-6">
            <div class="project-item mrb-30 position-relative">
                <a href="<?=$b_resim?>" data-fancybox="gallery" data-src="<?=$b_resim?>" class="stretched-link"></a>
                <div class="project-thumb">
                    <img src="<?=$g_resim?>" alt="<?=$this->temizle($veri["baslik_$lang"])?>" class="img-full ">
                    <div class="link-single-page">
                        <span class="icon"><i class="ti-eye"></i></span>
                    </div>
                </div>
                <div class="project-content">
                    <h4><?=$this->temizle($veri["baslik_$lang"])?></h4>
                </div>
            </div>
        </div>
    <?php endif; ?>


    <?php if ($tur == "duyuru"): ?>
        <div class="col-lg-6 col-md-4 col-6">
            <div class="project-item mrb-30 position-relative">
                <a href="<?=$b_resim?>" data-fancybox="gallery" data-src="<?=$b_resim?>" class="stretched-link"></a>
                <div class="project-thumb">
                    <img src="<?=$g_resim?>" alt="<?=$this->temizle($veri["baslik_$lang"])?>" class="img-full ">
                    <div class="link-single-page">
                        <span class="icon"><i class="ti-eye"></i></span>
                    </div>
                </div>
                <div class="project-content">
                    <h4><?=$this->temizle($veri["baslik_$lang"])?></h4>
                </div>
            </div>
        </div>
    <?php endif; ?>

        <?php if ($tur == "galeri"): ?>
                <div class="cmt-box-col-wrapper col-lg-4 col-md-6 col-sm-12 mb-10 foto-galeri-mobil-dd">
                    <!-- featured-imagebox -->
                        <div class="featured-imagebox featured-imagebox-portfolio style1" style="margin:0 0px;">
                            <!-- cmt-box-view-overlay -->
                            <div class="cmt-box-view-overlay">
                                <!-- featured-thumbnail -->
                                <div class="featured-thumbnail haber-resim">
                                    <img class="img-fluid" src="<?=$g_resim?>" alt="<?=$this->temizle($veri["baslik_$lang"])?>">
                                </div><!-- featured-thumbnail end-->
                                <div class="cmt-media-link">
                                    <a class="cmt_link"  style="line-height: 41px;color: #fff !important;" href="<?=$b_resim?>" data-fancybox="images">
                                        <i class="ti ti-plus"></i>
                                    </a>
                                </div>
                            </div><!-- cmt-box-view-overlay end-->
                        </div><!-- featured-imagebox -->
                </div>
    <?php endif; ?>






        <?php if ($tur == "kurs"): ?>
        <div class="col-lg-6 col-md-4 col-6">
            <div class="project-item mrb-30 position-relative">
                <a href="<?=$b_resim?>" data-fancybox="kurs" data-src="<?=$b_resim?>" class="stretched-link"></a>
                <div class="project-thumb">
                    <img src="<?=$g_resim?>" alt="<?=$this->temizle($veri["baslik_$lang"])?>" class="img-full ">
                    <div class="link-single-page">
                        <span class="icon"><i class="ti-eye"></i></span>
                    </div>
                </div>
                <div class="project-content">
                    <h4><?=$this->temizle($veri["baslik_$lang"])?></h4>
                </div>
            </div>
        </div>
    <?php endif; ?>



        <?php

$i++;
$delay = $delay + 30;
endif;
endforeach;

?>
        </div>
      </div>

<?php
      if ($pagination){
          echo "<div class='col-md-12'>";
          $this->sayfalamaButon(array(
              "toplamSayfa" => $toplamSayfa,
              "sayfa" => $sayfa,
              "pageURL" => $pageUrl,
          ));
          echo "</div>";
      }
}


}
?> 