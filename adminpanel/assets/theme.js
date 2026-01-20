



function bildirimAt(text, custom){
    if (typeof custom === 'undefined') custom = '';

    if (text !== ""){
        var master = $("#sonucMesaj");
        var text2 = master.children("div").html();


        if (text2 === ""){
            text2 = custom;
        }


        const toast = swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000
        });

        toast({
            type: 'success',
            title: text2
        });

    }
}





function decodeEntities(encodedString) {
    var textArea = document.createElement('textarea');
    textArea.innerHTML = encodedString;
    return textArea.value;
}


function bildirimKapat(){
    $("#sonucMesaj").slideUp();
}

String.prototype.cleanup = function() {
    return this.replace(/[^a-zA-Z0-9\w\._İÖÇŞÜĞıöçşğü-\s]+/g, "");
};

var mySkins = [
    'skin-blue',
    'skin-black',
    'skin-red',
    'skin-yellow',
    'skin-purple',
    'skin-green',
    'skin-blue-light',
    'skin-black-light',
    'skin-red-light',
    'skin-yellow-light',
    'skin-purple-light',
    'skin-green-light'
];

function changeSkin(cls) {
    $.each(mySkins, function (i) {
        $('body').removeClass(mySkins[i])
    });
    $("body").addClass(cls);
    return false;
}


function getPanelMessage(){
    $.ajax({
        url: BaseAdminURL +'/?cmd=Ajax/getPanelMessage',
        type: 'GET',
        success:function(g)
        {
            try
            {
                var data = JSON.parse(g);
                const toast = swal.mixin({
                    toast: true,
                    position: 'center-center',
                    showConfirmButton: false,
                    timer: 5000
                });

                toast({
                    type: data.type,
                    title: data.message
                });
            }
            catch(e)
            {
                //
            }
        }
    });
}


function updateNumberStudent(){
    $(".students-information tr").each(function (i, l) {
        var number = i + 1;
        $(this).find(".number").html(number);
    });
}

$(document).ready(function() {

    getPanelMessage();


    $(".lang_select_radios").find("input[type='radio']").on("change", function (e) {
        let val = $(this).val();
            $(".options_lang").hide();
            $(".option_"+val).show();
            $(".option_"+val).find("option:selected").prop("selected", false);
            $(".option_"+val).find("select").trigger("change");
    });




    $(".select_all_button").on("click", function (e) {
        let targetName = $(this).data("selectname");
        if($(this).is(':checked') ){
            $("#"+targetName+" > option").prop("selected","selected");
            $("#"+targetName).trigger("change");
        }else{
            $("#"+targetName+" > option").prop("selected", false);
            $("#"+targetName).trigger("change");
        }
    });




    $('.colorpicker').colorpicker({
        format: 'hex'
    });

    $('.kayitDetailBtn').on('click', function (){
       $(this).closest('tr').removeClass('goruldu_0')
    });


    $('[data-skin]').on('click', function (e) {
        var skin = $(this).data("skin");
        $.ajax({
            url: BaseAdminURL +'/?cmd=Ajax/changeTheme',
            type: 'GET',
            data: { theme: skin},
            success:function(g)
            {
                changeSkin(skin);
            }
        });
    });


    $('.remove-image-btn').on('click', function (e) {

        e.preventDefault();

        var table = $(this).data("table"),
            id = $(this).data("id"),
            column = $(this).data("column"),
            lang = $(this).data("lang"),
            imageName,
            btn = $(this);

        $.ajax({
            url: BaseAdminURL +'/?cmd=Ajax/removeImage',
            type: 'GET',
            data: { id: id, table:table, column:column, lang:lang},
            success:function(g)
            {
                if (g == 1){
                    bildirimAt("success","Resim Silindi");
                    if(lang === undefined){
                        imageName = column;
                    }else {
                        imageName = column+"_"+lang;
                    }
                    $(".cropper-wrapper").find('input[type="text"]#'+imageName+'-input').attr("value","");
                    $(".cropper-container").find("#cropper-preview-image-"+imageName).remove();
                    btn.remove();
                }
                else {
                    alert("Hata Oluştu");
                }
            }
        });
    });



    updateNumberStudent();

    var studentCount = $("input[name='toplam']");

    $("body").on("click", ".add-student", function (e) {

        e.preventDefault();

        var container = $("tbody.students-information");

        var studentRowTpl = "<tr class='row-student new-student'>"
            +"<td class='number' width='5%'></td>"
            +"<td width='35%'><input type='text' class='form-control students-input' name='adi[]' placeholder='Adı Soyadı *' required></td>"
            +"<td width='33%'><input type='text' class='form-control students-input' name='telefon[]' placeholder='Telefon Numarası *' required></td>"
            +"<td width='20%'><input type='email' class='form-control students-input' name='email[]' placeholder='Email Adresi *' required></td>"
            +"<td width='5%' style='text-align: center; vertical-align: middle'><a href='#' class='btn btn-small btn-danger remove-row'><i class='fa fa-remove'></i> </a> </td>"
            +"</tr>";

        container.append(studentRowTpl);
        studentCount++;

        updateNumberStudent();

        var eklenen = $("tr.new-student").length;
        if (eklenen > 0){
            $(".btn-save").show();
        }
        else {
            $(".btn-save").hide();
        }

    });



    $("body").on("click", ".modalKatilimci", function (e) {
        e.preventDefault();
        var kurs_id = $(this).data("id");
        var $modal = $("#modalKatilimci");



        $.ajax({
            url: BaseAdminURL +'/?cmd=Ajax/modalKatilimci&kurs_id='+kurs_id,
            type: 'GET',
            success:function(g)
            {

                try
                {
                    var obj=jQuery.parseJSON(g);
                    $modal.find("pre.email").html(obj.email);
                    $modal.find("pre.telefon").html(obj.telefon);
                    $modal.find(".emailList").attr("href", BaseAdminURL +'/?cmd=Ajax/setEmailExcel&kurs_id='+kurs_id);
                    $modal.find(".telefonList").attr("href", BaseAdminURL +'/?cmd=Ajax/setTelefonExcel&kurs_id='+kurs_id);
                    $modal.modal("show");

                }

                catch(err)
                {
                    swal({
                        title: 'Kayıt Bulunamadı.',
                        type: 'error',
                    });
                }

            }
        });
    });



    $("body").on("click", ".modalFatura", function (e) {
        e.preventDefault();
        var kurs_id = $(this).data("id");
        var $modal = $("#modalFatura");



        $.ajax({
            url: BaseAdminURL +'/?cmd=Ajax/modalFatura&kurs_id='+kurs_id,
            type: 'GET',
            success:function(g)
            {

                try
                {
                    var obj=jQuery.parseJSON(g);
                    $modal.find("h4.adi").html(obj.title);
                    $modal.find("tbody").html(obj.data);
                    $modal.modal("show");
                }

                catch(err)
                {
                    swal({
                        title: 'Kayıt Bulunamadı.',
                        type: 'error',
                    });
                }

            }
        });
    });



    $("body").on("click", ".remove-row", function (e) {
        e.preventDefault();
        var siparisId = $("input[name='siparisNo']").val();
        var id = $(this).data("id");
        var $this = $(this);

        if ($(this).hasClass("added-student")){
            swal({
                title: 'Veri Silinecektir!',
                html: "Bu katılımcı kalıcı olarak silinecektir.<br> Devam etmek istediğinize emin misiniz?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#9c9c9c',
                confirmButtonText: 'Tamam',
                cancelButtonText: 'İptal',
                reverseButtons: true
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: BaseAdminURL +'/?cmd=Ajax/kursiyerSil&id='+id+"&siparis_id="+siparisId,
                        type: 'GET',
                        success:function(g)
                        {
                            if (g == 1){
                                location.reload();
                            }
                            else{
                                swal({
                                    title: 'Hata Oluştu.',
                                    type: 'error',
                                });
                            }
                        }
                    });
                }
            });

        }
        else {
            $(this).parent().parent().remove();
            updateNumberStudent();

            var eklenen = $("tr.new-student").length;
            if (eklenen > 0){
                $(".btn-save").fadeIn();
            }
            else {
                $(".btn-save").fadeOut();
            }
        }



    });





    $('.yorumModal').on('click', function () {
        var button = $(this);
        var id = button.data("id");
        var modal = $('#yorumModal');


        $.ajax({
            url:BaseAdminURL+"/?cmd=Ajax/yorumAl&id="+id,
            type:'GET',
            success:function (g) {
                if(g){
                    var data = $.parseJSON(g);
                    modal.attr('data-id',id);

                    $.each(data,function (key,value) {
                        modal.find('label[for='+key+']').html(value);
                    });

                    modal.modal('show');
                }
            }
        });



    });


    $("a.truncateTable").on("click", function (e) {
       e.preventDefault();

        swal({
            title: 'Önemli Uyarı',
            html: "Veritabanı ve Upload Klasörü Tamamen Silinicektir.<br> Devam etmek istediğinize emin misiniz?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#9c9c9c',
            confirmButtonText: 'Tamam',
            cancelButtonText: 'İptal',
            reverseButtons: true
        }).then(function(result) {
            if (result.value) {

                swal({
                    title: 'İşlem Yapılıyor.',
                    html:'Veriler siliniyor. Lütfen bekleyiniz...',
                    type: 'info',
                });


                $.ajax({
                    url: BaseAdminURL +'/?cmd=Ajax/truncateTable',
                    type: 'GET',
                    success:function(g)
                    {
                        if (g == 1){
                            location.reload();
                            swal({
                                title: 'Başarılı',
                                html:"Veriler Başarıyla Temizlendi",
                                type: 'success',
                            });
                        }
                        else{
                            swal({
                                title: 'Hata Oluştu.',
                                type: 'error',
                            });
                        }
                    }
                });
            }
        });


    });

    $(".infoModal").on("click", function(e){

        e.preventDefault();

        var id = $(this).data("id");
        var modal = $('#infoModal');
        var tur = $(this).data("tur");

        modal.find(".modal-title").html("Üye Bilgileri");

        $.ajax({
            url:BaseAdminURL+"/?cmd=Ajax/uyeAl&id="+id,
            type:'GET',
            success:function (g) {
                if(g){

                        modal.find(".user-2").css("display","none");


                    var data = $.parseJSON(g);
                    modal.attr('data-id',id);


                    $.each(data,function (key,value) {

                        modal.find('label[for='+key+']').html(value);

                    });

                    modal.modal('show');
                }
            }
        });

    });



    $("body").on("click", "a.showPass", function (e) {
        e.preventDefault();
        if (!$(this).hasClass("active")){
            $(".hidden-pass").hide();
            $(".show-pass").show();
            $(this).addClass("active");
        }
        else {
            $(".hidden-pass").show();
            $(".show-pass").hide();
            $(this).removeClass("active");
        }
    });


    $(".buttonYorumOnay").on("click", function () {

        var modal = $('#yorumModal');
        var id = modal.data("id");
        var durum = $(this).data("durum");

        $.ajax({

            url:BaseAdminURL+"/?cmd=Ajax/yorumOnay&id="+id+"&durum="+durum,
            type:'GET',

            success:function (g) {
                if(g == 1){
                    if (durum == 1){
                        $("tr[data-id='"+id+"']").removeClass("durum_0").addClass("durum_1");
                    }
                    else {
                        $("tr[data-id='"+id+"']").removeClass("durum_1").addClass("durum_0");
                    }


                    modal.modal('hide');
                }
            }
        });
    });


    $(".search-block-input").on("click", function(e){
        e.preventDefault();
        $(this).parent().toggleClass("active");
    });

    $("body").on("click", function () {
        var noClose = '.search-block, .search-block *';

        if ($(".search-block").hasClass("active")){
            if (!event.target.matches(noClose)) {
                $(".search-block").removeClass("active");
            }
        }
    });


    $("body").on("click", ".search-default-text", function () {

        $(this).closest(".search-block").removeClass("active");
        $(this).closest(".search-block").find(".return_value").val(0);
        $(this).closest(".search-block").find("li").removeClass("selected");
        $(this).closest(".search-block").find(".search-block-input").html("Seçiniz");

    });


    $("body").on("click", ".siparisDurumGuncelle", function (e) {
        e.preventDefault();
        var btn = $(this);
        var yeni_durum = $(".islemDurum").val();
        var yeni_fiyat = $(".fiyatDurum").val();
        var eski_durum = $("input[name='eski_durum']").val();
        var eski_fiyat = $("input[name='eski_fiyat']").val();
        var siparisNo = $("input[name='siparisNo']").val();
        var ozet = $("textarea[name='siparis_ozet']").val();



        $.ajax({
            url: BaseAdminURL +'/?cmd=Ajax/siparisDurumGuncelle',
            type: 'GET',
            data: {
                "yeni_durum": yeni_durum,
                "yeni_fiyat": yeni_fiyat,
                "eski_durum": eski_durum,
                "eski_fiyat": eski_fiyat,
                "siparisNo" : siparisNo,
                'ozet' : ozet
            },
            success:function(g)
            {
                location.reload();
            }
        });

    });



    $("body").on("click", ".iptalDurum", function (e) {
        e.preventDefault();

        var box = $("input[name='iptal']");
        var siparisNo = $("input[name='siparisNo']").val();

        var value;

        if(box.is(':checked')){
            value = 1;
        }
        else{
            value = 0;
        }

        var type2 = ""; var text2 = "";

        $.ajax({
            url: BaseAdminURL +'/?cmd=Ajax/siparisIptal',
            type: 'GET',
            data: {
                "value": value,
                "siparisNo" : siparisNo,
            },
            success:function(g)
            {
                if (g == 1){
                    type2 = "success";
                    if (value == 1){
                        text2 = "Sipariş Başarıyla İptal Edildi";
                    }

                    else {
                        text2 = "Sipariş İptal İşlemi Geri Alındı";
                    }



                }
                else {
                    type2 = "error";
                    text2 = "Hata Oluştu"
                }

                console.log("Type : "+type2+"; Text : "+text2);

                const toast = swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 5000
                });

                toast({
                    type: type2,
                    title: text2
                });
            }




        });



    });







    $(".search-area .search-input").keyup(function() {

        var $this = $(this);

        var value = $this.val();
        $this.val($this.val().cleanup());
        value = value.cleanup();
        var ln = value.length;
        var type = $(this).data("type");
        var selected = $(this).closest(".search-area").find(".return_value").val();

        if (ln >= 3){
            $(".loading-result").show();

            $.ajax({
                url: BaseAdminURL +'/?cmd=Ajax/'+type+'&value='+value+"&selected="+selected,
                type: 'GET',
                success:function(g)
                {
                    $(".loading-result").hide();
                    $this.parent().children("ul.search-result").html(g);
                }
            });

        }
        else {
            $(".loading-result").hide();
            $this.parent().children("ul.search-result").html("");
        }


    });


    $("body").on("click", ".search-block ul.search-result li", function () {
        var contain = $(this).closest(".search-block");
        if (!$(this).hasClass("selected")){
            var getText = $(this).text();
            var id = $(this).data("id");
            contain.find(".search-block-input").html(getText);
            $(this).parent().find("li").removeClass("selected");
            $(this).addClass("selected");
            contain.find(".return_value").val(id);
        }
        else {
            contain.find(".search-block-input").html("Seçiniz");
            $(this).removeClass("selected");
            contain.find(".return_value").val(0);
        }

        $(this).closest(".search-block").removeClass("active");
    });






    $(".disable-tabs").tab("dispose");

    $( ".table-striped tr:odd" ).addClass("odd-row");
    $( ".table-striped tr:even" ).addClass("even-row");

    $('#printButton').on('click', function () {
        $(".form").printMe({
            path: ["https://cdn.vemedya.com/admin/assets/bootstrap/css/bootstrap.min.css", BaseAdminURL+"/theme/admin/css/AdminLTE.css", BaseAdminURL+"/theme/admin/css/skins/_all-skins.min.css"],
        });
    });


    $("#sifre_tr").on("keydown blur", function () {
        $(this).val($(this).val().cleanup());
    });


    $('#kelime').on('keydown', function(e) {
        if (e.which == 13) {
            var kelime = $(this).val();
            var sayfaUrl = $(this).data("url");
            if (kelime != 0 && kelime != ""){
                location.href=sayfaUrl+"&kelime="+kelime;
            }
        }
    });


    $(".siparisDurum").on("click", function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        var type = $(this).data("type");

        $.ajax({
            url: BaseAdminURL +'/?cmd=Ajax/siparisOnay',
            type: 'GET',
            data: {
                "type": type,
                "id": id
            },
            success:function(g)
            {
                if (g == 1){
                    //location.reload();
                    alert("Başarılı");
                }
                else {
                    alert("Hata Oluştu");
                }
            }
        });

    });



    $("#sonucMesaj .kapat").click(function(){
        bildirimKapat();
    });


    $("tr td a.silButon").click(function(e){
        e.preventDefault();
        var thiss = $(this);
        var url = $(this).attr("href");
        var id = $(this).data("id");
        var table = $(this).data("page");
        swal({
            title: 'Veri Silinecektir!',
            html: "Bu veri kalıcı olarak silinecektir.<br> Devam etmek istediğinize emin misiniz?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#9c9c9c',
            confirmButtonText: 'Tamam',
            cancelButtonText: 'İptal',
            reverseButtons: true
        }).then(function(result) {
            if (result.value) {

                $.ajax({
                    url: BaseAdminURL +'/?cmd=Ajax/veriSil&id='+id+"&table="+table,
                    type: 'GET',
                    success:function(g)
                    {
                        if (g == 1){

                            if (userType == 1){
                                $("tr[data-id='"+id+"']").addClass("bg-pale-danger").data("sil", 1);
                                thiss.addClass("disabled");
                            }

                            else {
                                $("tr[data-id='"+id+"']").slideUp();
                            }

                            if (result.value) {
                                location.reload();
                            }

                        }

                        else{
                            if (g == 3){
                                var text = "Bu eğitimle ilgili sipariş olduğu için silinemez";
                            }
                            else if(g == 4){
                                var text = "Aktif oturum silinemez.";
                            }
                            else if(g == 5){
                                var text = "Bu galeriye yüklenmiş fotoğraflar var. Öncelikle o fotoğrafları silip daha sonra galeriyi silin.";
                            }
                            else {
                                var text = "Hata Oluştu.";
                            }
                            swal({
                                title: text,
                                type: 'error',
                            });
                        }
                    }
                });


            }


        });




    });


    $("tr td a.dosyaSil").click(function(e){
        e.preventDefault();
        var thiss = $(this);
        var url = $(this).attr("href");
        var id = $(this).data("id");
        swal({
            title: 'Veri Silinecektir!',
            html: "Bu veri kalıcı olarak silinecektir.<br> Devam etmek istediğinize emin misiniz?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#9c9c9c',
            confirmButtonText: 'Tamam',
            cancelButtonText: 'İptal',
            reverseButtons: true
        }).then(function (result) {
            if (result.value) {

                $.ajax({
                    url: BaseAdminURL +'/?cmd=Ajax/dosyaSil&id='+id,
                    type: 'GET',
                    success:function(g)
                    {
                        if (g == 1){

                            if (userType == 1){
                                $("tr[data-id='"+id+"']").addClass("bg-pale-danger").data("sil", 1);
                                thiss.addClass("disabled");
                            }
                            else {
                                $("tr[data-id='"+id+"']").slideUp();
                            }


                            if (result.value){
                                location.reload();
                            }

                        }

                        else{
                            swal({
                                title: 'Hata Oluştu.',
                                type: 'error',
                            });
                        }
                    }
                });


            }
        });

    });


    $("#araButon").on("click", function(e){
        e.preventDefault();
        var kelime = $("#kelime").val();
        var sayfaUrl = $("#kelime").data("url");
        if (kelime != 0 && kelime != ""){
            location.href=sayfaUrl+"&kelime="+kelime;
        }
    });

    $("#sifreGuncelle").on("click", function(e){
        e.preventDefault();
        var sifre = $("#teknik_sifre").val();
        var sayfaUrl = $(this).attr("href");
        sayfaUrl+="&sifre="+sifre;


        if (sifre != 0 && sifre != ""){
            $.ajax({
                url: sayfaUrl,
                type: 'GET',
                success:function(g)
                {
                    alert("Şifre Güncellendi");

                }
            });
        }
    });


    $("button.home_switch").on("click", function () {

        var vall = "";
        var modul = $(this).data("modul");
        var $input = $(".modul_anasayfa_"+modul);
        if ($(this).hasClass("active")){
            vall = 0;
        }else {
            vall = 1;
        }
        $input.val(vall);
    });

    $(".aktifPasif").on("click", function () {
        var url = $(this).data("url");
        var id = $(this).data("id");
        var type = $(this).data("type");

        $.ajax({
            url: url,
            type: 'GET',
            data: {
                "type": type,
                "id": id
            },
            success:function(g)
            {
                if (g == 1){
                    location.reload();
                }
                else {
                    alert("Hata Oluştu");
                }

            }
        });

    });


    $('.buttonTemizle').click(function (e) {

        $.ajax({

            url: '../ajax/OnbellekTemizle.html',
            type: 'POST',
            success:function(g)
            {
                if(g==1) alert('Önbellek Temizlendi');
            }
        });

        return false;
    });



    $("input,select,textarea").not("[type=submit]").not("[type=image]").jqBootstrapValidation();


    // enable fileuploader plugin
    $('#fileuploader input[name="files"]').fileuploader({
        changeInput: '<div class="fileuploader-input">' +
            '<div class="fileuploader-input-inner">' +
            '<div class="fileuploader-input-button"><span>Dosya Seç</span></div>' +
            '</div>' +
            '</div>',
        theme: 'dragdrop',
        fileMaxSize:50, //mb
        extensions : ['jpg','jpeg','png','gif', 'pdf', "zip", "rar", "mp4", "doc", "docx","xls", "xlsx", "csv", "ppt", "pptx", "txt"],
        upload: {
            url: BaseAdminURL +'/?cmd=Dosya/YukleWidget',
            data: {
                'id':$('#fileuploader input[name=id]').val(),
                'name':$(".file_title").val(),
                'modul':$('#fileuploader input[name=modul]').val(),
                'lang':$('#fileuploader input[name=lang]').val(),
                'folder':$('#fileuploader input[name=folder]').val()
            },
            type: 'POST',
            enctype: 'multipart/form-data',
            start: true,
            synchron: true,
            beforeSend: null,
            onSuccess: function(result, item) {
                var data = JSON.parse(result);

                // if success
                if (data.isSuccess && data.files[0]) {
                    item.name = data.files[0].name;

                    item.html.find('.column-title div').animate({opacity: 0}, 400);
                    item.html.find('.column-actions').append('<a class="fileuploader-action fileuploader-action-remove fileuploader-action-success" title="Sil"><i></i></a>');
                    setTimeout(function() {
                        item.html.find('.column-title div').attr('title', item.name).text(item.name).animate({opacity: 1}, 400);
                        item.html.find('.progress-bar2').fadeOut(400);
                    }, 400);
                }

                // if warnings
                if (data.hasWarnings) {
                    for (var warning in data.warnings) {
                        alert(data.warnings);
                    }

                    item.html.removeClass('upload-successful').addClass('upload-failed');
                    // go out from success function by calling onError function
                    // in this case we have a animation there
                    // you can also response in PHP with 404
                    return this.onError ? this.onError(item) : null;
                }

                item.html.find('.column-actions').append('<a class="fileuploader-action fileuploader-action-remove fileuploader-action-success" title="Kaldır"><i></i></a>');
                setTimeout(function() {
                    item.html.find('.progress-bar2').fadeOut(400);
                }, 400);
            },
            onError: function(item) {
                var progressBar = item.html.find('.progress-bar2');

                if(progressBar.length > 0) {
                    progressBar.find('span').html(0 + "%");
                    progressBar.find('.fileuploader-progressbar .bar').width(0 + "%");
                    item.html.find('.progress-bar2').fadeOut(400);
                }

                item.upload.status != 'cancelled' && item.html.find('.fileuploader-action-retry').length == 0 ? item.html.find('.column-actions').prepend(
                    '<a class="fileuploader-action fileuploader-action-retry" title="Retry"><i></i></a>'
                ) : null;
            },
            onProgress: function(data, item) {
                var progressBar = item.html.find('.progress-bar2');

                if(progressBar.length > 0) {
                    progressBar.show();
                    progressBar.find('span').html(data.percentage + "%");
                    progressBar.find('.fileuploader-progressbar .bar').width(data.percentage + "%");
                }
            },
            onComplete: null,
        },
        onRemove: function(item) {
            $.post(BaseAdminURL +'/?cmd=Dosya/RemoveWidget', {
                file: item.name,
                id:$('#fileuploader input[name=id]').val(),
                modul:$('#fileuploader input[name=modul]').val(),
                folder:$('#fileuploader input[name=folder]').val()
            });
        },
        captions: {
            feedback: 'Sürükleyip Bırak',
            feedback2: 'Sürükleyip Bırak',
            drop: 'Sürükleyip Bırak',
            errors: {
                filesLimit: 'Only ${limit} files are allowed to be uploaded.',
                filesType: '${extensions} Dosya türlerine izin verilmektedir.',
                fileSize: '${name} çok büyük! ${fileMaxSize}MB daha az boyutta dosya yükleyin.',
                filesSizeAll: 'Files that you choosed are too large! Please upload files up to ${maxSize} MB.',
                fileName: 'File with the name ${name} is already selected.',
                folderUpload: 'You are not allowed to upload folders.'
            }
        },
    });

});

function resimkaldir(t)
{



    var bos  = "http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=Resim+Yok";
    var resim =  $(".eskiresim").val();


    $.ajax({

        url:BaseAdminURL+'?cmd=Ayarlar/Dosyasil.html',
        type:'POST',
        data : 'resim='+resim ,
        success:function(g)
        {
            if(g==1)
            {
                $('.fileinput ').find('.thumbnail img').attr('src',bos);
                $('.eskiresim').val('NULL');
                $('.kaldir').addClass('fileinput-exists');

            }

        }


    })


    return false;
}

/*jslint unparam: true */
/*global window, $ */
$(function () {
    'use strict';
    // Change this to the location of your server-side upload handler:

    var file_ext = {'.zip':'fa-file-archive-o','.rar':'fa-file-archive-o','.xls':'fa-file-excel-o','.xlsx':'fa-file-excell-o','.doc':'fa-file-word-o','.docx':'fa-file-word-o',
        '.jpg':'fa-file-image-o','.png':'fa-file-image-o','.jpeg':'fa-file-image-o','.pdf':'fa-file-pdf-o','.odt':'fa-file-word-o'};


    $('#fileupload2').fileupload({
        url: BaseAdminURL + '/?cmd=Files/upload2',
        dataType: 'json',
        done: function (e,data) {

            //  console.log(data._response.result.files);

            $('<p/>').html('<i class="fa '+file_ext[data._response.result.files.filename]+'"> &nbsp;'+data._response.result.files.filename).appendTo('#files');
            $('.filelist').val(data._response.result.files.filename+','+$('.filelist').val());

        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress .progress-bar').css(
                'width',
                progress + '%'
            );
        }
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
});

$(function () {
    'use strict';
    // Change this to the location of your server-side upload handler:



    $('.fileupload').each(function(index, element){


        var resimid = "#"+$(this).find('input[type=file]').attr('id');

        var id = "div#"+$(this).attr('id');

        var imageurl =  $('#fotoResim_folder').val();

        if (imageurl == undefined){
            imageurl = "";
        }


        $('input[type=file]').not(".over-max").on('change', function(){
            var fileSize = $(this)[0].files[0].size/1024/1024;
            if (fileSize > 5) {
                alert("Yüklediğiniz Dosya 5 MB dan küçük olmalıdır.");
                $(this).val("");
                return false;
            }
        });





        $(resimid).fileupload({
            url: BaseAdminURL+'/?cmd=Files/upload&folder='+imageurl,
            dataType: 'json',

            done: function (e, data) {

                if(data._response.result.error)
                { alert(data._response.result.error.replace('<p>','').replace('</p>',''));}
                else
                {

                    $(id).find('.files').html(data._response.result.files.filename);

                    $(id).find('.image_val').val(data._response.result.files.filename);
                    $(id).find('.img-prev').attr('src','../upload/'+imageurl+"/"+data._response.result.files.filename).css("display","block");
                    $(id).find('.crop').val('false');
                }

            },
            error: function (e, data) {

                var a = $.parseJSON(e.responseText);
                alert(a.error.replace('<p>','').replace('</p>',''));

            },
            progressall: function (e, data) {
                var progress = parseInt(data.loaded / data.total * 100, 10);
                $(id).find('#progress .progress-bar').css(
                    'width',
                    progress + '%'
                );
            }
        })

        $(resimid).click(function(e) {
            $(id).find('#progress .progress-bar').css(
                'width',
                0 + '%'
            );
        });


        $(id+' .crop_file').on('click',function(e){


            var classname = $(id);
            var class1 = $(id).attr('id');
            if($(classname).find('input.crop').val()=="true")
                var image = $(classname).find('.files').html().replace('crop_');
            else
                var image = $(classname).find('.files').html();

            var cropname =  $(classname).find('input.crop').attr('name');
            var imageurl =  $(classname).find('input.image_folder').val();
            var uzanti = image.substring(image.lastIndexOf('.')+1, image.length)
            console.log(uzanti);
            if(image)
            {
                if (uzanti == "svg"){
                    swal({
                        title: 'Svg dosyalarda crop işlemi yapılmamaktadır.',
                        type: 'error',
                    });
                }else {
                    var size = $(this).attr('data-id').split('x');
                    $.fancybox({
                        href: BaseAdminURL + '/?cmd=Files/crop&image=' + image + '&width=' + size[0] + '&height=' + size[1] + '&' + cropname + '=true' + '&classname=' + class1 + '&folder=' + imageurl,
                        type: 'iframe',
                        padding: 1,
                        margin: 1
                    });
                }
            }
            else alert('Resim bulunamadı');

        });

    });








});


$(window).ready(function(e){


    $('#eklefiyat').click(function (e) {

        var item = $('.ornek table tbody').html();
        $('#fiyatekle').append(item);



        return false;
    });


    $("#select_icon").on("blur", function () {
        var icon = $(this).val();
        if (!$(this).parent().find(".input-group-addon").length){
            $(this).parent().prepend("<div class='input-group-addon'><i class='"+icon+"'></i></div>");
        }else {
            $(this).parent().find(".input-group-addon i").removeClass().addClass(icon);
        }

    });

    $('select[name=projefild]').change(function(e){

        var  url = $(this).data('url');
        location.href = BaseAdminURL +'/?cmd=Projeler/Liste/' + $(this).find('option:selected').val();


    });

    $('select[name=fotogaleri]').change(function(e){

        var  url = $(this).data('url');
        location.href = BaseAdminURL +'/?cmd=Galeri/fotoekle/'+$(this).find('option:selected').val();


    });


    $('select[name=kurs_filter]').change(function (e) {
        var durumFilter = $('select[name=durumFilter]').find('option:selected').val();
        var url = $(this).data("url");
        var kurs_id = $(this).val();
        var thisVal = $(this).find('option:selected').val();

        if (durumFilter != ""){
            if (thisVal != 0){
                location.href = BaseAdminURL+url+"&kurs="+thisVal;
            }
            else {
                location.href = BaseAdminURL+url;
            }
        }

        else {
            alert("Önce Sipariş Durumu Seçiniz.");
        }
    });

    $('select[name=markaFilter]').change(function (e) {
        var flit_filter = $('select[name=katFilter]').find('option:selected').val();
        var url = $(this).data("url");
        var thisVal = $(this).find('option:selected').val();

        if (flit_filter != ""){
            if (thisVal != 0){
                location.href = BaseAdminURL+url+"/"+flit_filter+"&marka="+thisVal;
            }
            else {
                location.href = BaseAdminURL+url+"/"+flit_filter;
            }
        }

        else {
            if (thisVal != 0){
                location.href = BaseAdminURL+url+"&marka="+thisVal;
            }
            else {
                location.href = BaseAdminURL+url;
            }
        }
    });


    $('select[name=katFilter]').change(function (e) {
        var flit_filter = $('select[name=markaFilter]').find('option:selected').val();
        var url = $(this).data("url");
        var thisVal = $(this).find('option:selected').val();

        if (thisVal != ""){

            if (flit_filter != undefined){
                location.href = BaseAdminURL+url+"/"+thisVal+"&marka="+flit_filter;
            }else {
                location.href = BaseAdminURL+url+"/"+thisVal;
            }
        }
        else {
            if (flit_filter != undefined){
                location.href = BaseAdminURL+url+"&marka="+flit_filter;
            }
            else {
                location.href = BaseAdminURL+url;
            }
        }

    });

    $('select[name=paketfild]').change(function(e){

        var  url = $(this).data('url');
        location.href = BaseAdminURL +'/?cmd=Paketler/liste/'+$(this).find('option:selected').val();


    });

    $('select[name=projekatfild]').change(function(e){

        var  url = $(this).data('url');
        location.href = BaseAdminURL +'/?cmd=Projeler/Liste/' + $(this).find('option:selected').val();

    });


    $('.flit_filter').change(function(e){
        var  url = $(this).data('url');
        if ($(this).find('option:selected').val() != 0){
            location.href = BaseAdminURL + url + "/" + $(this).find('option:selected').val();
        }
        else {
            location.href = BaseAdminURL + url
        }
    });

    $('select[name=katfild]').change(function(e){
        var  url = $(this).data('url');
        location.href = BaseAdminURL + '/?cmd=Sayfa/SayfaListe/'+$(this).find('option:selected').val();
    });


    $(".urunKat_tr").change(function (e) {
        var selected = $(this).find('option:selected').val();
        var sayfaUrl = BaseAdminURL+'?cmd=Ayarlar/getFilter.html';

        if ($(".urunID").val() == undefined){
            var urunID = "0";
        }

        else {
            var urunID = $(".urunID").val();

        }


        if (selected != 0){
            $.ajax({
                url: '../ajax/ozellikler.html',
                cache: false,
                data: "data="+selected+"&urunID="+urunID,
                type: 'GET',
                success:function(g)
                {
                    try
                    {
                        var obj=jQuery.parseJSON(g);
                        $(".getOzellik").html("<h4>Özellikler <hr></h4>"+decodeEntities(obj.tr).replace(",", ""));
                    }
                    catch(err)
                    {
                        $(".getOzellik").html(g);
                    }
                }
            });
        }

    });

    $('select[name=urunfild]').change(function(e){

        var url = $(this).data('url');
        var veri = $(this).find('option:selected').val();

        if (veri != 0){
            location.href = BaseAdminURL + '/?cmd=Urunler/Liste/'+veri;
        }
        else {
            location.href = BaseAdminURL + '/?cmd=Urunler/Liste';
        }

    });



    $('select[name=urunkatfild]').change(function(e){

        var katID = $(this).find("option:selected").val();
        if (katID == 0){
            katID = "";
        }
        location.href = BaseAdminURL + '/?cmd=Urunler/kategoriListesi/' + katID;
    });

    $('.dosya').fancybox({width:'80%',height:'600'});
    $('.fancy').fancybox({width:'1100',height:'700'});

    $(".fancy-iframe").fancybox({
        'width'				: '75%',
        'height'			: '75%',
        'autoScale'     	: false,
        'transitionIn'		: 'none',
        'transitionOut'		: 'none',
        'type'				: 'iframe'
    });


    $(".popImage").fancybox();


    $("#checkbox").click(function(){
        if($("#checkbox").prop('checked') ){
            $(".select2 > option").prop("selected","selected");
            $(".select2").trigger("change");
        }else{
            $(".select2 > option").removeAttr("selected");
            $(".select2").trigger("change");
        }
    });

    /*  var group = $('.sorted_table').sortable({
     containerSelector: 'table',
     group: 'serialization',
     itemPath: '> tbody',
     itemSelector: 'tr',
     placeholder: '<tr class="placeholder"/>',
     onDrop: function ($item, container, _super, event) {
     $item.removeClass(container.group.options.draggedClass).removeAttr("style")
     $("body").removeClass(container.group.options.bodyClass);


     var data = group.sortable("serialize").get();
     console.log(data);
     var jsonString = JSON.stringify(data, null, ' ');

     console.log(jsonString);

     }
     });*/

    if(typeof($().bootstrapSwitch)=="function") $('input[name=state]').bootstrapSwitch();

    $("#sortable").sortable({
        handle: ".move",
        placeholder: "tr_placeholder",
        containment: ".sorted_table",
        items:'tr:not(.unsortable)',

        axis: "y",
        scroll: false,

        update : function (ev,ui) {
            //  var ilkID = (ui.item[0].nextElementSibling) ? $(ui.item[0].nextElementSibling).data('id'):null;
            //  var sonID = (ui.item[0].previousElementSibling) ? $(ui.item[0].previousElementSibling).data('id'):null;

            var sayfa = "VeriSirala";
            var page = $('#sortable').data('page');
            var table = $('#sortable').data('id');
            var reload = $('#sortable').data('reload');

            var sirala = [];

            $('#sortable tbody').find('tr').each(function(index, element) {
                sirala[index] = $(this).data('id');
            });

            if (table == "dosyalar"){
                $('#sortable[data-id="dosyalar"]').find("tr").each(function (index, value) {
                    $(this).find("td.sira_no").html(index);
                });
            }


            $("#sonucMesaj div").load(BaseAdminURL+'/?cmd=Sirala/VeriSirala&sirala='+sirala+"&page="+page+"&table="+table+"&reload="+reload, function() {
                if (reload == "1"){
                    location.reload();
                }else {
                    bildirimAt("success");
                }
            });


        }
    });




    $(window).ready(function (e) {
        uploader.init();
    });

    var uploader = new plupload.Uploader({
        runtimes : 'html5,flash,silverlight,html4',
        browse_button : 'pickfiles', // you can pass in id...
        container: document.getElementById('dosyayukle'), // ... or DOM Element itself
        chunk_size : '1mb',  // partlı olarak yukler
        multi_selection : true,
        multipart: true,
        lang:"tr",
        urlstream_upload: true,
        url : BaseAdminURL + '/?cmd=Dosya/yukle&son_id='+$('#pickfiles').data('id')+'&folder='+$('#pickfiles').data('url')+'&modul='+$('#pickfiles').data('type')+'&baslik='+$('#pickfiles').data('name')+'&tur='+$("#pickfiles").data("tur")+'&resim_tur='+$("#pickfiles").data("resimtur")+'&file_type='+$("#pickfiles").data("filetype")+'&lang='+$("#pickfiles").data("lang")+'&is_files='+$("#pickfiles").data("isfiles"),
        flash_swf_url : BaseAdminURL + '/helper/dosya/yukle/pl_upload/Moxie.swf',
        silverlight_xap_url : BaseAdminURL + '/helper/dosya/yukle/pl_upload/Moxie.xap',
        filters : {
            max_file_size : '100mb',
            mime_types: [
                {title : "Resimler", extensions : "jpg,jpeg,gif,png"},
                {title : "Dosyalar", extensions : "zip,rar,doc,docx,pdf,xls,xlsx,txt,tiff,tif,mp4"}
            ]
        },

        init: {
            PostInit: function() {
                document.getElementById('upload_area').innerHTML = '';


                document.getElementById('uploadfiles').onclick = function() {
                    uploader.start();
                    return false;
                };
            },

            // Automaticly upload files when files selected
            QueueChanged: function(up, file) {
                if ( up.files.length > 0 && uploader.state != 2) {
                    uploader.start();
                }
                $(".table-upload-area").show();
            },


            FilesAdded: function(up, files) {
                plupload.each(files, function(file) {
                    document.getElementById('upload_area').innerHTML += '<tr id="upload_file_'+file.id+'"><td>"'+file.name+'"</td><td>"'+plupload.formatSize(file.size)+'"</td><td><b class="progress_area">&nbsp;</b> </td></tr>';
                });
            },
            /*UploadProgress: function(up, file) {
             document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";

             },*/

            UploadProgress: function(up, file) {
                $("#upload_file_"+file.id+" b").html('<div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated active bg-info"  role="progressbar" aria-valuenow="'+file.percent+'" aria-valuemin="0" aria-valuemax="100" style="width:' + file.percent + '%;"></div></div>');

                if(file.percent==100){
                    $("#upload_file_"+file.id+" .progress_area").find(".progress-bar").removeClass("active").removeClass("progress-bar-animated").removeClass("bg-info").addClass("bg-olive");
                }

                //document.getElementById('yukleme').innerHTML='Dosyalar Yüklendi. <img height="60" src="../upload/resimler/'+ file.name +'">';
                //alert("A");

            },

            Error: function(up, err) {
                $(".table-upload-area").show();
                $("#console").show();
                document.getElementById('console').innerHTML = "Hata: <b>"+err.message+"</b>";
            }

        }
    });

    uploader.bind('FileUploaded', function(up, file, response){
        var res = $.parseJSON(response.response);

        //document.getElementById('yukleme').innerHTML='Dosyalar Yüklendi.';

    });
    uploader.bind('UploadComplete', function(up, files){

        //console.log(up);
        //console.log(files);
        $("#upload_area").html("<tr><td colspan='100%'><div style='margin-bottom: 0px;' class='alert alert-success'>Dosyalar Başarıyla Yüklendi. Sayfa Güncelleniyor...</div> </td></tr>");
        window.location.reload();

    });


    tinymce.init({
        entity_encoding : "raw",
        selector: 'textarea.editor',
        theme: 'modern',
        language: 'tr_TR',

        plugins: [
            'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen',
            'insertdatetime media nonbreaking save table contextmenu directionality',
            'emoticons template paste textcolor colorpicker textpattern imagetools responsivefilemanager code directionality'
        ],
        toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        toolbar2: " link unlink anchor | image media | forecolor backcolor  | print preview code | responsivefilemanager | pastetext,pasteword,selectall | ltr rtl",
        image_advtab: true,

        external_filemanager_path: BaseAdminURL +"/helper/editor/",
        filemanager_title:"Dosya Yöneticisi" ,
        external_plugins: { "filemanager" : BaseAdminURL +"/helper/editor/plugin.min.js"},
        filebrowserBrowseUrl : BaseAdminURL +'/helper/editor/dialog.php?type=2&editor=ckeditor&fldr=',
        filebrowserUploadUrl : BaseAdminURL +'/helper/editor/dialog.php?type=2&editor=ckeditor&fldr=',
        filebrowserImageBrowseUrl : BaseAdminURL +'/helper/editor/dialog.php?type=1&editor=ckeditor&fldr=',

    });



});