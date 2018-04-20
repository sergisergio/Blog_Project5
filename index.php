<?php

/* ***************** RESUME *******************

    1 . Page listant l'ensemble des blog posts (blog). ========================> OK
        (==>listPosts()==>getPosts)
    2 . Page qui affiche un blog post (blogpost).  ============================> OK
        (==>listPost()==>getPost et getComments)
    3 . Ajouter un commentaire (addComment).  =================================> OK
        (==>addComment() ==> postComment)
    4 . Afficher la page pour modifier un commentaire (modifyCommentPage). ====> OK
        (modifyCommentPage() ==> getComment et getPost)
    5 . Supprimer un commentaire (deleteComment). =============================> OK
        (deleteComment() ==> getComment et deletedComment)
    6 . Modifier un commentaire (modifyComment).  =============================> OK
        (modifyComment() ==> getComment et modifyComment)
    7 . Afficher la page de connexion (loginPage).  ===========================> OK
        (loginPage() ==> juste un require)
    8 . Se connecter (login).  ==========================================> TO CHECK
        (login() ==> loginRequest)
    9 . Se déconnecter (logoff). ========================================> TO CHECK
    
    10 . Afficher la page d'inscription utilisateur (signupPage).  ============> OK
        (signupPage() ==> juste un require)
    11 . Traitement du formulaire d'inscription (addUser). ====================> OK
    
    12 . Confirmation inscription utilisateur (confirmRegistration).=====> TO CHECK
    
    13 . Afficher la page de connexion administrateur (loginAdmin). ===========> OK
    
    14 . Afficher la page d'accueil administrateur (index_management). ========> OK
    
    15 . Afficher la rubrique articles (manage_posts). ========================> OK
    
    16 . Afficher la rubrique commentaires (manage_comments). =================> OK
    
    17 . Afficher la rubrique membres (manage_users). =========================> OK
    
    18 . Ajouter un article (addPost). ========================================> OK
    
    19 . Afficher la page pour modifier un article (modifyPostPage).  =========> OK
        (modifyPostPage() ==> getComment et require ModifyPostView)
    20 . Modifier un article (modifyPost).  ===================================> OK
        (modifyPost() ==> getPost et ModifyPostRequest)
    21 . Supprimer un article (deletePost).  ==================================> OK
        (deletePost() ==> deletePost et deletePostRequest)
    22 . Supprimer un membre (deleteUser). ====================================> OK
    
    23 . Afficher la page pour modifier un membre (modifyUserPage). ===========> OK
    
    24 . Modifier un membre (modifyUser). ===============================> TO CHECK
    
    25 . Afficher un post et ses commentaires (adminViewPost). ================> OK
        (adminViewPost() ==> getPost et getComments, require MCview)
    26 . Ajouter un commentaire (admin AddComment).  ==========================> OK
        (adminAddComment() ==> postComment et redirection)
    27 . Afficher page de modif commentaire (adminModifyCommentPage). =========> OK
        (adminModify... ==> getPost et getComment, Location)
    28 . Modifier un commentaire (adminModifyComment).  =======================> OK
        (adminModifyComment() ==> getComment et modifyComment)
    29 . Supprimer un commentaire (adminDeleteComment). =======================> OK
        (adminDeleteComment() ==> getComment et adminDeleteRequest)
    30 . Page d'accueil par défaut. ===========================================> OK
    
    31 . Afficher la page mot de passe oublié

   *************** FIN RESUME *****************/

/* Je charge les fichiers controller pour que les fonctions soient en mémoire*/
require('controller/frontend.php');
require('controller/backend.php');

/* Puis je teste le paramètre action pour savoir quel contrôleur appeler.
Par défaut, si il n'ya pas d'action, j'exécute la fonction home() qui appelera la page d'accueil. */

try {
        /* Si il y a une action... */
    if (isset($_GET['action']))  {

    /* **********************************************************************
    *                              FRONT-END                                *
    ************************************************************************/

        /* ********** 1. PAGE LISTANT L'ENSEMBLE DES BLOG POSTS **********************/

    	if ($_GET['action'] == 'blog') {
            /* alors j'exécute la fonction listPosts qui se trouve dans le contrôleur frontend */ 
    		listPosts();
    	}

        /* ********** 2. PAGE AFFICHANT UN BLOG POST *********************************/

        elseif ($_GET['action'] == 'blogpost') {
            /* Si il y a un paramètre URL 'id' et que celui-ci est supérieur à 0 */
             if (isset($_GET['id']) && $_GET['id'] > 0) {
                /* alors j'exécute la fonction listPost qui se trouve dans le contrôleur frontend */ 
                listPost();
             }
                /* Sinon j'envoie un message d'erreur */
            else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }

        /* ********** 3 . AJOUTER UN COMMENTAIRE *************************************/

        elseif ($_GET['action'] == 'addcomment') {
            /* Si il y a un paramètre URL 'id' et que celui-ci est supérieur à 0 */
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                /* Si les champs pseudo et commentaire sont bien remplis */
                if (!empty($_POST['member_pseudo']) && !empty($_POST['content'])) {
                    /* alors j'exécute la fonction addComment qui se trouve dans le contrôleur frontend
                    ( avec en paramètre, le paramètre URL 'id', les paramètre de formulaire 'pseudo' et 'contenu') */ 
                    addComment($_GET['id'], $_POST['member_pseudo'], $_POST['content']);
                }
                /* Si les champs pseudo et commentaire ne sont pas remplis, je l'indique à l'utilisateur */
                else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }
            /* Si il n'y a pas de paramètre 'id', j'indique qu'aucun article ne peut être affiché */
            else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }

        /* ********** 4 . AFFICHER LA PAGE POUR MODIFIER UN COMMENTAIRE *************/

        elseif ($_GET['action'] == 'modifyCommentPage') {
            /* Si il y a un paramètre URL 'id' et que celui-ci est supérieur à 0 */
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                /* alors j'exécute la fonction modifyCommentPage qui se trouve dans le contrôleur frontend ( avec en paramètre, le paramètre URL 'id') */ 
                modifyCommentPage($_GET['id']);
            }
            /* Si il n'y a pas de paramètre 'id', j'indique qu'aucun commentaire ne peut être affiché */
            else {
                throw new Exception('Aucun identifiant de commentaire envoyé');
            }
        }

        /* ********** 5 . AFFICHER LA PAGE POUR EFFACER UN COMMENTAIRE **************/

        elseif ($_GET['action'] == 'deleteComment') {
            /* Si il y a un paramètre URL 'id' et que celui-ci est supérieur à 0 */
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                /* alors j'exécute la fonction modifyCommentPage qui se trouve dans le contrôleur frontend ( avec en paramètre, le paramètre URL 'id') */ 
                deletedComment($_GET['id']);
            }
            
        }

        /* ********** 6 . MODIFIER UN COMMENTAIRE **********************************/

        elseif ($_GET['action'] == 'modifyComment') {
            /* Si il y a un paramètre URL 'id' et que celui-ci est supérieur à 0 */
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                /* Si les champs pseudo et commentaire ont bien été remplis */
                if (!empty($_POST['member_pseudo']) && !empty($_POST['content'])) {
                    /* alors j'exécute la fonction modifyComment qui se trouve dans le contrôleur frontend ( avec en paramètre, le paramètre URL 'id', les paramètre de formulaire 'pseudo' et 'contenu') */ 
                    modifyComment($_GET['id'], $_POST['member_pseudo'], $_POST['content']);
                }
                /* Si les champs pseudo et commentaire ne sont pas remplis, je l'indique à l'utilisateur */
                else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            /* Si il n'y a pas de paramètre 'id', j'indique qu'aucun commentaire ne peut être affiché */
            }
            else {
                throw new Exception('Aucun identifiant de commentaire envoyé');
            }
        }

        /* *********** 7 . PAGE CONNEXION UTILISATEUR *******************************/

    	elseif ($_GET['action'] == 'loginPage') {
             /* alors j'exécute la fonction connexion qui se trouve dans le contrôleur frontend */
    		loginPage();
        }

        /* *********** 8 . CONNEXION UTILISATEUR ************************************/

        elseif ($_GET['action'] == 'login') {
             /* alors j'exécute la fonction connexion qui se trouve dans le contrôleur frontend */

            login($_POST['pseudo'], $_POST['passe']);
        }

        /* *********** 9 . DECONNEXION UTILISATEUR *********************************/

        elseif ($_GET['action'] == 'logoff') {
             /* alors j'exécute la fonction connexion qui se trouve dans le contrôleur frontend */

            logoff();
        }
        
        /* *********** 10 . PAGE INSCRIPTION UTILISATEUR ****************************/

        elseif ($_GET['action'] == 'signupPage') {
             /* alors j'exécute la fonction registration qui se trouve dans le contrôleur frontend */
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
                 function debug($variable){
                    echo '<pre>' . print_r($variable, true) .'</pre>';
                } 
                
                // valider le pseudo
                if(empty($_POST['pseudo']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['pseudo'])) {
                    $errors['pseudo'] = "Votre pseudo n'est pas valide (caractères alphanumériques et underscore permis...";
                    echo '<div class="alert alert-danger">' . $errors['pseudo'] . '</div>';
                }
                if (checkExistPseudo($pseudo)) {
                    
                    $errors['pseudo'] = 'Ce pseudo est déjà pris';
                    echo '<div class="alert alert-danger">' . $errors['pseudo'] . '</div>';
                     
                }
                
                // Vérifier le format de l'e-mail
                // constante FILTER (retourne true ou false)
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
                
                 // debug($errors); 
            }
        }

        /* ************** 12 . CONFIRMATION INSCRIPTION UTILISATEUR ******************/

        elseif ($_GET['action'] == 'confirmRegistration') {
             /* alors j'exécute la fonction registration qui se trouve dans le contrôleur frontend */
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


        /* ************** 13 . CONNEXION ADMINISTRATEUR *********************************/

        elseif ($_GET['action'] == 'loginAdmin') {
             /* alors j'exécute la fonction connexionAdmin qui se trouve dans le contrôleur backend */
            loginAdmin();
        }

        /* ************** 14 . AFFICHER LA PAGE D'ACCUEIL ADMINISTRATEUR ****************/

        elseif ($_GET['action'] == 'index_management') {
             /* alors j'exécute la fonction indexManagement qui se trouve dans le contrôleur backend */
            indexManagement();
        }

        /* ************** 15 . AFFICHER LA RUBRIQUE ARTICLES ***************************/

        elseif ($_GET['action'] == 'manage_posts') {
            /* alors j'exécute la fonction managePosts qui se trouve dans le contrôleur backend */
            managePosts();
        }

        /* ************** 16 . AFFICHER LA RUBRIQUE COMMENTAIRES ***********************/

        elseif ($_GET['action'] == 'manage_comments') {
            /* alors j'exécute la fonction manageComments qui se trouve dans le contrôleur backend */
            manageComments();
            }
        
        /* ************** 17 . AFFICHER LA RUBRIQUE MEMBRES ****************************/

        elseif ($_GET['action'] == 'manage_users') {
            /* alors j'exécute la fonction manageUsers qui se trouve dans le contrôleur backend */
            manageUsers();
        }

        /* ************** 18 . AJOUTER UN ARTICLE **************************************/

        elseif ($_GET['action'] == 'addpost') {
          
                if (!empty($_POST['title']) && !empty($_POST['intro']) && !empty($_POST['member_pseudo']) && !empty($_POST['content'])) {
                    /* alors j'exécute la fonction addComment qui se trouve dans le contrôleur frontend ( avec en paramètre, le paramètre URL 'id', les paramètre de formulaire 'pseudo' et 'contenu') */ 
                    addPost($_POST['title'], $_POST['intro'], $_POST['member_pseudo'], $_POST['content']);
                }
                /* Si les champs pseudo et commentaire ne sont pas remplis, je l'indique à l'utilisateur */
                else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
        }

        /* *********** 19 . AFFICHER LA PAGE POUR MODIFIER UN ARTICLE *******************/
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

        /* ************ 20 . MODIFIER UN ARTICLE *****************************************/

        
        elseif ($_GET['action'] == 'modifyPost') {
            /* Si il y a un paramètre URL 'id' et que celui-ci est supérieur à 0 */
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['title']) && !empty($_POST['intro']) && !empty($_POST['member_pseudo']) && !empty($_POST['content'])) {
                    /* alors j'exécute la fonction modifiedPost qui se trouve dans le contrôleur backend ( avec en paramètre, le paramètre URL 'id', les paramètre de formulaire 'pseudo' et 'contenu') */ 
                    modifyPost($_GET['id'], $_POST['title'], $_POST['intro'], $_POST['member_pseudo'], $_POST['content']);
                }
                /*  */
                else {
                throw new Exception('Tous les champs ne sont pas remplis');
                }
            }
            else {
                throw new Exception('Pas d\'identifiant d\'article envoyé');
            }
            /* Si il n'y a pas de paramètre 'id', j'indique qu'aucun commentaire ne peut être affiché */
        }

        /* ************ 21. EFFACER UN ARTICLE ******************************************/

        elseif ($_GET['action'] == 'deletePost') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                deletePost($_GET['id']);

            }
        }

        /* ************ 22 . EFFACER UN MEMBRE ******************************************/

        elseif ($_GET['action'] == 'deleteUser') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                deleteUser($_GET['id']);

            }
        }

        /* ************ 23 . AFFICHER LA PAGE POUR MODIFIER UN MEMBRE *******************/

        elseif ($_GET['action'] == 'modifyUserPage') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                modifyUserPage($_GET['id']);

            }
        }

        /* ************ 24 . MODIFIER UN MEMBRE *****************************************/

        elseif ($_GET['action'] == 'modifyUser') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                modifyUser($_GET['id']);

            }
        }

        /* ************ 25 . AFFICHER L'ENSEMBLE DES BLOG POSTS *************************/

        elseif ($_GET['action'] == 'adminViewPost') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                AdminViewPost();
            }
        }

        /* ************ AJOUTER UN COMMENTAIRE *************************************/

        elseif ($_GET['action'] == 'adminAddComment') {
            /* Si il y a un paramètre URL 'id' et que celui-ci est supérieur à 0 */
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                /* Si les champs pseudo et commentaire sont bien remplis */
                if (!empty($_POST['member_pseudo']) && !empty($_POST['content'])) {
                    /* alors j'exécute la fonction addAddComment qui se trouve dans le contrôleur backend ( avec en paramètre, le paramètre URL 'id', les paramètre de formulaire 'pseudo' et 'contenu') */ 
                    adminAddComment($_GET['id'], $_POST['member_pseudo'], $_POST['content']);
                }
                /* Si les champs pseudo et commentaire ne sont pas remplis, je l'indique à l'utilisateur */
                else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }
            /* Si il n'y a pas de paramètre 'id', j'indique qu'aucun article ne peut être affiché */
            else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }

        /* ******** 27 . AFFICHER LA PAGE POUR MODIFIER UN COMMENTAIRE ******************/

        elseif ($_GET['action'] == 'adminModifyCommentPage') {
            /* Si il y a un paramètre URL 'id' et que celui-ci est supérieur à 0 */
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                /* alors j'exécute la fonction modifyCommentPage qui se trouve dans le contrôleur frontend ( avec en paramètre, le paramètre URL 'id') */ 
                adminModifyCommentPage($_GET['id']);
            }
            /* Si il n'y a pas de paramètre 'id', j'indique qu'aucun commentaire ne peut être affiché */
            else {
                throw new Exception('Aucun identifiant de commentaire envoyé');
            }
        }

        /* ********* 28 . MODIFIER UN COMMENTAIRE ****************************************/

        elseif ($_GET['action'] == 'adminModifyComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                /* Si les champs pseudo et commentaire ont bien été remplis */
                if (!empty($_POST['member_pseudo']) && !empty($_POST['content'])) {
                    /* alors j'exécute la fonction modifyComment qui se trouve dans le contrôleur frontend ( avec en paramètre, le paramètre URL 'id', les paramètre de formulaire 'pseudo' et 'contenu') */ 
                    adminModifyComment($_GET['id'], $_POST['member_pseudo'], $_POST['content']);
                }
                   
                /* Si les champs pseudo et commentaire ne sont pas remplis, je l'indique à l'utilisateur */
                else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }
                     /* Sinon j'envoie un message d'erreur */
            else {
                throw new Exception('Aucun identifiant de commentaire envoyé');
            }
            
        }

        /* ********* 29 . SUPPRIMER UN COMMENTAIRE ***************************************/

        elseif ($_GET['action'] == 'adminDeleteComment') {
                    /* Si il y a un paramètre URL 'id' et que celui-ci est supérieur à 0 */
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                /* alors j'exécute la fonction modifyCommentPage qui se trouve dans le contrôleur frontend ( avec en paramètre, le paramètre URL 'id') */ 
                adminDeleteComment($_GET['id']);
            }
        }    
        
        /* ********* 30 . AFFICHER LA PAGE MODIFIER LE MOT DE PASSE **********************/
        
        elseif ($_GET['action'] == 'forgetPassword') {
            forgetPassword();
        }
    }

        /* *********** 30 . PAGE D'ACCUEIL ***********************************************/

    /* Sinon, par défaut, si il n'y a pas d'"action", alors j'exécute la fonction home qui affichera la page d'accueil */ 
    else {
    home();
    }
}

/* Si rien de tout cela ne fonctionne, je dois récupérer un message */
catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}