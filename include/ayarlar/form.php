<?php
return [
    'inputs' => [
        [
            'type'          => 'text',
            'name'          => 'adi',
            'placeholder'   => 'Ad Soyad',
            'required'      => true,
        ],
        [
            'type'          => 'email',
            'name'          => 'email',
            'placeholder'   => 'Mail Adresiniz',
            'required'      => true,
        ],
        [
            'type'          => 'number',
            'name'          => 'tel',
            'placeholder'   => 'Telefon',
            'required'      => true,
        ],
        [
            'type'          => 'number',
            'name'          => 'yas',
            'placeholder'   => 'Yaşınız',
            'required'      => true,
        ],
        [
            'type'          => 'text',
            'name'          => 'sehir',
            'placeholder'   => 'Yaşadığınız Şehir',
            'required'      => true,
        ],
        [
            'type'          => 'text',
            'name'          => 'meslek',
            'placeholder'   => 'Mesleğiniz',
            'required'      => false,
        ],
        [
            'type'          => 'text',
            'name'          => 'basvuru_pozisyonu',
            'placeholder'   => 'Başvuru Yaptığınız Pozisyon',
            'required'      => false,
        ],
        [
            'type'          => 'text',
            'name'          => 'yabanci_dil',
            'placeholder'   => 'Yabancı Dil (Varsa seviyesi ile birlikte)',
            'required'      => false,
        ],
    ],
    'selects' => [
        [
            'name'          => 'medeni_hali',
            'label'         => 'Medeni Hali',
            'required'      => true,
            'options'       =>  ['Bekar', 'Evli'],

        ],
        [
            'name'          => 'cinsiyet',
            'label'         => 'Cinsiyet',
            'required'      => true,
            'options'       =>  ['Erkek', 'Kadın'],

        ],
        [
            'name'          => 'ehliyet',
            'label'         => 'Ehliyet',
            'options'       => ['Var', 'Yok'],
            'required'      => true,
        ],
        [
            'name'          => 'egitim',
            'label'         => 'Eğitim Durumu',
            'required'      => true,
            'options'       => ['İlkokul', 'Lise', 'Önlisans', 'Lisans', 'Yüksek Lisans'],

        ],
        [
            'name'          => 'saglik_problemi',
            'label'         => 'Herhangi Bir Sağlık Probleminiz Var mı ?',
            'options'       =>  ['Var', 'Yok'],
        ],

        [
            'name'          => 'seyahat_engel',
            'label'         => 'Seyahat Engeli',
            'options'       =>  ['Var', 'Yok'],

        ],
    ],
    'textareas' => [
        [
            'name'          => 'mesaj',
            'placeholder'   => 'Mesaj / Açıklama / Ek Bilgiler'
        ]
    ]
];
