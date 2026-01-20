<?php
$toplamSayfa    =  (isset($param["toplamSayfa"])) ? $param["toplamSayfa"] : 0;
$sayfa    =  (isset($param["sayfa"])) ? $param["sayfa"] : "";
$urlType    =  (isset($param["urlType"])) ? $param["urlType"] : "";
$pageUrl    =  (isset($param["pageURL"])) ? $param["pageURL"] : "";
$lang    =  (isset($param["lang"])) ? $param["lang"] : "tr";
?>

<?php
if ($toplamSayfa > 1){

    $full_url = parse_url($this->fullUrl);
    parse_str($full_url['query'], $queries);
    unset($queries["page"]);

    if($urlType === true){
        $pageUrl = $full_url['scheme']."://".$full_url['host'].str_replace("//", "/", $full_url['path']);
        $pageUrl = str_replace('gesob/', '', $pageUrl);
        $all_queries = http_build_query($queries, '', '&amp;');
    }
?>

    <nav class="pagination-nav pdt-30">
        <ul class="pagination-list">


            <?php
            if( $sayfa > 1 )
            {
                $onceki = $pageUrl."/".($sayfa - 1);
                if ($urlType != ""){
                    $onceki = $pageUrl."?page=".($sayfa - 1).((!empty($all_queries)) ? "&".$all_queries : '');
                }

                echo '<li class="pagination-left-arrow"><a class="prevposts-link" href="'.$onceki.'"><i class="fa fa-angle-left"></i><span></a></li>';
            }
            ?>


            <?php
            for( $i = $sayfa - 4; $i < $sayfa + 5; $i++ )
            {
                if( $i > 0 && $i <= $toplamSayfa )
                {
                    $url = $pageUrl."/".$i;

                    if ($urlType != ""){
                        $url = $pageUrl."?page=".$i.((!empty($all_queries)) ? "&".$all_queries : '');
                    }
            ?>

                    <li class="<?=($i == $sayfa) ? 'active' : ''?>"><a class="page-numbers" href="<?=$url?>"><?=$i?></a></li>

            <?php
                }
            }
            ?>


            <?php
            if( $sayfa != $toplamSayfa )
            {

                $sonraki = $pageUrl."/".($sayfa + 1);
                if ($urlType != ""){
                    $sonraki = $pageUrl."?page=".($sayfa + 1).((!empty($all_queries)) ? "&".$all_queries : '');
                }

                echo '<li class="pagination-right-arrow"><a href="'.$sonraki.'"><i class="fa fa-angle-right"></i></a></li>';

            }
            ?>

        </ul>
    </nav>





<? } ?>