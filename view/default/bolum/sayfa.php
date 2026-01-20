<?
if ($type == "open"){
$rnd = rand(1,4);
?>

    <?
    if (isset($resim) && !empty($resim)){
        if (strstr($resim, "http") !== false){
            $file = $resim;
        }else {
            $file = $this->themeURL.$resim;
        }
    }else {
        $file = $this->themeURL."images/main_bg2.jpg";
    }

    ?>

    <section class="page-title-section">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 text-center">
                    <h2 class="text-uppercase text-white mrb-20"><?=$baslik?></h2>
                    <?
                    if (is_array($breadcrumb)) {
                        echo '<ul class="mb-0 justify-content-center">';
                        echo '<li class="breadcrumb-item"><a href="'.$this->baseURL("index", $lang, 1).'" class="text-white">'.$this->lang->header("index").'</a></li>';

                        $toplam = count($breadcrumb);
                        $i = 1;
                        foreach ($breadcrumb as $item) {
                            if ($i == $toplam){
                                echo "<li class='breadcrumb-item color-secondary'>".$this->cumleKisalt($item['title'])."</li>";
                            }
                            else {
                                echo '<li class="breadcrumb-item"><a class="text-white" href="'.$item["href"].'">'.$item["title"].'</a></li>';
                            }
                            $i++;
                        }
                        echo '</ul>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>





    <section id="<?=(isset($id) ? $id : "sec1")?>" class="page-section section-full <?=(isset($page) && $page != "") ? $page : ""?> <?=(isset($contentClass) && $contentClass != "") ? $contentClass : ""?>" style="
    <?=((isset($contentImage)) ? "background-image:url('".$this->themeURL."/".$contentImage."')" : "")?>
            ">
        <div class="<?=(!isset($container)) ? "container" : "" ?>">
            <div class="<?=(!isset($row)) ? "row" : "" ?>">

                <? } ?>

                <?
                if ($type == "close"){?>
            </div>
        </div>
    </section>

<? } ?>






     

