<?php

/**
 * Hata Sayfası (404 - Sayfa Bulunamadı)
 * 
 * Bu sayfa, bulunamayan sayfalar için gösterilir.
 * 
 * @var $this FrontClass|Loader object - Frontend sınıfı nesnesi
 * @var $lang string - Aktif dil kodu (tr, en, ar)
 * @var $assetURL string - Asset dosyalarının URL'i
 * @var $page string - Sayfa adı
 */

// ============================================
// SAYFA TANIMLAMALARI
// ============================================
$baslik = "Sayfa Bulunamadı";
$this->sayfaBaslik = "404 - Sayfa Bulunamadı - " . $this->ayarlar("title_" . $lang);

?>
<div class="breadcrumb-area position-relative z-1">
    <img src="https://templates.envytheme.com/renius/default/assets/img/breadcrumb/br-line-shape.png"
        alt="Shape" class="br-line-shape position-absolute top-0 start-0 w-100 h-100 z-n1">
    <div class="container-fluid px-xxl-5">
        <div class="row">
            <div class="col-md-10 offset-md-1 text-center">
                <h2 class="section-title style-one fw-black text-white"><?= $baslik ?></h2>
                <ul class="br-menu list-unstyled">
                    <li><a href="<?= $this->BaseURL('index.html', $lang, 1); ?>"><img
                                src="https://templates.envytheme.com/renius/default/assets/img/icons/home-icon.svg"
                                alt="Icon">Anasayfa</a></li>
                    <li><?= $baslik ?></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="container ptb-120">
    <div class="row">
        <div class="col-12 text-center">
            <div class="error-content">
                <h1 class="error-title" style="font-size: 120px; font-weight: 900; color: #333; margin-bottom: 20px;">404</h1>
                <h2 class="section-title style-one fw-black mb-30">Sayfa Bulunamadı</h2>
                <p class="mb-40" style="font-size: 18px; color: #666;">
                    Aradığınız sayfa mevcut değil veya taşınmış olabilir.<br>
                    Lütfen ana sayfaya dönerek tekrar deneyin.
                </p>
                <a href="<?= $this->BaseURL('index.html', $lang, 1); ?>" 
                   class="btn style-one d-inline-flex flex-wrap align-items-center p-0">
                    <span class="btn-text d-inline-block fw-semibold position-relative transition">Anasayfaya Dön</span>
                    <span class="btn-icon position-relative d-flex flex-column align-items-center justify-content-center rounded-circle transition">
                        <i class="fa-light fa-arrow-up-right"></i>
                    </span>
                </a>
            </div>
        </div>
    </div>
</div>
