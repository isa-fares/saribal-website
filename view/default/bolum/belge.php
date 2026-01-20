<?
if (stristr($katurl, strtolower("belge")) || stristr($katurl, strtolower("certifi")) || stristr($katurl, strtolower("sertifika"))  || stristr($katurl, strtolower("document"))) {
    echo "<div class='row mt-30' style='margin-bottom: -30px'>";
    $kosul = "";
    $belge_kat = Request::GETURL("cat", "");
    if (!empty($belge_kat)) {
        $kosul .= " and kid = " . $belge_kat;
    }
    $belgeler = $this->dbLangSelect("belge", "aktif = 1 $kosul", "resim");
    if (is_array($belgeler)) {

        $boyutlar = $this->getmodulinfo("belge");
        foreach ($belgeler as $belge) {
            $t_resim = $this->dbResimAl($belge["resim"], "belge", $boyutlar["thumb"]);
            $b_resim = $this->dbResimAl($belge["resim"], "belge", $boyutlar["big"]);
        ?>
                <div class="col-lg-4 col-md-6">


                    <div class="portfolio mb-30">
                        <a href="<?=$b_resim?>" data-fancybox="certificate" data-src="<?=$b_resim?>" data-caption="<?=$this->temizle($belge["baslik"])?>">
                            <div class="portfolio__thumb pos-rel">
                                <img class="img-fluid" src="<?=$t_resim?>" alt="<?=$this->temizle($belge["baslik"])?>">
                            </div>
                            <div class="portfolio__text pos-abl text-center">
                                <div class="portfolio__icon">
                                    <span><i class="far fa-search"></i></span>
                                </div>
                                <? if (!empty($belge["baslik"])):?>
                                    <h3 class="mt-20"><?=$this->temizle($belge["baslik"])?></h3>
                                <? endif;?>
                            </div>
                        </a>
                    </div>

                </div>


<?
        }
    }else {
        echo "<div class='col-md-12'><div class='alert alert-warning text-center font-20 mb-30'>".$this->lang->genel("yapim")."</div></div> ";
    }

    echo "</div>";
}
?>
