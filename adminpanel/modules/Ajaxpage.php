<?php


namespace AdminPanel;


class Ajaxpage  extends Settings{


    public  $modulName;
    private $table;
    private $tablelang;
    public  $tablist;
    public  $modul_info;
    public $headerColumns;

    public function __construct($settings)
    {
        parent::__construct($settings);

        $this->AuthCheck();

        $this->table = $this->_GET("modul");
        $this->tablelang = $this->_GET("modul")."_lang";
    }


    public function index()
    {



        $data = [];

        $archive = $this->_GET("archive");
        $cols = $this->_POST("headerColumns");
        $this->headerColumns = $cols;
        $tools = $this->_POST("tools");
        $query_columns = [];

        foreach ($cols as $col){
            $query_columns[]=$col["value"];
        }


        $query_columns[] = "archive";
        $query_columns[] = "sil";
        $query_columns[] = "goruldu";
        $where = " WHERE sil <> 1 ";


        $columns =  $this->_POST('columns');
        $getOrder  = $this->_POST('order');
        $orderColumn = $columns[$getOrder[0]['column']]['data'];
        $orderType = $getOrder[0]['dir'];


        foreach ($columns as $column):
            if((isset($column['search']['value'])) and $column['search']['value'] != ""){
                $searchValue = $column["search"]["value"];
                $searchColumn = $column["data"];

                if ($searchColumn=="id" or $searchColumn=="cinsiyet" or $searchColumn=="durum" or $searchColumn=="calismak_istenen_yer" or $searchColumn=="tahsil"){
                    $where .= " and $searchColumn='$searchValue'";
                }
                else{
                    $where .= " and  $searchColumn like'%$searchValue%'";
                }
            }
        endforeach;

        $where.= " and archive = $archive";
        $sql = "SELECT ".implode(",",$query_columns)." FROM $this->table $where ORDER BY $orderColumn $orderType";




        $countSql = $this->dbConn->sorgu("SELECT id FROM $this->table WHERE sil <> 1 and archive = $archive");
        $recordsTotal = (is_array($countSql)) ? count($countSql) : 0;
        $pageLimitCount = $this->_POST('length'); if ($pageLimitCount == "-1") $pageLimitCount = 1000000;
        $pageLimitStart = $this->_POST('start');
        $totalData = $this->dbConn->sorgu($sql);
        $filteredData = $this->dbConn->sorgu($sql." limit $pageLimitStart,$pageLimitCount");

        $data['draw'] =  $this->_POST('draw');
        $data['recordsTotal'] = $recordsTotal;
        if (is_array($totalData)){
            $data['recordsFiltered'] =  count($totalData);
        }else {
            $data['recordsFiltered'] =  0;
        }



        if(is_array($filteredData)):
            foreach ($filteredData as $key=>$item):
                $colArray = array();
                foreach ($cols as $col):
                    if (isset($col["selectMenuMysql"])){

                        $title = $col["selectMenuMysql"]["settings"]["title"];
                        $value = $col["selectMenuMysql"]["settings"]["value"];
                        $table = $col["selectMenuMysql"]["table"];
                        $dt = $this->dbConn->tekSorgu("SELECT $value, $title FROM $table WHERE sil <> 1 and $value = ".$item[$col["value"]]);
                        $array_keys = array_column($col["selectMenuMysql"]["append"], "title", "value");
                        if (isset($array_keys[$item[$col["value"]]])){
                            $colArray[$col["value"]] = $this->temizle($array_keys[$item[$col["value"]]]);
                        }else {
                            $colArray[$col["value"]] = $this->temizle($dt[$title]);
                        }

                    }

                    elseif(isset($col["selectMenuData"])){
                        $array_keys = array_column($col["selectMenuData"], "title", "value");

                        $colArray[$col["value"]] = $this->temizle($array_keys[$item[$col["value"]]]);
                    }

                    else {
                        $colArray[$col["value"]] = mb_substr($this->temizle($item[$col["value"]]), 0, 80, "UTF-8").((strlen($item[$col["value"]]) > 80) ? "..." : "");
                    }
                    $colArray["goruldu"] = $item["goruldu"];
                endforeach;
                $toolsText = "";

                foreach ($tools as $tool){
                    $toolsText.='<a class="'.$tool["class"].'" data-toggle="tooltip" data-placement="top" title="'.$tool["title"].'" data-original-title="'.$tool["title"].'" href="'.$tool["url"].'" data-page="'.$this->table.'" data-archive="'.$item["archive"].'" data-table="'.$this->table.'" data-id="'.$item['id'].'"><i class="'.$tool["icon"].'"></i></a>';
                }

                $colArray["tools"] = $toolsText;
                $colArray["sql"] = $sql;
                $data["data"][] = $colArray;

            endforeach;


        else:
            $data["data"] = "";
        endif;





        echo  json_encode($data,JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        exit();

    }

    public function durum($data) {
        $array =  array(
            0=>array('id'=>0,"value" => 'İşlem Yapılmadı'),
            1=>array('id'=>1,"value" => 'Onaylandı'),
            2=>array('id'=>2,"value" => 'Olumlu'),
            3=>array('id'=>3,"value" => 'Olumsuz'),
            4=>array('id'=>4,"value" => 'Red Edildi')
        );

        return $array[$data]["value"];
    }

    public function detail($id=null)
    {

        if($id):
            $table = $this->_GET("table");
            $data =   $this->dbConn->tekSorgu("select * from $table where id='$id'");
            $this->dbConn->update($table,array("goruldu"=>1), $id);
            $data["durumu"] = $this->durum($data["durum"]);

            echo  json_encode($data,JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            exit;
        endif;
    }


    public function IsDurum($id=null)
    {
        if($id):
            $durum = $this->_POST("durum");
            if($this->dbConn->update("kariyer",array('durum'=>$durum),$id)) echo 1;else echo 0;
        endif;
    }

    public function sil($id=null)
    {
        if($id):
            if($this->dbConn->update("kariyer",array('sil'=>1),$id)) echo 1;else echo 0;
        endif;
    }

    public function archive($id=null)
    {
        if($id):
            $archive = $this->_POST("archive");
            if($this->dbConn->update("kariyer",array('archive'=>$archive),$id)) echo 1;else echo 0;
        endif;
    }

    public function GetNewDataCount()
    {
        $data = $this->dbConn->sorgu("SELECT goruldu FROM kariyer WHERE sil <> 1 and goruldu = 0");
        echo (is_array($data)) ? count($data) : 0;
    }












    public function CustomPageCss($url)
    {
        // Sadece bu sayfa için gerekli Stil dosyaları eklenebilir
        $text = "";
        foreach ($this->css as $css){
            $text.="<link rel='stylesheet' type='text/css' href='".$this->ThemeFile("assets/".$css)."'>\n\t";
        }
        return $text;

    }


    public function CustomPageJs($url)
    {
        // Sadece bu sayfa için gerekli javascript dosyaları eklenebilir
        $text = "";
        foreach ($this->js as $js){
            $text.="<script type='text/javascript' src='".$this->ThemeFile("assets/".$js)."'></script>\n\t";
        }
        return $text;
    }




}