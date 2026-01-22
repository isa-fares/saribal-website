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

    <div class="pagination-area">
        <ul class="page-nav d-flex flex-wrap align-items-center justify-content-center list-unstyled mb-0">
            <?php
            // Previous button
            if( $sayfa > 1 )
            {
                $onceki = $pageUrl."/".($sayfa - 1);
                if ($urlType != ""){
                    $onceki = $pageUrl."?page=".($sayfa - 1).((!empty($all_queries)) ? "&".$all_queries : '');
                }
                ?>
                <li>
                    <a class="page-numbers" href="<?=$onceki?>" title="Önceki Sayfa">
                        <i class="fa fa-angle-left"></i>
                    </a>
                </li>
                <?php
            }
            
            // Page numbers
            // Show first page if not in range
            if ($sayfa > 5) {
                $url = $pageUrl."/1";
                if ($urlType != ""){
                    $url = $pageUrl."?page=1".((!empty($all_queries)) ? "&".$all_queries : '');
                }
                ?>
                <li>
                    <a class="page-numbers" href="<?=$url?>">1</a>
                </li>
                <?php
                if ($sayfa > 6) {
                    ?>
                    <li><span class="page-numbers dots">...</span></li>
                    <?php
                }
            }
            
            // Show page numbers around current page
            for( $i = max(1, $sayfa - 2); $i <= min($toplamSayfa, $sayfa + 2); $i++ )
            {
                $url = $pageUrl."/".$i;
                if ($urlType != ""){
                    $url = $pageUrl."?page=".$i.((!empty($all_queries)) ? "&".$all_queries : '');
                }
                ?>
                <li>
                    <a class="page-numbers <?=($i == $sayfa) ? 'active' : ''?>" href="<?=$url?>"><?=$i?></a>
                </li>
                <?php
            }
            
            // Show last page if not in range
            if ($sayfa < $toplamSayfa - 3) {
                if ($sayfa < $toplamSayfa - 4) {
                    ?>
                    <li><span class="page-numbers dots">...</span></li>
                    <?php
                }
                $url = $pageUrl."/".$toplamSayfa;
                if ($urlType != ""){
                    $url = $pageUrl."?page=".$toplamSayfa.((!empty($all_queries)) ? "&".$all_queries : '');
                }
                ?>
                <li>
                    <a class="page-numbers" href="<?=$url?>"><?=$toplamSayfa?></a>
                </li>
                <?php
            }
            
            // Next button
            if( $sayfa != $toplamSayfa )
            {
                $sonraki = $pageUrl."/".($sayfa + 1);
                if ($urlType != ""){
                    $sonraki = $pageUrl."?page=".($sayfa + 1).((!empty($all_queries)) ? "&".$all_queries : '');
                }
                ?>
                <li>
                    <a class="page-numbers" href="<?=$sonraki?>" title="Sonraki Sayfa">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </li>
                <?php
            }
            ?>
        </ul>
    </div>





<? } ?>