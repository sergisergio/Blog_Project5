<?php
/**
 * My own blog.
 *
 * PHP Version 7
 * 
 * Register Controller
 *
 * @category PHP
 * @package  Default
 * @author   Philippe Traon <ptraon@gmail.com>
 * @license  http://projet5.philippetraon.com Phil Licence
 * @version  GIT: $Id$ In development.
 * @link     http://projet5.philippetraon.com
 */

namespace Philippe\Blog\Src\Controller;

use \Philippe\Blog\Src\Model\UserManager;
use \Philippe\Blog\Src\Entities\UserEntity;
use \Philippe\Blog\Src\Core\Session;
use \Philippe\Blog\Src\Controller\LogController;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
/**
 *  Class RegisterController
 *
 * @category PHP
 * @package  Default
 * @author   Philippe Traon <ptraon@gmail.com>
 * @license  http://projet5.philippetraon.com Phil Licence
 * @link     http://projet5.philippetraon.com
 */
class RegisterController
{
    private $_userManager;
    private $_logController;
    private $_userEntity;
    //private $data;

    /**
     * Function construct
     */
    public function __construct() 
    {
        $this->_userManager = new UserManager();
        $this->_logController = new LogController();
        //$this->_userEntity = new UserEntity($data);
    }
    /**
     * Function signupPage
     * 
     * @return mixed
     */
    public function signupPage()
    {
        $csrfSignupToken = md5(time()*rand(1, 1000)); 
        include 'views/frontend/modules/blog/signup/signup.php';
    }
    /**
     * Function addUser
     * 
     * @param string $pseudo          pseudo
     * @param string $email           email
     * @param string $passe           password1
     * @param string $passe2          password2
     * @param string $csrfSignupToken the token to try to avoid csrf
     *
     * @return mixed
     */
    public function addUser($pseudo, $email, $passe, $passe2, $csrfSignupToken)
    {
        $_SESSION['csrfSignupToken'] = $csrfSignupToken; 
        if (!empty($pseudo) && !empty($email) && !empty($passe) && !empty($passe2)) {
            $user = $this->_userManager->existPseudo($pseudo);
            $usermail = $this->_userManager->existMail($email);
            if ($user) {
                $_SESSION['flash']['danger'] = 'Ce pseudo est déjà pris !';
                RegisterController::signupPage();
            } elseif ($usermail) {
                $_SESSION['flash']['danger'] = 'Cet email est déjà utilisé !';
                RegisterController::signupPage();
            } elseif (empty($pseudo) || !preg_match('/^[a-zA-Z0-9_@#&é§è!çà^¨$*`£ù%=+:\;.,?°<>]+$/', $pseudo)) {
                $_SESSION['flash']['danger'] = 'Votre pseudo n\'est pas valide';
                RegisterController::signupPage();
            } elseif (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['flash']['danger'] = 'Votre email n\'est pas valide !';
                RegisterController::signupPage();
            } elseif (empty($passe) || $passe != $_POST['passe2']) {
                $_SESSION['flash']['danger'] = 'Vous devez entrer un mot de passe valide !';
                RegisterController::signupPage();
            } elseif (strlen($passe) < 6 || strlen($passe) > 50) {
                $_SESSION['flash']['danger'] = 'Votre mot de passe doit faire entre 6 et 50 caractères !';
                RegisterController::signupPage();
            } else {
                if (isset($_SESSION['csrfSignupToken']) AND isset($csrfSignupToken) AND !empty($_SESSION['csrfSignupToken']) AND !empty($csrfSignupToken)) {
                    if ($_SESSION['csrfSignupToken'] == $csrfSignupToken) {
                        $users = $this->_userManager->addUserRequest($pseudo, $email, $passe);
                        if ($users === false) {
                            $_SESSION['flash']['danger'] = 'Inscription impossible !';
                            RegisterController::signupPage();
                        } else {
                            $mail = new PHPMailer(true);                             
                            try {
                                $mail->setFrom('contact@philippetraon.com', 'Philippe Traon');
                                $mail->addAddress($email, $pseudo);
                                $mail->addReplyTo('contact@philippetraon.com', 'Information');
                                $mail->isHTML(true);                                  
                                $mail->Subject = 'Message';
                                $mail->Body = '<b>Blog de Philippe Traon : </b>' . '<br />' . 'Afin de valider votre compte, merci de cliquer sur ce lien : ' . '<br />' . '<a href="http://www.projet5.philippetraon.com/index.php?action=confirmRegistration&id='.$users->getId().'&token='.$users->getConfirmation_token().'">'.'Lien de confirmation</a>';
                                $mail->send();
                                
                                $_SESSION['flash']['success'] = 'Un mail de confirmation vous a été envoyé pour valider votre compte';
                                $this->_logController->loginPage();
                            } 
                            catch (Exception $e) {
                            echo 'Un problème est survenu ! Le message n\'a pas pu être envoyé : ', $mail->ErrorInfo;
                            }
                        }
                    } else {
                        $_SESSION['flash']['danger'] = 'Erreur de vérification !';
                        $this->_logController->loginPage();
                    }
                }
            }                
        } else {
            $_SESSION['flash']['danger'] = 'Vous devez remplir tous les champs !';
            RegisterController::signupPage();
        }
    }
    /**
     * Confirm the registration
     * 
     * @param int    $userId    the user's id
     * @param string $userToken the token to confirm the registration
     * 
     * @return mixed
     */
    public function confirmRegistration($userId, $userToken)
    {
        $user = $this->_userManager->getUser($userId);
        if (isset($_GET['id']) && isset($_GET['token'])) {
            if ($user &&  $user->getConfirmation_token() == $userToken) {
                $this->_userManager->setActiveRequest($userId);
                $_SESSION['flash']['success'] = 'Votre inscription a bien été prise en compte ! Vous pouvez vous connecter !';
                $this->_logController->loginPage();
            } else {
                $_SESSION['flash']['danger'] = 'Ce token n est plus valide ! Veuillez réessayer ! !';
                RegisterController::signupPage();
            } 
        } else {
            $_SESSION['flash']['danger'] = 'Echec de l\'inscription ! Veuillez réessayer sinon contactez l\'administrateur';
            RegisterController::signupPage();
        }  
    }
    /**
     * Function setActiveUser
     * 
     * @param id $userId the user's id
     *
     * @return mixed
     */
    public function setActiveUser($userId)
    {
        $activeUser = $this->_userManager->setActiveRequest($userId);
    }
}