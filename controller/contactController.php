<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/* **************** CONTACT FORM **************/
function contact($name, $email, $subject, $message, $response, $remoteip)
{
    if (!empty($name) && !empty($email) && !empty($subject) && !empty($message)) 
    {
        
        $secret = "6LeS_lwUAAAAABD6EBW4fo0y2jVBfLr_ho0IGZ2j";
        $api_url = "https://www.google.com/recaptcha/api/siteverify?secret=" 
    . $secret
    . "&response=" . $response
    . "&remoteip=" . $remoteip ;

        $decode = json_decode(file_get_contents($api_url), true);
    
        if ($decode['success'] == true) 
        {
            $mail = new PHPMailer(true);                             
            try 
            {
                $mail->setFrom($email, 'Mailer');
                $mail->addAddress('contact@philippetraon.com', 'Philippe Traon');
                $mail->addReplyTo($email, 'Information');
                $ip = $_SERVER["REMOTE_ADDR"];
                $mail->isHTML(true);                                  
                $mail->Subject = 'Message';
                $mail->Body    = '<b>Auteur : </b>' . $name . '<br />' . '<b>IP : </b>' . $ip . '<br />' . '<b>Message : </b>' . $message;
                $mail->AltBody = 'Message non-HTML : '.$message;
                $mail->send();
                echo 'Le message a bien été envoyé';
            } 
            catch (Exception $e) 
            {
                echo 'Un problème est survenu ! Le message n\'a pas pu être envoyé : ', $mail->ErrorInfo;
            }
        }
        else 
        {
            echo 'Veuillez confirmer le captcha !';
        }
    }
}