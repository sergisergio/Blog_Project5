<?php

namespace Philippe\Blog\Model\Entities;
//require_once "model/Manager.php";
class UserEntity /*extends Manager*/
{
    protected $id;
    protected $first_name;
    protected $last_name;
    protected $pseudo;
    protected $password;
    protected $email;
    protected $registration_date;
    protected $authorization;
    protected $confirmation_token;
    protected $avatar;
    protected $is_active;

    /*
     * Méthode de construction
     */
    public function __construct($datas) 
      {
        $this->hydrate($datas);
      }

    /*
     * Methode d'hydratation
     */
    public function hydrate($datas) {
        /*foreach ($data as $key => $value) {
            $method = 'set'.ucfirst($key);
            
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }*/
        $this->setId($datas['id']);
        $this->setFirstName($datas['first_name']);
        $this->setLastName($datas['last_name']);
        $this->setPseudo($datas['pseudo']);
        $this->setPassword($datas['password']);
        $this->setEmail($datas['email']);
        $this->setRegistrationDate($datas['registration_date']);
        $this->setAuthorization($datas['authorization']);
        $this->setConfirmationToken($datas['confirmation_token']);
        $this->setAvatar($datas['avatar']);
        $this->setIsActive($datas['is_active']);
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
}