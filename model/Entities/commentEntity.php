<?php

namespace Philippe\Blog\Model\Entity;
//require_once "model/Manager.php";
class CommentEntity /*extends Manager*/
{
    protected $id;
    protected $post_id;
    protected $author;
    protected $content;
    protected $creation_date;
    protected $last_updated;
    protected $validation;

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
        $this->setPostId($datas['post_id']);
        $this->setAuthor($datas['author']);
        $this->setContent($datas['content']);
        $this->setCreationDate($datas['creation_date']);
        $this->setLastUpdated($datas['last_updated']);
        $this->setValidation($datas['validation']);
    }

    public function setId($id)
      {
        $this->id = $id;
      }
    public function getId()
      {
        return $this->id;
      }
    public function setPostId($post_id)
      {
        $this->post_id = $post_id;
      }
    public function getPostId()
      {
        return $this->post_id;
      }
    public function setAuthor($author)
      {
        $this->author = $author;
      }
    public function getAuthor()
      {
        return $this->author;
      }
    public function setContent($content)
      {
        $this->content = $content;
      }
    public function getContent()
      {
        return $this->content;
      }
    public function setCreationDate($creation_date)
      {
        $this->creation_date = $creation_date;
      }
    public function getCreationDate()
      {
        return $this->creation_date;
      }
    public function setLastUpdated($last_updated)
      {
        $this->last_updated = $last_updated;
      }
    public function getLastUpdated()
      {
        return $this->last_updated;
      }
    public function setValidation($validation)
      {
        $this->validation = $validation;
      }
    public function getValidation()
      {
        return $this->validation;
      }
}