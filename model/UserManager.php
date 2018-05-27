<?php
/* ************************* RESUME *************************************
1 . RECUPERER TOUS LES MEMBRES.
2 . RECUPERER UN SEUL MEMBRE.
3 . RECUPERER AUTORISATION DU MEMBRE.
4 . INSCRIPTION.
5 . CONFIRMATION INSCRIPTION.
6 . LE PSEUDO EST-IL DEJA PRIS ?
7 . L'EMAIL EST-IL DEJA PRIS ?
8 . CONNEXION.
*********************** FIN RESUME *************************************/
namespace Philippe\Blog\Model;
require_once "model/Manager.php";
class UserManager extends Manager
{
    private $id;
    private $first_name;
    private $last_name;
    private $pseudo;
    private $password;
    private $email;
    private $registration_date;
    private $authorization;
    private $confirmation_token;
    private $avatar;
    private $is_active;

     // CONSTRUCT
    /*public function __construct($datas)
    {
        $this->hydrate($datas);
    }*/
    // HYDRATE
    public function hydrate($datas)
    {
        $this->setId($datas["id"]);
        $this->setFirstName($datas["first_name"]);
        $this->setLastName($datas["last_name"]);
        $this->setPseudo($datas["pseudo"]);
        $this->setPassword($datas["password"]);
        $this->setEmail($datas["email"]);
        $this->setRegistrationDate($datas["registration_date"]);
        $this->setAuthorization($datas["authorization"]);
        $this->setConfirmationToken($datas["confirmation_token"]);
        $this->setAvatar($datas["avatar"]);
        $this->setIsActive($datas["is_active"]);
    }

    public function setId($id)
      {
        $this->id = $id;
      }
    public function getId()
      {
        return $this->id;
      }
    public function setFirstName($first_name)
      {
        $this->firstName = $first_name;
      }
    public function getFirstName()
      {
        return $this->firstName;
      }
    public function setLastName($last_name)
      {
        $this->lastName = $last_name;
      }
    public function getLastName()
      {
        return $this->lastName;
      }
    public function setPseudo($pseudo)
      {
        $this->pseudo = $pseudo;
      }
    public function getPseudo()
      {
        return $this->pseudo;
      }
    public function setPassword($password)
      {
        $this->password = $password;
      }
    public function getPassword()
      {
        return $this->password;
      }
    public function setEmail($email)
      {
        $this->email = $email;
      }
    public function getEmail()
      {
        return $this->email;
      }
    public function setRegistrationDate($registration_date)
      {
        $this->registrationDate = $registration_date;
      }
    public function getRegistrationDate()
      {
        return $this->registrationDate;
      }
    public function setAuthorization($authorization)
      {
        $this->authorization = $authorization;
      }
    public function getAuthorization1()
      {
        return $this->authorization;
      }
    public function setConfirmationToken($confirmation_token)
      {
        $this->confirmationToken = $confirmation_token;
      }
    public function getConfirmationToken()
      {
        return $this->confirmationToken;
      }
    public function setAvatar($avatar)
      {
        $this->avatar = $avatar;
      }
    public function getAvatar()
      {
        return $this->avatar;
      }
    public function setIsActive($is_active)
      {
        $this->isActive = $is_active;
      }
    public function getIsActive()
      {
        return $this->isActive;
      }
    /* ************** 1 . RECUPERER TOUS LES MEMBRES ***********************/
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
    /* ************** 2 . RECUPERER UN SEUL MEMBRE *************************/
    public function getUser($userId)
    {
        $dbProjet5 = $this->dbConnect();
        $req = $dbProjet5->prepare(
            'SELECT id, first_name, last_name, pseudo, password, email, confirmation_token, DATE_FORMAT(registration_date, \'%d/%m/%Y à %Hh%imin\') AS registration_date_fr, authorization, is_active
			FROM Users 
			WHERE id = ?'
        );
        $req->execute(array($userId));
        $post = $req->fetch();
        return $post;
    }
    /* ************** 3 . RECUPERER AUTORISATION DU MEMBRE *****************/
    public function getAuthorization($pseudo)
    {
        $dbProjet5 = $this->dbConnect();
        $req = $dbProjet5->prepare(
            'SELECT authorization
			FROM Users 
			WHERE pseudo = ?
			'
        );
        $req->execute(array($pseudo));
        $access = $req->fetch();
        return $access;
    }
    /* ************** 4 . INSCRIPTION **************************************/
    public function addUserRequest($pseudo, $email, $passe)
    {
        $dbProjet5 = $this->dbConnect();
        $post = $dbProjet5->prepare('INSERT INTO Users(pseudo, email, password, confirmation_token) VALUES(?, ?, ?, ?)');
        $passe = password_hash($passe, PASSWORD_BCRYPT);
        function str_random($length)
        {
            $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
            return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length); 
        }
        $token = str_random(100);
        $users = $post->execute(array($pseudo, $email, $passe, $token));
        $user_id = $dbProjet5->lastInsertId();
    }
    /* ************** 5 . CONFIRMATION INSCRIPTION *************************/
    public function setActiveRequest($userId) 
    {
        $dbProjet5 = $this->dbConnect();
        $req = $dbProjet5->prepare('UPDATE Users SET is_active = 1, confirmation_token = NULL, registration_date = NOW() WHERE id = ?');
        $activeUser = $req->execute(array($userId));
        return $activeUser;
    }
    /* ************** 6 . LE PSEUDO EST-IL DEJA PRIS ? *********************/
    public function existPseudo($pseudo)
    {
        $dbProjet5 = $this->dbConnect();
        $req = $dbProjet5->prepare('SELECT id FROM Users WHERE pseudo = ?');
        $req->execute([$pseudo]);
        $user = $req->fetch();
        return $user;
    }
    /* ************** 7 . L'EMAIL EST-IL DEJA PRIS ? ***********************/
    public function existMail($email)
    {
        $dbProjet5 = $this->dbConnect();
        $req = $dbProjet5->prepare('SELECT id FROM Users WHERE email = ?');
        $req->execute([$email]);
        $usermail = $req->fetch();
        return $usermail;
    }
    /* ************** 8 . CONNEXION ****************************************/
    public function loginRequest($pseudo, $passe)
    {
        $dbProjet5 = $this->dbConnect();
        $req = $dbProjet5->prepare('SELECT * FROM Users WHERE pseudo = :pseudo');
        $req->execute(array('pseudo' => $pseudo));
        $user = $req->fetch();
        return $user;
    }
}