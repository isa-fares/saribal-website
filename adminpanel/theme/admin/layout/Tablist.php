<?
$_get = $this->getParameter();
$modul = $_get["modul"];
$function = $_get["function"];

    if (isset($param) && is_array($param)){
?>
<div class='nav-tabs-custom flat-tab'>
    <ul class='nav nav-tabs'>
        <?
            foreach ($param as $tab) {
        ?>
            <li><a class='<?= ($function == $tab["href"]) ? "active" : "" ?>' href='<?= $this->baseAdminURL($modul . "/" . $tab["href"]) ?>'><i class="<?= $tab["icon"] ?>"></i> <?= $tab["title"] ?></a></li>
        <?
            }
        ?>


    </ul>
</div>
<? } ?>
