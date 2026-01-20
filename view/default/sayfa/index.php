<?php

/**
 * Ana Sayfa / Home Page
 * 
 * @var $this FrontClass|Loader object
 * @var $lang string
 * @var $assetURL string
 * @var $page string
 */

// ============================================
// PAGE CONFIGURATION
// ============================================
$this->sayfaBaslik = $this->ayarlar("title_" . $lang);

// ============================================
// DATA PREPARATION
// ============================================

?>


<div class="hero-area style-three position-relative overflow-hidden z-1">
    <div class="hero-bg bg-f position-absolute top-0 start-0 w-100 h-100 transition"></div>
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-xxl-6 col-md-7 pe-xxl-5">
                <div class="hero-content mb-35">
                    <h1 class="font-secondary fw-normal text-white mb-0" data-cue="slideInUp"><span
                            class="fw-black">Lazer Aksesuar Baskılı</span> Sac Üretimi</h1>
                </div>
            </div>
            <div class="col-xl-4 offset-xl-2 col-lg-4 offset-lg-1 col-md-5 ps-xxl-5 mb-35">
                <div class="hero-para" data-cue="slideInUp">
                    <p class="ms-xxl-5 mb-35">Yüksek kaliteli metal ürünleriyle müşteri beklentilerini
                        karşılamak için titizlikle çalışıyor, özel çözümler sunuyoruz.</p>
                    <a href="#"
                        class="btn style-one d-inline-flex flex-wrap align-items-center p-0 ms-xxl-5"><span
                            class="btn-text d-inline-block fw-semibold position-relative transition">Ürünlerimizi
                            İnceleyin</span><span
                            class="btn-icon position-relative d-flex flex-column align-items-center justify-content-center rounded-circle transition"><i
                                class="fa-light fa-arrow-up-right"></i></span></a>
                </div>
            </div>
            <div class="col-xl-6 offset-xl-6 col-lg-5 offset-lg-7 col-md-4 offset-md-8 ps-xxl-5 ps-md-4">
                <div class="circle-text-wrap position-relative overflow-hidden z-1" data-cue="slideInUp"
                    data-delay="300">
                    <img src="<?= $assetURL ?>img/rotate-anim-text.png" class="rotate position-relative z-1">
                    <a data-fslightbox="" href="https://www.youtube.com/watch?v=u31qwQUeGuM"
                        class="play-icon position-absolute d-flex flex-column align-items-center justify-content-center rounded-circle z-1 bg_primary"><i
                            class="fa-sharp fa-solid fa-play"></i></a>
                </div>
            </div>
            <div class="col-12">
                <div class="hero-transparent-text-wrap">
                    <h6 class="section-subtitle style-two d-inline-block fs-13 ls-1 font-optional fw-semibold position-relative text_secondary mb-18"
                        data-cue="slideInUp" data-delay="400"><img
                            src="https://templates.envytheme.com/renius/default/assets/img/icons/home-2.svg"
                            alt="Icon">SANATIN METALLE BULUŞMA ANI SARIBAL'DA GERÇEKLEŞİR</h6>
                    <h2 class="hero-transparent-text font-secondary fw-black mb-0 d-flex flex-wrap align-items-center justify-content-between"
                        data-cue="slideInUp" data-delay="500">
                        <span>S</span>
                        <span>A</span>
                        <span>R</span>
                        <span>I</span>
                        <span>B</span>
                        <span>A</span>
                        <span>L</span>
                    </h2>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="container pb-90">
    <div class="row align-items-end">
        <div class="col-xl-8 offset-xl-2 col-md-10 offset-md-1 text-center px-xxl-5">
            <h6 class="section-subtitle style-two d-inline-block fs-13 ls-1 font-optional fw-semibold position-relative text_primary mb-25"
                data-cue="slideInUp"><img
                    src="https://templates.envytheme.com/renius/default/assets/img/icons/home-icon.svg"
                    alt="Icon">ÜRÜNLERİMİZ</h6>
            <h2 class="section-title style-one fw-normal text-title mb-40" data-cue="slideInUp"
                data-delay="300">Mekanların ruhunu değiştiren <span class="fw-black">baskılı saclardan, ince
                    işçilikli aksesuarlara</span> uzanan geniş koleksiyonumuzu keşfedin</h2>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-xl-4 col-md-6" data-cue="slideInUp">
            <div class="feature-card style-three position-relative round-20 transition mb-30">
                <div class="br-one position-absolute top-0 start-0"></div>
                <div class="br-two position-absolute bottom-0 start-0"></div>
                <div class="feature-img position-relative z-1 d-block mx-auto">
                    <img src="<?= $assetURL ?>img/ferforje.jpg" alt="Image" style="border-radius: 10%;">
                </div>
                <h3 class="fs-24 font-primary fw-black">Döküm Ferforje</h3>
                <p>Yüksek basınçlı presleme teknolojisiyle metal yüzeyine derinlik ve karakter katan
                    ürünler </p>
                <a href="#" class="link style-one fw-semibold">Ürünleri İnceleyin <img
                        src="<?= $assetURL ?>img/icons/right-arrow-small.svg" alt="Icon"></a>
            </div>
        </div>
        <div class="col-xl-4 col-md-6" data-cue="slideInUp">
            <div class="feature-card style-four position-relative z-1 overflow-hidden round-20 mb-30">
                <div class="feature-info">
                    <h3 class="fs-24 font-primary fw-black">Baskılı Sac</h3>
                    <p>Geleneksel baskı sanatını milimetrik lazer kesim hassasiyetiyle birleştirdik</p>
                    <a href="#" class="link style-one fw-semibold">Ürünleri İnceleyin <img
                            src="<?= $assetURL ?>img/icons/right-arrow-small.svg" alt="Icon"></a>
                </div>
                <img src="<?= $assetURL ?>img/baskili_lazer.png" alt="Image"
                    class="position-absolute bottom-0 start-0 z-n1 transition">
            </div>
        </div>
        <div class="col-xl-4 col-md-6" data-cue="slideInUp">
            <div class="feature-card style-five bg-f position-relative overflow-hidden d-flex flex-column align-items-end justify-content-end round-20 z-1 mb-30"
                style="background-image: url(<?= $assetURL ?>img/aksesuar.png);">
                <div class="feature-info">
                    <h3 class="fs-24 font-primary fw-black text-white">Aksesuarlar</h3>
                    <p class="text-alto">Tasarımlarımızı tamamlayan ve montaj kolaylığı sağlayan fonksiyonel
                        aksesuarlarımız</p>
                    <a href="#" class="link style-one fw-semibold">Ürünleri İnceleyin<img
                            src="<?= $assetURL ?>img/icons/right-arrow-small.svg" alt="Icon"></a>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="about-area style-three position-relative z-1 ptb-120">
    <div class="move-text-wrapper overflow-hidden mb-120">
        <div class="move-text style-two position-relative z-1">
            <ul class="list-unstyled mb-0">
                <li class="position-relative font-secondary">BASKILI SAC</li>
                <li class="position-relative font-secondary">BASKILI LAZER SAC</li>
                <li class="position-relative font-secondary">LAZER KESİM</li>
                <li class="position-relative font-secondary">AKSESUARLAR</li>
                <li class="position-relative font-secondary">BASKILI SAC</li>
                <li class="position-relative font-secondary">BASKILI LAZER SAC</li>
                <li class="position-relative font-secondary">LAZER KESİM</li>
                <li class="position-relative font-secondary">AKSESUARLAR</li>
                <li class="position-relative font-secondary">BASKILI SAC</li>
                <li class="position-relative font-secondary">BASKILI LAZER SAC</li>
                <li class="position-relative font-secondary">LAZER KESİM</li>
                <li class="position-relative font-secondary">AKSESUARLAR</li>
                <li class="position-relative font-secondary">BASKILI SAC</li>
                <li class="position-relative font-secondary">BASKILI LAZER SAC</li>
                <li class="position-relative font-secondary">LAZER KESİM</li>
                <li class="position-relative font-secondary">AKSESUARLAR</li>
                <li class="position-relative font-secondary">BASKILI SAC</li>
                <li class="position-relative font-secondary">BASKILI LAZER SAC</li>
                <li class="position-relative font-secondary">LAZER KESİM</li>
                <li class="position-relative font-secondary">AKSESUARLAR</li>
                <li class="position-relative font-secondary">BASKILI SAC</li>
                <li class="position-relative font-secondary">BASKILI LAZER SAC</li>
                <li class="position-relative font-secondary">LAZER KESİM</li>
                <li class="position-relative font-secondary">AKSESUARLAR</li>
            </ul>
        </div>
    </div>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xxl-5 col-lg-5">
                <div class="about-img-wrap position-relative z-1 mb-md-30">
                    <img src="<?= $assetURL ?>img/laser.png" alt="Image" class="d-block tilt-img mx-auto">
                    <img src="https://templates.envytheme.com/renius/default/assets/img/about/shape-1.png"
                        alt="Shape" class="about-shape position-absolute top-0 z-n1">
                </div>
            </div>
            <div class="col-xxl-6 offset-xxl-1 col-lg-7 ps-xxl-3 ps-xl-4">
                <div class="about-content position-relative">
                    <h6
                        class="section-subtitle style-two d-inline-block fs-13 ls-1 font-optional fw-semibold position-relative text_primary mb-20">
                        <img src="https://templates.envytheme.com/renius/default/assets/img/icons/home-icon.svg"
                            alt="Icon">HAKKIMIZDA
                    </h6>
                    <h2 class="section-title style-one fw-normal text-title">Sarıbal Metal <span
                            class="fw-black">Baskılı Sac Üretiminde</span> Kalite ve Estetik Sunar</h2>

                    <p class="mb-28">Sarıbal Metal olarak, uzmanlık alanımızda baskılı saç üretiminde
                        öncüyüz. Yüksek kaliteli metal ürünleriyle müşteri beklentilerini karşılamak için
                        titizlikle çalışıyor, özel çözümler sunuyoruz.</p>

                    <div class="row gx-xxl-45">
                        <div class="col-sm-6">
                            <div class="feature-item position-relative">
                                <img src="https://templates.envytheme.com/renius/default/assets/img/about/feature-icon-1.png"
                                    alt="Icon" class="feature-icon">
                                <h3 class="fs-16 fw-semibold">Güncel ve Modern Teknolojiyi Kullanıyoruz</h3>
                                <p class="mb-0">İleri teknoloji makine parkurumuzla hatasız ve hızlı üretim
                                    sağlıyoruz.</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="feature-item position-relative">
                                <img src="https://templates.envytheme.com/renius/default/assets/img/about/feature-icon-4.png"
                                    alt="Icon" class="feature-icon">
                                <h3 class="fs-16 fw-semibold">Deneyimli Ekibimizle Müşteri Odaklılık Ön
                                    Planda</h3>
                                <p>Yılların verdiği tecrübe ile taleplerinize özel esnek çözümler
                                    geliştiriyoruz.</p>
                            </div>
                        </div>
                    </div>

                    <a href="#" class="btn style-one d-inline-flex flex-wrap align-items-center p-0">
                        <span
                            class="btn-text d-inline-block fw-semibold position-relative transition">Hakkımızda</span>
                        <span
                            class="btn-icon position-relative d-flex flex-column align-items-center justify-content-center rounded-circle transition">
                            <i class="fa-light fa-arrow-up-right"></i>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="bg-optional pt-120 pb-90">
    <div class="container">
        <div class="row align-items-end mb-45">
            <div class="col-lg-7 col-md-8">
                <h6 class="section-subtitle style-two d-inline-block fs-13 ls-1 font-optional fw-semibold position-relative text_primary mb-25"
                    data-cue="slideInUp"><img
                        src="https://templates.envytheme.com/renius/default/assets/img/icons/home-icon.svg"
                        alt="Icon">HİZMETLERİMİZ</h6>
                <h2 class="section-title style-one fw-normal text-white" data-cue="slideInUp"
                    data-delay="400">Metal İşlemede <span class="fw-black">Yüksek Hassasiyet ve
                        Profesyonel</span> Çözümler</h2>
            </div>
            <div class="col-lg-5 col-md-4 text-md-end">
                <a href="#" class="btn style-one d-inline-flex flex-wrap align-items-center p-0"><span
                        class="btn-text d-inline-block fw-semibold position-relative transition">Ürünlerimizi
                        İnceleyin</span><span
                        class="btn-icon position-relative d-flex flex-column align-items-center justify-content-center rounded-circle transition"><i
                            class="fa-light fa-arrow-up-right"></i></span></a>
            </div>
        </div>
        <div class="service-card-wrap style-one d-flex flex-wrap justify-content-center">
            <div class="service-card style-three mb-30" data-cue="slideInUp">
                <i class="fa-sharp fa-light fa-layer-group"></i>
                <h3 class="fs-24 fw-semibold"><a class="text-white link-hover-primary transition">Özel
                        Tasarım Baskılı Sac</a></h3>
                <p class="text-alto">Projelerinize estetik değer katan, yüksek kaliteli ve dayanıklı baskılı
                    sac çözümlerini uzmanlıkla üretiyoruz.</p>
                <a href="#" class="link style-one fw-semibold">Ürünler<img
                        src="<?= $assetURL ?>img/icons/right-arrow-small.svg" alt="Icon"></a>
            </div>
            <div class="service-card style-three mb-30" data-cue="slideInUp">
                <i class="fa-light fa-raygun" style="transform: rotate(90deg);"></i>
                <h3 class="fs-24 fw-semibold"><a class="text-white link-hover-primary transition">Lazer
                        Kesim Hizmetleri</a>
                </h3>
                <p class="text-alto">En karmaşık metal formları, modern lazer teknolojimizle sıfır hata ve
                    maksimum hassasiyetle şekillendiriyoruz.</p>
                <a href="#" class="link style-one fw-semibold">Ürünler<img
                        src="<?= $assetURL ?>img/icons/right-arrow-small.svg" alt="Icon"></a>
            </div>
            <div class="service-card style-three mb-30" data-cue="slideInUp">
                <i class="fa-light fa-industry"></i>
                <h3 class="fs-24 fw-semibold"><a
                        class="text-white link-hover-primary transition">Endüstriyel Aksesuar Üretimi</a>
                </h3>
                <p class="text-alto">Sektör ihtiyaçlarına yönelik, fonksiyonel ve dayanıklı metal aksesuar
                    tasarımları ile projelerinizi tamamlıyoruz.</p>
                <a href="#" class="link style-one fw-semibold">Ürünler<img
                        src="<?= $assetURL ?>img/icons/right-arrow-small.svg" alt="Icon"></a>
            </div>
            <div class="service-card style-three mb-30" data-cue="slideInUp">
                <i class="fa-sharp fa-light fa-sitemap"></i>
                <h3 class="fs-24 fw-semibold"><a class="text-white link-hover-primary transition">Bütünleşik
                        Proje Yönetimi</a>
                </h3>
                <p class="text-alto">Tasarımdan sevkiyata kadar tüm metal işleme süreçlerini titiz bir
                    kalite kontrol ve zaman yönetimi ile yürütüyoruz.</p>
                <a href="#" class="link style-one fw-semibold">Hakkımızda<img
                        src="<?= $assetURL ?>img/icons/right-arrow-small.svg" alt="Icon"></a>
            </div>
        </div>
    </div>
    <div class="photo_collage">
        <div class="pr_row transform_xt">
            <div>
                <img src="<?= $assetURL ?>img/collage/10.jpg" alt="">
            </div>
            <div>
                <img src="<?= $assetURL ?>img/collage/2.jpg" alt="">
            </div>
            <div>
                <img src="<?= $assetURL ?>img/collage/14.jpg" alt="">
            </div>
            <div>
                <img src="<?= $assetURL ?>img/collage/4.jpg" alt="">
            </div>
            <div>
                <img src="<?= $assetURL ?>img/collage/5.jpg" alt="">
            </div>
            <div>
                <img src="<?= $assetURL ?>img/collage/6.jpg" alt="">
            </div>
            <div>
                <img src="<?= $assetURL ?>img/collage/7.jpg" alt="">
            </div>
            <div>
                <img src="<?= $assetURL ?>img/collage/8.jpg" alt="">
            </div>
        </div>
        <div class="pr_row transform_xb">
            <div>
                <img src="<?= $assetURL ?>img/collage/3.jpg" alt="">
            </div>
            <div>
                <img src="<?= $assetURL ?>img/collage/9.jpg" alt="">
            </div>
            <div>
                <img src="<?= $assetURL ?>img/collage/11.jpg" alt="">
            </div>
            <div>
                <img src="<?= $assetURL ?>img/collage/12.jpg" alt="">
            </div>
            <div>
                <img src="<?= $assetURL ?>img/collage/13.jpg" alt="">
            </div>
            <div>
                <img src="<?= $assetURL ?>img/collage/15.jpg" alt="">
            </div>
            <div>
                <img src="<?= $assetURL ?>img/collage/20.jpg" alt="">
            </div>
            <div>
                <img src="<?= $assetURL ?>img/collage/18.jpg" alt="">
            </div>
        </div>
    </div>
</div>

<div class="container ptb-120">
    <div class="row align-items-end mb-30">
        <div class="col-xxl-6 col-lg-7 col-md-8 mb-sm-20">
            <h6 class="section-subtitle style-two d-inline-block fs-13 ls-1 font-optional fw-semibold position-relative text_primary mb-25"
                data-cue="slideInUp"><img
                    src="https://templates.envytheme.com/renius/default/assets/img/icons/home-icon.svg"
                    alt="Icon">YANGIN KAPI SACI</h6>
            <h2 class="section-title style-one fw-normal text-title mb-0" data-cue="slideInUp"
                data-delay="300"><span class="fw-black">Türkiye'de</span> İlk!</h2>
        </div>
    </div>
    <div class="row align-items-center">
        <div class="col-12 pe-xl-2" data-cue="slideInUp">
            <div class="testimonial-slider-one style-three swiper position-relative z-1 pt-1">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="testimonial-card style-three d-flex flex-wrap align-items-center">
                            <div class="testimonial-content d-flex flex-wrap">
                                <span
                                    class="quote-icon bg_secondary d-flex flex-wrap align-items-center justify-content-center rounded-circle"><img
                                        src="<?= $assetURL ?>img/icons/quote-large.svg" alt="Icon"></span>
                                <p class="fw-medium text-title">Türkiye'de ilk defa üretilen özel bir yangın
                                    kapı sacı modelinin üreticisidir. Yüksek kaliteli ürünleri ve
                                    uzmanlığıyla, yangın güvenliği konusunda endüstri standartlarını
                                    belirlemeye devam etmektedir.</p>
                                <h6
                                    class="fs-20 font-primary fw-semibold position-relative text-title mb-0">
                                    Sarıbal<span class="fs-15 fw-normal d-block text-para mt-1 pt-1">Lazer
                                        Aksesuar Baskılı Sac</span>
                                </h6>
                            </div>
                            <div class="testimonial-img round-30">
                                <img src="<?= $assetURL ?>img/exit.jpg" alt="Image" class="round-30">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="cta-area style-three bg-f position-relative overflow-hidden z-1" data-cue="slideInUp">
    <img src="<?= $assetURL ?>img/cta/shape-1.png" alt="Shape"
        class="section-shape position-absolute bottom-0 end-0 z-0">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-7 mb-sm-20">
                <h4 class="text-white"><strong>Güncel Ürünlerimizi Keşfedin</strong></h4>
                <h2 class="section-title style-two fw-normal text-white mb-0"><span
                        class="fw-black">E-kataloğu</span><br>İnceleyin</h2>
                <p class="text-white pgux01">Lazer kesim teknolojisiyle müşterilerin sanatını metal üzerine
                    aktaran
                    özel tasarımlı
                    ürünler sunmaktadır. Müşteriler, ürünlerini istedikleri renkte tercih edebilmekte ve
                    kendi sanatlarını ürünlere uygulayabilmektedirler.
                </p>
            </div>
            <div class="col-lg-6 col-md-5">
                <div
                    class="circle-text-wrap position-relative bg-transparent rounded-circle overflow-hidden z-1 ms-md-auto me-md-0 ms-auto me-auto">
                    <img src="<?= $assetURL ?>img/cta/circle-text.png"
                        class="rotate position-relative z-2 d-block mx-auto">
                    <img src="<?= $assetURL ?>img/icons/up-right-arrow-white-small.svg" alt="Icon"
                        class="arrow-icon position-absolute z-n1">
                    <a href="#" class="position-absolute top-0 start-0 w-100 h-100 z-2"></a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="blog-area style-two position-relative z-1 round-20 pt-90">
    <div class="container pb-90">
        <div class="row">
            <div class="col-xl-8 offset-xl-2 col-md-10 offset-md-1 text-center">
                <h6 class="section-subtitle style-two d-inline-block fs-13 ls-1 font-optional fw-semibold position-relative text_primary mb-25"
                    data-cue="slideInUp" data-delay="200"><img
                        src="https://templates.envytheme.com/renius/default/assets/img/icons/home-icon.svg"
                        alt="Icon">BLOG</h6>
                <h2 class="section-title style-one text-center text-title px-xxl-5 mb-4"
                    data-cue="slideInUp" data-delay="400">Kalite Odaklı Çözümlerimiz <span
                        class="fw-black">ve Sektörel Tecrübe
                        Paylaşımlarımız</h2>
            </div>
        </div>
        <div class="row gx-xxl-25 justify-content-center">
            <div class="col-xl-4 col-md-6">
                <div class="blog-card style-one position-relative mb-30" data-cue="slideInUp">
                    <div class="blog-img position-relative overflow-hidden round-20">
                        <img src="<?= $assetURL ?>img/blog1.avif" alt="Blog" class="round-20">
                    </div>
                    <h3 class="fs-24 fw-black">
                        <a href="#" class="text-title link-hover-primary fw-bold transition">
                            Dekoratif Baskılı Sac Modelleri ile Projelerinize Estetik Dokunuşlar
                        </a>
                    </h3>
                    <a href="#" class="link style-one fw-semibold">Devamını Oku<img
                            src="<?= $assetURL ?>img/icons/right-arrow-small.svg" alt="Icon"></a>
                </div>
            </div>

            <div class="col-xl-4 col-md-6">
                <div class="blog-card style-one position-relative mb-30" data-cue="slideInUp">
                    <div class="blog-img position-relative overflow-hidden round-20">
                        <img src="<?= $assetURL ?>img/blog2.jpg" alt="Blog" class="round-20">
                    </div>
                    <h3 class="fs-24 fw-black">
                        <a href="#" class="text-title link-hover-primary fw-bold transition">
                            Endüstriyel Üretimde Lazer Kesim Teknolojisinin Sağladığı Avantajlar
                        </a>
                    </h3>
                    <a href="#" class="link style-one">Devamını Oku <img
                            src="<?= $assetURL ?>img/icons/right-arrow-small.svg" alt="Icon"></a>
                </div>
            </div>

            <div class="col-xl-4 col-md-6">
                <div class="blog-card style-one position-relative mb-30" data-cue="slideInUp">
                    <div class="blog-img position-relative overflow-hidden round-20">
                        <img src="<?= $assetURL ?>img/blog3.avif" alt="Blog" class="round-20">
                    </div>
                    <h3 class="fs-24 fw-black">
                        <a href="#" class="text-title link-hover-primary fw-bold transition">
                            Doğru Metal Aksesuar Seçimi: Dayanıklılık ve Kalite İçin 10 İpucu
                        </a>
                    </h3>
                    <a href="#" class="link style-one fw-semibold">Devamını Oku<img
                            src="<?= $assetURL ?>img/icons/right-arrow-small.svg" alt="Icon"></a>
                </div>
            </div>
        </div>
    </div>
</div>