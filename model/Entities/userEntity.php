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

    /**
     * Construct
     * 
     * @param datas $datas datas
     *
     * @return [type] 
     */
    public function __construct($datas) 
    {
        $this->hydrate($datas);
    }

    /**
     * Hydrate
     * 
     * @param datas $datas datas
     * 
     * @return [type]
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
     * @param id $id id
     *
     * @return [type] [<description>]
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
     * @param first_name $first_name first_name
     *
     * @return [type] [<description>]
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
     * @param last_name $last_name last_name
     *
     * @return [type] [<description>]
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
     * @param pseudo $pseudo pseudo
     *
     * @return [type] [<description>]
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
     * @param password $password password
     *
     * @return [type] [<description>]
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
     * @param email $email email
     *
     * @return [type] [<description>]
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
     * @param registration_date $registration_date registration_date
     *
     * @return [type] [<description>]
     */
    public function setRegistrationDate($registration_date)
    {
        $this->registration_date = $registration_date;
    }
    /**
     * Setter Authorization
     * 
     * @param authorization $authorization authorization
     *
     * @return [type] [<description>]
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
     * @param confirmation_token $confirmation_token confirmation_token
     *
     * @return [type] [<description>]
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
     * @param avatar $avatar avatar
     *
     * @return [type] [<description>]
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
     * @param is_active $is_active is_active
     *
     * @return [type] [<description>]
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
     * @param description $description description
     *
     * @return [type] [<description>]
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
     * @param reset_token $reset_token reset_token
     *
     * @return [type] [<description>]
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
     * @param reset_at $reset_at reset_at
     *
     * @return [type] [<description>]
     */
    public function setResetAt($reset_at)
    {
        $this->reset_at = $reset_at;
    }
    /**
     * Getter Id
     * 
     * @return [type]
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * Getter FirstName
     * 
     * @return [type]
     */
    public function getFirstName()
    {
        return $this->first_name;
    }
    /**
     * Getter LastName
     * 
     * @return [type]
     */
    public function getLastName()
    {
        return $this->last_name;
    }
    /**
     * Getter Pseudo
     * 
     * @return [type]
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }
    /**
     * Getter Password
     * 
     * @return [type]
     */
    public function getPassword()
    {
        return $this->password;
    }
    /**
     * Getter Email
     * 
     * @return [type]
     */
    public function getEmail()
    {
        return $this->email;
    }
    /**
     * Getter RegistrationDate
     * 
     * @return [type]
     */
    public function getRegistrationDate()
    {
        return $this->registration_date;
    }
    /**
     * Getter Authorization
     * 
     * @return [type]
     */
    public function getAuthorization1()
    {
        return $this->authorization;
    }
    /**
     * Getter ConfirmationToken
     * 
     * @return [type]
     */
    public function getConfirmationToken()
    {
        return $this->confirmation_token;
    }
    /**
     * Getter Avatar
     * 
     * @return [type]
     */
    public function getAvatar()
    {
        return $this->avatar;
    }
    /**
     * Getter IsActive
     * 
     * @return [type]
     */
    public function getIsActive()
    {
        return $this->is_active;
    }
    /**
     * Getter Description
     * 
     * @return [type]
     */
    public function getDescription()
    {
        return $this->description;
    }
    /**
     * Getter ResetToken
     * 
     * @return [type]
     */
    public function getResetToken()
    {
        return $this->reset_token;
    }
    /**
     * Getter ResetAt
     * 
     * @return [type]
     */
    public function getResetAt()
    {
        return $this->reset_at;
    }
}