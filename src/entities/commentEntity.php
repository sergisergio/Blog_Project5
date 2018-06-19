<?php
/**
 * My own blog.
 *
 * Comment Entity
 *
 * @category PHP
 * @package  Default
 * @author   Philippe Traon <ptraon@gmail.com>
 * @license  http://projet5.philippetraon.com Phil Licence
 * @version  PHP 7.1.14
 * @link     http://projet5.philippetraon.com
 */
namespace Philippe\Blog\Src\Entities;
class CommentEntity
{
    use Constructor, Hydrator;

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
     * @param array $data datas
     *
     * @return array
     */
    /*public function __construct($data) 
    {
        $this->hydrate($data);
    }

    /**
     * Hydrate
     * 
     * @param array $data datas
     * 
     * @return array
     */
    /*public function hydrate($data) 
    {
          foreach ($data as $key => $value) {
              $method = 'set'.ucfirst($key);
              
              if (method_exists($this, $method)) {
                  $this->$method($value);
              }
          }
          $this->setId($datas['id']);
          $this->setPost_id($datas['post_id']);
          $this->setAuthor($datas['author']);
          $this->setContent($datas['content']);
          $this->setCreation_date($datas['creation_date']);
          $this->setLast_updated($datas['last_updated']);
          $this->setValidation($datas['validation']);
          $this->setAvatar($datas['avatar']);
    }*/
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
     * Setter PostId
     * 
     * @param int $post_id postid
     *
     * @return int
     */
    public function setPost_id($post_id)
    {
        $post_id = (int)$post_id;
        if ($post_id) {
            $this->post_id = $post_id;
        }
    }
    /**
     * Setter Author
     * 
     * @param string $author author
     *
     * @return string
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
     * @param string $content content
     *
     * @return string
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
     * @param string $last_updated last_updated
     *
     * @return string
     */
    public function setLast_updated($last_updated)
    {
        $this->last_updated = $last_updated;
    }
    /**
     * Setter creationDate
     * 
     * @param string $creation_date creation_date
     *
     * @return string
     */
    public function setCreation_date($creation_date)
    {
        $this->creation_date = $creation_date;
    }
    /**
     * Setter validation
     * 
     * @param int $validation validation
     *
     * @return int
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
     * Getter Id
     * 
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * Getter PostId
     * 
     * @return int
     */
    public function getPost_id()
    {
        return $this->post_id;
    }
    /**
     * Getter Author
     * 
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }
    /**
     * Getter Content
     * 
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }
    /**
     * Getter creationDate
     * 
     * @return string
     */
    public function getCreation_date()
    {
        return $this->creation_date;
    }
    /**
     * Getter LastUpdated
     * 
     * @return string
     */
    public function getLast_updated()
    {
        return $this->last_updated;
    }
    /**
     * Getter Validation
     * 
     * @return int
     */
    public function getValidation()
    {
        return $this->validation;
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
}