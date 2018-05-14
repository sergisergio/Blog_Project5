<?php
session_start();

/* ***************************** RESUME ************************************/

    /* **********************************************************************
    *                              UTILISATEUR                                *
    *************************************************************************

    1 . PAGE D'ACCUEIL DU BLOG.
    2 . PAGE QUI AFFICHE UN BLOG POST.
    3 . AJOUTER UN COMMENTAIRE.
    4 . AFFICHER LA PAGE POUR MODIFIER UN COMMENTAIRE.
    5 . SUPPRIMER UN COMMENTAIRE.
    6 . MODIFIER UN COMMENTAIRE.
    7 . PAGE DE CONNEXION UTILISATEUR.
    8 . CONNEXION UTILISATEUR.
    9 . DECONNEXION UTILISATEUR. 
    10. PAGE INSCRIPTION UTILISATEUR.
    11. INSCRIPTION UTILISATEUR.
    12. CONFIRMATION INSCRIPTION UTILISATEUR.
    13. AFFICHER LA PAGE DU PROFIL.
    14. SUPPRIMER MON COMPTE.
    15. AFFICHER LA PAGE RESET PASSWORD 1.
    16. ENVOI MAIL RESET PASSWORD.
    17. AFFICHER LA PAGE RESET PASSWORD 2.
    18. MODIFIER LE MOT DE PASSE.
    19. PAS LES DROITS ADMINISTRATEUR.

    /* **********************************************************************
    *                            ADMINISTRATEUR                             *
    *************************************************************************

    1 . AFFICHER PAGE D'ACCUEIL ADMINISTRATEUR.
    2 . AFFICHER LA RUBRIQUE ARTICLES.
    3 . AFFICHER LA RUBRIQUE COMMENTAIRES.
    4 . AFFICHER LA RUBRIQUE MEMBRES.
    5 . AJOUTER UN ARTICLE.
    6 . AFFICHER LA PAGE POUR MODIFIER UN COMMENTAIRE.
    7 . MODIFIER UN ARTICLE.
    8 . SUPPRIMER UN ARTICLE.
    9 . EFFACER UN MEMBRE.
    10. AFFICHER LA PAGE POUR MODIFIER UN MEMBRE.
    11. MODIFIER UN MEMBRE.
    12. AFFICHER L'ENSEMBLE DES BLOG POSTS.
    13. VALIDER UN COMMENTAIRE.
    14. SUPPRIMER UN COMMENTAIRE.
    15. DONNER LES DROITS ADMIN.
    16. SUPPRIMER LES DROITS ADMIN

    /* **********************************************************************
    *                              PAR DEFAUT                               *
    *************************************************************************

    1 . PAGE D'ACCUEIL DU SITE.

*************************** FIN RESUME *************************************/

require('controller/frontend.php');
require('controller/backend.php');

try {
    if (isset($_GET['action']))  {

    /* **********************************************************************
    *                              FRONT-END                                *
    ************************************************************************/

    /* ********** 1 . PAGE LISTANT L'ENSEMBLE DES BLOG POSTS ***************/
        
        if ($_GET['action'] == 'blog') {
             listPosts();
    	}

    /* ********** 2 . PAGE AFFICHANT UN BLOG POST **************************/
        
        elseif ($_GET['action'] == 'blogpost') {
             if (isset($_GET['id']) && $_GET['id'] > 0) {
                listPost();
             }
             else {
                $_SESSION['flash']['danger'] = 'Aucun id ne correspond à ce billet !';
                errors();
                exit();
            }
        }

    /* ********** 3 . AJOUTER UN COMMENTAIRE *******************************/
        
        elseif ($_GET['action'] == 'addcomment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['content'])) { 
                    addComment($_GET['id'], $_SESSION['id'], $_POST['content']);
                }
                else {
                    $_SESSION['flash']['danger'] = 'Le champ est vide !';
                    header('Location: index.php?action=blogpost&id=' . $_GET['id'] . '#comments');
                    exit();
                }
            }
            else {
                errors();
                exit();
            }
        }

    /* ********** 4 . AFFICHER LA PAGE POUR MODIFIER UN COMMENTAIRE ********/

        elseif ($_GET['action'] == 'modifyCommentPage') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                modifyCommentPage($_GET['id']);
            }
            else {
                $_SESSION['flash']['danger'] = 'Aucun id ne correspond à ce billet !';
                errors();
                exit();
            }
        }

    /* ********** 5 . SUPPRIMER UN COMMENTAIRE *****************************/

        elseif ($_GET['action'] == 'deleteComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                deleteComment($_GET['id']);
            }
            else {
                $_SESSION['flash']['danger'] = 'Aucun id ne correspond à ce billet !';
                errors();
                exit();
            }
        }

    /* ********** 6 . MODIFIER UN COMMENTAIRE ******************************/

        elseif ($_GET['action'] == 'modifyComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['content'])) { 
                    modifyComment($_GET['id'], $_SESSION['id'], $_POST['content']);
                }
                else {
                    $_SESSION['flash']['danger'] = 'Le champ est vide !';
                    header('Location: index.php?action=modifyCommentPage&id=' . $_GET['id']);
                    exit();
                }
            }
            else {
                $_SESSION['flash']['danger'] = 'Aucun id ne correspond à ce billet !';
                errors();
                exit();
            }
        }

    /* ********** 7 . PAGE CONNEXION UTILISATEUR ***************************/

    	elseif ($_GET['action'] == 'loginPage') {
    		loginPage();
        }

    /* ********** 8 . CONNEXION UTILISATEUR ********************************/

        elseif ($_GET['action'] == 'login') {
            if(!empty($_POST) && !empty($_POST['pseudo']) && !empty($_POST['passe'])) {
                login($_POST['pseudo'], $_POST['passe']);
                if($_POST['remember']){
                    remember($_POST['remember']);
                }
            }
            else {
                $_SESSION['flash']['danger'] = 'Veuillez remplir tous les champs !';
                loginPage();
                exit();
            }
        }

    /* ********** 9 . DECONNEXION UTILISATEUR ******************************/

        elseif ($_GET['action'] == 'logout') {
            logout();
        }
        
    /* ********* 10 . PAGE INSCRIPTION UTILISATEUR *************************/

        elseif ($_GET['action'] == 'signupPage') {
             signupPage();
        }
            
    /* ********* 11 . INSCRIPTION UTILISATEUR ******************************/

        elseif ($_GET['action'] == 'addUser') {
             if (!empty($_POST)) {
                $pseudo = $_POST['pseudo'];
                $email = $_POST['email'];
                $passe = $_POST['passe'];
                $passe2 = $_POST['passe2'];
                // $errors = array();
                } 

                if(empty($pseudo) || !preg_match('/^[a-zA-Z0-9_]+$/', $pseudo)) {
                    $_SESSION['flash']['danger'] = 'Votre pseudo n\'est pas valide (caractères alphanumériques et underscore permis... !';
                    signupPage();
                    exit();

                }

                checkExistPseudo($pseudo);

                if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $_SESSION['flash']['danger'] = 'Votre email n\'est pas valide !';
                    signupPage();
                    exit();
                }
                checkExistMail($email);
                
                if (empty($passe) || $passe != $_POST['passe2']) {
                    $_SESSION['flash']['danger'] = 'Vous devez entrer un mot de passe valide !';
                    signupPage();
                    exit();
                }

                if(empty($errors)) {
                    addUser($pseudo, $email, $passe); 
                }
        }

    /* ********* 12 . CONFIRMATION INSCRIPTION UTILISATEUR *****************/

        elseif ($_GET['action'] == 'confirmRegistration') {
            if (isset($_GET['id']) && isset($_GET['token'])) {
                  confirmRegistration($_GET['id'], $_GET['token']); 
            }
            else {
                $_SESSION['flash']['danger'] = 'Aucun id ou token ne correspond à cet utilisateur !';
                signupPage();
                exit();
            }
        }

    /* ********* 13 . AFFICHER LA PAGE DU PROFIL ***************************/
        
        elseif ($_GET['action'] == 'profilePage') {
            profilePage($_SESSION['id']);
        }

    /* ********* 14 . SUPPRIMER MON COMPTE *********************************/

        elseif ($_GET['action'] == 'deleteAccount') {
            if (isset($_SESSION['id'])) {
                  deleteAccount($_SESSION['id']); 
            }
            else {
                $_SESSION['flash']['danger'] = 'Aucun id ou token ne correspond à cet utilisateur !';
                profilePage();
                exit();
            }
        }

    /* ********* 15 . AFFICHER LA PAGE POUR LE MOT DE PASSE ****************/
        
        elseif ($_GET['action'] == 'forgetPasswordPage') {
            forgetPasswordPage();
        }

    /* ********* 16 . ENVOI MAIL MODIF MOT DE PASSE ************************/
        
        elseif ($_GET['action'] == 'forgetPassword') {
            if (empty($_POST['email'])) {
                $_SESSION['flash']['danger'] = 'Veuillez renseigner un email !';
                forgetPasswordPage();
                exit();
           }
            else {
                forgetPassword($_POST['email']);
            }
        }

    /* ********* 17 . AFFICHER LA PAGE MODIFIER LE MOT DE PASSE ************/
        
        elseif ($_GET['action'] == 'changePasswordPage') {
            if ((isset($_GET['id']) && $_GET['id'] > 0) && isset($_GET['token'])) {
                changePasswordPage($_GET['id'], $_GET['token']);
            }
            else {
                $_SESSION['flash']['danger'] = 'Aucun id ou token ne coresspond à cet email, veuillez réessayer !';
                forgetPasswordPage();
                exit();
            }
        }

    /* ********* 18 . MODIFIER LE MOT DE PASSE *****************************/
        
        elseif ($_GET['action'] == 'changePassword') {
            changePassword($_POST['userId'] , $_POST['passe']);
           }

    /* ********* 19 . PAS LES DROITS ADMINISTRATEUR ************************/

        elseif ($_GET['action'] == 'noAdmin') {
            noAdmin();
        }

    /* ********* 20 . RECHERCHER ************************/

        elseif ($_GET['action'] == 'search') {
            if(isset($_POST['search']) && $_POST['search'] != NULL) {
                search($_POST['search']);
            }
            else {
                listPosts();
            }
        }

    /* ********* 21 . MODIFIER LE PROFIL ************************/

        elseif ($_GET['action'] == 'modifyProfile') {
            /*if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                    $_SESSION['flash']['danger'] = 'Votre email n\'est pas valide !';
                    profilePage();
                    exit();
            }
            else {
                // checkExistMail($_POST['email']);*/
                //if ($_POST['email'] == $_SESSION['email']) {
                modifyProfile($_POST['userId'], $_POST['first_name'], $_POST['name'], $_POST['email'], $_POST['description']);
                //}
            //}
        }

    /* ********* 22 . COLOR YELLOW ************************/

        elseif ($_GET['action'] == 'changeColorYellow') {
            
                changeColorYellow($_SESSION['id']);
        }

    /* ********* 23 . COLOR AQUA ************************/

        elseif ($_GET['action'] == 'changeColorAqua') {
            
                changeColorAqua($_SESSION['id']);
        }

    /* ********* 24 . COLOR BLUE ************************/

        elseif ($_GET['action'] == 'changeColorBlue') {
            
                changeColorBlue($_SESSION['id']);
        }

    /* ********* 25 . COLOR GRAY ************************/

        elseif ($_GET['action'] == 'changeColorGray') {
            
                changeColorGray($_SESSION['id']);
        }

    /* ********* 26 . COLOR GREEN ************************/

        elseif ($_GET['action'] == 'changeColorGreen') {
            
                changeColorGreen($_SESSION['id']);
        }

    /* ********* 27 . COLOR ORANGE ************************/

        elseif ($_GET['action'] == 'changeColorOrange') {
            
                changeColorOrange($_SESSION['id']);
        }

    /* ********* 28 . COLOR PINK ************************/

        elseif ($_GET['action'] == 'changeColorPink') {
            
                changeColorPink($_SESSION['id']);
        }

    /* ********* 29 . COLOR RED ************************/

        elseif ($_GET['action'] == 'changeColorRed') {
            
                changeColorRed($_SESSION['id']);
        }

    /* ********* 29 . COLOR RED ************************/

        elseif ($_GET['action'] == 'publicProfile') {
            if (isset($_GET['id'])) {
                publicProfile($_GET['id']);
            }
        }
    /* **********************************************************************
    *                            ADMINISTRATEUR                             *
    ************************************************************************/
      
    /* ********** 1 . AFFICHER LA PAGE D'ACCUEIL ADMINISTRATEUR ************/

        elseif ($_GET['action'] == 'index_management') {
            indexManagement();
        }

    /* ********** 2 . AFFICHER LA RUBRIQUE ARTICLES ************************/

        elseif ($_GET['action'] == 'manage_posts') {
            managePosts();
        }

    /* ********** 3 . AFFICHER LA RUBRIQUE COMMENTAIRES ********************/

        elseif ($_GET['action'] == 'manage_comments') {
            manageComments();
            }
        
    /* ********** 4 . AFFICHER LA RUBRIQUE MEMBRES *************************/

        elseif ($_GET['action'] == 'manage_users') {
            manageUsers();
        }

    /* ********** 5 . AJOUTER UN ARTICLE ***********************************/

        elseif ($_GET['action'] == 'addpost') {
          
                if (!empty($_POST['title']) && !empty($_POST['content']) && !empty($_POST['chapo'])) {
                    // Testons si le fichier a bien été envoyé et s'il n'y a pas d'erreur
                    if (isset($_FILES['file_extension']) AND $_FILES['file_extension']['error'] == 0) {
                        // Testons si le fichier n'est pas trop gros
                        if ($_FILES['file_extension']['size'] <= 1000000) {
                            // Testons si l'extension est autorisée
                            $infosfichier = pathinfo($_FILES['file_extension']['name']);
                            $extension_upload = $infosfichier['extension'];
                            $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
                            if (in_array($extension_upload, $extensions_autorisees)) {
                                // On peut valider le fichier et le stocker définitivement
                                move_uploaded_file($_FILES['file_extension']['tmp_name'], 'public/images/posts/' . basename($_FILES['file_extension']['name']));
                                echo "L'envoi a bien été effectué !";
                            }
                        }
                    }
                    addPost($_POST['title'], $_POST['chapo'], $_SESSION['id'], $_POST['content'], $_FILES['file_extension']['name']);
                }
                else {
                    $_SESSION['flash']['danger'] = 'Tous les champs ne sont pas remplis !';
                    managePosts();
                    exit();
                }
        }

    /* ********** 6 . AFFICHER LA PAGE POUR MODIFIER UN ARTICLE ************/
        elseif ($_GET['action'] == 'modifyPostPage') {
              if (isset($_GET['id']) && $_GET['id'] > 0) {
                modifyPostPage($_GET['id']);
                }
                else {
                $_SESSION['flash']['danger'] = 'Aucun id ne correspond à cet article !';
                managePosts();
                exit();
                }
        }

    /* ********** 7 . MODIFIER UN ARTICLE **********************************/

        elseif ($_GET['action'] == 'modifyPost') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['title']) && !empty($_POST['content']) && !empty($_POST['chapo'])) { 
                    modifyPost($_GET['id'], $_POST['title'], $_POST['chapo'], $_SESSION['id'], $_POST['content']);
                }
                else {
                $_SESSION['flash']['danger'] = 'Veuillez remplir les champs !';
                modifyPostPage($_GET['id']);
                exit();
                }
            }
            else {
                $_SESSION['flash']['danger'] = 'Pas d\'identifiant d\'article envoyé !';
                modifyPostPage($_GET['id']);
                exit();
                }
            }       

    /* ********** 8 . EFFACER UN ARTICLE ***********************************/

        elseif ($_GET['action'] == 'deletePost') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                deletePost($_GET['id']);
            }
        }

    /* ********** 9 . EFFACER UN MEMBRE ************************************/

        elseif ($_GET['action'] == 'deleteUser') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                deleteUser($_GET['id']);
            }
        }

    /* ********* 10 . AFFICHER LA PAGE POUR MODIFIER UN MEMBRE *************/

        elseif ($_GET['action'] == 'modifyUserPage') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                modifyUserPage($_GET['id']);
            }
        }

    /* ********* 11 . MODIFIER UN MEMBRE ***********************************/

        elseif ($_GET['action'] == 'modifyUser') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                modifyUser($_GET['id']);

            }
        }

    /* ********* 12 . AFFICHER L'ENSEMBLE DES BLOG POSTS *******************/

        elseif ($_GET['action'] == 'adminViewPost') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                AdminViewPost();
            }
        }

    /* ********* 13 . VALIDER UN COMMENTAIRE *******************************/

        elseif ($_GET['action'] == 'validateComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                validateComment($_GET['id']);
            }
        } 

    /* ********* 14 . SUPPRIMER UN COMMENTAIRE *****************************/

        elseif ($_GET['action'] == 'adminDeleteComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                adminDeleteComment($_GET['id']);
            }
        }   

    /* ********* 15 . DONNER LES DROITS ADMIN ******************************/
        
        elseif ($_GET['action'] == 'giveAdminRights') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                giveAdminRights($_GET['id']);
            }
        }

    /* ********* 16 . SUPPRIMER LES DROITS ADMIN ***************************/
        
        elseif ($_GET['action'] == 'cancelAdminRights') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                stopAdminRights($_GET['id']);
            }
        }
    }

    /* **********************************************************************
    *                              PAR DEFAUT                               *
    ************************************************************************/

    /* ********** 1 . PAGE D'ACCUEIL ***************************************/

    else {
        home();
    }
}
catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}