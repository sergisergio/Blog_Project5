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
        elseif ($_GET['action'] == 'registration') {
    		registration();
        }
        elseif ($_GET['action'] == 'administration') {
    		administration();
        }
    }
    else {
    home();

}

}
catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}