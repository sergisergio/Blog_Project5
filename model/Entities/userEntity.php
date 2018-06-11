<?php

namespace Philippe\Blog\Model\Entities;
class UserEntity
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
    private $description;
    private $reset_token;
    private $reset_at;

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
    public function hydrate($datas) 
    {
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
          $this->setRegistrationDate($datas['registration_date_fr']);
          $this->setAuthorization($datas['authorization']);
          $this->setConfirmationToken($datas['confirmation_token']);
          $this->setAvatar($datas['avatar']);
          $this->setIsActive($datas['is_active']);
          $this->setDescription($datas['description']);
          $this->setResetToken($datas['reset_token']);
          $this->setResetAt($datas['reset_at']);
    }

    public function setId($id)
    {
        $id = (int)$id;
        if ($id > 0) {
            $this->id = $id;
        }
    }
    public function setFirstName($first_name)
    {
        if (is_string($first_name)) {
            $this->first_name = $first_name;
        }
    }
    public function setLastName($last_name)
    {
        if (is_string($last_name)) {
            $this->last_name = $last_name;
        }
    }
    public function setPseudo($pseudo)
    {
        if (is_string($pseudo)) {
            $this->pseudo = $pseudo;
        }
    }
    public function setPassword($password)
    {
        if (is_string($password)) {
            $this->password = $password;
        }
    }
    public function setEmail($email)
    {
        if (is_string($email)) {
            $this->email = $email;
        }
    }
    public function setRegistrationDate($registration_date)
    {
        $this->registration_date = $registration_date;
    }
    public function setAuthorization($authorization)
    {
        $authorization = (int)$authorization;
        if ($authorization >= 0) {
            $this->authorization = $authorization;
        }
    }
    public function setConfirmationToken($confirmation_token)
    {
        if (is_string($confirmation_token)) {
            $this->confirmation_token = $confirmation_token;
        }
    }
    public function setAvatar($avatar)
    {
        if (is_string($avatar)) {
            $this->avatar = $avatar;
        }
    }
    public function setIsActive($is_active)
    {
        $is_active = (int)$is_active;
        if ($is_active >= 0) {
            $this->is_active = $is_active;
        }
    }
    public function setDescription($description)
    {
        if (is_string($description)) {
            $this->description = $description;
        }
    }
    public function setResetToken($reset_token)
    {
        if (is_string($reset_token)) {
            $this->reset_token = $reset_token;
        }
    }
    public function setResetAt($reset_at)
    {
        $this->reset_at = $reset_at;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getFirstName()
    {
        return $this->first_name;
    }
    public function getLastName()
    {
        return $this->last_name;
    }
    public function getPseudo()
    {
        return $this->pseudo;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getRegistrationDate()
    {
        return $this->registration_date;
    }
    public function getAuthorization1()
    {
        return $this->authorization;
    }
    public function getConfirmationToken()
    {
        return $this->confirmation_token;
    }
    public function getAvatar()
    {
        return $this->avatar;
    }
    public function getIsActive()
    {
        return $this->is_active;
    }
    public function getDescription()
    {
        return $this->description;
    }
    public function getResetToken()
    {
        return $this->reset_token;
    }
    public function getResetAt()
    {
        return $this->reset_at;
    }
}