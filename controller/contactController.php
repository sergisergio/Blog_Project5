<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/**
 * Function contact
 * 
 * @param name     $name     mailer's name
 * @param email    $email    mailer's email
 * @param subject  $subject  mailer's subject
 * @param message  $message  mailer's message
 * @param response $response captcha
 * @param remoteip $remoteip mailer's IP address
 * 
 * @return [type]
 */
function contact($name, $email, $subject, $message, $response, $remoteip)
{
    if (!empty($name) && !empty($email) && !empty($subject) && !empty($message)) {
        
        $secret = "6LeS_lwUAAAAABD6EBW4fo0y2jVBfLr_ho0IGZ2j";
        $api_url = "https://www.google.com/recaptcha/api/siteverify?secret=" 
        . $secret
        . "&response=" . $response
        . "&remoteip=" . $remoteip ;

        $decode = json_decode(file_get_contents($api_url), true);
    
        if ($decode['success'] == true) {
            $mail = new PHPMailer(true);                             
            try 
            {
                $mail->setFrom($email, 'Expediteur');
                $mail->addAddress('contact@philippetraon.com', 'Philippe Traon');
                $mail->addReplyTo($email, 'Information');
                $ip = $_SERVER["REMOTE_ADDR"];
                $mail->isHTML(true);                                  
                $mail->Subject = 'Message';
                $mail->Body    = '<b>Auteur : </b>' . $name . '<br />' . '<b>IP : </b>' . $ip . '<br />' . '<b>Message : </b>' . $message;
                $mail->AltBody = 'Message non-HTML : '.$message;
                $mail->send();
                echo '<p style="font-weight: bold;text-align: center;">Le message a bien été envoyé</p>';
            } 
            catch (Exception $e) 
            {
                echo '<p style="color:red; font-weight: bold;text-align: center;">Un problème est survenu ! Le message n\'a pas pu être envoyé : </p>';
            }
        } else {
            echo '<p style="color:red; font-weight: bold;text-align: center;">Veuillez confirmer le captcha !</p>';
        }
    }
}