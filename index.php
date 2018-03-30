<?php

/* Je charge les fichiers controller pour que les fonctions soient en mémoire*/
require('controller/frontend.php');
require('controller/backend.php');

/* Puis je teste le paramètre action pour savoir quel contrôleur appeler. Par défaut, si il n'ya pas d'action, j'exécute la fonction home() qui appelera la page d'accueil. */

try {
        /* Si il y a une action... */
    if (isset($_GET['action']))  {
        /* ...et que cette action est égale à blog */
    	if ($_GET['action'] == 'blog') {
            /* alors j'exécute la fonction listPosts qui se trouve dans le contrôleur frontend */ 
    		listPosts();
    	}


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


        /* ...et que cette action est égale à addcomment */
        elseif ($_GET['action'] == 'addcomment') {
            /* Si il y a un paramètre URL 'id' et que celui-ci est supérieur à 0 */
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                /* Si les champs pseudo et commentaire sont bien remplis */
                if (!empty($_POST['member_pseudo']) && !empty($_POST['content'])) {
                    /* alors j'exécute la fonction addComment qui se trouve dans le contrôleur frontend ( avec en paramètre, le paramètre URL 'id', les paramètre de formulaire 'pseudo' et 'contenu') */ 
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

        /* ...et que cette action est égale à modifyComment */
    	elseif ($_GET['action'] == 'connexion') {
             /* alors j'exécute la fonction connexion qui se trouve dans le contrôleur frontend */
    		connexion();
        }

        /* ...et que cette action est égale à administration */
        elseif ($_GET['action'] == 'administration') {
             /* alors j'exécute la fonction connexionAdmin qui se trouve dans le contrôleur backend */
            connexionAdmin();
        }

        /* ...et que cette action est égale à registration */
        elseif ($_GET['action'] == 'registration') {
             /* alors j'exécute la fonction registration qui se trouve dans le contrôleur frontend */
    		registration();
        }

        /* ...et que cette action est égale à index_management */
        elseif ($_GET['action'] == 'index_management') {
             /* alors j'exécute la fonction indexManagement qui se trouve dans le contrôleur backend */
            indexManagement();
        }

        /* ...et que cette action est égale à manage_posts */
        elseif ($_GET['action'] == 'manage_posts') {
            /* alors j'exécute la fonction managePosts qui se trouve dans le contrôleur backend */
            managePosts();
        }

        /* ...et que cette action est égale à manage_comments */
        elseif ($_GET['action'] == 'manage_comments') {
            /* alors j'exécute la fonction manageComments qui se trouve dans le contrôleur backend */
            manageComments();
        }

        /* ...et que cette action est égale à manage_users */
        elseif ($_GET['action'] == 'manage_users') {
            /* alors j'exécute la fonction manageUsers qui se trouve dans le contrôleur backend */
            manageUsers();
        }

     
    }
    /* Sinon, par défaut, si il n'y a pas d'"action", alors j'exécute la fonction home qui affichera la page d'accueil */ 
    else {
    home();

}

}
/* Si rien de tout cela ne fonctionne, je dois récupérer un message */
catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}