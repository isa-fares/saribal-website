<? if (isset($recaptcha) && $recaptcha){?>

    <script src="https://www.google.com/recaptcha/api.js?render=<?=$sitekey?>&hl=<?=$lang?>"></script>

    <script>
        grecaptcha.ready(function() {
            grecaptcha.execute(recaptchaKey, {action: 'form'}).then(function(token) {
                var recaptchaReturn = document.getElementById('recaptchaReturn');
                recaptchaReturn.value = token;
            });
        });
    </script>


<? } ?>

<form <?php
     echo((isset($action) ? 'action="'.$action.'"' :''))
        .((isset($id) ? 'id="'.$id.'"' :''))
        .((isset($name) ? 'name="'.$name.'"' :''))
        .((isset($class) ? ' class="'.$class.'"' :''))
        .'method="'.((isset($method) ? $method :'post')).'"'
        .((isset($fileUpload) ? 'enctype="multipart/form-data"' :''))?>>
<?php  if(isset($token) and $token) echo '<input type="hidden" name="'.$name.'_token" value="'.$token_value.'" />';?>
<?php if (isset($hidden_msg) and !empty($hidden_msg)){echo $hidden_msg;}?>

<? if (isset($recaptcha) && $recaptcha){?>
    <input type='hidden' name='recaptcha_return' id='recaptchaReturn'>
<? } ?>

