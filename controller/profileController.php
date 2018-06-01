<?php

use \Philippe\Blog\Model\Entities\UserEntity;
use \Philippe\Blog\Model\UserManager;
use \Philippe\Blog\Core\Session;

/* ***************** PROFILE PAGE *****************/
    function profilePage($userId)
    {
        $userManager = new \Philippe\Blog\Model\UserManager();
        $post = $userManager->getUser($userId);
        require('view/frontend/pages/profile.php');
    }
/* ***************** MODIFY PROFILE ***************/
    function modifyProfile($userId, $avatar, $first_name, $name, $email, $description)
    {

        $userManager = new \Philippe\Blog\Model\UserManager();

        if (!empty($_POST['email'])) {
            // Testons si le fichier a bien été envoyé et s'il n'y a pas d'erreur
            if (isset($_FILES['avatar']) AND $_FILES['avatar']['error'] == 0) 
            {
                // Testons si le fichier n'est pas trop gros
                if ($_FILES['avatar']['size'] <= 1000000) 
                { // taille du fichier envoyé
                    // Testons si l'extension est autorisée
                    $infosfichier = pathinfo($_FILES['avatar']['name']); // nom du fichier envoyé par le visiteur
                    $extension_upload = $infosfichier['extension']; // on récupère l'extension du fichier
                    $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
                    // on vérifie si l'extension de notre fichier correspond bien à celles qu'on autorise.
                    if (in_array($extension_upload, $extensions_autorisees)) 
                    {
                        // On peut valider le fichier et le stocker définitivement
                        move_uploaded_file($_FILES['avatar']['tmp_name'], 'public/images/avatar/' . basename($_FILES['avatar']['name'])); // déplace notre fichier de l'emplacement temporaire vers notre serveur
                        echo "L'envoi a bien été effectué !";
                    }
                }
            }
            $modifiedProfile = $userManager->modifyProfileRequest($userId, $avatar, $first_name, $name, $email, $description);
            if ($modifiedProfile === false) 
            {
                throw new Exception('Impossible de modifier le profil');
            }
            else 
            {
                $_SESSION['flash']['success'] = 'Modification effectuée !';
                profilePage($_SESSION['id']);
                exit();
                unset($_SESSION['avatar']);
                $_SESSION['avatar'] = $avatar;
            }
            
        }
        else 
        {
            $_SESSION['flash']['danger'] = 'Tous les champs ne sont pas remplis !';
            profilePage($_SESSION['id']);
            exit();
        }
    }
/* ***************** DELETE ACCOUNT ***************/
    function deleteAccount($userId){
        $userManager = new \Philippe\Blog\Model\UserManager();
        $session = new Session();
        $deleteAccount = $userManager->deleteAccountRequest($userId);
        $session->stopSession();

        if ($deleteAccount === false) {
            throw new Exception('Impossible de supprimer le profil');
        }
        else {
            header('Location: index.php?action=blog');
        }
    }
/* ***************** PUBLIC PROFILE ***************/
    function publicProfile($commentAuthor)
    {
        $commentManager = new \Philippe\Blog\Model\CommentManager();
        $user = $commentManager->getUserByCommentRequest($commentAuthor);
        require('view/frontend/pages/publicProfile.php');
    }