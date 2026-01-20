
<?
$appendedFiles = array();
if(isset($sql) and $sql)
{


    if(is_array($sql))
        foreach ($sql as $item)
        {

            $resim = $this->resimGet($item['dosya']);


            if($resim and  file_exists($params['folder'].$resim)):
                $appendedFiles[] = array(
                    "name" => ($item['baslik']) ? $item['baslik']:$resim,
                    "type" => \FileUploader::mime_content_type($params['folder'].$resim),
                    "size" => filesize($params['folder'].$resim),
                    "file_type"=>$item["file_type"],
                    "lang"=>$item["lang"],
                    "file" => $params['folder'].$resim,
                    "data" => array(
                        "url" =>  $this->BaseURL($params['folder'].$resim)
                    )
                );

            endif;

        }

}



if(isset($_SESSION['proje_new_file_'.$params['modul']]) and is_array($_SESSION['proje_new_file_'.$params['modul']])):
    foreach ($_SESSION['proje_new_file_'.$params['modul']] as $item)
    {

        $appendedFiles[] = array(
            "name" => $item['name'],
            "type" => $item['type'],
            "size" =>  $item['size'],
            "file" =>  $item['file'],
            "lang" =>  $item['lang'],
            "file_type"=>$item["file_type"],
            "data" => array(
                "url" =>  $this->BaseURL($item['file'])
            )
        );
    }
endif;


// convert our array into json string
$appendedFiles = json_encode($appendedFiles);
?>

<div id="fileuploader">
    <input class="over-max" type="file" name="<?=(($name) ? $name:'files')?>"  data-fileuploader-files='<?php echo $appendedFiles;?>'>

    <?
    if(isset($params) and is_array($params))
        foreach ($params as $name=>$item)
            echo '<input type="hidden" name="'.$name.'" value="'.$item.'">';

    ?>


</div>