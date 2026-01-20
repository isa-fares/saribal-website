<?
$_get = $this->getParameter();
$modul = $_get["modul"];
$function = $_get["function"];
$archive = (isset($_GET["archive"])) ? $_GET["archive"] : 0;
?>
<div class='nav-tabs-custom flat-tab'>
    <ul class='nav nav-tabs'>

            <li><a class='<?= ($archive == 0) ? "active" : "" ?>' href='<?= $this->baseAdminURL($modul . "/liste")?>'><i class="mdi mdi-view-sequential"></i> Liste</a></li>
            <li style="margin-bottom: -2px"><a class='<?= ($archive == 1) ? "active" : "" ?>' href='<?= $this->baseAdminURL($modul . "/liste&archive=1")?>'><i class="fa fa-archive"></i> Arşiv Kayıtları</a></li>


    </ul>
</div>
