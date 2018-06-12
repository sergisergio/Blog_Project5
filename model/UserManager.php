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

/*require_once "model/Entities/commentEntity.php";
require_once "model/Entities/postEntity.php";
require_once "model/Entities/userEntity.php";*/

use \Philippe\Blog\Model\Entities\UserEntity;
class UserManager extends Manager
{
    /* ******** 1 . GET ALL USERS **********************/
    public function getUsers()
    {
        $dbProjet5 = $this->dbConnect();
        $getUsers = $dbProjet5->query(
            'SELECT id, first_name, last_name, pseudo, password, email, confirmation_token, DATE_FORMAT(registration_date, \'%d/%m/%Y à %Hh%i\') AS registration_date_fr, authorization, is_active, avatar, description, reset_token, reset_at
			FROM Users 
			ORDER BY pseudo'
        );
        $users = [];
        while ($data = $getUsers->fetch()) {
            $users[] = new UserEntity($data);
        }
        $getUsers->closeCursor();
        return $users;
    }
    /* ******** 2 . GET ONLY ONE USER ******************/
    public function getUser($userId)
    {
        $dbProjet5 = $this->dbConnect();
        $getUser = $dbProjet5->prepare(
            'SELECT id, first_name, last_name, pseudo, password, email, confirmation_token, DATE_FORMAT(registration_date, \'%d/%m/%Y à %Hh%i\') AS registration_date_fr, authorization, is_active, avatar, description, reset_token, reset_at
			FROM Users 
			WHERE id = :id'
        );
        $getUser->bindParam(':id', $userId);
        $getUser->execute();
        $data = $getUser->fetch();
        $post = new UserEntity($data);
        return $post;
    }
    /* ******** 3 . GET LEVEL AUTHORIZATION ************/
    public function getAuthorization($pseudo)
    {
        $dbProjet5 = $this->dbConnect();
        $getAuthorization = $dbProjet5->prepare(
            'SELECT authorization
			FROM Users 
			WHERE pseudo = :pseudo
			'
        );
        $getAuthorization->bindParam(':id', $pseudo);
        $getAuthorization->execute();
        $data = $getAuthorization->fetch();
        $access = new UserEntity($data);
        return $access;
    }
    /* ******** 4 . REGISTRATION ***********************/
    public function addUserRequest($pseudo, $email, $passe)
    {
        $dbProjet5 = $this->dbConnect();
        $addUser = $dbProjet5->prepare('INSERT INTO Users(pseudo, email, password, confirmation_token) VALUES(:pseudo, :email, :password, :confirmationtoken)');
        $passe = password_hash($passe, PASSWORD_BCRYPT);
        function str_random($length)
        {
            $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
            return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length); 
        }
        $token = str_random(100);

        $addUser->bindParam(':pseudo', $pseudo);
        $addUser->bindParam(':email', $email);
        $addUser->bindParam(':password', $passe);
        $addUser->bindParam(':confirmationtoken', $token);
        $addUser->execute();
        $data = $addUser->fetch();
        $user_id = $dbProjet5->lastInsertId();

        $to      = $email;
        $subject = 'Confirmation de votre compte';
        $message = "Afin de valider votre compte, merci de cliquer sur ce lien\n\nhttp://www.projet5.philippetraon.com/index.php?action=confirmRegistration&id=$user_id&token=$token";
        $headers = 'From: contact@philippetraon.com' . "\r\n" .
        'Reply-To: contact@philippetraon.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

        mail($to, $subject, $message, $headers);
        //mail($email, 'Confirmation de votre compte', "Afin de valider votre compte, merci de cliquer sur ce lien\n\nhttp://www.projet5.philippetraon.com/index.php?action=confirmRegistration&id=$user_id&token=$token");*/

        $users = new UserEntity($data);
        return $users;
    }
    /* ******** 5 . CONFIRM REGISTRATION ***************/
    public function setActiveRequest($userId) 
    {
        $dbProjet5 = $this->dbConnect();
        $setActive = $dbProjet5->prepare('UPDATE Users SET is_active = 1, confirmation_token = NULL, registration_date = NOW() WHERE id = :id');
        $setActive->bindParam(':id', $userId);
        $activeUser = $setActive->execute();
        return $activeUser;
    }
    /* ******** 6 . PSEUDO ALREADY USED ? **************/
    public function existPseudo($pseudo)
    {
        $dbProjet5 = $this->dbConnect();
        $existPseudo = $dbProjet5->prepare('SELECT id FROM Users WHERE pseudo = :pseudo');
        $existPseudo->bindParam(':pseudo', $pseudo);
        $existPseudo->execute();
        $user = $existPseudo->fetch();
        return $user;
    }
    /* ******** 7 . EMAIL ALREADY USED ? ***************/
    public function existMail($email)
    {
        $dbProjet5 = $this->dbConnect();
        $existMail = $dbProjet5->prepare('SELECT id FROM Users WHERE email = :email');
        $existMail->bindParam(':email', $email);
        $existMail->execute();
        $usermail = $existMail->fetch();
        return $usermail;
    }
    /* ******** 8 . CONNECTION *************************/
    public function loginRequest($pseudo, $passe)
    {
        $dbProjet5 = $this->dbConnect();
        $login = $dbProjet5->prepare('SELECT * FROM Users WHERE pseudo = :pseudo OR email = :pseudo');
        $login->bindParam(':pseudo', $pseudo);
        $login->execute();
        $data = $login->fetch();
        $user = new UserEntity($data);
        return $user;
    }
    /* ******** 9 . VIEW PROFILE ***********************/

    public function modifyProfileRequest($userId, $avatar, $first_name, $name, $email, $description) 
    {
        $dbProjet5 = $this->dbConnect();

        $modifyProfile = $dbProjet5->prepare('UPDATE Users SET avatar = :avatar, first_name = :firstname, last_name = :lastname, email = :email, description = :description WHERE id = :id');
        $modifyProfile->bindParam(':avatar', $avatar);
        $modifyProfile->bindParam(':firstname', $first_name);
        $modifyProfile->bindParam(':lastname', $name);
        $modifyProfile->bindParam(':email', $email);
        $modifyProfile->bindParam(':description', $description);
        $modifyProfile->bindParam(':id', $userId);
        $modifiedProfile = $modifyProfile->execute();
        return $modifiedProfile;
    }
    /* ******* 10 . DELETE ACCOUNT *********************/
    public function deleteAccountRequest($userId)
    {
        $dbProjet5 = $this->dbConnect();
        $deleteAccount = $dbProjet5->prepare('DELETE FROM Users WHERE id = :id');
        $deleteAccount->bindParam(':id', $userId);
        $deleteAccount = $deleteAccount->execute();
        
        return $deleteAccount;
    }
    /* ******* 11. FORGET PASSWORD *********************/

    public function forgetPasswordRequest($email) 
    {
        
        $dbProjet5 = $this->dbConnect();
        
        $forgetPassword = $dbProjet5->prepare('SELECT * FROM Users where email = :email AND registration_date IS NOT NULL');
        $forgetPassword->bindParam(':email', $email);
        $forgetPassword->execute();
        $user = $forgetPassword->fetch();
        if($user) {

            function str_random($length)
            {
                $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
                return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length); 
            }

            $reset_token = str_random(100);
            $user_id = $user['id'];
            $forgetUpdate = $dbProjet5->prepare('UPDATE Users SET reset_token = :token, reset_at = NOW() WHERE id = :id');
            $forgetUpdate->bindParam(':token', $reset_token);
            $forgetUpdate->bindParam(':id', $user_id);
            $forgetUpdate->execute();

            /*$subject = 'Changement de votre mot de passe';
            $body = "Afin de changer votre mot de passe, merci de cliquer sur ce lien :\n\nhttp://www.projet5.philippetraon.com/index.php?action=changePasswordPage&id=$user_id&token=$reset_token";
            mail($email, $subject, $body);*/

            $to      = $email;
            $subject = 'Changement de votre mot de passe';
            $message = "Afin de changer votre mot de passe, merci de cliquer sur ce lien :\n\nhttp://www.projet5.philippetraon.com/index.php?action=changePasswordPage&id=$user_id&token=$reset_token";
            $headers = 'From: contact@philippetraon.com' . "\r\n" .
            'Reply-To: contact@philippetraon.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

            mail($to, $subject, $message, $headers);

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
        $changePassword = $dbProjet5->prepare('UPDATE Users SET password = :password, reset_token = NULL, reset_at = NULL WHERE id = :id');
        $changePassword->bindParam(':password', $passe);
        $changePassword->bindParam(':id', $userId);
        $changePassword = $changePassword->execute();
        return $changePassword;
    }
    /* ******* 13. CHECK RESET TOKEN *******************/
    public function checkResetTokenRequest($userId, $token)
    {

        $dbProjet5 = $this->dbConnect();

        $checkResetToken = $dbProjet5->prepare('SELECT * FROM Users WHERE id = :id AND reset_token IS NOT NULL AND reset_token = :token AND reset_at > DATE_SUB(NOW(), INTERVAL 30 MINUTE)');
        $checkResetToken->bindParam(':id', $userId);
        $checkResetToken->bindParam(':token', $token);
        $checkResetToken->execute();
        $user = $checkResetToken->fetch();
        return $user;
    }
    /* ******* 14. DELETE A USER ***********************/
    public function deleteUserRequest($userId)
    {
        $dbProjet5 = $this->dbConnect();

        $deleteUser = $dbProjet5->prepare('DELETE FROM Users WHERE id = :id');
        $deleteUser->bindParam(':id', $userId);

        $affectedUser = $deleteUser->execute();
        return $affectedUser;
    }
    /* ******* 15. GIVE RIGHT ADMINS *******************/
    public function giveAdminRightsRequest($userId) 
    {
        $dbProjet5 = $this->dbConnect();

        $giveAdminRights = $dbProjet5->prepare('UPDATE Users SET authorization = 1 WHERE id = :id');
        $giveAdminRights->bindParam(':id', $userId);
        $adminRights = $giveAdminRights->execute();
        return $adminRights;
    }
    /* ******* 16. CANCEL RIGHT ADMINS *****************/
    public function stopAdminRightsRequest($userId) 
    {
        $dbProjet5 = $this->dbConnect();

        $stopAdminRights = $dbProjet5->prepare('UPDATE Users SET authorization = 0 WHERE id = :id');
        $stopAdminRights->bindParam(':id', $userId);
        $adminRights = $stopAdminRights->execute();
        return $adminRights;
    }
    /* ******* 17 . INFO USER COOKIE *****************************/
    public function userCookie($cookiepseudo) 
    {
        $dbProjet5 = $this->dbConnect();

        $req = $dbProjet5->prepare('SELECT * FROM users WHERE pseudo = :pseudo AND password = :password');
        $req->bindParam(':pseudo', $cookiepseudo);
        $req->execute();
        $user = $req->fetch();
        return $user;
    }
}