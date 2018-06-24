<?php
/**
 * My own blog.
 *
 * User manager
 *
 * PHP Version 7
 * 
 * @category PHP
 * @package  Default
 * @author   Philippe Traon <ptraon@gmail.com>
 * @license  http://projet5.philippetraon.com Phil Licence
 * @version  GIT: $Id$ In development.
 * @link     http://projet5.philippetraon.com
 */
namespace Philippe\Blog\Src\Model;

require_once "src/model/manager.php";
use \Philippe\Blog\Src\Entities\UserEntity;
use \Philippe\Blog\Src\Model\SecurityManager;
/**
 *  Class UserManager
 *
 * @category PHP
 * @package  Default
 * @author   Philippe Traon <ptraon@gmail.com>
 * @license  http://projet5.philippetraon.com Phil Licence
 * @link     http://projet5.philippetraon.com
 */
class UserManager extends Manager
{
    private $_securityManager;
    /**
     * Function construct
     */
    public function __construct() 
    {
        $this->_securityManager = new SecurityManager();
    }
    /**
     * Function getUsers
     * 
     * @return mixed
     */
    public function getUsers()
    {
        $dbProjet5 = $this->dbConnect();
        $getUsers = $dbProjet5->query(
            'SELECT id, first_name, last_name, pseudo, password, email, confirmation_token, DATE_FORMAT(registration_date, \'%d/%m/%Y à %Hh%i\') AS registration_date, authorization, is_active, avatar, description, reset_token, reset_at
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
    /**
     * Function getUser
     * 
     * @param int $userId userId
     * 
     * @return int
     */
    public function getUser($userId)
    {
        $dbProjet5 = $this->dbConnect();
        $getUser = $dbProjet5->prepare(
            'SELECT id, first_name, last_name, pseudo, password, email, confirmation_token, DATE_FORMAT(registration_date, \'%d/%m/%Y à %Hh%i\') AS registration_date, authorization, is_active, avatar, description, reset_token, reset_at
			FROM Users 
			WHERE id = :id'
        );
        $getUser->bindParam(':id', $userId);
        $getUser->execute();
        $data = $getUser->fetch();
        $post = new UserEntity($data);
        return $post;
    }
    /**
     * Function addUserRequest
     * 
     * @param string $pseudo pseudo
     * @param string $email  email
     * @param string $passe  password
     *
     * @return string
     */
    public function addUserRequest($pseudo, $email, $passe)
    {
        $dbProjet5 = $this->dbConnect();
        $addUser = $dbProjet5->prepare('INSERT INTO Users(pseudo, email, password, confirmation_token) VALUES(:pseudo, :email, :password, :confirmationtoken)');
        $passe = password_hash($passe, PASSWORD_BCRYPT);
        $token = $this->_securityManager->str_random(100);
        $addUser->bindParam(':pseudo', $pseudo);
        $addUser->bindParam(':email', $email);
        $addUser->bindParam(':password', $passe);
        $addUser->bindParam(':confirmationtoken', $token);
        $addUser->execute();
        $data = $addUser->fetch();
        $user_id = $dbProjet5->lastInsertId();
        $users = self::getUser($user_id);
        return $users;
    }
    /**
     * Function setActiveRequest
     * 
     * @param int $userId userId
     *
     * @return int
     */
    public function setActiveRequest($userId) 
    {
        $dbProjet5 = $this->dbConnect();
        $setActive = $dbProjet5->prepare('UPDATE Users SET is_active = 1, confirmation_token = NULL, registration_date = NOW() WHERE id = :id');
        $setActive->bindParam(':id', $userId);
        $activeUser = $setActive->execute();
        return $activeUser;
    }
    /**
     * Function existPseudo
     * 
     * @param string $pseudo pseudo
     * 
     * @return string
     */
    public function existPseudo($pseudo)
    {
        $dbProjet5 = $this->dbConnect();
        $existPseudo = $dbProjet5->prepare('SELECT id FROM Users WHERE pseudo = :pseudo');
        $existPseudo->bindParam(':pseudo', $pseudo);
        $existPseudo->execute();
        $user = $existPseudo->fetch();
        return $user;
    }
    /**
     * Function existMail
     * 
     * @param string $email email
     * 
     * @return string
     */
    public function existMail($email)
    {
        $dbProjet5 = $this->dbConnect();
        $existMail = $dbProjet5->prepare('SELECT id FROM Users WHERE email = :email');
        $existMail->bindParam(':email', $email);
        $existMail->execute();
        $usermail = $existMail->fetch();
        return $usermail;
    }
    /**
     * Function loginRequest
     * 
     * @param string $pseudo pseudo
     * @param string $passe  password
     * 
     * @return string
     */
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
    /**
     * Function modifyProfileRequest
     * 
     * @param int    $userId      userId
     * @param string $avatar      avatar
     * @param string $first_name  $first_name
     * @param string $name        name
     * @param string $email       email
     * @param string $description description
     * 
     * @return [mixed
     */
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
    /**
     * Function deleteAccountRequest
     * 
     * @param int $userId userId
     * 
     * @return int
     */
    public function deleteAccountRequest($userId)
    {
        $dbProjet5 = $this->dbConnect();
        $deleteAccount = $dbProjet5->prepare('DELETE FROM Users WHERE id = :id');
        $deleteAccount->bindParam(':id', $userId);
        $deleteAccount = $deleteAccount->execute();
        
        return $deleteAccount;
    }
    /**
     * Function forgetPasswordRequest
     * 
     * @param string $email email
     * 
     * @return string
     */
    public function forgetPasswordRequest($email) 
    {
        $dbProjet5 = $this->dbConnect();
        $forgetPassword = $dbProjet5->prepare('SELECT * FROM Users where email = :email AND registration_date IS NOT NULL');
        $forgetPassword->bindParam(':email', $email);
        $forgetPassword->execute();
        $user = $forgetPassword->fetch();
        if ($user) {
            $reset_token = $this->_securityManager->str_random(100);
            $user_id = $user['id'];
            $forgetUpdate = $dbProjet5->prepare('UPDATE Users SET reset_token = :token, reset_at = NOW() WHERE id = :id');
            $forgetUpdate->bindParam(':token', $reset_token);
            $forgetUpdate->bindParam(':id', $user_id);
            $forgetUpdate->execute();
            $data = $forgetUpdate->fetch();
            $users = self::getUser($user_id);
            return $users;
        } else {
            echo 'Aucun compte ne correspond à cette adresse';
        } 
        return $user;
    }
    /**
     * Function changePasswordRequest
     * 
     * @param int    $userId userId
     * @param string $passe  password
     * 
     * @return mixed
     */
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
    /**
     * Function checkResetTokenRequest
     * 
     * @param int    $userId userId
     * @param string $token  token
     * 
     * @return mixed
     */
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
    /**
     * Function deleteUserRequest
     * 
     * @param int $userId ueserId
     * 
     * @return int
     */
    public function deleteUserRequest($userId)
    {
        $dbProjet5 = $this->dbConnect();
        $deleteUser = $dbProjet5->prepare('DELETE FROM Users WHERE id = :id');
        $deleteUser->bindParam(':id', $userId);
        $affectedUser = $deleteUser->execute();
        return $affectedUser;
    }
    /**
     * Function giveAdminRightsRequest
     * 
     * @param int $userId userId
     * 
     * @return int
     */
    public function giveAdminRightsRequest($userId) 
    {
        $dbProjet5 = $this->dbConnect();
        $giveAdminRights = $dbProjet5->prepare('UPDATE Users SET authorization = 1 WHERE id = :id');
        $giveAdminRights->bindParam(':id', $userId);
        $adminRights = $giveAdminRights->execute();
        return $adminRights;
    }
    /**
     * Function stopAdminRightsRequest
     * 
     * @param int $userId userId
     * 
     * @return int
     */
    public function stopAdminRightsRequest($userId) 
    {
        $dbProjet5 = $this->dbConnect();
        $stopAdminRights = $dbProjet5->prepare('UPDATE Users SET authorization = 0 WHERE id = :id');
        $stopAdminRights->bindParam(':id', $userId);
        $adminRights = $stopAdminRights->execute();
        return $adminRights;
    }
    /**
     * Function add Remember Token
     * 
     * @param string $pseudo pseudo
     * 
     * @return int
     */
    public function rememberToken($pseudo) 
    {
        $dbProjet5 = $this->dbConnect();
        $token = $this->_securityManager->str_random(100);
        $remember = $dbProjet5->prepare('UPDATE Users SET remember_token = :token WHERE pseudo = :pseudo');
        $remember->bindParam(':token', $token);
        $remember->bindParam(':pseudo', $pseudo);
        $rememberOK = $remember->execute();
        return $rememberOK;
    }
    /**
     * Function userCookie
     * 
     * @param int $user_id user_id
     * 
     * @return int
     */
    public function userCookie($user_id) 
    {
        $dbProjet5 = $this->dbConnect();
        $req = $dbProjet5->prepare('SELECT * FROM users WHERE id = :id');
        $req->bindParam(':id', $user_id);
        $req->execute();
        $user = $req->fetch();
        return $user;
    }
}