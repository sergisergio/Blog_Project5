<?php

/*use \Philippe\Blog\Model\Entities\PostEntity;
use \Philippe\Blog\Model\Entities\CommentEntity;
use \Philippe\Blog\Model\Entities\UserEntity;
use \Philippe\Blog\Model\UserManager;
use \Philippe\Blog\Model\PostManager;
use \Philippe\Blog\Model\CommentManager;
use \Philippe\Blog\Model\SessionManager;
use \Philippe\Blog\Model\SecurityManager;*/
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function contact($name, $email, $subject, $message)
{
    if (!empty($name) && !empty($email) && !empty($subject) && !empty($message)) {
         $mail = new PHPMailer(true);                             
        try {
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
        catch (Exception $e) {
        echo 'Un problème est survenu ! Le message n\'a pas pu être envoyé : ', $mail->ErrorInfo;
        }
    }
}