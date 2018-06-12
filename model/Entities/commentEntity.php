<?php

namespace Philippe\Blog\Model\Entities;
class CommentEntity
{
    private $id;
    private $post_id;
    private $author;
    private $content;
    private $creation_date;
    private $last_updated;
    private $validation;
    private $avatar;

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
          $this->setPostId($datas['post_id']);
          $this->setAuthor($datas['author']);
          $this->setContent($datas['content']);
          $this->setCreationDate($datas['creation_date_fr']);
          $this->setLastUpdated($datas['last_updated_fr']);
          $this->setValidation($datas['validation']);
          $this->setAvatar($datas['avatar']);
    }
    /**
     * Setter Id
     * 
     * @param id $id id
     *
     * @return [type]
     */
    public function setId($id)
    {
        $id = (int)$id;
        if ($id > 0) {
            $this->id = $id;
        }
    }
    /**
     * Setter PostId
     * 
     * @param postid $post_id postid
     *
     * @return [type]
     */
    public function setPostId($post_id)
    {
        $post_id = (int)$post_id;
        if ($post_id) {
            $this->post_id = $post_id;
        }
    }
    /**
     * Setter Author
     * 
     * @param author $author author
     *
     * @return [type]
     */
    public function setAuthor($author)
    {
        if (is_string($author)) {
            $this->author = $author;
        }
    }
    /**
     * Setter Content
     * 
     * @param content $content content
     *
     * @return [type]
     */
    public function setContent($content)
    {
        if (is_string($content)) {
            $this->content = $content;
        }
    }
    /**
     * Setter lastUpdated
     * 
     * @param last_updated $last_updated last_updated
     *
     * @return [type]
     */
    public function setLastUpdated($last_updated)
    {
        $this->last_updated = $last_updated;
    }
    /**
     * Setter creationDate
     * 
     * @param creation_date $creation_date creation_date
     *
     * @return [type]
     */
    public function setCreationDate($creation_date)
    {
        $this->creation_date = $creation_date;
    }
    /**
     * Setter validation
     * 
     * @param validation $validation validation
     *
     * @return [type]
     */
    public function setValidation($validation)
    {
        $validation = (int)$validation;
        if ($validation >= 0) {
            $this->validation = $validation;
        }
    }
    /**
     * Setter avatar
     * 
     * @param avatar $avatar avatar
     *
     * @return [type]
     */
    public function setAvatar($avatar)
    {
        if (is_string($avatar)) {
            $this->avatar = $avatar;
        }
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
     * Getter PostId
     * 
     * @return [type]
     */
    public function getPostId()
    {
        return $this->post_id;
    }
    /**
     * Getter Author
     * 
     * @return [type]
     */
    public function getAuthor()
    {
        return $this->author;
    }
    /**
     * Getter Content
     * 
     * @return [type]
     */
    public function getContent()
    {
        return $this->content;
    }
    /**
     * Getter creationDate
     * 
     * @return [type]
     */
    public function getCreationDate()
    {
        return $this->creation_date;
    }
    /**
     * Getter LastUpdated
     * 
     * @return [type]
     */
    public function getLastUpdated()
    {
        return $this->last_updated;
    }
    /**
     * Getter Validation
     * 
     * @return [type]
     */
    public function getValidation()
    {
        return $this->validation;
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
}