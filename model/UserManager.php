<?php
/* ****************** SUM UP *********************
1 . GET ALL USERS.
2 . GET ONLY ONE USER.
3 . GET LEVEL AUTHORIZATION.
4 . REGISTRATION.
5 . CONFIRM REGISTRATION.
6 . PSEUDO ALREADY USED ?
7 . EMAIL ALREADY USED ?
8 . CONNECTION.
********************* END SUM UP *****************/
namespace Philippe\Blog\Model;
require_once "model/Manager.php";
use \Philippe\Blog\Model\Entities\UserEntity;
class UserManager extends Manager
{
/* ******** 1 . GET ALL USERS **********************/
    public function getUsers()
    {
        $dbProjet5 = $this->dbConnect();
        $req = $dbProjet5->query(
            'SELECT * 
			FROM Users 
			ORDER BY pseudo'
        );
        return $req;
    }
/* ******** 2 . GET ONLY ONE USER ******************/
    public function getUser($userId)
    {
        $dbProjet5 = $this->dbConnect();
        $req = $dbProjet5->prepare(
            'SELECT id, first_name, last_name, pseudo, password, email, confirmation_token, DATE_FORMAT(registration_date, \'%d/%m/%Y à %Hh%imin\') AS registration_date_fr, authorization, is_active
			FROM Users 
			WHERE id = :id'
        );
        $req->bindParam(':id', $postId);
        $req->execute();
        $post = $req->fetch();
        return $post;
    }
/* ******** 3 . GET LEVEL AUTHORIZATION ************/
    public function getAuthorization($pseudo)
    {
        $dbProjet5 = $this->dbConnect();
        $req = $dbProjet5->prepare(
            'SELECT authorization
			FROM Users 
			WHERE pseudo = :pseudo
			'
        );
        $req->bindParam(':id', $pseudo);
        $req->execute();
        $access = $req->fetch();
        return $access;
    }
/* ******** 4 . REGISTRATION ***********************/
    public function addUserRequest($pseudo, $email, $passe)
    {
        $dbProjet5 = $this->dbConnect();
        $post = $dbProjet5->prepare('INSERT INTO Users(pseudo, email, password, confirmation_token) VALUES(:pseudo, :email, :password, :confirmationtoken)');
        $passe = password_hash($passe, PASSWORD_BCRYPT);
        function str_random($length)
        {
            $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
            return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length); 
        }
        $token = str_random(100);

        $post->bindParam(':pseudo', $pseudo);
        $post->bindParam(':email', $email);
        $post->bindParam(':password', $passe);
        $post->bindParam(':confirmationtoken', $token);
        $users = $post->execute();
        $user_id = $dbProjet5->lastInsertId();
        mail($email, 'Confirmation de votre compte', "Afin de valider votre compte, merci de cliquer sur ce lien\n\nhttp://www.projet5.philippetraon.com/index.php?action=confirmRegistration&id=$user_id&token=$token");
    }
/* ******** 5 . CONFIRM REGISTRATION ***************/
    public function setActiveRequest($userId) 
    {
        $dbProjet5 = $this->dbConnect();
        $req = $dbProjet5->prepare('UPDATE Users SET is_active = 1, confirmation_token = NULL, registration_date = NOW() WHERE id = :id');
        $req->bindParam(':id', $userId);
        $activeUser = $req->execute();
        return $activeUser;
    }
/* ******** 6 . PSEUDO ALREADY USED ? **************/
    public function existPseudo($pseudo)
    {
        $dbProjet5 = $this->dbConnect();
        $req = $dbProjet5->prepare('SELECT id FROM Users WHERE pseudo = :pseudo');
        $req->bindParam(':pseudo', $pseudo);
        $req->execute();
        $user = $req->fetch();
        return $user;
    }
/* ******** 7 . EMAIL ALREADY USED ? ***************/
    public function existMail($email)
    {
        $dbProjet5 = $this->dbConnect();
        $req = $dbProjet5->prepare('SELECT id FROM Users WHERE email = :email');
        $req->bindParam(':email', $email);
        $req->execute();
        $usermail = $req->fetch();
        return $usermail;
    }
/* ******** 8 . CONNECTION *************************/
    public function loginRequest($pseudo, $passe)
    {
        $dbProjet5 = $this->dbConnect();
        $req = $dbProjet5->prepare('SELECT * FROM Users WHERE pseudo = :pseudo');
        $req->bindParam(':pseudo', $pseudo);
        $req->execute();
        $data = $req->fetch();
        $user = new UserEntity($data);
        return $user;
    }
}