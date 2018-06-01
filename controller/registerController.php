<?php

use \Philippe\Blog\Model\Entities\UserEntity;
use \Philippe\Blog\Model\UserManager;
use \Philippe\Blog\Core\Session;
use \Philippe\Blog\Model\SecurityManager;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/* ***************** REGISTRATION PAGE *******************/
    function signupPage()
    {
        include 'view/frontend/pages/signup.php';
    }
/* ***************** REGISTRATION ************************/
    function addUser($pseudo, $email, $passe, $passe2)
    {
        $userManager = new UserManager();
        $session = new Session();
        if (!empty($pseudo) && !empty($email) && !empty($passe) && !empty($passe2)) {
            $user = $userManager->existPseudo($pseudo);
            $usermail = $userManager->existMail($email);
            if ($user) {
                $session->errorPseudo1();
            }
            elseif ($usermail) {
                $session->errorEmail1();
            }
            elseif(empty($pseudo) || !preg_match('/^[a-zA-Z0-9_]+$/', $pseudo)) {
                $session->errorPseudo2();
            }
            elseif (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $session->errorEmail2();
            }
            elseif (empty($passe) || $passe != $_POST['passe2']) {
                $session->errorPassword();
            }
            else {
                $users = $userManager->addUserRequest($pseudo, $email, $passe);
                /* test mail local */
                //mail($email, 'Confirmation de votre compte', "Afin de valider votre compte, merci de cliquer sur ce lien\n\nhttp://localhost:8888/Blog_Project5/index.php?action=confirmRegistration&id=$user_id&token=$token");
                /* test mail online */
                

                    /*$mail = new PHPMailer(true);                             
                    try {
                        $mail->setFrom('contact@philippetraon.com', 'Philippe Traon');
                        $mail->addAddress($email, $pseudo);
                        $mail->addReplyTo('contact@philippetraon.com', 'Information');
                        $mail->isHTML(true);                                  
                        $mail->Subject = 'Message';
                        $mail->Body = '<b>Blog de Philippe Traon : </b>' . '<br />' . 'Afin de valider votre compte, merci de cliquer sur ce lien : ' . '<br />' . 
                        //'<a href="http://www.projet5.philippetraon.com/index.php?action=confirmRegistration&id='.$user_id.'&token='.$token.'>'.'Lien de confirmation</a>';
                        '<a href="http://www.projet5.philippetraon.com/index.php?action=confirmRegistration&id='.$user_id.'&token='.$token.'">'.'Lien de confirmation</a>';
                        //$mail->AltBody = 'Message non-HTML : '.$message;
                        $mail->send();
                        // echo 'Le message a bien été envoyé';
                    } 
                    catch (Exception $e) {
                    echo 'Un problème est survenu ! Le message n\'a pas pu être envoyé : ', $mail->ErrorInfo;
                    }*/
                

                $session->registerSuccess();
                if ($users === false) {
                    $session->badRequest();
                }
            } 
        }
        else {
            $session->emptyContents();
        }
    }
/* ***************** CONFIRM REGISTRATION ****************/
    function confirmRegistration($userId, $userToken)
    {

        $userManager = new UserManager();
        $user = $userManager->getUser($userId);
        $session = new Session();
        if (isset($_GET['id']) && isset($_GET['token'])) {
            if ($user &&  $user['confirmation_token'] == $userToken) {
                $userManager->setActiveRequest($userId);
                $session->registerSuccess2();
                /*$mail = new PHPMailer(true);                             
                    try {
                        $mail->setFrom('contact@philippetraon.com', 'Philippe Traon');
                        $mail->addAddress($user['email'], $user['pseudo']);
                        $mail->addReplyTo('contact@philippetraon.com', 'Information');
                        $mail->isHTML(true);                                  
                        $mail->Subject = 'Bienvenue !';
                        $mail->Body = '<b>Votre inscription a bien été prise en compte ! Bienvenue sur le blog !  </b>' . '<a href="http://projet5.philippetraon.com">http://projet5.philippetraon.com</a>';
                        //$mail->AltBody = 'Message non-HTML : '.$message;
                        $mail->send();
                        // echo 'Le message a bien été envoyé';
                    } 
                    catch (Exception $e) {
                    echo 'Un problème est survenu ! Le message n\'a pas pu être envoyé : ', $mail->ErrorInfo;
                    }*/
            }
            else {
                $session->errorToken();
            } 
        }
        else {
            $session->registerFailure();
        }  
    }
/* ***************** SET ACTIVE USER *********************/
    function setActiveUser($userId)
    {
        $userManager = new UserManager();
        $activeUser = $userManager->setActiveRequest($userId);
    }
