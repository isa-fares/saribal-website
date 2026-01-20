<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Yönetim Paneli</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">


    <link rel="stylesheet" href="{$ThemeURL}/assets/vendor_components/bootstrap/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="{$ThemeURL}/css/bootstrap-extend.css">

    <link rel="stylesheet" href="{$ThemeURL}/css/master_style.css">

    <link rel="stylesheet" href="{$ThemeURL}/css/skins/_all-skins.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>




<body class="hold-transition login-page bg-1">
<div class="login-box">
    <div class="login-logo" style="color:#fff;">
        <!-- <img src="{$BaseAdminURL}/img/logo.png" class="user-image" alt=""> -->
        <b>Yönetim </b>Paneli
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg"></p>

        <form action="{$BaseAdminURL}/?cmd={$modulName}/kontrol.html" method="post" class="form-element" id="loginCheck">
            <div class="form-group has-feedback">
                <input type="text" class="form-control" name="user" placeholder="Kullanıcı Adı" name="user">
                <span class="ion ion-email form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Şifre" name="pass">
                <span class="ion ion-locked form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="checkbox">
                        <input type="checkbox" id="basic_checkbox_1" name="hatirla" value="1" >
                        <label for="basic_checkbox_1">Beni Hatırla</label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-6">
                    <div class="fog-pwd">
                        <a href="javascript:void(0)"><i class="ion ion-locked"></i> Şifremi Unuttum?</a><br>
                    </div>

                </div>

                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-info btn-block margin-top-10">Giriş Yap</button>
                </div>

            </div>
        </form>


    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<script src="{$ThemeURL}/assets/vendor_components/jquery/dist/jquery.min.js"></script>

<script src="{$ThemeURL}/assets/vendor_components/popper/dist/popper.min.js"></script>

<script src="{$ThemeURL}/assets/vendor_components/bootstrap/dist/js/bootstrap.min.js"></script>

<script>
    $(function () {
        $(window).ready(function(e){

            $("#loginCheck").submit(function(e){
                $.ajax({
                    url :  $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: $(this).serialize(),
                    success:function(g)
                    {
                        if(g==1) window.location.href = '{$BaseAdminURL}/';
                        else {
                            $('.login-box-msg').fadeIn(100).css('color','#c20000').html('Kullanıcı Adı veya Şifre Hatalı');
                            setTimeout(function(){
                                $('.login-box-msg').fadeOut(2000)
                            }, 4000);
                        }
                    }
                });
                return false;
            });

        });

    });
</script>