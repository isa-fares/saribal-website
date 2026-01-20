/**
 * Created by VEMEDYA on 21.05.2016.
 */

$(window).ready(function(e){

    $.panel = {

        'durum' : function(t,id,url){

          var  durum =  (($(t).hasClass("active")) ? 0:1);

          var sil = $('tr[data-id=' + id + ']').data("sil");

            $.ajax({

                url:url,
                type:'GET',
                data:'id='+id+'&durum='+durum,
                success:function(g)
                {
                    if(g==1) {//alert('Güncellendi');
                        $(t).val(durum);
                        if (sil != 1) {

                            if (durum == 1) {
                                $('tr[data-id=' + id + ']').removeClass("durum_0").addClass("durum_1");
                                var text2 = "Durum Aktif Olarak Güncellendi";
                            }
                            else {
                                $('tr[data-id=' + id + ']').removeClass("durum_1").addClass("durum_0");
                                var text2 = "Durum Pasif Olarak Güncellendi";
                            }

                            setTimeout(function(){
                                /*
                                    $.toast().reset('all');
                                    $.toast({
                                        text: text2,
                                        position: 'top-right',
                                        loaderBg: '#ff6849',
                                        icon: 'success',
                                        hideAfter: 3500,
                                        stack: 6
                                    });
                                */
                                const toast = swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 5000
                                });

                                toast({
                                    type: 'success',
                                    title: text2
                                })

                            }, 200);




                        }
                    }

                    else console.log(g);
                }



            });





    },


        'proje_durum' : function(t,id,url){

            var  durum =  (($(t).hasClass("active")) ? 0:1);

            var sil = $('tr[data-id=' + id + ']').data("sil");

            $.ajax({

                url:url,
                type:'GET',
                data:'id='+id+'&proje_durum='+durum,
                success:function(g)
                {
                    if(g==1) {//alert('Güncellendi');
                        $(t).val(durum);
                        if (sil != 1) {

                            if (durum == 1) {
                                $('tr[data-id=' + id + ']').removeClass("durum_0").addClass("durum_1");
                                var text2 = "Proje Durumu Aktif Olarak Güncellendi";
                            }
                            else {
                                $('tr[data-id=' + id + ']').removeClass("durum_1").addClass("durum_0");
                                var text2 = "Proje Durumu Pasif Olarak Güncellendi";
                            }

                            setTimeout(function(){
                                const toast = swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 5000
                                });

                                toast({
                                    type: 'success',
                                    title: text2
                                })

                            }, 200);
                        }
                    }

                    else console.log(g);
                }
            });

        },


    'detay':function (t) {

            var url = $(t).data('url');

            
            $.ajax({

                url:url,
                type:'GET',
                success:function (g) {
                    if(g){

                        var data = $.parseJSON(g);
                        var modal = $('#teknikDetay');

                        modal.attr('data-id',data.id);


                      
                        $.each(data,function (key,value) {


                         if($.inArray(key, checkbox) && modal.find('input.'+key).length>0 && value=="1"){
                                modal.find('input.' + key).prop('checked', true).iCheck('update');
                            }
                            else modal.find('label[for='+key+']').html(value);
                        });
                        
                        $('#teknikDetay').modal('show');



                    }
                }

            });




            return false;
        }



    };


});
