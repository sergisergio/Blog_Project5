<?php
require('controller/frontend.php');
require('controller/backend.php');

try {
    if (isset($_GET['action']))  {
    	if ($_GET['action'] == 'blog') {
    		listPosts();
    	}
        elseif ($_GET['action'] == 'blogpost') {
             if (isset($_GET['id']) && $_GET['id'] > 0) {
                listPost();

            }
            else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
    	elseif ($_GET['action'] == 'connexion') {
    		connexion();
        }
        elseif ($_GET['action'] == 'administration') {
            connexionAdmin();
        }
        elseif ($_GET['action'] == 'registration') {
    		registration();
        }
        elseif ($_GET['action'] == 'index_management') {
            indexManagement();
        }
        elseif ($_GET['action'] == 'manage_posts') {
            managePosts();
        }
        elseif ($_GET['action'] == 'manage_comments') {
            manageComments();
        }
        elseif ($_GET['action'] == 'manage_users') {
            manageUsers();
        }
        
    }
    else {
    home();

}

}
catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}