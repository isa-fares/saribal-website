<?php

/**
 * Ürünler Listeleme Sayfası
 * 
 * Bu sayfa, kategorilere göre ürünleri listeler ve dinamik kategori yapısını gösterir.
 * 
 * @var $this FrontClass|Loader object - Frontend sınıfı nesnesi
 * @var $lang string - Aktif dil kodu (tr, en, ar)
 * @var $assetURL string - Asset dosyalarının URL'i
 * @var $page string - Sayfa adı
 * @var $katurl string - Kategori URL'i (URL'den gelen)
 */

// ============================================
// TABLO VE SAYFA TANIMLAMALARI
// ============================================
$table = "urun";              // Ürünler tablosu
$sayfaAdi = "urunler";        // Sayfa adı (URL için) - pagination için saklanıyor
$kategoriTable = "kategori";  // Kategoriler tablosu

// ============================================
// KATEGORİLERİ GETİR VE AYIR
// ============================================
// Tüm aktif kategorileri getir (ana ve alt kategoriler dahil)
$tumKategoriler = $this->dbLangSelect($kategoriTable, "aktif = 1 and sil = 0", "", "", "ORDER BY sira ASC, id ASC");

// Ana kategoriler (ustu = 0 veya NULL) ve alt kategoriler (ustu > 0) için diziler
$anaKategoriler = array();  // Ana kategoriler dizisi
$altKategoriler = array();  // Alt kategoriler dizisi (ana kategori ID'sine göre gruplanmış)

if (is_array($tumKategoriler)) {
    // Her kategoriyi kontrol et ve ana/alt kategori olarak ayır
    foreach ($tumKategoriler as $kat) {
        $katID = $this->getID($kat);  // Dil desteği ile ID al (getID fonksiyonu kullanılıyor)
        $ustu = isset($kat['ustu']) ? intval($kat['ustu']) : 0;  // Üst kategori ID'si

        if ($ustu == 0 || $ustu == null) {
            // Ana kategori (üst kategori yok)
            $anaKategoriler[$katID] = $kat;
            $anaKategoriler[$katID]['alt_kategoriler'] = array();  // Alt kategoriler için boş dizi hazırla
        } else {
            // Alt kategori (üst kategori var)
            $altKategoriler[$ustu][] = $kat;  // Üst kategori ID'sine göre grupla
        }
    }

    // Alt kategorileri ilgili ana kategorilere ekle
    foreach ($altKategoriler as $ustID => $altlar) {
        if (isset($anaKategoriler[$ustID])) {
            $anaKategoriler[$ustID]['alt_kategoriler'] = $altlar;
        }
    }
}

// ============================================
// SEÇİLİ KATEGORİYİ BELİRLE
// ============================================
// Hangi kategorinin seçili olduğunu belirle 
$seciliKategoriID = 0;

if (!empty($katurl) && $id > 0) {
    // Durum 1: URL'den kategori bilgisi geldi (örn: urunler/kategori-url-6.html)
    $seciliKategoriID = intval($id);
} else if ($kid > 0) {
    // Durum 2: Direkt kid parametresi var (GET parametresi)
    $seciliKategoriID = intval($kid);
} else {
    // Durum 3: Hiçbir kategori seçilmemişse, ilk alt kategoriyi varsayılan olarak seç
    if (is_array($anaKategoriler) && count($anaKategoriler) > 0) {
        foreach ($anaKategoriler as $anaKat) {
            // Ana kategorinin alt kategorileri var mı kontrol et
            if (isset($anaKat['alt_kategoriler']) && is_array($anaKat['alt_kategoriler']) && count($anaKat['alt_kategoriler']) > 0) {
                // İlk alt kategoriyi bul ve varsayılan olarak seç
                $ilkAltKat = $anaKat['alt_kategoriler'][0];
                $seciliKategoriID = $this->getID($ilkAltKat);
                break;
            }
        }
    }
}

// ============================================
// ÜRÜNLERİ GETİR (PAGINATION İÇİN TÜM ÜRÜNLER)
// ============================================
// Tüm ürünleri getir
$all_urunler = array();
$kategoriVeri = null; // Pagination için kategori verisini sakla

if ($seciliKategoriID > 0) {
    $kategoriVeri = $this->dbLangSelectRow($kategoriTable, array("id" => $seciliKategoriID, "master_id" => $seciliKategoriID));

    if (is_array($kategoriVeri)) {
        $baslik = $this->temizle($kategoriVeri["baslik"]);
        $this->sayfaBaslik = $this->temizle($kategoriVeri["baslik"]) . " - " . $this->ayarlar("title_" . $lang);
        $all_urunler = $this->dbLangSelect("urun", "aktif = 1 and sil = 0 and baslik <> '' and kid = " . $seciliKategoriID, "resim", "", "ORDER BY id DESC");
    } else {
        $baslik = "Ürünler";
        $this->sayfaBaslik = "Ürünler - " . $this->ayarlar("title_" . $lang);
        $all_urunler = $this->dbLangSelect("urun", "aktif = 1 and sil = 0 and baslik <> ''", "resim", "", "ORDER BY id DESC");
        $seciliKategoriID = 0;
        $kategoriVeri = null;
    }
} else {
    $baslik = "Ürünler";
    $this->sayfaBaslik = "Ürünler - " . $this->ayarlar("title_" . $lang);
    $all_urunler = $this->dbLangSelect("urun", "aktif = 1 and sil = 0 and baslik <> ''", "resim", "", "ORDER BY id DESC");
}

// ============================================
// PAGINATION AYARLARI 
// ============================================
$sayfaLimit = 12; // Her sayfada 12 ürün göster

// sayfalama fonksiyonunu kullan (blog.php'deki gibi)
list($gecerli, $sayfaLimit, $toplamSayfa, $sayfa, $showlist) = $this->sayfalama($all_urunler, $sayfaLimit);

// Pagination'a göre ürünleri kes (array_slice kullanarak)
$urunler = array_slice($all_urunler, $gecerli, $sayfaLimit);

// ============================================
// KATEGORİ BAŞINA ÜRÜN SAYISINI HESAPLA
// ============================================
$kategoriUrunSayisi = $this->getKategoriUrunSayisi($table);

?>
<div class="breadcrumb-area position-relative z-1">
    <img src="https://templates.envytheme.com/renius/default/assets/img/breadcrumb/br-line-shape.png"
        alt="Shape" class="br-line-shape position-absolute top-0 start-0 w-100 h-100 z-n1">
    <div class="container-fluid px-xxl-5">
        <div class="row">
            <div class="col-md-10 offset-md-1 text-center">
                <h2 class="section-title style-one fw-black text-white"><?= $baslik  ?></h2>
                <ul class="br-menu list-unstyled">
                    <li><a href="<?= $this->BaseURL('index.html', $lang, 1); ?>"><img
                                src="https://templates.envytheme.com/renius/default/assets/img/icons/home-icon.svg"
                                alt="Icon">Anasayfa</a></li>
                    <li><a href="<?= $this->BaseURL($sayfaAdi . '.html', $lang, 1); ?>">Ürünlerimiz</a></li>
                    <?php if ($seciliKategoriID > 0): ?>
                        <?php
                        $kategoriVeri = $this->dbLangSelectRow($kategoriTable, array("id" => $seciliKategoriID, "master_id" => $seciliKategoriID));
                        if (is_array($kategoriVeri)):
                            $kategoriBaslik = $this->temizle($kategoriVeri["baslik"]);
                        ?>
                            <li><?= $kategoriBaslik ?></li>
                        <?php endif; ?>
                    <?php else: ?>
                        <li><?= $baslik ?></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</div>



<div class="container ptb-120 product_lister">
    <div class="row">
        <div class="col-lg-3">
            <?php
            // ============================================
            // SIDEBAR İÇİN VERİ HAZIRLAMA
            // ============================================
            // sidebar.php için gerekli parametreleri hazırla
            $sidebarParam = array(
                "anaKategoriler" => $anaKategoriler,        // Ana kategoriler listesi (alt_kategoriler içerir)
                "seciliKategoriID" => $seciliKategoriID,   // Seçili kategori ID'si
                "sayfa" => $sayfaAdi,                      // Sayfa adı: "urunler"
                "lang" => $lang,                            // Aktif dil
                "kategoriUrunSayisi" => $kategoriUrunSayisi // Her kategori için ürün sayısı dizisi
            );

            // sidebar.php dosyasını kullan
            $this->sidebar($sidebarParam);
            ?>
        </div>
        <!-- ürünleri listele -->
        <div class="col-lg-9">
            <?php if (is_array($urunler) && count($urunler) > 0): ?>
                <div class="row prd_lister">
                    <?php foreach ($urunler as $urun): ?>
                        <?php
                        // ============================================
                        // ÜRÜN BİLGİLERİNİ HAZIRLA
                        // ============================================
                        $urunID = $this->getID($urun);  // Dil desteği ile ID al
                        $urunBaslik = isset($urun['baslik']) ? $this->temizle($urun['baslik']) : '';
                        $urunResim = isset($urun['resim']) && !empty($urun['resim']) ? $urun['resim'] : '';
                        $urunYeni = isset($urun['yeni']) && $urun['yeni'] == 1 ? true : false;  // "Yeni" ürün mü?
                        $urunOzellikler = isset($urun['ozellikler']) && !empty($urun['ozellikler']) ? html_entity_decode($urun['ozellikler'], ENT_QUOTES, 'UTF-8') : '';

                        // ============================================
                        // RESİM URL'İNİ OLUŞTUR (ORİJİNAL BOYUTTA)
                        // ============================================
                        $resimURL = '';
                        if (!empty($urunResim)) {
                            if (strpos($urunResim, 'data:image') === 0) {
                                // Base64 formatında resim (doğrudan kullan)
                                $resimURL = $urunResim;
                            } else {
                                // Normal resim dosyası: resimGet ile işle ve orijinal boyutta göster
                                $resimDosya = $this->resimGet($urunResim);  // JSON formatını parse et
                                if ($resimDosya && file_exists($this->settings->config('folder') . $table . "/" . $resimDosya)) {
                                    // Resim dosyası mevcut: BaseURL ile link oluştur
                                    $resimURL = $this->BaseURL('upload/' . $table . '/' . $resimDosya);
                                } else {
                                    // Resim dosyası yok: Varsayılan resim göster
                                    $resimURL = $this->BaseURL('assets/img/no-image.jpg');
                                }
                            }
                        }

                        // ============================================
                        // ÜRÜN ÖZELLİKLERİNİ PARSE ET (JSON)
                        // ============================================
                        // Dinamik tablo için kolon ve satır verilerini hazırla
                        $ozelliklerData = null;
                        $dataColumns = '[]';  // Modal için kolonlar (JSON string)
                        $dataRows = '[]';     // Modal için satırlar (JSON string)

                        if (!empty($urunOzellikler)) {
                            // JSONGet fonksiyonu ile JSON'u parse et
                            $ozelliklerData = $this->jsonGet($urunOzellikler);

                            if (is_array($ozelliklerData) && isset($ozelliklerData['kolonlar']) && isset($ozelliklerData['satirlar'])) {
                                // Kolon ve satır verilerini JSON string'e çevir (Modal için)
                                $dataColumns = json_encode($ozelliklerData['kolonlar'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                                $dataRows = json_encode($ozelliklerData['satirlar'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                            }
                        }

                        // ============================================
                        // MODAL İÇİN DATA ATTRIBUTE'LARINI HAZIRLA
                        // ============================================
                        // Bootstrap Modal'a gönderilecek veriler
                        $modalAttributes = '';

                        if (!empty($resimURL)) {
                            $modalAttributes .= ' data-img="' . htmlspecialchars($resimURL, ENT_QUOTES, 'UTF-8') . '"';
                        }
                        $modalAttributes .= ' data-code="' . htmlspecialchars($urunBaslik, ENT_QUOTES, 'UTF-8') . '"';

                        // Özellikler varsa modal'a ekle
                        if (!empty($dataColumns) && $dataColumns != '[]') {
                            $modalAttributes .= ' data-columns=\'' . htmlspecialchars($dataColumns, ENT_QUOTES, 'UTF-8') . '\'';
                        }
                        if (!empty($dataRows) && $dataRows != '[]') {
                            $modalAttributes .= ' data-rows=\'' . htmlspecialchars($dataRows, ENT_QUOTES, 'UTF-8') . '\'';
                        }
                        ?>
                        <!-- Ürün kartı -->
                        <div class="col-lg-3 col-md-4 col-6">
                            <div class="product_item_card" <?php echo (!empty($modalAttributes)) ? 'data-bs-toggle="modal" data-bs-target="#productModal"' : '';
                                                            echo $modalAttributes; ?>>
                                <!-- "Yeni" etiketi (eğer ürün yeni ise) -->
                                <?php if ($urunYeni): ?>
                                    <span class="new">yeni</span>
                                <?php endif; ?>

                                <!-- Ürün resmi -->
                                <div class="pi_img">
                                    <?php if (!empty($resimURL)): ?>
                                        <img src="<?php echo htmlspecialchars($resimURL, ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($urunBaslik, ENT_QUOTES, 'UTF-8'); ?>">
                                    <?php else: ?>
                                        <!-- Resim yoksa varsayılan resim göster -->
                                        <img src="<?php echo $this->BaseURL('assets/img/no-image.jpg'); ?>" alt="<?php echo htmlspecialchars($urunBaslik, ENT_QUOTES, 'UTF-8'); ?>">
                                    <?php endif; ?>
                                </div>

                                <!-- Ürün adı/kodu -->
                                <div class="pi_names">
                                    <span data-title="Ürünü İncele">
                                        <i><?php echo htmlspecialchars($urunBaslik, ENT_QUOTES, 'UTF-8'); ?></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <!-- Pagination -->
                <?php if ($toplamSayfa > 1): ?>
                    <div class="row mt-50">
                        <div class="col-12">
                            <div class="pagination-wrapper text-center">
                                <?php
                                // Pagination URL'i hazırla
                                // BaseURL($url, $lang, 1) otomatik olarak .html ekler
                                // sayfalama.php /2 ekler, bu yüzden URL format: urunler.html/2 olmalı
                                $pageURL = $this->BaseURL($sayfaAdi, $lang, 1);
                                
                                if ($seciliKategoriID > 0 && isset($kategoriVeri) && is_array($kategoriVeri)) {
                                    $kategoriURL = isset($kategoriVeri['url']) ? $kategoriVeri['url'] : '';
                                    if (!empty($kategoriURL)) {
                                        // Kategori URL format: urunler/kategori-url.html/2
                                        // BaseURL otomatik olarak .html ekler
                                        $pageURL = $this->BaseURL($sayfaAdi . "/" . $kategoriURL, $lang, 1);
                                    }
                                }
                                
                                $this->sayfalamaButon(array(
                                    "toplamSayfa" => $toplamSayfa,
                                    "sayfa" => $sayfa,  // $sayfa burada pagination sayfa numarası (1, 2, 3...)
                                    "pageURL" => $pageURL,
                                ));
                                ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
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
                    <div class="col-md-5"><img id="mImg" src="" class="img-fluid "></div>
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

<script>
    /**
     * Ürün Detay Modal JavaScript
     * 
     * Bu script, ürün kartlarına tıklandığında Modal'ı açar ve dinamik tablo verilerini gösterir.
     * Veriler data-attributes üzerinden gelir:
     * - data-img: Ürün resmi URL'i
     * - data-code: Ürün kodu
     * - data-columns: Tablo kolonları (JSON string)
     * - data-rows: Tablo satırları (JSON string - nesne dizisi)
     */
    document.addEventListener('DOMContentLoaded', function() {
        const modalElement = document.getElementById('productModal');

        // Modal elementi yoksa çık
        if (!modalElement) return;

        const bsModal = new bootstrap.Modal(modalElement);

        // Modal açıldığında verileri yükle
        modalElement.addEventListener('show.bs.modal', function(e) {
            let btn = e.relatedTarget;

            // Eğer btn yoksa ve URL'de hash varsa, hash'ten bul
            if (!btn && window.location.hash) {
                const hash = decodeURIComponent(window.location.hash.substring(1));
                btn = document.querySelector(`.product_item_card[data-code="${hash}"]`);
            }

            // Hala btn yoksa çık
            if (!btn) return;

            // Ürün kodu ve resim URL'ini al
            const code = btn.getAttribute('data-code');
            window.location.hash = code;

            // Resim URL'ini al ve göster
            const imgSrc = btn.getAttribute('data-img');
            document.getElementById('mImg').src = imgSrc || '';
            document.getElementById('mCode').textContent = code || '';

            // Kolon ve satır verilerini al
            const colsAttr = btn.getAttribute('data-columns');
            const rowsAttr = btn.getAttribute('data-rows');

            // Tablo başlığını ve gövdesini hazırla
            const thead = document.getElementById('mHead');
            const tbody = document.getElementById('mBody');

            // Eğer kolon ve satır verileri varsa tabloyu oluştur
            if (colsAttr && rowsAttr && colsAttr !== '[]' && rowsAttr !== '[]') {
                try {
                    // JSON string'leri parse et
                    const cols = JSON.parse(colsAttr);
                    const rows = JSON.parse(rowsAttr);

                    // Kolon başlıklarını oluştur
                    thead.innerHTML = '<tr>' + cols.map(c => `<th>${c}</th>`).join('') + '</tr>';

                    // Satırları oluştur
                    // rows bir dizi nesne olduğu için, her nesneyi kolon sırasına göre diziye çevir
                    tbody.innerHTML = rows.map(row => {
                        // Her satır bir nesne, kolon sırasına göre değerleri al
                        const cells = cols.map(col => {
                            // Kolon adına göre değeri al, yoksa boş string
                            return row[col] || '';
                        });
                        return `<tr>${cells.map(cell => `<td>${cell}</td>`).join('')}</tr>`;
                    }).join('');
                } catch (e) {
                    console.error('Tablo verisi parse edilemedi:', e);
                    thead.innerHTML = '';
                    tbody.innerHTML = '<tr><td colspan="100%" class="text-center">Veri yüklenemedi</td></tr>';
                }
            } else {
                // Veri yoksa boş tablo göster
                thead.innerHTML = '';
                tbody.innerHTML = '<tr><td colspan="100%" class="text-center">Bu ürün için özellik bilgisi bulunmamaktadır.</td></tr>';
            }
        });

        // Modal kapandığında hash'i temizle
        modalElement.addEventListener('hidden.bs.modal', function() {
            history.replaceState(null, null, ' ');
        });

        // Sayfa yüklendiğinde URL'de hash varsa Modal'ı aç
        const currentHash = decodeURIComponent(window.location.hash.substring(1));
        if (currentHash) {
            const targetProduct = document.querySelector(`.product_item_card[data-code="${currentHash}"]`);
            if (targetProduct) {
                bsModal.show(targetProduct);
            }
        }
    });
</script>