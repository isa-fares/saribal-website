<?php
return [

    [
        'href' => 'Index',
        'title' =>'Anasayfa',
        'icon' => 'mdi mdi-home-variant',
        'display'=>false,
        'submenu' => null
    ],

    [ 'href' => 'Sayfa',
        'title' =>'Sayfalar',
        'icon' => 'fa fa-file-text',
        'display'=>true,
        'submenu' => false
    ],

    [ 'href' => 'Hizmet',
        'title' =>'Hizmetlerimiz',
        'icon' => 'mdi mdi-settings',
        'display'=>true,
        'submenu' => false
    ],


    [ 'href' => 'Bilgi',
        'title' =>'Bilgi Bankası',
        'icon' => 'mdi mdi-database',
        'display'=>true,
        'submenu' => false
    ],

    [ 'href' => 'SSS',
        'title' =>'Sık Sorulan Sorular',
        'icon' => 'mdi mdi-comment-question-outline',
        'display'=>true,
        'submenu' => false
    ],

    [ 'href' => 'Slayt',
        'title' =>'Slayt',
        'icon' => 'fa fa-picture-o',
        'display'=>true,
        'submenu' => false
    ],


    [ 'href' => 'Haber',
        'title' =>'Haberler',
        'icon' => 'mdi mdi-newspaper',
        'display'=>true,
        'submenu' => false
    ],




    [ 'href' => 'Galeri',
        'title' =>"Foto Galeri",
        'icon' => 'glyphicon glyphicon-camera',
        'display'=>true,
        'submenu' => false
    ],


    [ 'href' => 'Video',
        'title' =>"Video Galeri",
        'icon' => 'mdi mdi-video',
        'display'=>true,
        'submenu' => false
    ],



    [ 'href' => 'Kurslar',
        'title' =>"Eğitimler",
        'icon' => 'mdi mdi-presentation',
        'display'=>false,
        'submenu' => false
    ],


    [ 'href' => 'Siparis',
        'title' =>'Satışlar',
        'icon' => 'mdi mdi-basket',
        'display'=>false,
        'submenu' => false,
        'pill'=>array("table"=>"siparis", "column"=>"goruldu")
    ],


    [ 'href' => 'Uyeler',
        'title' =>'Üyeler',
        'icon' => 'mdi mdi-account-multiple',
        'display'=>false,
        'submenu' => false,
        'pill'=>array("table"=>"uyeler", "column"=>"goruldu")
    ],

    [ 'href' => 'Ogretmen',
        'title' =>"Eğitmenler",
        'icon' => 'mdi mdi-voice',
        'display'=>false,
        'submenu' => false
    ],

    [ 'href' => 'Gorus',
        'title' =>'Katılımcı Görüşleri',
        'icon' => 'mdi mdi-account-edit',
        'display'=>false,
        'submenu' => false
    ],







    [ 'href' => 'Urun',
        'title' =>'Ürünler',
        'icon' => 'fa fa-product-hunt',
        'display'=>true,
        'submenu' => [
            [ 'href' => 'kategoriListesi','title' =>'Kategoriler','icon' => 'fa fa-list','active' => true,'display'=>true,'submenu' => null],
            [ 'href' => 'liste','title' =>'Ürünler','icon' => 'fa fa-list','active' => true,'display'=>true,'submenu' => null],
        ]
    ],

    [ 'href' => 'Rakam',
        'title' =>'Rakamlarla Biz',
        'icon' => 'mdi mdi-format-list-numbers',
        'display'=>false,
        'submenu' => false
    ],




    [ 'href' => 'Yorum',
        'title' =>'Yorumlar',
        'icon' => 'mdi mdi-account',
        'display'=>false,
        'submenu' => false,
        'pill'=>array("table"=>"yorum", "column"=>"goruldu")
    ],



    [ 'href' => 'Bulten',
        'title' =>'E-Bülten Listesi',
        'icon' => 'mdi mdi-email-variant',
        'display'=>true,
        'submenu' => false
    ],


    ['href' =>'Ayar',
        'title'=>'Ayarlar',
        'icon' => 'fa  fa-cogs',
        'display'=>true,
        'submenu'=> false
    ],

    ['href' =>'Moduller',
        'title'=>'Modüller',
        'icon' => 'mdi mdi-arrange-send-backward',
        'display'=>true,
        'submenu'=> false
    ]

];


?>