<?php
/***
 * @var $param array
 */
$_get = $this->getParameter();
$modul = $_get["modul"];
$function = $_get["function"];
$id = $_get["id"];
$columns_list = array();
?>

<style>
    tbody tr td {
        word-break: break-word;
    }
    .dataTables_filter{
        display: none;
    }
</style>

<div class="box">
    <div class="box-content">
        <table class="display table table-responsive-lg table-striped table-hover table-bordered"  data-page="<?=$param["modul"]?>" id="<?=$param["modul"]?>" >

            <thead>
            <? if (isset($param["columns"]) && is_array($param["columns"])):?>

                <tr class="bb-3 theme-border-color">
                    <? foreach ($param["columns"] as $key=>$column):?>
                        <? $columns_list[] = array("data"=>$column["value"], "orderable"=>$column["orderable"]); ?>
                        <th data-column="<?=$key?>">
                            <button style="border:0;background-color: transparent;" class="order-btn <?=($key == 0) ? "sorting-desc" : ""?>"></button>
                            <?=$column["title"]?>
                            <? if (isset($column["search"])):?>
                                <?
                                if ($column["search"] == "textbox"){
                                    echo "<input type='search' class='form-control form-control-sm' name='".$column["value"]."' placeholder='".$column["title"]."'>";
                                }

                                if ($column["search"] == "selectMenu"){

                                    if (isset($column["selectMenuData"])){
                                        echo "<select name='".$column["value"]."' class='custom-select  form-control form-control-sm'>";
                                        echo "<option value=''>Tümü</option>";
                                        foreach ($column["selectMenuData"] as $item){
                                            echo "<option value='".$item["value"]."'>".$item["title"]."</option>";
                                        }
                                        echo "</select>";
                                    }

                                    if (isset($column["selectMenuMysql"])){
                                        $title = $column["selectMenuMysql"]["settings"]["title"];
                                        $value = $column["selectMenuMysql"]["settings"]["value"];
                                        $table = $column["selectMenuMysql"]["table"];
                                        echo "<select name='".$column["value"]."' class='custom-select form-control form-control-sm'>";
                                        echo "<option value=''>Tümü</option>";
                                        foreach ($this->dbConn->sorgu("SELECT $value, $title FROM $table WHERE sil <> 1") as $data){
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
            <tbody></tbody>
        </table>
    </div>
</div>
<?php
$columns_list[] = array("data"=>"tools","targets"=>"no-sort");
?>

<script>
    let $body = $("body");
    let autoWidthValue = true;
    let winWidth = $(window).outerWidth();
    if (winWidth < 1200){
        autoWidthValue = false;
    }
    jQuery(document).ready(function($){


        let dataTable = $('#<?=$param["modul"]?>').DataTable({
            language: {
                "url": "<?=$this->ThemeFile("assets/jquery_datatable/tr.json")?>"
            },
            paging: true,
            lengthChange: true,
            info: true,
            cache: false,
            /*dom: 'Blfrtip',
            buttons: [
                'excelHtml5', 'pdf'
            ],*/
            processing: false,
            serverSide: true,
            lengthMenu: [[30, 50, 100], [30, 50, 100]],
            ajax: {
                url: BaseAdminURL+ "/?cmd=AjaxPage/index&modul=<?=$param["modul"]?>&modul_id=<?=$param["modul_id"]?>&archive=<?=$param["archive"]?>",
                type:"POST",
                data:{
                    headerColumns:<?=json_encode($param["columns"], JSON_PRETTY_PRINT)?>,
                    tools:<?=json_encode($param["tools"], JSON_PRETTY_PRINT)?>
                }
            },
            order: [[ 0, "desc" ]],
            autoWidth: autoWidthValue,
            "columnDefs": [
                { "width": "5%", "targets": 0 },
                /*{ "width": "10%", "targets": 9 },
                { "width": "15%", "targets":  6},*/
                { targets: '_all', orderable: false }
            ],
            "columns": <?=json_encode($columns_list, JSON_PRETTY_PRINT)?>,
            "createdRow": function( row, data, dataIndex ) {
                if (data["goruldu"] == 0){
                    $(row).addClass("bg-pale-danger");
                }
            },
            initComplete: function () {
                let table = this;
                $(".dataTable thead tr th .order-btn").on("click", function (){
                    $(".dataTable thead tr th .order-btn").not(this).removeClass("sorting-desc sorting-asc");
                    let column = $(this).parent("th").data("column");
                    if ($(this).hasClass("sorting-desc")){
                        $(this).addClass("sorting-asc").removeClass("sorting-desc");
                        table.api().column(column).order('asc').draw();
                    }else{
                        $(this).addClass("sorting-desc").removeClass("sorting-asc");
                        table.api().column(column).order('desc').draw();
                    }
                });

                $(".dataTable thead tr th input[type='search']").on("keyup change", function (){
                    let column = $(this).parent("th").data("column");
                    table.api().columns(column).search($(this).val()).draw();
                });

                $(".dataTable thead tr th select").on("change keyup", function (){
                    let column = $(this).parent("th").data("column");
                    let selectedVal = $(this).find("option:selected").val();

                    if (selectedVal === "Tümü"){
                        table.api().columns(column).search("").draw();
                    }else {
                        table.api().columns(column).search(selectedVal).draw();
                    }

                });

                let datePicker = $(".date-picker");
                datePicker.on("dp.change", function (){
                    let column = $(this).parent("th").data("column");
                    table.api().columns(column).search($(this).val()).draw();
                });


                $('[data-toggle="tooltip"]').tooltip();
                table.api().columns.adjust().draw();
                table.on( 'draw.dt', function () {
                    setTimeout(function (){
                        $('[data-toggle="tooltip"]').tooltip();
                    },300)
                });

            }


        });

        $body.on("click", ".changeType", function (){
            let $btn = $(this);
            let text  = $btn.data("text");
            let type  = $btn.data("type");
            let id    = $("#KariyerModal").data("id");
            $btn.attr("disabled",true);
            $btn.append("<i class='loading fa fa-spin fa-spinner'></i>");
            setTimeout(function (){
                $.post(BaseAdminURL +'/?cmd=AjaxPage/IsDurum/'+id, {
                    durum: type,
                }, function (data){
                    if(data==1) {alert('Durum Güncellendi');
                        $('#KariyerModal label[for=durumu]').html(text);
                        dataTable.ajax.reload(null, false);
                    }
                    else alert('Hata Oluştu');
                    $btn.attr("disabled",false);
                    $btn.find(".loading").remove();
                });
            },300);
        });

        $body.on("click", ".deletePerson", function (e){
            e.preventDefault();
            let data_id  = $(this).data("id");
            let url = $(this).attr("href");
            swal({
                title: 'Veri Silinecektir!',
                html: "Bu kayıt kalıcı olarak silinecektir.<br> Devam etmek istediğinize emin misiniz?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#9c9c9c',
                confirmButtonText: 'Tamam',
                cancelButtonText: 'İptal',
                reverseButtons: true
            }).then(function(result) {
                if (result.value) {
                    $.get( url+data_id).done(function( data ) {
                        if (data == 1){
                            dataTable.ajax.reload(null, false);
                            const toast = swal.mixin({
                                toast: true,
                                position: 'top-center',
                                showConfirmButton: false,
                                timer: 5000
                            });

                            toast({
                                type: "success",
                                title: "Kayıt Silindi"
                            });
                        }
                        else{
                            swal({
                                title: "Hata Oluştu",
                                type: 'error',
                            });
                        }
                    });
                }
            });
        });


        $body.on("click", ".AddArchive", function (e){
            e.preventDefault();
            let data_id  = $(this).data("id");
            let url = $(this).attr("href");
            let archive = $(this).data("archive");
            if (archive === 0){
                archive = 1;
            }else {
                archive = 0;
            }
            swal({
                title: 'Arşiv İşlemi',
                html: "Bu veri "+((archive == "1") ? "arşive eklenecektir" : " arşivden çıkarılacaktır")+".<br> Devam etmek istediğinize emin misiniz?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#9c9c9c',
                confirmButtonText: 'Tamam',
                cancelButtonText: 'İptal',
                reverseButtons: true
            }).then(function(result) {
                if (result.value) {
                    $.post( url+data_id, {"archive":archive}).done(function( data ) {
                        if (data == "1"){
                            dataTable.ajax.reload(null, false);
                            const toast = swal.mixin({
                                toast: true,
                                position: 'top-center',
                                showConfirmButton: false,
                                timer: 5000
                            });

                            toast({
                                type: "success",
                                title: (archive == "1") ? "Arşive Eklendi" : "Arşivden Çıkarıldı"
                            });
                        }
                        else{
                            swal({
                                title: "Hata Oluştu",
                                type: 'error',
                            });
                        }
                    });
                }
            });
        });


        $("body").on("click", ".KariyerModalDetail", function (){
            setTimeout(function (){
                dataTable.ajax.reload(null,false);
            },300)
        });


        $("body").on("click", ".KariyerModalDetail", function (e){
            e.preventDefault();
            let url = $(this).attr("href");
            let id = $(this).data("id");
            let table = $(this).data("table");
            $.ajax({

                url:url+id+"&table="+table,
                type:'GET',
                success:function (g) {
                    if(g){

                        let data = $.parseJSON(g);
                        let this_modal = $('#KariyerModal');

                        this_modal.attr('data-id',data.id);

                        $('.yazdir').attr('data-id',data.id);


                        $.each(data,function (key,value) {
                            this_modal.find('label[for='+key+']').html(value);
                            if (key === "resim"){
                                if (value !== ""){
                                    this_modal.find(".imageBlok").removeClass("disable");
                                    this_modal.find(".imageBlok img").attr("src", value);
                                }
                                else {
                                    this_modal.find(".imageBlok").addClass("disable");
                                }
                            }
                            if (key === "cv"){
                                if (value !== null){
                                    this_modal.find(".cvBlok").removeClass("d-none");
                                    this_modal.find(".cvBlok a").attr("href", value);
                                }else {
                                    this_modal.find(".cvBlok").addClass("d-none");
                                }
                            }
                        });
                        this_modal.modal('show');

                        var bturl = $(".yazdirButon").attr("data-url");
                        $(".yazdirButon").attr("href", bturl+data.id);

                    }
                }

            });
            return false;
        });


        function GetNewDataCount(){
            $.get(BaseAdminURL+"/AjaxPage/GetNewDataCount").done(function (data){
                let elementLi = $("li[data-modul='kariyer']");
                if (data > 0){
                    if (elementLi.find(".badge-pill").length){
                        elementLi.find(".badge-pill").text(data);
                    }else {
                        elementLi.find("a").append("<span class='badge badge-pill badge-danger ml-5'>"+data+"</span>");
                    }
                }else {
                    elementLi.find(".badge-pill").remove();
                }
            });
        }
        setInterval(GetNewDataCount, 3000 );
    });
</script>

