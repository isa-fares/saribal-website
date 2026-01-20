<?php


namespace AdminPanel;


class Dosya extends Settings
{

    public $settings;
    public $SayfaBaslik = 'Dosya Ekle';

    public function __construct($settings)
    {
        parent::__construct($settings);

        $this->settings = $settings;
        $this->AuthCheck();


    }


    public function index()
    {
        return 'Dosya Ekle';
    }

    public function resimekle()
    {
        $control = array();
        $control['folder'] = ((isset($_GET["folder"])) ?  $this->koru($_GET["folder"]):null);
        $gelenid = $control['gelenid'] = ((isset($_GET["gelenid"])) ?  $this->koru($_GET["gelenid"]):null);
        $modul =  $control['modul'] = ((isset($_GET["modul"])) ?  $this->koru($_GET["modul"]):null);
        $resim_tur = $control['resim_tur'] = ((isset($_GET["resim_tur"])) ?  $this->koru($_GET["resim_tur"]):null);




        if($modul==1)
        {
            $control['baslik'] = "Ürün Fotoğraflar";

            $rec7 = $this->dbConn->teksorgu("SELECT * FROM urunler where id=$gelenid");
            $control['gelen_baslik'] = $this->per(strtolower($rec7["baslik"]));

            $control['data'] = $this->dbConn->sorgu("SELECT * FROM dosyalar where type=$modul and kid=$gelenid order by sira");;
        }

        if($modul==2)
        {
            $control['baslik'] = "Galeri Fotoğraflar";

            $rec7 = $this->dbConn->teksorgu("SELECT * FROM fotogaleri where id=$gelenid");
            $control['gelen_baslik'] = $this->per(strtolower($rec7["baslik"]));

            $control['data'] = $this->dbConn->sorgu("SELECT * FROM dosyalar where type=$modul and kid=$gelenid order by sira");;
        }
        $this->load('dosya/index',$control);
    }

    public function yukle()
    {
        $control = array();
        $control['folder'] = ((isset($_GET["folder"])) ?  $this->koru($_GET["folder"]):null);
        $control['modul'] = ((isset($_GET["modul"])) ?  $this->koru($_GET["modul"]):null);
        $control['file_type'] = ((isset($_GET["file_type"])) ?  $this->koru($_GET["file_type"]):null);
        $control['son_id'] = ((isset($_GET["son_id"])) ?  $this->koru($_GET["son_id"]):null);
        $control['is_files'] = ((isset($_GET["is_files"])) ?  $this->koru($_GET["is_files"]):null);
        $control['baslikper'] =((isset($_GET["baslik"])) ?  $this->koru($_GET["baslik"]):null);
        $control['tur'] = ((isset($_GET["tur"])) ?  $this->koru($_GET["tur"]):null);
        $control['lang'] = ((isset($_GET["lang"])) ?  $this->koru($_GET["lang"]):null);
        $control['resim_tur'] = ((isset($_GET["resim_tur"])) ?  $this->koru($_GET["resim_tur"]):null);
        $this->loadphp('helper/dosya/yukle',$control);
    }



    public function dosyaTur($dosya){
        $par = explode(".",$dosya);
        $count = count($par);
        $uzanti = $par[$count - 1];

        $resimler = array("jpg","gif","jpeg","png","bmp","JPG","JPEG","GIF","PNG","BMP");
        return (in_array($uzanti, $resimler)) ? "resim" : "dosya";
    }

    public function permalink($str, $options = array())
    {
        $str = mb_convert_encoding((string)$str, 'UTF-8', mb_list_encodings());
        $defaults = array(
            'delimiter' => '-',
            'limit' => null,
            'lowercase' => true,
            'replacements' => array(),
            'transliterate' => true
        );
        $options = array_merge($defaults, $options);
        $char_map = array(
            // Latin
            'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'AE', 'Ç' => 'C',
            'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I',
            'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ő' => 'O',
            'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ű' => 'U', 'Ý' => 'Y', 'Þ' => 'TH',
            'ß' => 'ss',
            'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'ae', 'ç' => 'c',
            'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
            'ð' => 'd', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ő' => 'o',
            'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ű' => 'u', 'ý' => 'y', 'þ' => 'th',
            'ÿ' => 'y',
            // Latin symbols
            '©' => '(c)',
            // Greek
            'Α' => 'A', 'Β' => 'B', 'Γ' => 'G', 'Δ' => 'D', 'Ε' => 'E', 'Ζ' => 'Z', 'Η' => 'H', 'Θ' => '8',
            'Ι' => 'I', 'Κ' => 'K', 'Λ' => 'L', 'Μ' => 'M', 'Ν' => 'N', 'Ξ' => '3', 'Ο' => 'O', 'Π' => 'P',
            'Ρ' => 'R', 'Σ' => 'S', 'Τ' => 'T', 'Υ' => 'Y', 'Φ' => 'F', 'Χ' => 'X', 'Ψ' => 'PS', 'Ω' => 'W',
            'Ά' => 'A', 'Έ' => 'E', 'Ί' => 'I', 'Ό' => 'O', 'Ύ' => 'Y', 'Ή' => 'H', 'Ώ' => 'W', 'Ϊ' => 'I',
            'Ϋ' => 'Y',
            'α' => 'a', 'β' => 'b', 'γ' => 'g', 'δ' => 'd', 'ε' => 'e', 'ζ' => 'z', 'η' => 'h', 'θ' => '8',
            'ι' => 'i', 'κ' => 'k', 'λ' => 'l', 'μ' => 'm', 'ν' => 'n', 'ξ' => '3', 'ο' => 'o', 'π' => 'p',
            'ρ' => 'r', 'σ' => 's', 'τ' => 't', 'υ' => 'y', 'φ' => 'f', 'χ' => 'x', 'ψ' => 'ps', 'ω' => 'w',
            'ά' => 'a', 'έ' => 'e', 'ί' => 'i', 'ό' => 'o', 'ύ' => 'y', 'ή' => 'h', 'ώ' => 'w', 'ς' => 's',
            'ϊ' => 'i', 'ΰ' => 'y', 'ϋ' => 'y', 'ΐ' => 'i',
            // Turkish
            'Ş' => 'S', 'İ' => 'I', 'Ç' => 'C', 'Ü' => 'U', 'Ö' => 'O', 'Ğ' => 'G',
            'ş' => 's', 'ı' => 'i', 'ç' => 'c', 'ü' => 'u', 'ö' => 'o', 'ğ' => 'g',
            // Russian
            'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'Yo', 'Ж' => 'Zh',
            'З' => 'Z', 'И' => 'I', 'Й' => 'J', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
            'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
            'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sh', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'Yu',
            'Я' => 'Ya',
            'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh',
            'з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',
            'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',
            'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sh', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu',
            'я' => 'ya',
            // Ukrainian
            'Є' => 'Ye', 'І' => 'I', 'Ї' => 'Yi', 'Ґ' => 'G',
            'є' => 'ye', 'і' => 'i', 'ї' => 'yi', 'ґ' => 'g',
            // Czech
            'Č' => 'C', 'Ď' => 'D', 'Ě' => 'E', 'Ň' => 'N', 'Ř' => 'R', 'Š' => 'S', 'Ť' => 'T', 'Ů' => 'U',
            'Ž' => 'Z',
            'č' => 'c', 'ď' => 'd', 'ě' => 'e', 'ň' => 'n', 'ř' => 'r', 'š' => 's', 'ť' => 't', 'ů' => 'u',
            'ž' => 'z',
            // Polish
            'Ą' => 'A', 'Ć' => 'C', 'Ę' => 'e', 'Ł' => 'L', 'Ń' => 'N', 'Ó' => 'o', 'Ś' => 'S', 'Ź' => 'Z',
            'Ż' => 'Z',
            'ą' => 'a', 'ć' => 'c', 'ę' => 'e', 'ł' => 'l', 'ń' => 'n', 'ó' => 'o', 'ś' => 's', 'ź' => 'z',
            'ż' => 'z',
            // Latvian
            'Ā' => 'A', 'Č' => 'C', 'Ē' => 'E', 'Ģ' => 'G', 'Ī' => 'i', 'Ķ' => 'k', 'Ļ' => 'L', 'Ņ' => 'N',
            'Š' => 'S', 'Ū' => 'u', 'Ž' => 'Z',
            'ā' => 'a', 'č' => 'c', 'ē' => 'e', 'ģ' => 'g', 'ī' => 'i', 'ķ' => 'k', 'ļ' => 'l', 'ņ' => 'n',
            'š' => 's', 'ū' => 'u', 'ž' => 'z'
        );
        $str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);
        if ($options['transliterate']) {
            $str = str_replace(array_keys($char_map), $char_map, $str);
        }
        $str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);
        $str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);
        $str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');
        $str = trim($str, $options['delimiter']);
        return $options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;
    }

    public function _KLASORSIL($_KLASOR) {
        IF (substr($_KLASOR, strlen($_KLASOR)-1, 1)!= '/')
            $_KLASOR .= '/';
        IF ($handle = opendir($_KLASOR)) {
            WHILE ($_OBJ = readdir($handle)) {
                IF ($_OBJ!= '.' && $_OBJ!= '..') {
                    IF (is_dir($_KLASOR.$_OBJ)) {
                        IF (!$this->_KLASORSIL($_KLASOR.$_OBJ))
                            RETURN FALSE;
                    } ELSEIF (is_file($_KLASOR.$_OBJ)) {
                        IF (!unlink($_KLASOR.$_OBJ))
                            RETURN FALSE;
                    }
                }
            }
            CLOSEDIR($handle);
            IF (!@rmdir($_KLASOR))
                RETURN FALSE;
            RETURN TRUE;
        }
        RETURN FALSE;
    }

    public function YukleWidget()
    {
        $control = array();
        $control['folder'] = $this->_POST('folder');
        $control['lang'] = $this->_POST('lang');
        $control['modul'] = $this->_POST('modul');
        $control['id'] = $this->_POST('id');
        $control['name'] = $this->_POST('name');

        if($control['folder'] and !is_dir($control['folder'])) mkdir($control['folder'],755);

        // initialize FileUploader
        $FileUploader = new \FileUploader('files', array(
            'limit' => null,
            'maxSize' => null,
            'fileMaxSize' => null,
            'extensions' => null,
            'required' => false,
            'lang'=>$control["lang"],
            'uploadDir' => $control['folder'],
            'title' => (($control['name']) ? $this->permalink($control['name']) : 'dosya').'-'.rand(100000,999999),
            'replace' => false,
            'listInput' => true,
            'files' => null
        ));

        // call to upload the files
        $data = $FileUploader->upload();

        if($control['id'])
        {
            if(isset($data['files']) and is_array($data['files']))
                foreach ($data['files'] as $file)
                {

                    if ($control["modul"] == "temalar")
                    {
                        $baslik = $this->dbConn->tekSorgu('select * from temalar_alt WHERE id='.$control["id"]);
                        $folderName = $baslik["url"];
                        $uploadPath = $_SERVER["DOCUMENT_ROOT"]."demo/".$folderName."-".$control["id"];

                        if (!is_dir($uploadPath))
                        {
                            @mkdir($uploadPath, 755);
                        }
                        else {
                            $this->_KLASORSIL($uploadPath);
                            @mkdir($uploadPath, 755);
                        }

                        $dosya = $_SERVER["DOCUMENT_ROOT"]."upload/temalar/".$file['name'];

                        $zip = new \ZipArchive;
                        if ($zip->open($dosya) === TRUE) {
                            $zip->extractTo($uploadPath);
                            $zip->close();
                        }


                        $al = $this->dbConn->tekSorgu("select * from dosyalar WHERE type = 'temalar' and data_id=".$control["id"]);
                        if (is_array($al)){
                            $eski = $_SERVER['DOCUMENT_ROOT']."/upload/temalar/".$al["dosya"];
                            @unlink($eski);
                        }

                        @$this->dbConn->sil("DELETE FROM  dosyalar where type='temalar' and data_id = ".$control["id"]);

                    }

                    $this->dbConn->insert('dosyalar',
                        array(
                            'data_id'=>$control['id'],
                            'dosya'=>$file['name'],
                            'type' => $control['modul'],
                            "lang"=>$control["lang"],
                            'tur'=>$this->dosyaTur($file["name"]),
                        ));
                }
        }
        else
        {
            if(isset($_SESSION['proje_new_file_'.$control['modul']]) and is_array($_SESSION['proje_new_file_'.$control['modul']]))  $_SESSION['proje_new_file_'.$control['modul']] = array_merge($_SESSION['proje_new_file_'.$control['modul']],$data['files']);
            else  $_SESSION['proje_new_file_'.$control['modul']] = $data['files'];
        }

       echo json_encode($data);
       exit;

    }


    public function RemoveWidget(){


        $folder = $this->_POST('folder');
        $modul = $this->_POST('modul');
        $id = $this->_POST('id');
        $file =$this->_POST('file');

        if ($modul == "temalar"){
            if ($id){
                $al = $this->dbConn->tekSorgu("SELECT * FROM temalar_alt WHERE id = $id");
                $folderName = $al["url"]."-".$al["id"];
                $removePath = $_SERVER["DOCUMENT_ROOT"]."demo/".$folderName;
                if (is_dir($removePath)){
                    $this->_KLASORSIL($removePath);
                }
            }
        }

        if($file):

            $silme_tarihi = date("Y-m-d H:i:s");
            $silen = $this->getUserInfo("adi");
            //$filename  = $folder.$file;
            if($id) $this->dbConn->update("dosyalar",array("sil"=>1, "silme_tarihi"=>$silme_tarihi, "silen"=>$silen), array("data_id"=>$id, "type"=>$modul, "dosya"=>$file));
            //DELETE from dosyalar where data_id='{$id}' and type='{$modul}' and dosya='{$file}'");
            //if($filename and file_exists($filename))   unlink($filename);
            if(isset($_SESSION['proje_new_file_'.$modul]) and is_array($_SESSION['proje_new_file_'.$modul]))
            {
                $files = $_SESSION['proje_new_file_'.$modul];
                foreach ($files as $key=>$item) if($item['name'] == $file) unset($_SESSION['proje_new_file_'.$modul][$key]);
            }

        endif;

    }



    public  function sil()
    {


        $id = ((isset($_GET["id"])) ?  $this->koru($_GET["id"]):null);
        $gelenid =  ((isset($_GET["gelenid"])) ?  $this->koru($_GET["gelenid"]):null);
        $modul =  ((isset($_GET["modul"])) ?  $this->koru($_GET["modul"]):null);
        $folder =  ((isset($_GET["folder"])) ?  $this->koru($_GET["folder"]):null);

        $rec2 = $this->dbConn->tekSorgu("SELECT * FROM dosyalar WHERE id='$id'");

        $resim2=$rec2["dosya"];
        $this->ResimSil($resim2,base64_decode($folder)); // Eski resmi sil


        $this->dbConn->sil("DELETE FROM dosyalar WHERE id='$id'");


        header("location:?cmd=Dosya/resimekle&gelenid=".$gelenid."&modul=".$modul."&folder=".$folder);

    }

}