<?php

/**
 * @var $this FrontClass|Loader object
 * @var $lang string
 * @var $assetURL string
 * @var $page string
 * @var $content string
 */
?>
<?php $this->disable_cache = false ?>
<!-- HTML, HEAD, META -->
<?= $this->getHeader(); ?>
<!-- GOOGLE ANALYTICS -->
<?= $this->getAnalytics(); ?>


<meta name="Copyright" content="Copyright 2020. <?= $this->ayarlar("firma_" . $lang) ?>. Tüm Hakları Saklıdır.">
<meta name="publisher" content="Ve İnteraktif Medya" />
<meta name="robots" content="index, follow">
<meta name="revisit-after" content="3 days">
<meta name="twitter:card" content="summary">
<meta name="Abstract" content="<?= $this->ayarlar("title_" . $lang) ?>">
<link rel="canonical" href="<?= $this->fullUrl ?>">


<link rel="shortcut icon" href="<?= $assetURL ?>img/favicon.png">
<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "url": "<?= $this->baseURL() ?>",
        "logo": "<?= $assetURL ?>images/logo/logo.png"
    }
</script>



<script>
    let requiredMessage = "<?= $this->lang->form("doldur") ?>";
    let successMessage = "<?= $this->lang->form("basarili") ?>";
    let warningMessage = "<?= $this->lang->form("uyari") ?>";
    let errorMessage = "<?= $this->lang->form("hata") ?>";
    let infoMessage = "<?= $this->lang->form("bilgi") ?>";
    let pageLang = "<?= $lang ?>";
    let confirmButton = "<?= $this->lang->genel("KAPAT") ?>";
    let confirmButtonT = "<?= $this->lang->genel("KAPAT") ?>";
    let sonucClickTest = "<?= $this->lang->genel("sonuc_text") ?>"
    let slidingMenuMargin = 'margin-left';
</script>



<?php
$this->inc_file("css", array(
    "css/styles.css"
));
?>

<?php

$this->inc_file("script", array(
    "js/jquery-3.6.0.min.js",
));

?>
</head>



<body class="lang_<?= $lang ?> <?= ($page == "index") ? "index" : "other" ?>">

    <div class="page">


        <?= $content ?>



        <?php
        $this->inc_file("script", array(
            "js/jquery-3.6.0.min.js",
            "js/form.js",
            "js/sweetalert2@11.js",

        ));
        ?>




        <script>
            jQuery(document).ready(function($) {

                if ($(".captcha_image").length) {
                    $(".captcha_image").on("click", function() {
                        $(this).attr("src", BaseURL + "ajax/getcaptchaimage.html?rnd=" + Math.random());
                    });
                }

                if ($("form.iletisim-form").length) {
                    $("form.iletisim-form").ajaxForm({
                        swal: true,
                        submitClass: ".cmt-btn",
                        callback: function(obj, data) {
                            if (data != 3) {
                                $('.captcha_image').trigger("click");
                            }
                        }
                    });
                }

                if ($("form.test-ekipmani-destek-form").length) {
                    $("form.test-ekipmani-destek-form").ajaxForm({
                        swal: true,
                        submitClass: ".test-btn",
                        callback: function(obj, data) {
                            if (data != 3) {
                                $('.captcha_image').trigger("click");
                            }
                        }
                    });
                }
                if ($("form.yedek-parca-destek-form").length) {
                    $("form.yedek-parca-destek-form").ajaxForm({
                        swal: true,
                        submitClass: ".yedek-btn",
                        callback: function(obj, data) {
                            if (data != 3) {
                                $('.captcha_image').trigger("click");
                            }
                        }
                    });
                }


                if ($("form.basvuru-form").length) {
                    $("form.basvuru-form").ajaxForm({
                        swal: true,
                        submitClass: ".btn-fancy",
                        callback: function(obj, data) {
                            if (data != 3) {
                                $('.captcha_image').trigger("click");
                            }
                        }
                    });
                }


                if ($("form#contactform").length) {
                    $("form#contactform").ajaxForm({
                        swal: true,
                        submitClass: ".float-btn",
                        callback: function(obj, data) {
                            if (data != 3) {
                                $('.captcha_image').trigger("click");
                            }
                        }
                    });
                }

                if ($("form.kursKayit").length) {
                    $("form.kursKayit").ajaxForm({
                        swal: true,
                        submitClass: ".btn-submit",
                        callback: function(obj, data) {
                            if (data != 3) {
                                $('.captcha_image').trigger("click");
                            }
                        }
                    });
                }


                if ($("form.uzmanKayit").length) {
                    $("form.uzmanKayit").ajaxForm({
                        swal: true,
                        submitClass: ".btn-submit",
                        callback: function(obj, data) {
                            if (data != 3) {
                                $('.captcha_image').trigger("click");
                            }
                        }
                    });
                }

                if ($("form.bilgiEdinme").length) {
                    $("form.bilgiEdinme").ajaxForm({
                        swal: true,
                        submitClass: ".btn-submit",
                        callback: function(obj, data) {
                            if (data != 3) {
                                $('.captcha_image').trigger("click");
                            }
                        }
                    });
                }



                if ($("form.dilekSikayet").length) {
                    $("form.dilekSikayet").ajaxForm({
                        swal: true,
                        submitClass: ".btn-submit",
                        callback: function(obj, data) {
                            if (data != 3) {
                                $('.captcha_image').trigger("click");
                            }
                        }
                    });
                }

                /* img to svg */
                $('.svg').each(function() {
                    var $img = jQuery(this);
                    var imgID = $img.attr('id');
                    var imgClass = $img.attr('class');
                    var imgURL = $img.attr('src');

                    jQuery.get(imgURL, function(data) {
                        var $svg = jQuery(data).find('svg');
                        if (typeof imgID !== 'undefined') {
                            $svg = $svg.attr('id', imgID);
                        }
                        if (typeof imgClass !== 'undefined') {
                            $svg = $svg.attr('class', imgClass + ' replaced-svg');
                        }
                        $svg = $svg.removeAttr('xmlns:a');
                        if (!$svg.attr('viewBox') && $svg.attr('height') && $svg.attr('width')) {
                            $svg.attr('viewBox', '0 0 ' + $svg.attr('height') + ' ' + $svg.attr('width'))
                        }
                        $img.replaceWith($svg);
                    }, 'xml');

                });


                <?php
                $popup = $this->tekSorgu("SELECT * FROM popup WHERE aktif = 1 and tarih >= NOW() and sil <> 1 ORDER BY id DESC");
                if (is_array($popup)):
                    if (!isset($_SESSION["modal"]) || $_SESSION["modal"] != $popup["id"]):
                ?>
                        let fancyTpl = "";
                        <? if ($popup["link"] != ""): ?> fancyTpl += "<a target='_blank' href='<?= $popup["link"] ?>'>";
                        <? endif; ?>
                        fancyTpl += "<h5 class='text-theme-dark'><?= $this->temizle($popup["baslik"]) ?></h5>";
                        fancyTpl += "<img src='<?= $this->dbResimAl($popup["resim"], "popup", "0x600") ?>' alt='<?= $this->temizle($popup["baslik"]) ?>'>";
                        <? if ($popup["link"] != ""): ?> fancyTpl += "</a>";
                        <? endif; ?>
                        $.fancybox.open('<div class="message p-15 bg-white">' + fancyTpl + '</div>');
                <?php $_SESSION["modal"] = $popup["id"];
                    endif;
                endif; ?>

            });
        </script>

</body>

</html>