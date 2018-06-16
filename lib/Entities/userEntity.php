<?php
/**
 * My own blog.
 *
 * User Entity
 *
 * @category PHP
 * @package  Default
 * @author   Philippe Traon <ptraon@gmail.com>
 * @license  http://projet5.philippetraon.com Phil Licence
 * @version  PHP 7.1.14
 * @link     http://projet5.philippetraon.com
 */
namespace Philippe\Blog\Lib\Entities;
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

    /**
     * Construct
     * 
     * @param array $datas datas
     *
     * @return array 
     */
    public function __construct($datas) 
    {
        $this->hydrate($datas);
    }

    /**
     * Hydrate
     * 
     * @param array $datas datas
     * 
     * @return array
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
    /**
     * Setter Id
     * 
     * @param int $id id
     *
     * @return int
     */
    public function setId($id)
    {
        $id = (int)$id;
        if ($id > 0) {
            $this->id = $id;
        }
    }
    /**
     * Setter Firstname
     * 
     * @param string $first_name first_name
     *
     * @return string
     */
    public function setFirstName($first_name)
    {
        if (is_string($first_name)) {
            $this->first_name = $first_name;
        }
    }
    /**
     * Setter Lastname
     * 
     * @param string $last_name last_name
     *
     * @return string [<description>]
     */
    public function setLastName($last_name)
    {
        if (is_string($last_name)) {
            $this->last_name = $last_name;
        }
    }
    /**
     * Setter Pseudo
     * 
     * @param string $pseudo pseudo
     *
     * @return string
     */
    public function setPseudo($pseudo)
    {
        if (is_string($pseudo)) {
            $this->pseudo = $pseudo;
        }
    }
    /**
     * Setter Password
     * 
     * @param string $password password
     *
     * @return string
     */
    public function setPassword($password)
    {
        if (is_string($password)) {
            $this->password = $password;
        }
    }
    /**
     * Setter Email
     * 
     * @param string $email email
     *
     * @return string
     */
    public function setEmail($email)
    {
        if (is_string($email)) {
            $this->email = $email;
        }
    }
    /**
     * Setter RegistrationDate
     * 
     * @param string $registration_date registration_date
     *
     * @return string
     */
    public function setRegistrationDate($registration_date)
    {
        $this->registration_date = $registration_date;
    }
    /**
     * Setter Authorization
     * 
     * @param int $authorization authorization
     *
     * @return int
     */
    public function setAuthorization($authorization)
    {
        $authorization = (int)$authorization;
        if ($authorization >= 0) {
            $this->authorization = $authorization;
        }
    }
    /**
     * Setter ConfirmationToken
     * 
     * @param string $confirmation_token confirmation_token
     *
     * @return string
     */
    public function setConfirmationToken($confirmation_token)
    {
        if (is_string($confirmation_token)) {
            $this->confirmation_token = $confirmation_token;
        }
    }
    /**
     * Setter Avatar
     * 
     * @param string $avatar avatar
     *
     * @return string
     */
    public function setAvatar($avatar)
    {
        if (is_string($avatar)) {
            $this->avatar = $avatar;
        }
    }
    /**
     * Setter Isactive
     * 
     * @param int $is_active is_active
     *
     * @return int
     */
    public function setIsActive($is_active)
    {
        $is_active = (int)$is_active;
        if ($is_active >= 0) {
            $this->is_active = $is_active;
        }
    }
    /**
     * Setter Description
     * 
     * @param string $description description
     *
     * @return string
     */
    public function setDescription($description)
    {
        if (is_string($description)) {
            $this->description = $description;
        }
    }
    /**
     * Setter ResetToken
     * 
     * @param string $reset_token reset_token
     *
     * @return string
     */
    public function setResetToken($reset_token)
    {
        if (is_string($reset_token)) {
            $this->reset_token = $reset_token;
        }
    }
    /**
     * Setter ResetAt
     * 
     * @param string $reset_at reset_at
     *
     * @return string
     */
    public function setResetAt($reset_at)
    {
        $this->reset_at = $reset_at;
    }
    /**
     * Getter Id
     * 
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * Getter FirstName
     * 
     * @return string
     */
    public function getFirstName()
    {
        return $this->first_name;
    }
    /**
     * Getter LastName
     * 
     * @return string
     */
    public function getLastName()
    {
        return $this->last_name;
    }
    /**
     * Getter Pseudo
     * 
     * @return string
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }
    /**
     * Getter Password
     * 
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }
    /**
     * Getter Email
     * 
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
    /**
     * Getter RegistrationDate
     * 
     * @return string
     */
    public function getRegistrationDate()
    {
        return $this->registration_date;
    }
    /**
     * Getter Authorization
     * 
     * @return string
     */
    public function getAuthorization1()
    {
        return $this->authorization;
    }
    /**
     * Getter ConfirmationToken
     * 
     * @return string
     */
    public function getConfirmationToken()
    {
        return $this->confirmation_token;
    }
    /**
     * Getter Avatar
     * 
     * @return string
     */
    public function getAvatar()
    {
        return $this->avatar;
    }
    /**
     * Getter IsActive
     * 
     * @return string
     */
    public function getIsActive()
    {
        return $this->is_active;
    }
    /**
     * Getter Description
     * 
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
    /**
     * Getter ResetToken
     * 
     * @return string
     */
    public function getResetToken()
    {
        return $this->reset_token;
    }
    /**
     * Getter ResetAt
     * 
     * @return string
     */
    public function getResetAt()
    {
        return $this->reset_at;
    }
}