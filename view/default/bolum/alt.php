<?php /**
 * @var $this FrontClass|Loader object
 * @var $lang string
 * @var $assetURL string
 * @var $page string
 */ ?>
<?php
$kurumsal  = $this->dbLangSelect("sayfa","aktif = 1 and baslik <> '' and kid = 1");
$mevzuat  = $this->dbLangSelect("sayfa","aktif = 1 and baslik <> '' and kid = 2");
$ahilik  = $this->dbLangSelect("sayfa","aktif = 1 and baslik <> '' and kid = 3");
$kurumsal_kimlik = $this->dbLangSelectRow('sayfa', ['id'=>2, 'master_id'=>22]);
?>

