<div class="breadcrumbs inline-breadcrumbs fl-wrap block-breadcrumbs">
    <a href="<?=$this->baseURL("index", $lang, 1)?>"><?=$this->lang->header("Anasayfa")?></a>
    <?
    if (is_array($param)) {
        $toplam = count($param);
        $i = 1;
        foreach ($param as $item) {
            if ($i == $toplam){
                echo "<span>".$item["title"]."</span>";
            }
            else {
                echo '<a href="'.$item["href"].'">'.$item["title"].'</a>';
            }
            $i++;
        }
    }
    ?>
</div>
