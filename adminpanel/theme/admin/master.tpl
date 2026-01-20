<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Yönetim Paneli - {$control->get_element('title_tr')}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <script src="{$control->ThemeFile()}/assets/vendor_components/jquery/dist/jquery.js"></script>
    <script src="{$control->ThemeFile()}/assets/vendor_components/jquery-ui/jquery-ui.js"></script>

    <link rel="icon" href="{$control->ThemeFile()}/images/favicon2.png">

    <link rel="stylesheet" href="{$control->ThemeFile()}/assets/vendor_components/bootstrap/dist/css/bootstrap.css">

    <link rel="stylesheet" href="{$control->ThemeFile()}/css/bootstrap-extend.css">

    <link rel="stylesheet" href="{$control->ThemeFile()}/assets/vendor_components/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="{$control->ThemeFile()}/assets/vendor_components/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">

    <link href="{$control->ThemeFile()}/assets/vendor_components/jquery-toast-plugin-master/src/jquery.toast.css" rel="stylesheet">

    <link rel="stylesheet" href="{$control->ThemeFile()}/css/master_style.css?v=5">

    <link rel="stylesheet" href="{$control->ThemeFile()}/css/skins/_all-skins.css">

    <link href="{$control->ThemeFile()}/assets/vendor_components/sweetalert/sweetalert2.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="{$control->ThemeFile()}/css/custom.css?v=5">

    <link rel="stylesheet" href="{$control->ThemeFile()}/assets/vendor_components/morris.js/morris.css">


    <link rel="stylesheet" href="{$control->ThemeFile()}/assets/vendor_components/bootstrap-switch/switch.css">

    <link rel="stylesheet" href="{$control->ThemeFile()}/assets/plugins/fancyapps-fancyBox/source/jquery.fancybox.css">

    <link href="{$control->ThemeFile()}/assets/plugins/fileuploader/jquery.fileuploader.css?v=52" media="all" rel="stylesheet">
    <link rel="stylesheet" href="{$control->ThemeFile()}/assets/plugins/jupload/css/jquery.fileupload.css">

    <link rel="stylesheet" href="{$control->ThemeFile()}/assets/plugins/tags-input/tagsinput.css">



    <link rel="stylesheet" href="{$control->ThemeFile()}/assets/vendor_components/bootstrap4-datetimepicker/build/css/bootstrap-datetimepicker.css">





    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


    {$control->CustomPageCss($control->BaseAdmin())}
    <!-- END HEAD -->
    <script>
        var BaseAdminURL  = '{$control->BaseAdmin()}';
        var BaseURL = '{$control->Base()}';
    </script>

    {if $control->getCurrentClass() eq "Ayar"}
        <style>
            .remove-image-btn {
                display: none !important;
            }
        </style>
    {/if}


    {if $control->getCurrentClass() eq "Ayar" or $control->getCurrentClass() eq "sube" or $control->getCurrentClass() eq "petrol_istasyon"}
        <script src="https://maps.googleapis.com/maps/api/js?key={$control->get_element('map_api')}&libraries=places"></script>
    {/if}

</head>

<body class="hold-transition sidebar-mini fixed {$control->getUserTheme()}">

<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="index.html" class="logo">
            <!-- mini logo -->
            <b class="logo-mini">
                <span class="light-logo"> <img src="{$control->ThemeFile()}/images/logo-light.png" alt="logo"></span>
                <span class="dark-logo"><img src="{$control->ThemeFile()}/images/logo-dark.png" alt="logo"></span>
            </b>
            <!-- logo-->
            <span class="logo-lg">
		  <img src="{$control->ThemeFile()}/images/logo-light-text.png" alt="logo" class="light-logo">
	  	  <img src="{$control->ThemeFile()}/images/logo-dark-text.png" alt="logo" class="dark-logo">
	  </span>
        </a>
        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">

                    <!-- User Account-->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{$control->base("upload/users/")}{$control->getUsericon()}" class="user-image rounded-circle">
                        </a>
                        <ul class="dropdown-menu scale-up">
                            <!-- User image -->
                            <li class="user-header">
                                <span class="user-avatar" style="background-image: url('{$control->base("upload/users/")}{$control->getUsericon()}')"></span>

                                <p>
                                    {$control->getUser("adi")}
                                    <small class="mb-5">{$system->get_element("telefon_merkez")}</small>
                                </p>
                            </li>
                            <!-- Menu Body -->
                            <li class="user-body">
                                <div class="row no-gutters">

                                    <div class="col-12 text-left">
                                        <a href="{$control->BaseAdminURL('kullanici/liste')}"><i class="mdi mdi-account-settings-variant"></i> Kullanıcı Ayarları</a>
                                    </div>
                                    <div class="col-12 text-left">
                                        <a href="{$control->BaseAdminURL('Ayar/ayarlar')}"><i class="ion ion-settings"></i> Genel Ayarlar</a>
                                    </div>
                                    <div class="col-12 text-left">
                                        <a href="{$control->BaseAdminURL('login/cikis')}"><i class="fa fa-power-off"></i> Çıkış Yap</a>
                                    </div>
                                </div>
                                <!-- /.row -->
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->
                    <li>
                        <a href="#" data-toggle="control-sidebar"><i class="fa fa-cog fa-spin"></i></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <aside class="main-sidebar">
        <!-- sidebar-->
        <section class="sidebar">

            <!-- sidebar menu-->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="user-profile treeview">
                    <a href="{$control->BaseAdminURL("Index")}">
                        <img src="{$control->base("upload/users/")}{$control->getUsericon()}" alt="user">
                        {$control->getUser("adi")}
                        <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{$control->BaseAdminURL('kullanici/liste')}"><i class="fa fa-user mr-5"></i>Kullanıcı Ayarları</a></li>
                        <li><a href="{$control->BaseAdminURL('Ayar/ayarlar')}"><i class="fa fa-cog mr-5"></i>Genel Ayarlar</a></li>
                        <li><a href="{$control->BaseAdminURL('login/cikis')}"><i class="fa fa-power-off mr-5"></i>Çıkış Yap</a></li>
                    </ul>
                </li>

                {$sidebar->solMenu()}

            </ul>
        </section>
    </aside>


    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {$control->sayfaBaslik()}
            </h1>

            <ol class="breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-user"></i> {$control->getUser("adi")}</a></li>
                <li class="breadcrumb-item"><a href="{$control->BaseAdminURL('Index')}"><i class="fa fa-dashboard"></i> Yönetim Paneli</a></li>
                <li class="breadcrumb-item active">{$control->sayfaBaslik()}</li>
            </ol>

        </section>

        <section class="content">
            {$control->content()}
        </section>

    </div>

    <footer class="main-footer">
        Copyright &copy; 2019 - Ve İnteraktif Medya Tüm Hakları Saklıdır.
    </footer>


    <aside class="control-sidebar control-sidebar-light">

        <div class="tab-content">
            <div class="tab-pane" id="control-sidebar-home-tab"></div>
        </div>

    </aside>

    <div class="control-sidebar-bg"></div>
    <div id="sonucMesaj">
        <div></div>
    </div>

</div>





<script>
    $.widget.bridge('uibutton', $.ui.button);
    var mapArray = [];
    var userType = {$control->getUserType()};
</script>

<script src="{$control->ThemeFile()}/assets/vendor_components/popper/dist/popper.min.js"></script>




<script src="{$control->ThemeFile()}/assets/vendor_components/bootstrap/dist/js/bootstrap.js"></script>


<script src="{$control->ThemeFile()}/assets/vendor_components/raphael/raphael.min.js"></script>
<script src="{$control->ThemeFile()}/assets/vendor_components/morris.js/morris.min.js"></script>


<script src="{$control->ThemeFile()}/assets/vendor_components/jquery-sparkline/dist/jquery.sparkline.js"></script>

<script src="{$control->ThemeFile()}/assets/plugins/fancyapps-fancyBox/source/jquery.fancybox.js"></script>


<script src="{$control->ThemeFile()}/assets/vendor_components/moment/min/moment.min.js"></script>

<script src="{$control->ThemeFile()}/assets/tinymce/tinymce.min.js" type="text/javascript"></script>


<script src="{$control->ThemeFile()}/assets/vendor_components/bootstrap4-datetimepicker/build/js/moment-with-locales.min.js"></script>
<script src="{$control->ThemeFile()}/assets/vendor_components/bootstrap4-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>


<script src="{$control->ThemeFile()}/assets/vendor_components/jquery-slimscroll/jquery.slimscroll.js"></script>


<script src="{$control->ThemeFile()}/assets/vendor_components/fastclick/lib/fastclick.js"></script>

<script src="{$control->ThemeFile()}/assets/vendor_components/select2/dist/js/select2.full.js"></script>
<script src="{$control->ThemeFile()}/assets/vendor_components/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<script src="{$control->ThemeFile()}/assets/vendor_plugins/input-mask/jquery.inputmask.js"></script>
<script src="{$control->ThemeFile()}/assets/vendor_plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="{$control->ThemeFile()}/assets/vendor_plugins/input-mask/jquery.inputmask.extensions.js"></script>


<script src="{$control->ThemeFile()}/assets/vendor_components/jquery.peity/jquery.peity.js"></script>

<script src="{$control->ThemeFile()}/assets/plugins/jupload/js/vendor/jquery.ui.widget.js"></script>

<script src="{$control->ThemeFile()}/assets/plugins/jupload/js/jquery.iframe-transport.js"></script>

<script src="{$control->ThemeFile()}/assets/plugins/jupload/js/jquery.fileupload.js"></script>



<script src="{$control->ThemeFile()}/assets/plugins/fileuploader/jquery.fileuploader.min.js" type="text/javascript"></script>
<script type="text/javascript" src="{$control->ThemeFile()}/helper/dosya/pl_upload/plupload.full.min.js"></script>
<script type="text/javascript" src="{$control->ThemeFile()}/helper/dosya/pl_upload/i18n/tr.js"></script>

<script src="{$control->ThemeFile()}/assets/vendor_components/jquery-toast-plugin-master/src/jquery.toast.js"></script>


<script src="{$control->ThemeFile()}/assets/plugins/tags-input/tagsinput.js"></script>


<script src="{$control->ThemeFile()}/assets/vendor_components/sweetalert/sweetalert2.js"></script>
<script src="https://cdn.jsdelivr.net/npm/promise-polyfill@7.1.0/dist/promise.min.js"></script>


<script src="{$control->ThemeFile()}/js/template.js"></script>
<script src="{$control->ThemeFile()}/js/validation.js"></script>

<script src="{$control->ThemeFile()}/js/pages/dashboard.js"></script>


<script src="{$control->ThemeFile()}/js/demo.js"></script>


{$control->CustomPageJs($control->BaseAdmin())}

<script src="{$control->BaseAdmin()}/assets/theme.js?v=15" charset="utf-8"></script>
<script src="{$control->BaseAdmin()}/assets/panel.js"></script>
<script src="{$control->BaseAdmin()}/assets/script.js"></script>

<script>
    $(function () {
        $('.select2').select2();
        $('[data-mask]').inputmask();

        var initDateTimePicker = function(selector) {
            $(selector).each(function () {
                var opt = {
                    locale: "tr",
                    icons:{
                        time:     "fa fa-clock-o",
                        date:     "fa fa-calendar",
                        up:       "fa fa-chevron-up",
                        down:     "fa fa-chevron-down",
                        previous: "fa fa-chevron-left",
                        next:     "fa fa-chevron-right",
                        today:    "fa fa-crosshairs",
                        clear:    "fa fa-trash",
                        close:    "fa fa-times",
                    },
                };

                if (typeof $(this).data('use-current') !== 'undefined') {
                    opt.useCurrent = $(this).data('use-current');
                }

                if (typeof $(this).data('show-close') !== 'undefined') {
                    opt.showClose = $(this).data('show-close');
                }

                if (typeof $(this).data('show-clear') !== 'undefined') {
                    opt.showClear = $(this).data('show-clear');
                }

                if (typeof $(this).data('format') !== 'undefined') {
                    opt.format = $(this).data('format');
                }

                $(this).datetimepicker(opt);
            });
        };

        if ($('.date-picker').length > 0) {
            initDateTimePicker('.date-picker');
        }

    });

</script>



</body>
</html>