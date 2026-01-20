<?php
/***
 * @var $param array
 */
$_get = $this->getParameter();
$modul = $_get["modul"];
$function = $_get["function"];
$id = $_get["id"];
?>

<div class="box">
    <div class="box-content">
        <table class="display table table-responsive-md table-striped  table-bordered"  data-page="<?=$param["modul"]?>" id="<?=$param["modul"]?>" >

            <thead>
                <? if (isset($param["columns"]) && is_array($param["columns"])):?>
                    <tr class="bb-3 theme-border-color">
                        <? foreach ($param["columns"] as $key=>$column):?>
                            <th data-column="<?=$key?>">
                                <button class="order-btn <?=($key == 0) ? "sorting-desc" : ""?>"></button>
                                <?=$column["title"]?>
                                <? if (isset($column["search"])):?>
                                    <?
                                        if ($column["search"] == "textbox"){
                                            echo "<input type='search' class='form-control form-control-sm' name='".$column["value"]."' placeholder='".$column["title"]."'>";
                                        }

                                        if ($column["search"] == "selectMenu"){

                                            if (isset($column["selectMenuData"])){
                                                echo "<select name='".$column["value"]."' class='custom-select  form-control form-control-sm'>";
                                                echo "<option>Tümü</option>";
                                                foreach ($column["selectMenuData"] as $item){
                                                    echo "<option value='".$item["value"]."'>".$item["title"]."</option>";
                                                }
                                                echo "</select>";
                                            }

                                            if (isset($column["selectMenuMysql"])){
                                                $title = $column["selectMenuMysql"]["settings"]["title"];
                                                $value = $column["selectMenuMysql"]["settings"]["value"];
                                                echo "<select name='".$column["value"]."' class='custom-select form-control form-control-sm'>";
                                                echo "<option>Tümü</option>";
                                                foreach ($column["selectMenuMysql"]["data"] as $data){
                                                    echo "<option value='".$data[$value]."'>".$data[$title]."</option>";
                                                }
                                                if (isset($column["selectMenuMysql"]["append"])){
                                                    foreach ($column["selectMenuMysql"]["append"] as $append_item){
                                                        echo "<option value='".$append_item["value"]."'>".$append_item["title"]."</option>";
                                                    }
                                                }
                                                echo "</select>";
                                            }

                                        }

                                        if ($column["search"] == "date"){
                                            echo "<input placeholder='".$column["title"]."'  data-use-current='false' value='' data-format='DD-MM-YYYY' data-show-close='true' data-show-clear='true' type='text' name='".$column["value"]."' class='form-control  form-control-sm date-picker'>";
                                        }

                                    ?>
                                <? endif; ?>

                            </th>
                        <? endforeach;?>

                        <? if (isset($param["tools"])):?>
                            <th data-column="<?=$key+1?>">Araçlar</th>
                        <? endif;?>
                    </tr>
                <? endif;?>
            </thead>

            <tbody>
                <? if (isset($param["data"]) && is_array($param["data"])):?>
                    <? foreach ($param["data"] as $data):?>
                        <tr>
                            <? foreach ($param["columns"] as $column):?>
                                <td>
                                    <?
                                        if (isset($column["selectMenuMysql"])){
                                            $title = $column["selectMenuMysql"]["settings"]["title"];
                                            $value = $column["selectMenuMysql"]["settings"]["value"];
                                            $array_keys = array_column($column["selectMenuMysql"]["data"], $title, $value);
                                            echo $array_keys[$data[$column["value"]]];
                                        }
                                        elseif(isset($column["selectMenuData"])){
                                            $array_keys = array_column($column["selectMenuData"], "title", "value");
                                            echo $array_keys[$data[$column["value"]]];
                                        }
                                        else {
                                            echo $data[$column["value"]];
                                        }
                                    ?>
                                </td>
                            <? endforeach;?>
                        </tr>
                    <? endforeach;?>
                <? endif;?>
            </tbody>

        </table>
    </div>
</div>


<script>
    jQuery(document).ready(function($){


        let table = $('#<?=$param["modul"]?>').DataTable({
           language: {
                "url": "<?=$this->ThemeFile("assets/jquery_datatable/tr.json")?>"
            },
            paging: true,
            lengthChange: true,
            searching: true,
            ordering: true,
            info: true,
            cache: false,
            pageLength:"20",
            processing: false,
            serverSide: true,
            ajax: BaseAdminURL+ "?cmd=Ajax/datalist",
            order: [[ 0, "desc" ]],
            autoWidth: false,
            fixedHeader: true,
            columnDefs: [{
                "width": "10%", "targets": "0",
                targets: "_all",
                orderable: false
            }]
        });

        $('.dataTable tbody').on('click', 'tr', function () {
            $(this).toggleClass('bg-light-blue text-dark');
        } );

        $(".dataTable thead tr th .order-btn").on("click", function (){
            $(".dataTable thead tr th .order-btn").not(this).removeClass("sorting-desc sorting-asc");
            let column = $(this).parent("th").data("column");
                if ($(this).hasClass("sorting-desc")){
                    $(this).addClass("sorting-asc").removeClass("sorting-desc");
                    table.column(column).order('asc').draw();
                }else{
                    $(this).addClass("sorting-desc").removeClass("sorting-asc");
                    table.column(column).order('desc').draw();
                }
        });


        $(".dataTable thead tr th input[type='search']").on("keyup change", function (e){
            let column = $(this).parent("th").data("column");
            table.columns(column).search($(this).val()).draw();
        });

        $(".dataTable thead tr th select").on("change keyup", function (e){
            let column = $(this).parent("th").data("column");
            let selectedText = $(this).find("option:selected").text();

            if (selectedText == "Tümü"){
                table.columns(column).search("").draw();
            }else {
                table.columns(column).search(selectedText).draw();
            }

        });


        let datePicker = $(".date-picker");
        datePicker.on("dp.change", function (){
            let column = $(this).parent("th").data("column");
            table.columns(column).search($(this).val()).draw();
        });


    });
</script>

