jQuery(document).ready(function($){

    (function( $ ){
        $.fn.ajaxForm = function(options) {

            var settings = $.extend({
                submitClass: ".cmt-btn",
                alert:".alert",
                alertClose:true,
                callback:function(){},
                animation: "", // FADE - SLåŠ›DE
                disableReset: "3",
                closeTimeDelay: 5,
                locationHref:false,
                locationNumber:1,
                swal:false,
            }, options );


            var timeDelay = settings.closeTimeDelay * 1000;
            var form = $(this);




            this.submit(function(e){
                var action = $(this).attr('action');
                e.preventDefault();


                form.find(settings.submitClass).addClass("disabled");

                form.find(settings.submitClass).after("<div style=\"width: 2.5rem; height: 2.5rem;\" class=\"spinner-border  form-loading text-danger\" role=\"status\"></div>");




                jQuery.ajax({
                    url : action,
                    type: 'POST',
                    data : new FormData(form[0]),

                    cache: false,
                    contentType: false,
                    enctype: 'multipart/form-data',
                    processData: false,
                    success:function(gelen){



                        form.find(".form-loading").remove();

                        var mnesne = form.find(".mesaj"+gelen);
                        var mesaj = mnesne.data("mesaj");
                        var durum = mnesne.data("durum");
                        var title;

                        if (durum == "success") title = successMessage;
                        if (durum == "warning") title = warningMessage;
                        if (durum == "error") title = errorMessage;
                        if (durum == "info") title = infoMessage;

                        if (settings.swal === true){
                            Swal.fire({
                                icon: durum,
                                title: title,
                                text: mesaj,
                                confirmButtonText:"Kapat"
                            });
                        }

                        else {
                            form.find(settings.alert).show();
                            form.find(settings.alert).attr("class", settings.alert.replace(".", ""));
                            form.find(settings.alert).addClass(durum);
                            form.find(settings.alert).html(mesaj);
                        }



                        if (settings.disableReset != gelen){
                            form.trigger('reset');
                        }


                        if (settings.locationHref === true){
                            if (settings.locationNumber == gelen){
                                setTimeout(function () {
                                    location.reload();
                                }, 1000)
                            }
                        }

                        form.find(settings.submitClass).addClass("disabled");

                        if (settings.alertClose === true) {
                            setTimeout(function () {
                                if (settings.animation == "fade") {
                                    form.find(settings.alert).stop().fadeOut("normal");
                                }
                                else if (settings.animation == "slide") {
                                    form.find(settings.alert).stop().slideUp("normal");
                                }
                                else {
                                    form.find(settings.alert).hide();
                                }

                                form.find(settings.alert).removeClass(durum);
                            }, timeDelay);
                        }


                        if (typeof settings.callback == 'function') {
                            let param1 = gelen;
                            let param2 = mesaj;
                            let obj = this;
                            settings.callback.call(this, obj, param1, param2);
                        }

                    }
                });

                return false;

            });
            return this;
        };
    })( jQuery );

});