
<?php
session_start();

/* ***************** RESUME *******************

    1 . Page d'accueil du blog (blog). ========================================> OK
    2 . Page qui affiche un blog post (blogpost).  ============================> OK
    3 . Ajouter un commentaire (addComment).  =================================> OK
    4 . Afficher la page pour modifier un commentaire (modifyCommentPage). ====> OK
    5 . Supprimer un commentaire (deleteComment). =============================> OK
    6 . Modifier un commentaire (modifyComment).  =============================> OK
    7 . Afficher la page de connexion (loginPage).  ===========================> OK
    8 . Se connecter (login).  ================================================> ?
        PROBLEME DE REDIRECTION
    9 . Se déconnecter (logout). ==============================================> OK 
    10 . Afficher la page d'inscription utilisateur (signupPage).  ============> OK
    11 . Traitement du formulaire d'inscription (addUser). ====================> OK
    12 . Confirmation inscription utilisateur (confirmRegistration).===========> OK
    13 . Afficher la page d'accueil administrateur (index_management). ========> OK
    14 . Afficher la rubrique articles (manage_posts). ========================> OK
    15 . Afficher la rubrique commentaires (manage_comments). =================> OK
    16 . Afficher la rubrique membres (manage_users). =========================> OK
    17 . Ajouter un article (addPost). ========================================> ?
         B. Mettre un substring pour l'intro
    18 . Afficher la page pour modifier un article (modifyPostPage).  =========> OK
    19 . Modifier un article (modifyPost).  ===================================> ?
         B. Mettre un substring pour l'intro
    20 . Supprimer un article (deletePost).  ==================================> OK
    21 . Supprimer un membre (deleteUser). ====================================> OK
    22 . Afficher la page pour modifier un membre (modifyUserPage). ===========> OK
    23 . Modifier un membre (modifyUser). =====================================> OK
    24 . Afficher un post et ses commentaires (adminViewPost). ================> OK
    
    29 . AFFICHER LA PAGE MODIFIER LE MOT DE PASSE ============================> OK
    30 . Modifier le mot de passe =============================================> ?
         En cours
    31 . Afficher la page du profil ===========================================> OK
    32 . Page d'accueil =======================================================> OK

   *************** FIN RESUME *****************/

/* Je charge les fichiers controller pour que les fonctions soient en mémoire*/
require('controller/frontend.php');
require('controller/backend.php');

/* Puis je teste le paramètre action pour savoir quel contrôleur appeler.
Par défaut, si il n'ya pas d'action, j'exécute la fonction home() qui appelera la page d'accueil. */
// die();
try {
        /* Si il y a une action... */
    if (isset($_GET['action']))  {

    /* **********************************************************************
    *                              FRONT-END                                *
    ************************************************************************/

        /* ********** 1. PAGE LISTANT L'ENSEMBLE DES BLOG POSTS **********************/
        
        if ($_GET['action'] == 'blog') {
             listPosts();
    	}

        /* ********** 2. PAGE AFFICHANT UN BLOG POST *********************************/
        
        elseif ($_GET['action'] == 'blogpost') {
             if (isset($_GET['id']) && $_GET['id'] > 0) {
                listPost();
             }
             else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }

        /* ********** 3 . AJOUTER UN COMMENTAIRE *************************************/
        
        elseif ($_GET['action'] == 'addcomment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['content'])) { 
                    addComment($_GET['id'], $_SESSION['id'], $_POST['content']);
                }
                else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }
            else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }

        /* ********** 4 . AFFICHER LA PAGE POUR MODIFIER UN COMMENTAIRE *************/

        elseif ($_GET['action'] == 'modifyCommentPage') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                modifyCommentPage($_GET['id']);
            }
            else {
                throw new Exception('Aucun identifiant de commentaire envoyé');
            }
        }

        /* ********** 5 . AFFICHER LA PAGE POUR EFFACER UN COMMENTAIRE **************/

        elseif ($_GET['action'] == 'deleteComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                deleteComment($_GET['id']);
            }
        }

        /* ********** 6 . MODIFIER UN COMMENTAIRE **********************************/

        elseif ($_GET['action'] == 'modifyComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['content'])) { 
                    modifyComment($_GET['id'], $_SESSION['id'], $_POST['content']);
                }
                else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }
            else {
                throw new Exception('Aucun identifiant de commentaire envoyé');
            }
        }

        /* *********** 7 . PAGE CONNEXION UTILISATEUR *******************************/

    	elseif ($_GET['action'] == 'loginPage') {
    		loginPage();
        }

        /* *********** 8 . CONNEXION UTILISATEUR ************************************/

        elseif ($_GET['action'] == 'login') {
            login($_POST['pseudo'], $_POST['passe']);
        }

        /* *********** 9 . DECONNEXION UTILISATEUR *********************************/

        elseif ($_GET['action'] == 'logout') {
            logout();
        }
        
        /* *********** 10 . PAGE INSCRIPTION UTILISATEUR ****************************/

        elseif ($_GET['action'] == 'signupPage') {
             signupPage();
        }
            
        /* ************ 11 . FORMULAIRE INSCRIPTION REMPLI **************************/

        elseif ($_GET['action'] == 'addUser') {
             if (!empty($_POST)) {
                $pseudo = $_POST['pseudo'];
                $email = $_POST['email'];
                $passe = $_POST['passe'];
                $passe2 = $_POST['passe2'];
                $errors = array();
                } 
                if(empty($_POST['pseudo']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['pseudo'])) {
                    $errors['pseudo'] = "Votre pseudo n'est pas valide (caractères alphanumériques et underscore permis...";
                    echo '<div class="alert alert-danger">' . $errors['pseudo'] . '</div>';
                }
                if (checkExistPseudo($pseudo)) {
                    $errors['pseudo'] = 'Ce pseudo est déjà pris';
                    echo '<div class="alert alert-danger">' . $errors['pseudo'] . '</div>';
                }
                if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                    $errors['email'] = "Votre email n'est pas valide";
                    echo '<div class="alert alert-danger">' . $errors['email'] . '</div>';
                }
                if (checkExistMail($email)) {
                    $errors['email'] = 'Cet email est déjà pris';
                    echo '<div class="alert alert-danger">' . $errors['email'] . '</div>';
                }
                if (empty($_POST['passe']) || $_POST['passe'] != $_POST['passe2']) {
                    $errors['passe'] = "Vous devez entrer un mot de passe valide.";
                    echo '<div class="alert alert-danger">' . $errors['passe'] . '</div>' . '<br />';
                }
                if(empty($errors)) {
                    addUser($pseudo, $email, $passe); 
                }
        }

        /* ************** 12 . CONFIRMATION INSCRIPTION UTILISATEUR ******************/

        elseif ($_GET['action'] == 'confirmRegistration') {
            if (isset($_GET['id']) && isset($_GET['token'])) {
                  confirmRegistration($_GET['id'], $_GET['token']); 
            }
            else {
                echo 'Aucun id ou token...';
            }
        }

        /* **********************************************************************
        *                              BACK-END                                *
        ************************************************************************/
        
        /* ************** 13 . AFFICHER LA PAGE D'ACCUEIL ADMINISTRATEUR ****************/

        elseif ($_GET['action'] == 'noAdmin') {
            noAdmin();
        }


        /* ************** 13 . AFFICHER LA PAGE D'ACCUEIL ADMINISTRATEUR ****************/

        elseif ($_GET['action'] == 'index_management') {
            indexManagement();
        }

        /* ************** 14 . AFFICHER LA RUBRIQUE ARTICLES ***************************/

        elseif ($_GET['action'] == 'manage_posts') {
            managePosts();
        }

        /* ************** 15 . AFFICHER LA RUBRIQUE COMMENTAIRES ***********************/

        elseif ($_GET['action'] == 'manage_comments') {
            manageComments();
            }
        
        /* ************** 16 . AFFICHER LA RUBRIQUE MEMBRES ****************************/

        elseif ($_GET['action'] == 'manage_users') {
            manageUsers();
        }

        /* ************** 17 . AJOUTER UN ARTICLE **************************************/

        elseif ($_GET['action'] == 'addpost') {
          
                if (!empty($_POST['title']) && !empty($_POST['intro']) && !empty($_POST['content'])) {
                    addPost($_POST['title'], $_POST['intro'], $_SESSION['id'], $_POST['content']);
                }
                else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
        }

        /* *********** 18 . AFFICHER LA PAGE POUR MODIFIER UN ARTICLE *******************/
        elseif ($_GET['action'] == 'modifyPostPage') {
            /* alors j'exécute la fonction manageUsers qui se trouve dans le contrôleur backend */
              if (isset($_GET['id']) && $_GET['id'] > 0) {
                 /* alors j'exécute la fonction modifyPost qui se trouve dans le contrôleur backend ( avec en paramètre, le paramètre URL 'id') */ 
                modifyPostPage($_GET['id']);
                }
                /*  */
                else {
                throw new Exception('Aucun identifiant d\'article envoyé');
                }
            /* Si il n'y a pas de paramètre 'id', j'indique qu'aucun commentaire ne peut être affiché */
        }

        /* ************ 19 . MODIFIER UN ARTICLE *****************************************/

        
        elseif ($_GET['action'] == 'modifyPost') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['title']) && !empty($_POST['intro']) && !empty($_POST['content'])) { 
                    modifyPost($_GET['id'], $_POST['title'], $_POST['intro'], $_SESSION['id'], $_POST['content']);
                }
                else {
                throw new Exception('Tous les champs ne sont pas remplis');
                }
            }
            else {
                throw new Exception('Pas d\'identifiant d\'article envoyé');
            }
            /* Si il n'y a pas de paramètre 'id', j'indique qu'aucun commentaire ne peut être affiché */
        }

        /* ************ 20. EFFACER UN ARTICLE ******************************************/

        elseif ($_GET['action'] == 'deletePost') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                deletePost($_GET['id']);

            }
        }

        /* ************ 21 . EFFACER UN MEMBRE ******************************************/

        elseif ($_GET['action'] == 'deleteUser') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                deleteUser($_GET['id']);

            }
        }

        /* ************ 22 . AFFICHER LA PAGE POUR MODIFIER UN MEMBRE *******************/

        elseif ($_GET['action'] == 'modifyUserPage') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                modifyUserPage($_GET['id']);

            }
        }

        /* ************ 23 . MODIFIER UN MEMBRE *****************************************/

        elseif ($_GET['action'] == 'modifyUser') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                modifyUser($_GET['id']);

            }
        }

        /* ************ 24 . AFFICHER L'ENSEMBLE DES BLOG POSTS *************************/

        elseif ($_GET['action'] == 'adminViewPost') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                AdminViewPost();
            }
        }   
        
        /* ********* 29 . AFFICHER LA PAGE MODIFIER LE MOT DE PASSE **********************/
        
        elseif ($_GET['action'] == 'forgetPasswordPage') {
            forgetPasswordPage();
        }
        /* ***************** 30 . MODIFIER LE MOT DE PASSE *******************************/
        
        elseif ($_GET['action'] == 'forgetPassword') {
            if (isset($_POST['email'])) {
            forgetPassword($_POST['email']);
            }
            else {
                echo 'Veuillez renseigner votre email';
            }
        }
        
        /* ***************** 31 . Afficher la page du profil *******************************/
        elseif ($_GET['action'] == 'profilePage') {
            profilePage();
        }
    }

        /* *********** 32 . PAGE D'ACCUEIL ***********************************************/

    else {
        home();
    }
}

/* Si rien de tout cela ne fonctionne, je dois récupérer un message */
catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}