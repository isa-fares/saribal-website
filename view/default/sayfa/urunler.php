<?php

/**
 * @var $this FrontClass|Loader object
 * @var $lang string
 * @var $assetURL string
 * @var $page string
 * @var $katurl string
 */

$table = "urun";
$sayfa = "urunler";
$kategoriTable = "kategori";

// Tüm kategorileri getir (ana ve alt kategoriler)
$tumKategoriler = $this->dbLangSelect($kategoriTable, "aktif = 1 and sil = 0", "", "", "ORDER BY sira ASC, id ASC");

// Ana kategorileri (ustu = 0 veya NULL) ve alt kategorileri ayır
$anaKategoriler = array();
$altKategoriler = array();

if (is_array($tumKategoriler)) {
    foreach ($tumKategoriler as $kat) {
        $katID = $this->getID($kat);
        $ustu = isset($kat['ustu']) ? intval($kat['ustu']) : 0;
        
        if ($ustu == 0 || $ustu == null) {
            // Ana kategori
            $anaKategoriler[$katID] = $kat;
            $anaKategoriler[$katID]['alt_kategoriler'] = array();
        } else {
            // Alt kategori
            $altKategoriler[$ustu][] = $kat;
        }
    }
    
    // Alt kategorileri ana kategorilere ekle
    foreach ($altKategoriler as $ustID => $altlar) {
        if (isset($anaKategoriler[$ustID])) {
            $anaKategoriler[$ustID]['alt_kategoriler'] = $altlar;
        }
    }
}

// Eğer katurl ve id varsa (kategori sayfası), o kategoriye ait ürünleri göster
// Eğer kid varsa, o kategoriye ait ürünleri göster
// Eğer ikisi de yoksa, ilk alt kategoriyi aktif yap
$seciliKategoriID = 0;
if (!empty($katurl) && $id > 0) {
    // URL'den gelen kategori ID'si
    $seciliKategoriID = intval($id);
} else if ($kid > 0) {
    // Direkt kid parametresi
    $seciliKategoriID = intval($kid);
} else {
    // Eğer hiçbir kategori seçilmemişse, ilk alt kategoriyi bul
    if (is_array($anaKategoriler) && count($anaKategoriler) > 0) {
        foreach ($anaKategoriler as $anaKat) {
            if (isset($anaKat['alt_kategoriler']) && is_array($anaKat['alt_kategoriler']) && count($anaKat['alt_kategoriler']) > 0) {
                // İlk alt kategoriyi bul
                $ilkAltKat = $anaKat['alt_kategoriler'][0];
                $seciliKategoriID = $this->getID($ilkAltKat);
                break; // İlk alt kategoriyi bulduktan sonra döngüden çık
            }
        }
    }
}

if ($seciliKategoriID > 0) {
    // Kategori sayfası - kategori bilgilerini al
    $kategoriVeri = $this->dbLangSelectRow($kategoriTable, array("id" => $seciliKategoriID, "master_id" => $seciliKategoriID));
    if (is_array($kategoriVeri)) {
        $baslik = $this->temizle($kategoriVeri["baslik"]);
        $this->sayfaBaslik = $this->temizle($kategoriVeri["baslik"]) . " - " . $this->ayarlar("title_" . $lang);
        $urunler = $this->dbLangSelect("urun", "aktif = 1 and sil = 0 and baslik <> '' and kid = " . $seciliKategoriID, "resim");
    } else {
        $baslik = "Ürünler";
        $this->sayfaBaslik = "Ürünler - " . $this->ayarlar("title_" . $lang);
        $urunler = $this->dbLangSelect("urun", "aktif = 1 and sil = 0 and baslik <> ''", "resim");
        $seciliKategoriID = 0;
    }
} else {
    // Ana ürünler sayfası - tüm ürünleri göster
    $baslik = "Ürünler";
    $this->sayfaBaslik = "Ürünler - " . $this->ayarlar("title_" . $lang);
    $urunler = $this->dbLangSelect("urun", "aktif = 1 and sil = 0 and baslik <> ''", "resim");
}

// Her kategori için ürün sayısını hesapla (tüm aktif ürünlerden)
$kategoriUrunSayisi = array();
$tumUrunlerSayisi = $this->dbLangSelect("urun", "aktif = 1 and sil = 0 and baslik <> ''", "resim");
if (is_array($tumUrunlerSayisi)) {
    foreach ($tumUrunlerSayisi as $urun) {
        $urunKid = isset($urun['kid']) ? intval($urun['kid']) : 0;
        if ($urunKid > 0) {
            if (!isset($kategoriUrunSayisi[$urunKid])) {
                $kategoriUrunSayisi[$urunKid] = 0;
            }
            $kategoriUrunSayisi[$urunKid]++;
        }
    }
}
?>
<div class="breadcrumb-area position-relative z-1">
    <img src="https://templates.envytheme.com/renius/default/assets/img/breadcrumb/br-line-shape.png"
        alt="Shape" class="br-line-shape position-absolute top-0 start-0 w-100 h-100 z-n1">
    <div class="container-fluid px-xxl-5">
        <div class="row">
            <div class="col-md-10 offset-md-1 text-center">
                <h2 class="section-title style-one fw-black text-white"><?php echo htmlspecialchars($baslik, ENT_QUOTES, 'UTF-8'); ?></h2>
                <ul class="br-menu list-unstyled">
                    <li><a href="<?php echo $this->BaseURL('index.html', $lang, 1); ?>"><img
                                src="https://templates.envytheme.com/renius/default/assets/img/icons/home-icon.svg"
                                alt="Icon">Anasayfa</a></li>
                    <li><a href="<?php echo $this->BaseURL($sayfa . '.html', $lang, 1); ?>">Ürünlerimiz</a></li>
                    <?php if ($seciliKategoriID > 0): ?>
                        <?php
                        $kategoriVeri = $this->dbLangSelectRow($kategoriTable, array("id" => $seciliKategoriID, "master_id" => $seciliKategoriID));
                        if (is_array($kategoriVeri)):
                            $kategoriBaslik = $this->temizle($kategoriVeri["baslik"]);
                        ?>
                            <li><?php echo htmlspecialchars($kategoriBaslik, ENT_QUOTES, 'UTF-8'); ?></li>
                        <?php endif; ?>
                    <?php else: ?>
                        <li><?php echo htmlspecialchars($baslik, ENT_QUOTES, 'UTF-8'); ?></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</div>



<div class="container ptb-120 product_lister">
    <div class="row">
        <div class="col-lg-3">
            <div class="sidebar-widget">
                <h3 class="sidebar-widget-title">Kategoriler</h3>
                <ul class="sidebar-widget-list">
                    <?php if (is_array($anaKategoriler) && count($anaKategoriler) > 0): ?>
                        <?php foreach ($anaKategoriler as $anaKat): ?>
                            <?php
                            $anaKatID = $this->getID($anaKat);
                            $anaKatBaslik = isset($anaKat['baslik']) ? $this->temizle($anaKat['baslik']) : '';
                            $anaKatURL = isset($anaKat['url']) ? $anaKat['url'] : '';
                            // URL zaten ID içeriyor (örn: 1000x1000-mm-6), direkt kullan
                            $anaKatLink = $this->BaseURL($sayfa . "/" . $anaKatURL, $lang, 1);
                            
                            ?>
                            <li>
                                <a href="<?php echo $anaKatLink; ?>" <?php echo ($seciliKategoriID == $anaKatID) ? 'class="active"' : ''; ?>>
                                    <?php echo $anaKatBaslik; ?>
                                </a>
                                <?php if (isset($anaKat['alt_kategoriler']) && is_array($anaKat['alt_kategoriler']) && count($anaKat['alt_kategoriler']) > 0): ?>
                                    <ul>
                                        <?php foreach ($anaKat['alt_kategoriler'] as $altKat): ?>
                                            <?php
                                            $altKatID = $this->getID($altKat);
                                            $altKatBaslik = isset($altKat['baslik']) ? $this->temizle($altKat['baslik']) : '';
                                            $altKatURL = isset($altKat['url']) ? $altKat['url'] : '';
                                            // URL zaten ID içeriyor (örn: 1000x1000-mm-6), direkt kullan
                                            $altKatLink = $this->BaseURL($sayfa . "/" . $altKatURL, $lang, 1);
                                            $altUrunSayisi = isset($kategoriUrunSayisi[$altKatID]) ? $kategoriUrunSayisi[$altKatID] : 0;
                                            ?>
                                            <li>
                                                <a href="<?php echo $altKatLink; ?>" <?php echo ($seciliKategoriID == $altKatID) ? 'class="active"' : ''; ?>>
                                                    <?php echo $altKatBaslik; ?>
                                                    <?php if ($altUrunSayisi > 0): ?>
                                                        <span>(<?php echo $altUrunSayisi; ?>)</span>
                                                    <?php endif; ?>
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li><a href="#">Kategori bulunamadı</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
        <!-- ürünleri listele -->
        <div class="col-lg-9">
            <?php if (is_array($urunler) && count($urunler) > 0): ?>
                <div class="row prd_lister">
                    <?php foreach ($urunler as $urun): ?>
                        <?php
                        $urunID = $this->getID($urun);
                        $urunBaslik = isset($urun['baslik']) ? $this->temizle($urun['baslik']) : '';
                        $urunResim = isset($urun['resim']) && !empty($urun['resim']) ? $urun['resim'] : '';
                        $urunYeni = isset($urun['yeni']) && $urun['yeni'] == 1 ? true : false;
                        $urunOzellikler = isset($urun['ozellikler']) && !empty($urun['ozellikler']) ? html_entity_decode($urun['ozellikler'], ENT_QUOTES, 'UTF-8') : '';
                        
                        // Resim URL'i oluştur - resimGet ve BaseURL kullan (orijinal boyutta)
                        $resimURL = '';
                        if (!empty($urunResim)) {
                            if (strpos($urunResim, 'data:image') === 0) {
                                // Base64 resim - direkt kullan
                                $resimURL = $urunResim;
                            } else {
                                // Normal resim dosyası - resimGet kullanarak orijinal boyutta
                                $resimDosya = $this->resimGet($urunResim);
                                if ($resimDosya && file_exists($this->settings->config('folder') . $table . "/" . $resimDosya)) {
                                    $resimURL = $this->BaseURL('upload/' . $table . '/' . $resimDosya);
                                } else {
                                    // Resim yoksa no-image göster
                                    $resimURL = $this->BaseURL('assets/img/no-image.jpg');
                                }
                            }
                        }
                        
                        // Özellikler JSON'unu parse et - jsonGet kullan
                        $ozelliklerData = null;
                        $dataColumns = '[]';
                        $dataRows = '[]';
                        if (!empty($urunOzellikler)) {
                            $ozelliklerData = $this->jsonGet($urunOzellikler);
                            if (is_array($ozelliklerData) && isset($ozelliklerData['kolonlar']) && isset($ozelliklerData['satirlar'])) {
                                $dataColumns = json_encode($ozelliklerData['kolonlar'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                                $dataRows = json_encode($ozelliklerData['satirlar'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                            }
                        }
                        
                        // Modal için data attribute'ları hazırla
                        $modalAttributes = '';
                        if (!empty($resimURL)) {
                            $modalAttributes .= ' data-img="' . htmlspecialchars($resimURL, ENT_QUOTES, 'UTF-8') . '"';
                        }
                        $modalAttributes .= ' data-code="' . htmlspecialchars($urunBaslik, ENT_QUOTES, 'UTF-8') . '"';
                        if (!empty($dataColumns) && $dataColumns != '[]') {
                            $modalAttributes .= ' data-columns=\'' . htmlspecialchars($dataColumns, ENT_QUOTES, 'UTF-8') . '\'';
                        }
                        if (!empty($dataRows) && $dataRows != '[]') {
                            $modalAttributes .= ' data-rows=\'' . htmlspecialchars($dataRows, ENT_QUOTES, 'UTF-8') . '\'';
                        }
                        ?>
                        <div class="col-lg-3 col-md-4 col-6">
                            <div class="product_item_card" <?php echo (!empty($modalAttributes)) ? 'data-bs-toggle="modal" data-bs-target="#productModal"' : ''; echo $modalAttributes; ?>>
                                <?php if ($urunYeni): ?>
                                    <span class="new">yeni</span>
                                <?php endif; ?>
                                <div class="pi_img">
                                    <?php if (!empty($resimURL)): ?>
                                        <img src="<?php echo htmlspecialchars($resimURL, ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($urunBaslik, ENT_QUOTES, 'UTF-8'); ?>">
                                    <?php else: ?>
                                        <img src="<?php echo $this->BaseURL('assets/img/no-image.jpg'); ?>" alt="<?php echo htmlspecialchars($urunBaslik, ENT_QUOTES, 'UTF-8'); ?>">
                                    <?php endif; ?>
                                </div>
                                <div class="pi_names">
                                    <span data-title="Ürünü İncele">
                                        <i><?php echo htmlspecialchars($urunBaslik, ENT_QUOTES, 'UTF-8'); ?></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="alert alert-info">
                    <p>Bu kategoride henüz ürün bulunmamaktadır.</p>
                </div>
            <?php endif; ?>
        </div>
        <!-- ürünleri listele -->
    </div>
</div>




<!-- ürün detay modal  en sonda olacak-->
<div class="modal fade" id="productModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ürün Teknik Detayı</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-5"><img id="mImg" src="" class="img-fluid border"></div>
                    <div class="col-md-7">
                        <p><strong id="mCode"></strong></p>
                        <!--<p><strong>Ölçü:</strong> <span id="mSize"></span></p>-->
                        <h3>Ürününe ait detaylı bilgiler</h3>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered mt-3">
                                <thead id="mHead" class="table-light"></thead>
                                <tbody id="mBody"></tbody>
                            </table>
                        </div>
                        <div class="modal_contact">
                            <p>Bu ürünle ilgili bilgi almak için bizimle iletişime geçebilirsiniz.</p>
                            <a href="#">İletişime Geçin <i class="fa-solid fa-arrow-right-long"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ürün detay modal -->