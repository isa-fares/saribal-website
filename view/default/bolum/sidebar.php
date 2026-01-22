<?php
/**
 * Sidebar Component - Kategoriler Listesi
 * 
 * Bu dosya, ürünler sayfası için kategori sidebar'ını gösterir.
 * Ana kategoriler ve alt kategorileri destekler.
 * 
 * @var $this FrontClass|Loader object
 * @var $param Array - Parametreler dizisi
 * 
 * Gerekli parametreler (yeni kullanım):
 * - $param["anaKategoriler"] - Ana kategoriler dizisi (alt_kategoriler içerir)
 * - $param["seciliKategoriID"] - Seçili kategori ID'si
 * - $param["sayfa"] - Sayfa adı (örn: "urunler")
 * - $param["lang"] - Aktif dil kodu
 * - $param["kategoriUrunSayisi"] - Her kategori için ürün sayısı dizisi
 * 
 * Eski parametreler (geriye dönük uyumluluk):
 * - $param["sql"] - Kategoriler dizisi
 * - $param["page"] - Sayfa adı
 * - $param["id"] - Seçili ID
 * - $param["lang"] - Dil
 */

// Parametreleri al
$anaKategoriler = isset($param["anaKategoriler"]) ? $param["anaKategoriler"] : array();
$seciliKategoriID = isset($param["seciliKategoriID"]) ? intval($param["seciliKategoriID"]) : 0;
$sayfa = isset($param["sayfa"]) ? $param["sayfa"] : "";
$lang = isset($param["lang"]) ? $param["lang"] : "tr";
$kategoriUrunSayisi = isset($param["kategoriUrunSayisi"]) ? $param["kategoriUrunSayisi"] : array();

// Eski parametreler için geriye dönük uyumluluk (eski sidebar kullanımı)
if (empty($anaKategoriler) && isset($param["sql"])) {
    $sql = $param["sql"];
    $page = isset($param["page"]) ? $param["page"] : "";
    $id = isset($param["id"]) ? intval($param["id"]) : 0;
    $mid = ($lang != "tr") ? "master_" : "";
    $data  =  $param["data"];
    $table = isset($param["table"]) ? $param["table"] : "";
    $alt = isset($param["alt"]) ? $param["alt"] : "";
    $baslik = isset($param["baslik"]) ? $param["baslik"] : "";
    $katurl = isset($param["katurl"]) ? $param["katurl"] : "";
    $column = isset($param["column"]) ? $param["column"] : "";
    $type = Request::GETURL("type", null);
    ?>
    <aside class="widget widget-nav-menu">
        <ul class="widget-menu">
            <?
            if (is_array($sql)){
            foreach ($sql as $item) {
            $url = $this->BaseURL($this->lang->link($page)."/".$item["url"], $lang, 1);
            if (@$item["link"] != "") $url = $item["link"];
            ?>
                <li class="<?=($item[$mid."id"] == $id) ? "active" : ""?>"><a  href="<?=$url?>"><?=$this->temizle($item["baslik"])?></a></li>

                <?
            }
            }
            ?>


        </ul>
    </aside>
    <?php
} else {
    // Yeni sidebar - Ana kategoriler ve alt kategoriler ile
    ?>
    <div class="sidebar-widget">
        <h3 class="sidebar-widget-title">Kategoriler</h3>
        <ul class="sidebar-widget-list">
            <?php if (is_array($anaKategoriler) && count($anaKategoriler) > 0): ?>
                <?php foreach ($anaKategoriler as $anaKat): ?>
                    <?php
                    // ============================================
                    // ANA KATEGORİ BİLGİLERİNİ HAZIRLA
                    // ============================================
                    $anaKatID = $this->getID($anaKat);  // Dil desteği ile ID al
                    $anaKatBaslik = isset($anaKat['baslik']) ? $this->temizle($anaKat['baslik']) : '';
                    $anaKatURL = isset($anaKat['url']) ? $anaKat['url'] : '';
                    
                    // URL oluştur: URL zaten ID içeriyor (örn: 1000x1000-mm-6), direkt kullan
                    // BaseURL fonksiyonu otomatik olarak .html ekler
                    $anaKatLink = $this->BaseURL($sayfa . "/" . $anaKatURL, $lang, 1);
                    
                    ?>
                    <li>
                        <!-- Ana kategori linki -->
                        <a href="<?php echo $anaKatLink; ?>" <?php echo ($seciliKategoriID == $anaKatID) ? 'class="active"' : ''; ?>>
                            <?php echo $anaKatBaslik; ?>
                        </a>
                        
                        <?php if (isset($anaKat['alt_kategoriler']) && is_array($anaKat['alt_kategoriler']) && count($anaKat['alt_kategoriler']) > 0): ?>
                            <!-- Alt kategoriler listesi -->
                            <ul>
                                <?php foreach ($anaKat['alt_kategoriler'] as $altKat): ?>
                                    <?php
                                    // ============================================
                                    // ALT KATEGORİ BİLGİLERİNİ HAZIRLA
                                    // ============================================
                                    $altKatID = $this->getID($altKat);  // Dil desteği ile ID al
                                    $altKatBaslik = isset($altKat['baslik']) ? $this->temizle($altKat['baslik']) : '';
                                    $altKatURL = isset($altKat['url']) ? $altKat['url'] : '';
                                    
                                    // URL oluştur: URL zaten ID içeriyor (örn: 1000x1000-mm-6), direkt kullan
                                    $altKatLink = $this->BaseURL($sayfa . "/" . $altKatURL, $lang, 1);
                                    
                                    // Bu alt kategoriye ait ürün sayısını al
                                    $altUrunSayisi = isset($kategoriUrunSayisi[$altKatID]) ? $kategoriUrunSayisi[$altKatID] : 0;
                                    ?>
                                    <li>
                                        <!-- Alt kategori linki ve ürün sayısı -->
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
                <!-- Kategori bulunamadı durumu -->
                <li><a href="#">Kategori bulunamadı</a></li>
            <?php endif; ?>
        </ul>
    </div>
    <?php
}
?>
