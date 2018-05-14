<?php

/* ************************* RESUME *************************************

1 . RECUPERER TOUS LES MEMBRES.
2 . RECUPERER UN SEUL MEMBRE.
3 . RECUPERER AUTORISATION DU MEMBRE.
4 . SUPPRIMER UN MEMBRE.
5 . INSCRIPTION.
6 . CONFIRMATION INSCRIPTION.
7 . LE PSEUDO EST-IL DEJA PRIS ?
8 . L'EMAIL EST-IL DEJA PRIS ?
9 . CONNEXION.
10. DECONNEXION.
11. CHECK RESET TOKEN.
12. CHANGE PASSWORD.
13. MAIL RESET PASSWORD.
14. DONNER DROITS ADMIN.
15. RETIRER DROITS ADMIN.

*********************** FIN RESUME *************************************/

namespace Philippe\Blog\Model;

require_once("model/Manager.php");

class UserManager extends Manager
{
/* ************** 1 . RECUPERER TOUS LES MEMBRES ***********************/

	public function getUsers(){
		
		$dbProjet5 = $this->dbConnect();
		$req = $dbProjet5->query('SELECT * 
			FROM Users 
			ORDER BY pseudo');
		return $req;
	}

/* ************** 2 . RECUPERER UN SEUL MEMBRE *************************/

	public function getUser($userId){

		$dbProjet5 = $this->dbConnect();
		$req = $dbProjet5->prepare('SELECT id, first_name, last_name, pseudo, password, email, confirmation_token, DATE_FORMAT(registration_date, \'%d/%m/%Y à %Hh%imin\') AS registration_date_fr, authorization, is_active
			FROM Users 
			WHERE id = ?');
		$req->execute(array($userId));
		$post = $req->fetch();
		return $post;
	}

/* ************** 3 . RECUPERER AUTORISATION DU MEMBRE *****************/

	public function getAuthorization($pseudo){

		$dbProjet5 = $this->dbConnect();
		$req = $dbProjet5->prepare('SELECT id, first_name, last_name, pseudo, password, email, confirmation_token, DATE_FORMAT(registration_date, \'%d/%m/%Y à %Hh%imin\') AS registration_date_fr, authorization, is_active
			FROM Users 
			WHERE pseudo = ?
			');
		$req->execute(array($pseudo));
		$access = $req->fetch();
		return $access;
	}
	
/* ************** 4 . SUPPRIMER UN MEMBRE ******************************/

	public function deleteUserRequest($userId){

        $dbProjet5 = $this->dbConnect();
		$post = $dbProjet5->prepare('DELETE FROM Users WHERE id = ?');
		$affectedUser = $post->execute(array($userId));
		return $affectedUser;
    }

/* ************** 5 . INSCRIPTION **************************************/

	public function addUserRequest($pseudo, $email, $passe){

		$dbProjet5 = $this->dbConnect();
		$post = $dbProjet5->prepare('INSERT INTO Users(pseudo, email, password, confirmation_token) VALUES(?, ?, ?, ?)');
		$passe = password_hash($passe, PASSWORD_BCRYPT);
		function str_random($length){
		   	$alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
		    return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length); 
		}
		$token = str_random(100);
		$users = $post->execute(array($pseudo, $email, $passe, $token));
        $user_id = $dbProjet5->lastInsertId();
        /* test mail local */
		//mail($email, 'Confirmation de votre compte', "Afin de valider votre compte, merci de cliquer sur ce lien\n\nhttp://localhost:8888/Blog_Project5/index.php?action=confirmRegistration&id=$user_id&token=$token");
		mail($email, 'Confirmation de votre compte', "Afin de valider votre compte, merci de cliquer sur ce lien\n\nhttp://www.projet5.philippetraon.com/index.php?action=confirmRegistration&id=$user_id&token=$token");
	}
    
/* ************** 6 . CONFIRMATION INSCRIPTION *************************/

	public function setActiveRequest($userId) {

		$dbProjet5 = $this->dbConnect();
		$req = $dbProjet5->prepare('UPDATE Users SET is_active = 1, confirmation_token = NULL, registration_date = NOW() WHERE id = ?');
		$activeUser = $req->execute(array($userId));
		return $activeUser;
	}

/* ************** 7 . LE PSEUDO EST-IL DEJA PRIS ? *********************/

    public function existPseudo($pseudo){

    	$dbProjet5 = $this->dbConnect();
		$req = $dbProjet5->prepare('SELECT id FROM Users WHERE pseudo = ?');
		$req->execute([$pseudo]);
		$user = $req->fetch();
		return $user;
    }

/* ************** 8 . L'EMAIL EST-IL DEJA PRIS ? ***********************/

	public function existMail($email){

    	$dbProjet5 = $this->dbConnect();
		$req = $dbProjet5->prepare('SELECT id FROM Users WHERE email = ?');
		$req->execute([$email]);
		$usermail = $req->fetch();
		return $usermail;
    }

/* ************** 9. CONNEXION ****************************************/

	public function loginRequest($pseudo, $passe){

		$dbProjet5 = $this->dbConnect();
		$req = $dbProjet5->prepare('SELECT * FROM Users WHERE pseudo = :pseudo');
		$req->execute(array('pseudo' => $pseudo));
		$user = $req->fetch();
        return $user;
    }

/* ************** 10. DECONNEXION **************************************/

    public function logoutRequest(){

		session_destroy();
		unset($_SESSION['pseudo']);
		unset($_SESSION['id']);
        unset($_SESSION['prenom']);
        unset($_SESSION['nom']);
        unset($_SESSION['email']);
        unset($_SESSION['password']);
        unset($_SESSION['autorisation']);
        unset($_SESSION['avatar']);
        unset($_SESSION['registration']);
        unset($_SESSION['description']);
        unset($_SESSION['color']);
		header('Location: index.php?action=blog');
	}

/* ************** 11. CHECK RESET TOKEN ********************************/

    public function checkResetTokenRequest($userId){

    	$dbProjet5 = $this->dbConnect();
		$req = $dbProjet5->prepare('SELECT * FROM Users WHERE id = ? AND reset_token IS NOT NULL AND reset_token = ? AND reset_at > DATE_SUB(NOW(), INTERVAL 30 MINUTE)');
    	$req->execute([$userId, $_GET['token']]);
    	$user = $req->fetch();
    	return $user;
	}

/* ************** 12. CHANGE PASSWORD **********************************/

    public function changePasswordRequest($userId, $passe){

		$dbProjet5 = $this->dbConnect();
		$passe = password_hash($passe, PASSWORD_BCRYPT);
		$req = $dbProjet5->prepare('UPDATE Users SET password = ?, reset_token = NULL, reset_at = NULL WHERE id = ?');
		$changePassword = $req->execute(array($passe, $userId));
		return $changePassword;
	}
    
/* ************** 13. MAIL RESET PASSWORD ******************************/

    public function forgetPasswordRequest($email){
        
        $dbProjet5 = $this->dbConnect();
        $req = $dbProjet5->prepare('SELECT * FROM Users where email = ? AND registration_date IS NOT NULL');
        $req->execute([$email]);
        $user = $req->fetch();
        if($user) {
			function str_random($length){
		   	$alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
		    return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length); 
			}
			$reset_token = str_random(100);
		    $user_id = $user['id'];
		    $dbProjet5->prepare('UPDATE Users SET reset_token = ?, reset_at = NOW() WHERE id = ?')->execute([$reset_token, $user_id]);
			$subject = 'Changement de votre mot de passe';
        	$body = "Afin de changer votre mot de passe, merci de cliquer sur ce lien :\n\nhttp://www.projet5.philippetraon.com/index.php?action=changePasswordPage&id=$user_id&token=$reset_token";
        	mail($email, $subject , $body);
			/* test mail local */
			//mail($email, $subject, "Afin de valider votre compte, merci de cliquer sur ce lien\n\nhttp://localhost:8888/Blog_Project5/index.php?action=confirmRegistration&id=$user_id&token=$token");
        }
        else {
        	echo 'Aucun compte ne correspond à cette adresse';
        } 
        return $user;
    }

/* ************** 14. DONNER DROITS ADMIN ******************************/

	public function giveAdminRightsRequest($userId){

		$dbProjet5 = $this->dbConnect();
		$req = $dbProjet5->prepare('UPDATE Users SET authorization = 1 WHERE id = ?');
		$adminRights = $req->execute(array($userId));
		return $adminRights;
	}

/* ************** 15. RETIRER DROITS ADMIN *****************************/

	public function stopAdminRightsRequest($userId){

		$dbProjet5 = $this->dbConnect();
		$req = $dbProjet5->prepare('UPDATE Users SET authorization = 0 WHERE id = ?');
		$adminRights = $req->execute(array($userId));
		return $adminRights;
	}
}