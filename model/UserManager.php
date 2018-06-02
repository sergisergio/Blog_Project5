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
9 . VIEW PROFILE.
10. DELETE ACCOUNT.
11. FORGET PASSWORD.
12. CHANGE PASSWORD.
13. CHECK RESET TOKEN.
14. DELETE A USER.
15. GIVE RIGHT ADMINS.
16. CANCEL RIGHT ADMINS.
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
            'SELECT id, first_name, last_name, pseudo, password, email, confirmation_token, DATE_FORMAT(registration_date, \'%d/%m/%Y à %Hh%i\') AS registration_date_fr, authorization, is_active, avatar, description
			FROM Users 
			ORDER BY pseudo'
        );
        $users = [];
        while ($data = $req->fetch()) {
            $users[] = new UserEntity($data);
        }
        $req->closeCursor();
        return $users;
    }
    /* ******** 2 . GET ONLY ONE USER ******************/
    public function getUser($userId)
    {
        $dbProjet5 = $this->dbConnect();
        $req = $dbProjet5->prepare(
            'SELECT id, first_name, last_name, pseudo, password, email, confirmation_token, DATE_FORMAT(registration_date, \'%d/%m/%Y à %Hh%i\') AS registration_date_fr, authorization, is_active, avatar, description
			FROM Users 
			WHERE id = :id'
        );
        $req->bindParam(':id', $userId);
        $req->execute();
        $data = $req->fetch();
        $post = new UserEntity($data);
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
    /* ******** 9 . VIEW PROFILE ***********************/

    public function modifyProfileRequest($userId, $avatar, $first_name, $name, $email, $description) 
    {
        $dbProjet5 = $this->dbConnect();

        $req = $dbProjet5->prepare('UPDATE Users SET avatar = :avatar, first_name = :firstname, last_name = :lastname, email = :email, description = :description WHERE id = :id');
        $req->bindParam(':avatar', $avatar);
        $req->bindParam(':firstname', $first_name);
        $req->bindParam(':lastname', $name);
        $req->bindParam(':email', $email);
        $req->bindParam(':description', $description);
        $req->bindParam(':id', $userId);
        $modifiedProfile = $req->execute();
        return $modifiedProfile;
    }
    /* ******* 10 . DELETE ACCOUNT *********************/
    public function deleteAccountRequest($userId)
    {
        $dbProjet5 = $this->dbConnect();

        $post = $dbProjet5->prepare('DELETE FROM Users WHERE id = :id');
        $post->bindParam(':id', $userId);
        $deleteAccount = $post->execute();
        
        return $deleteAccount;
    }
    /* ******* 11. FORGET PASSWORD *********************/

    public function forgetPasswordRequest($email) 
    {
        
        $dbProjet5 = $this->dbConnect();
        
        $req = $dbProjet5->prepare('SELECT * FROM Users where email = :email AND registration_date IS NOT NULL');
         $req->bindParam(':email', $email);
        $req->execute();
        $user = $req->fetch();
        if($user) {

            function str_random($length)
            {
                $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
                return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length); 
            }

            $reset_token = str_random(100);
            $user_id = $user['id'];
            $dbProjet5->prepare('UPDATE Users SET reset_token = :token, reset_at = NOW() WHERE id = :id');
            $dbProjet5->bindParam(':token', $reset_token);
            $dbProjet5->bindParam(':id', $user_id);
            $dbProjet5->execute();

            $subject = 'Changement de votre mot de passe';
            $body = "Afin de changer votre mot de passe, merci de cliquer sur ce lien :\n\nhttp://www.projet5.philippetraon.com/index.php?action=changePasswordPage&id=$user_id&token=$reset_token";
            mail($email, $subject, $body);

            /* test mail local */
            //mail($email, $subject, "Afin de valider votre compte, merci de cliquer sur ce lien\n\nhttp://localhost:8888/Blog_Project5/index.php?action=confirmRegistration&id=$user_id&token=$token");
        }
        else {
            echo 'Aucun compte ne correspond à cette adresse';
        } 
        return $user;
    }
    /* ******* 12. CHANGE PASSWORD *********************/
    public function changePasswordRequest($userId, $passe) 
    {
        $dbProjet5 = $this->dbConnect();
        
        $passe = password_hash($passe, PASSWORD_BCRYPT);
        $req = $dbProjet5->prepare('UPDATE Users SET password = :password, reset_token = NULL, reset_at = NULL WHERE id = :id');
        $req->bindParam(':password', $passe);
        $req->bindParam(':id', $userId);
        $changePassword = $req->execute();
        return $changePassword;
    }
    /* ******* 13. CHECK RESET TOKEN *******************/
    public function checkResetTokenRequest($userId, $token)
    {

        $dbProjet5 = $this->dbConnect();

        $req = $dbProjet5->prepare('SELECT * FROM Users WHERE id = :id AND reset_token IS NOT NULL AND reset_token = :token AND reset_at > DATE_SUB(NOW(), INTERVAL 30 MINUTE)');
        $req->bindParam(':id', $userId);
        $req->bindParam(':token', $token);
        $req->execute();
        $user = $req->fetch();
        return $user;
    }
    /* ******* 14. DELETE A USER ***********************/
    public function deleteUserRequest($userId)
    {
        $dbProjet5 = $this->dbConnect();

        $post = $dbProjet5->prepare('DELETE FROM Users WHERE id = :id');
        $post->bindParam(':id', $userId);

        $affectedUser = $post->execute();
        return $affectedUser;
    }
    /* ******* 15. GIVE RIGHT ADMINS *******************/
    public function giveAdminRightsRequest($userId) 
    {
        $dbProjet5 = $this->dbConnect();

        $req = $dbProjet5->prepare('UPDATE Users SET authorization = 1 WHERE id = :id');
        $req->bindParam(':id', $userId);
        $adminRights = $req->execute();
        return $adminRights;
    }
    /* ******* 16. CANCEL RIGHT ADMINS *****************/
    public function stopAdminRightsRequest($userId) 
    {
        $dbProjet5 = $this->dbConnect();

        $req = $dbProjet5->prepare('UPDATE Users SET authorization = 0 WHERE id = :id');
        $req->bindParam(':id', $userId);
        $adminRights = $req->execute();
        return $adminRights;
    }
}