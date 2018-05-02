<?php

/* ************************* RESUME *************************************

1 . Récupérer tous les membres
2 . Récupérer un seul membre
3 . Modifier un membre
4 . Supprimer un membre
5 . Inscription
6 . Le pseudo est-il déjà pris ?
7 . L'email est-il déjà pris ?
8 . Connexion
9 . Déconnexion
************************************************************************/

/* Je crée un emplacement pour éviter les conflits avec d'autres développeurs */
namespace Philippe\Blog\Model;

/* Je fais appel à la classe parent */
require_once("model/Manager.php");

/* Je crée une classe Postmanager qui hérite de la classe Manager */
class UserManager extends Manager
{
/* **********************************************************************
*                  1 . RECUPERER TOUS LES MEMBRES                       *
************************************************************************/
	public function getUsers()
	{
		/* A revoir */
		$db = $this->dbConnect();

		/* Fonction query à revoir */
		$req = $db->query('SELECT * 
			FROM Users 
			ORDER BY pseudo ASC LIMIT 15');
		return $req;
	}

/* **********************************************************************
*                  2 . RECUPERER UN SEUL MEMBRE                         *
************************************************************************/
	public function getUser($userId){

		/* A revoir */
		$db = $this->dbConnect();

		/* Fonction prepare à revoir */
		$req = $db->prepare('SELECT id, first_name, last_name, pseudo, password, email, confirmation_token, DATE_FORMAT(registration_date, \'%d/%m/%Y à %Hh%imin%ss\') AS registration_date_fr, authorization, avatar, is_active
			FROM Users 
			WHERE id = ?
			');

		/* Fonction execute à revoir */
		$req->execute(array($userId));
		/* Fonction fetch à revoir */
		$post = $req->fetch();
		return $post;
	}
/* **********************************************************************
*                  2 . RECUPERER AUTORISATION                         *
************************************************************************/

	public function getAuthorization($pseudo){

		/* A revoir */
		$db = $this->dbConnect();

		/* Fonction prepare à revoir */
		$req = $db->prepare('SELECT id, first_name, last_name, pseudo, password, email, confirmation_token, DATE_FORMAT(registration_date, \'%d/%m/%Y à %Hh%imin%ss\') AS registration_date_fr, authorization, avatar, is_active
			FROM Users 
			WHERE pseudo = ?
			');

		/* Fonction execute à revoir */
		$req->execute(array($pseudo));
		/* Fonction fetch à revoir */
		$access = $req->fetch();
		return $access;
	}


/* **********************************************************************
*                       3 . MODIFIER UN MEMBRE                         	*
************************************************************************/
	public function modifyUserRequest($userId){

		/* A revoir */
		$db = $this->dbConnect();

		/* Fonction prepare à revoir */
		$post = $db->prepare('UPDATE Users SET title = ?, intro = ?, author = ?, content = ?, creation_date = NOW() WHERE id = ?');

		$affectedPost = $post->execute(array($title, $intro, $author, $content, $postId));
		
		return $affectedPost;

	}
	
/* **********************************************************************
*                       4 . SUPPRIMER UN MEMBRE                         *
************************************************************************/
	public function deleteUserRequest($userId){
        $db = $this->dbConnect();

		/* Fonction prepare à revoir */
		$post = $db->prepare('DELETE FROM Users WHERE id = ?');

		$affectedUser = $post->execute(array($userId));
		
		return $affectedUser;
    }

/* **********************************************************************
*                         5 . INSCRIPTION                         		*
************************************************************************/
	public function addUserRequest($pseudo, $email, $passe){

		/* A revoir */
		$db = $this->dbConnect();
		
		/* Fonction prepare à revoir */
		$post = $db->prepare('INSERT INTO Users(pseudo, email, password, confirmation_token) VALUES(?, ?, ?, ?)');

		$passe = password_hash($_POST['passe'], PASSWORD_BCRYPT);

		function str_random($length){
		   	$alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
		    return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length); 
		}

		    $token = str_random(100);

		$users = $post->execute(array($pseudo, $email, $passe, $token));
        
        $user_id = $db->lastInsertId();
        
        /* test mail local */
		//mail($_POST['email'], 'Confirmation de votre compte', "Afin de valider votre compte, merci de cliquer sur ce lien\n\nhttp://localhost:8888/Blog_Project5/index.php?action=confirmRegistration&id=$user_id&token=$token");
        
        /* test mail serveur */
        mail($_POST['email'], 'Confirmation de votre compte', "Afin de valider votre compte, merci de cliquer sur ce lien :\n\nhttp://www.projet5.philippetraon.com/index.php?action=confirmRegistration&id=$user_id&token=$token");
        
		
		return $users;

	}
    
/* **********************************************************************
*                5 . CONFIRMATION INSCRIPTION                           *
************************************************************************/
    
    /*public function confirmRegistrationRequest($userId) {
        
        $db = $this->dbConnect();
        
        $req = $db->prepare('SELECT * FROM Users WHERE id = ?'); 
        $req->execute([$userId]);
        $user = $req->fetch();
        
        return $user;
    }*/

/* **********************************************************************
*                5 . CONFIRMATION INSCRIPTION                           *
************************************************************************/

	public function setActiveRequest($userId) {
		$db = $this->dbConnect();

		$req = $db->prepare('UPDATE Users SET is_active = 1, confirmation_token = NULL, registration_date = NOW() WHERE id = ?');

		$activeUser = $req->execute(array($userId));

		return $activeUser;
	}

/* **********************************************************************
*                   6 . LE PSEUDO EST-IL DEJA PRIS ?                    *
************************************************************************/

    public function existPseudo($pseudo) {

    	$db = $this->dbConnect();

    	$req = $db->prepare('SELECT id FROM Users WHERE pseudo = ?');

    	$req->execute([$_POST['pseudo']]);

    	$user = $req->fetch();

    	return $user;

    }

/* **********************************************************************
*                    7 . L'EMAIL EST-IL DEJA PRIS ?                    	*
************************************************************************/

    public function existMail($email) {

    	$db = $this->dbConnect();

    	$req = $db->prepare('SELECT id FROM Users WHERE email = ?');

    	$req->execute([$_POST['email']]);

    	$usermail = $req->fetch();

    	return $usermail;

    }
/* **********************************************************************
*                        8 . CONNEXION                         			*
************************************************************************/
	public function loginRequest($pseudo, $passe){

		$db = $this->dbConnect();

		$req = $db->prepare('SELECT * FROM Users WHERE pseudo = :pseudo');

        $req->execute(array('pseudo' => $pseudo));

		$user = $req->fetch();
        
        return $user;

	}

/* **********************************************************************
*                         9 . DECONNEXION                         		*
************************************************************************/

    public function logoutRequest(){

    	// Suppression des variables de session et de la session
		session_start();
		unset($_SESSION['pseudo']);
		header('Location: index.php?action=blog');

    }
    
/* **********************************************************************
*                         9 . MAIL RESET PASSWORD                         		*
************************************************************************/

    public function forgetPasswordRequest($email) {
        
        $db = $this->dbConnect();
        
        $req = $db->prepare('SELECT * FROM Users where email = ? ');
        $req->execute([$_POST['email']]);
        $user = $req->fetch();
        return $user;
    }
    
    /* **********************************************************************
*                         9 . MAIL RESET PASSWORD                         		*
************************************************************************/

    public function rememberRequest($rememberToken) {
        
        $db = $this->dbConnect();
        
        function str_random($length){
		   	$alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
		    return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length); 
		}
        $rememberToken = str_random(100);
        $req = $db->prepare('UPDATE users SET remember_token = ? WHERE id = ?');
        $req->execute([$rememberToken, $user['id']]);
        setcookie('remember', $user['id'] . '==' . $rememberToken . sha1($user['id'] . 'cookieTraon'), time() + 60 * 60 * 24 * 7);
    }
    
}