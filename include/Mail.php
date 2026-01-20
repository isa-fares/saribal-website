<?php


class Mail extends \Database\Data
{

    public $settings;

    public function __construct($settings)
    {
        parent::__construct($settings);
        $this->settings = $settings;

    }

    public function _SEND($from,$to,$subject,$govde,$fromName=null, $mailCC=null)
    {
        if($this->ayarlar('mailType') =='smtp')
            return  $this->_SMTP_MAIL_SEND($from,$to,$subject,$govde,$fromName,$mailCC);
        else
            return  $this->_MAIL_SEND($from,$to,$subject,$govde);

    }

    // Php Mail Kullanımı
    public  function _MAIL_SEND($from,$to,$subject,$govde)
    {
        $subject  =  $subject."\n";
        $headers  = 'From: ' . $from . "\r\n";
        $headers .= 'Return-Path: ' . $to . "\r\n";
        $headers .= 'MIME-Version: 1.0' ."\r\n";
        $headers .= 'Content-Type: text/HTML; charset=UTF-8' . "\r\n";
        $headers .= 'Content-Transfer-Encoding: 8bit'. "\n\r\n";

        if(mail($from,$subject,$govde,$headers))
            return 1; else return 0;
    }

    // SMTP Üzerinden Mail Kullanımı
    public  function _SMTP_MAIL_SEND($from=null, $to, $subject,$govde,$fromName = null, $mailCC=null)
    {
        //Create a new PHPMailer instance
        $mail = new \PHPMailer(true);
        //Tell PHPMailer to use SMTP
        $mail->isSMTP();
        //Enable SMTP debugging
        // 0 = off (for production use)
        // 1 = client messages
        // 2 = client and server messages
        $mail->SMTPDebug = 0;

        $mail->CharSet = 'UTF-8';
        //Ask for HTML-friendly debug output
        //Set the hostname of the mail server
        $mail->Host = $this->ayarlar('SmtpHost');
        //Set the SMTP port number - likely to be 465 or 587
        $mail->Port = ($this->ayarlar('SmtpPort')) ? $this->ayarlar('SmtpPort'):587;
        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;
        //Set the encryption system to use - ssl (deprecated) or tls
        (($this->ayarlar('SmtpSecret') == 0) ? $mail->SMTPSecure = $this->ayarlar('SmtpSecret') :null);
        //Username to use for SMTP authentication
        $mail->Username = $this->ayarlar('SmtpMail');
        //Password to use for SMTP authentication
        $mail->Password = $this->temizle($this->ayarlar('SmtpPass'));

        $name = (!empty($fromName)) ? $fromName : $subject;
        //Set who the message is to be sent from
        $mail->setFrom($this->ayarlar('SmtpMail'), $name);
        //Set an alternative reply-to address
        //  $mail->addReplyTo('replyto@example.com', 'First Last');
        //Set who the message is to be sent to
        $mail->addAddress($to, $name);
        //Set the subject line

        if ($mailCC != null){
            $mail->AddCC($mailCC, $fromName); // CC MAİL
        }


        $mail->Subject =  $subject;
        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        $mail->msgHTML($govde);
        //Replace the plain text body with one created manually
        //$mail->AltBody = 'This is a plain-text message body';
        //Attach an image file
        //$mail->addAttachment('images/phpmailer_mini.png');
        //send the message, check for errors
        if ($mail->send())  return 1; else return 0;

    }


    public function GooglereCAPTCHACont($kod)
    {
        if($kod):
            $secret = $this->settings->security('reCAPTCHA')['secret'];
            $recaptcha = new \ReCaptcha\ReCaptcha($secret);
            $resp = $recaptcha->verify($kod, $_SERVER['REMOTE_ADDR']);
            if ($resp->isSuccess()):
                return 1;
            else:
                return 0;
            endif;
        else:
            return 0;
        endif;

    }

}