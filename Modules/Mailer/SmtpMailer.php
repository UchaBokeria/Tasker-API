<?php

date_default_timezone_set('Etc/UTC');
header('Content-Type: text/html; charset=utf-8');

require "./Services/Mailer/PHPMailer/src/PHPMailer.php";
require "./Services/Mailer/PHPMailer/src/SMTP.php";
require "./Services/Mailer/PHPMailer/src/Exception.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class SmtpMailer extends Database
{

    public $Options = null;
    public $mailer = null;

    public function __construct($OPTIONS = null) 
    {
        if($OPTIONS != null)
            $this->Options = $OPTIONS;
    }

    public function Send($OPTIONS = null)
    {
        if($OPTIONS != null)
            $this->Options = $OPTIONS;

        $mail = new PHPMailer();
        
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->SMTPAuth = MAILSMTPAUTH; 
        $mail->Host = MAILHOST;
        $mail->SMTPAuth = MAILSMTPAUTH;
        $mail->SMTPSecure = MAILSMTPSECURE;
        $mail->Port = MAILPORT;
        $mail->Username = MAILUSERNAME;
        $mail->Password = MAILPASSWORD;
        $mail->Subject = $this->Options['subject'];
        $mail->setFrom(MAILFORMNAME);
        $mail->isHTML(MAILISHTML);
        $mail->Body = $this->Options['body'];
        $mail->addAddress($this->Options['address']);

            // foreach ($this->Options["attachments"] as $key => $value) {
            //     $value = str_replace("../", "", $value);
            //     $file = explode("/", $value);
            //     if($file[COUNT($file)-1] != '') {
            //         //var_dump(["https://wpatbilisicongress.com/$value",$file[COUNT($file)-1]]);
            //         $mail->addAttachment(
            //             "https://wpatbilisicongress.com/$value",
            //             $file[COUNT($file)-1]
            //         );
            //     }
            // }
        /* /
        $mail->SMTPOptions = array(
            'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
            )
        ); 
        /**/

        $resp = $mail->send();
        $mail->smtpClose();

        return [
            'error' => !$resp , 
            'msg' => (!$resp) ? 
                'Mail Has Been Failed To Sent': 
                'Mail Has Been Sent '
        ];
        
    }

    public function TemplateBuild($object, $template)
    {

        $template = file_get_contents($template);

        foreach ($object as $key => $value)
            $template = str_replace("{". $key . "}", $value, $template);
        
        return $template;
        
    }

}