<?php

/**
 * @var $this FrontClass|Loader object
 * @var $lang string
 * @var $assetURL string
 * @var $page string
 */
?>
<div class="navbar-area style-three position-relative" id="navbar">
    <div class="container-fluid">
        <div class="navbar-wrapper d-flex justify-content-between align-items-center">
            <a href="index.html" class="navbar-brand">
                <img src="<?= $assetURL ?>img/logo-white.png" alt="Logo">
            </a>
            <div class="menu-area me-auto">
                <div class="overlay"></div>
                <nav class="menu">
                    <div class="menu-mobile-header">
                        <button type="button" class="menu-mobile-arrow bg-transparent border-0"><i
                                class="ri-arrow-left-s-line"></i></button>
                        <div class="menu-mobile-title"></div>
                        <button type="button" class="menu-mobile-close bg-transparent border-0"><i
                                class="fa-sharp fa-light fa-circle-xmark"></i></button>
                    </div>
                    <ul class="menu-section p-0 mb-0 lh-1">
                        <li><a href="#" class="active">Anasayfa</a></li>
                        <li class="menu-item-has-children">
                            <a href="javascript:void(0)">Ürünlerimiz<i class="fa-solid fa-plus"></i></a>
                            <ul class="menu-subs menu-column-1">
                                <li class="list-item">
                                    <a href="#">Baskılı Sac</a>
                                </li>
                                <li class="list-item">
                                    <a href="#">Baskılı Lazer Sac</a>
                                </li>
                                <li class="list-item">
                                    <a href="#">Aksesuarlar</a>
                                </li>
                                <li class="list-item">
                                    <a href="#">Lazer Kesim</a>
                                </li>
                            </ul>
                        </li>
                        <li class="menu-item-has-children">
                            <a href="javascript:void(0)">Kurumsal<i class="fa-solid fa-plus"></i></a>
                            <ul class="menu-subs menu-column-1">
                                <li class="list-item">
                                    <a href="#">Hakkımızda</a>
                                </li>
                                <li class="list-item">
                                    <a href="#">Sertifikalarımız</a>
                                </li>
                            </ul>
                        </li>
                        <li><a href="#">Sürdürülebilirlik</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">İletişim</a></li>
                    </ul>
                </nav>
            </div>
            <div class="other-options d-flex flex-wrap align-items-center justify-content-end">
                <div class="option-item d-flex flex-wrap align-items-center">
                    <div class="mobile-options position-relative d-lg-none">
                        <button class="dropdown-toggle  text-center bg-transparent border-0 p-0 transition"
                            type="button" data-bs-toggle="dropdown" aria-expanded="true">
                            <i class="fa-regular fa-comment-arrow-up-right"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-centered mobile-option-list top-1 border-0"
                            data-bs-popper="static">
                            <div class="dropdown-item">
                                <div
                                    class="contact-link d-flex flex-wrap align-items-center position-relative transition">
                                    <span
                                        class="contact-icon d-flex flex-column align-items-center justify-content-center rounded-circle transition"><img
                                            src="<?= $assetURL ?>img/icons/phone.svg" alt="Icon"
                                            class="transition"></span>
                                    <div>
                                        <span class="text-white d-block">Bize Ulaşın:</span>
                                        <span class="text_primary fw-semibold">+90 (342) 235 01 94</span>
                                    </div>
                                    <a href="tel:+903422350194"
                                        class="position-absolute top-0 start-0 w-100 h-100"></a>
                                </div>
                            </div>
                            <div class="dropdown-item">
                                <a href="#"
                                    class="btn style-two d-inline-flex flex-wrap align-items-center p-0"><span
                                        class="btn-text d-inline-block fw-semibold position-relative transition">E-Katalog</span><span
                                        class="btn-icon position-relative d-flex flex-column align-items-center justify-content-center rounded-circle transition"><img
                                            src="<?= $assetURL ?>img/icons/up-right-arrow-black.svg"
                                            alt="Image"></span></a>
                            </div>
                        </div>
                    </div>
                    <div
                        class="contact-link d-lg-flex flex-wrap align-items-center position-relative d-none transition">
                        <span
                            class="contact-icon d-flex flex-column align-items-center justify-content-center rounded-circle transition"><img
                                src="<?= $assetURL ?>img/icons/phone.svg" alt="Icon" class="transition"></span>
                        <div class="d-xl-inline d-none">
                            <span class="text-white d-block fw-semibold">Bize Ulaşın</span>
                            <span class="text_primary fw-semibold">+90 (342) 235 01 94</span>
                        </div>
                        <a href="tel:+903422350194" class="position-absolute top-0 start-0 w-100 h-100"></a>
                    </div>
                </div>
                <div class="option-item d-lg-block d-none">
                    <a href="#" class="btn style-two d-inline-flex flex-wrap align-items-center p-0"><span
                            class="btn-text d-inline-block fw-semibold position-relative transition">E-katalog</span><span
                            class="btn-icon position-relative d-flex flex-column align-items-center justify-content-center rounded-circle transition"><img
                                src="<?= $assetURL ?>img/icons/up-right-arrow-black.svg" alt="Image"></span></a>
                </div>
                <div class="option-item d-lg-none">
                    <button type="button" class="menu-mobile-trigger">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>