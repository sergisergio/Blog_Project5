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
    13. PAS LES DROITS ADMINISTRATEUR
    14. CONTACT

    /* **********************************************************************
    *                            ADMINISTRATEUR                             *
    *************************************************************************

    1 . AFFICHER PAGE D'ACCUEIL ADMINISTRATEUR.
    2 . AFFICHER LA RUBRIQUE ARTICLES.
    3 . AFFICHER LA RUBRIQUE COMMENTAIRES.
    4 . AJOUTER UN ARTICLE.
    5 . AFFICHER LA PAGE POUR MODIFIER UN COMMENTAIRE.
    6 . MODIFIER UN ARTICLE.
    7 . SUPPRIMER UN ARTICLE.
    8 . VALIDER UN COMMENTAIRE.
    9 . SUPPRIMER UN COMMENTAIRE.

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

    /* ********* 13 . PAS LES DROITS ADMINISTRATEUR ************************/

        elseif ($_GET['action'] == 'noAdmin') {
            noAdmin();
        }

    /* ********* 14 . CONTACT ************************/

        elseif ($_GET['action'] == 'contact') {
            contact();
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

    /* ********** 4 . AJOUTER UN ARTICLE ***********************************/

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

    /* ********** 5 . AFFICHER LA PAGE POUR MODIFIER UN ARTICLE ************/
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

    /* ********** 6 . MODIFIER UN ARTICLE **********************************/

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

    /* ********** 7 . EFFACER UN ARTICLE ***********************************/

        elseif ($_GET['action'] == 'deletePost') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                deletePost($_GET['id']);
            }
        }

    /* ********** 8 . VALIDER UN COMMENTAIRE *******************************/

        elseif ($_GET['action'] == 'validateComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                validateComment($_GET['id']);
            }
        } 

    /* ********** 9 . SUPPRIMER UN COMMENTAIRE *****************************/

        elseif ($_GET['action'] == 'adminDeleteComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                adminDeleteComment($_GET['id']);
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