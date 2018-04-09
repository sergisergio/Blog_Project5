<?php

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


        /* **************************************** PAGE LISTANT L'ENSEMBLE DES BLOG POSTS ***************************************/

        /* ...et que cette action est égale à blog */
    	if ($_GET['action'] == 'blog') {
            /* alors j'exécute la fonction listPosts qui se trouve dans le contrôleur frontend */ 
    		listPosts();
    	}

        /* **************************************** PAGE AFFICHANT UN BLOG POST *************************************************/

        /* ...et que cette action est égale à blogpost */
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

        /* **************************************** AJOUTER UN COMMENTAIRE ******************************************************/

        /* ...et que cette action est égale à addcomment */
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

        /* ******************************** AFFICHER LA PAGE POUR MODIFIER UN COMMENTAIRE ***************************************/

        /* ...et que cette action est égale à modifyCommentpage */
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

        /* ******************************** AFFICHER LA PAGE POUR EFFACER UN COMMENTAIRE ***************************************/

        /* ...et que cette action est égale à modifyCommentpage */
        elseif ($_GET['action'] == 'deleteCommentPage') {
            /* Si il y a un paramètre URL 'id' et que celui-ci est supérieur à 0 */
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                /* alors j'exécute la fonction modifyCommentPage qui se trouve dans le contrôleur frontend ( avec en paramètre, le paramètre URL 'id') */ 
                deletedCommentPage($_GET['id']);
            }
            
        }

        /* ******************************************** MODIFIER UN COMMENTAIRE ************************************************/

        /* ...et que cette action est égale à modifyComment */
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

        /* ******************************************** PAGE CONNEXION UTILISATEUR ************************************************/

        /* ...et que cette action est égale à modifyComment */
    	elseif ($_GET['action'] == 'connexion') {
             /* alors j'exécute la fonction connexion qui se trouve dans le contrôleur frontend */
    		connexion();
        }

        /* ******************************************** CONNEXION UTILISATEUR ************************************************/

        /* ...et que cette action est égale à modifyComment */
        elseif ($_GET['action'] == 'connected') {
             /* alors j'exécute la fonction connexion qui se trouve dans le contrôleur frontend */

            connected($_POST['pseudo'], $_POST['passe']);
        }

        /* ******************************************** DECONNEXION UTILISATEUR ************************************************/

        /* ...et que cette action est égale à modifyComment */
        elseif ($_GET['action'] == 'disconnected') {
             /* alors j'exécute la fonction connexion qui se trouve dans le contrôleur frontend */

            disconnected();
        }
        
        /* ******************************************** PAGE INSCRIPTION UTILISATEUR ************************************************/

        /* ...et que cette action est égale à registration */
        elseif ($_GET['action'] == 'registration') {
             /* alors j'exécute la fonction registration qui se trouve dans le contrôleur frontend */
             registration();
        }
            
        

        /* ******************************************** FORMULAIRE INSCRIPTION REMPLI ************************************************/

        elseif ($_GET['action'] == 'addUser') {
             
             /*if (!empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['passe']) && !empty($_POST['passe2'])) {

                $pseudo = htmlspecialchars($_POST['pseudo']);
                $email = htmlspecialchars($_POST['email']);
                $passe = sha1($_POST['passe']);
                $passe2 = sha1($_POST['passe2']);

                $pseudolength = strlen($pseudo);
                if($pseudolength <= 255) {
                    if($passe == $passe2) {
                        addUser($pseudo, $email, $passe);
                    }
                    else {
                        throw new Exception ('Veuillez entrer des mots de passe identiques');
                    }
                }
                else {
                    throw new Exception('Votre pseudo ne doit pas dépasser 255 caractères');
                }
            }
            else {
                throw new Exception('Tous les champs ne sont pas remplis !');
            }*/
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
        

        /* ******************************************** INSCRIPTION UTILISATEUR ************************************************/

        /* ...et que cette action est égale à registration */
        elseif ($_GET['action'] == 'confirmRegistration') {
             /* alors j'exécute la fonction registration qui se trouve dans le contrôleur frontend */
             confirmRegistration();
        }


                                                            /* **********************************************************************
                                                            *                              BACK-END                                *
                                                            ************************************************************************/


        /* ******************************************** CONNEXION ADMINISTRATEUR ************************************************/

        /* ...et que cette action est égale à administration */
        elseif ($_GET['action'] == 'administration') {
             /* alors j'exécute la fonction connexionAdmin qui se trouve dans le contrôleur backend */
            connexionAdmin();
        }

        /* ********************************** AFFICHER LA PAGE D'ACCUEIL ADMINISTRATEUR *****************************************/

        /* ...et que cette action est égale à index_management */
        elseif ($_GET['action'] == 'index_management') {
             /* alors j'exécute la fonction indexManagement qui se trouve dans le contrôleur backend */
            indexManagement();
        }

        /* ********************************** AFFICHER LA RUBRIQUE ARTICLES *****************************************************/

        /* ...et que cette action est égale à manage_posts */
        elseif ($_GET['action'] == 'manage_posts') {
            /* alors j'exécute la fonction managePosts qui se trouve dans le contrôleur backend */
            managePosts();
        }

        /* ********************************** AFFICHER LA RUBRIQUE COMMENTAIRES *************************************************/

        /* ...et que cette action est égale à manage_comments */
        elseif ($_GET['action'] == 'manage_comments') {
            /* alors j'exécute la fonction manageComments qui se trouve dans le contrôleur backend */
            
            manageComments();
            }
        
        /* ********************************** AFFICHER LA RUBRIQUE MEMBRES ******************************************************/

        /* ...et que cette action est égale à manage_users */
        elseif ($_GET['action'] == 'manage_users') {
            /* alors j'exécute la fonction manageUsers qui se trouve dans le contrôleur backend */
            manageUsers();
        }

        /* ********************************** AJOUTER UN ARTICLE ****************************************************************/

        /* ...et que cette action est égale à manage_users */
        elseif ($_GET['action'] == 'addpost') {
          
                /* Si les champs pseudo et commentaire sont bien remplis */
                if (!empty($_POST['title']) && !empty($_POST['intro']) && !empty($_POST['member_pseudo']) && !empty($_POST['content'])) {
                    /* alors j'exécute la fonction addComment qui se trouve dans le contrôleur frontend ( avec en paramètre, le paramètre URL 'id', les paramètre de formulaire 'pseudo' et 'contenu') */ 

                    addedPost($_POST['title'], $_POST['intro'], $_POST['member_pseudo'], $_POST['content']);

                    
                }
                /* Si les champs pseudo et commentaire ne sont pas remplis, je l'indique à l'utilisateur */
                else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            
        }

        /* ********************************** AFFICHER LA PAGE POUR MODIFIER UN ARTICLE *******************************************/

        /* ...et que cette action est égale à modifyPost */
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

        /* ********************************** MODIFIER UN ARTICLE ****************************************************************/

        /* ...et que cette action est égale à modifyPost */
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

        /* ********************************** EFFACER UN ARTICLE ****************************************************************/

        elseif ($_GET['action'] == 'deletePost') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                deletedPost($_GET['id']);

            }
        }

        /* ********************************** EFFACER UN MEMBRE ****************************************************************/

        elseif ($_GET['action'] == 'deleteUser') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                deletedUser($_GET['id']);

            }
        }

        /* ********************************** AFFICHER LA PAGE POUR MODIFIER UN MEMBRE ******************************************/

        elseif ($_GET['action'] == 'modifyUser') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                modifyUser($_GET['id']);

            }
        }

        /* ********************************** MODIFIER UN MEMBRE ***************************************************************/

        elseif ($_GET['action'] == 'modifiedUser') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                modifiedUser($_GET['id']);

            }
        }

        /* ********************************** AFFICHER L'ENSEMBLE DES BLOG POSTS ***********************************************/

        elseif ($_GET['action'] == 'adminListPost') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                AdminListPost();
            }
        }

        

        /* ********************************** AJOUTER UN COMMENTAIRE **********************************************************/

        /* ...et que cette action est égale à addcomment */
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

        /* ********************************** AFFICHER LA PAGE POUR MODIFIER UN COMMENTAIRE ************************************/

        /* ...et que cette action est égale à modifyCommentpage */
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

        /* ********************************** MODIFIER UN COMMENTAIRE **********************************************************/

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

        /* ********************************** SUPPRIMER UN COMMENTAIRE **********************************************************/

        elseif ($_GET['action'] == 'adminDeleteCommentPage') {
                    /* Si il y a un paramètre URL 'id' et que celui-ci est supérieur à 0 */
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                /* alors j'exécute la fonction modifyCommentPage qui se trouve dans le contrôleur frontend ( avec en paramètre, le paramètre URL 'id') */ 
                adminDeletedCommentPage($_GET['id']);
            }
                }    
    }

        /* ********************************** PAGE D'ACCUEIL *********************************************************************/

    /* Sinon, par défaut, si il n'y a pas d'"action", alors j'exécute la fonction home qui affichera la page d'accueil */ 
    else {
    home();
    }
}


/* Si rien de tout cela ne fonctionne, je dois récupérer un message */
catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}