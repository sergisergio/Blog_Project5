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
          $this->setPostId($datas['post_id']);
          $this->setAuthor($datas['author']);
          $this->setContent($datas['content']);
          $this->setCreationDate($datas['creation_date_fr']);
          $this->setLastUpdated($datas['last_updated_fr']);
          $this->setValidation($datas['validation']);
      }

    public function setId($id)
      {
        $id = (int)$id;
        if ($id > 0)
        {
          $this->id = $id;
        }
      }
    public function getId()
      {
        return $this->id;
      }
    public function setPostId($post_id)
      {
        $post_id = (int)$post_id;
        if ($post_id)
        {
          $this->post_id = $post_id;
        }
      }
    public function getPostId()
      {
        return $this->post_id;
      }
    public function setAuthor($author)
      {
        if (is_string($author))
        {
          $this->author = $author;
        }
      }
    public function getAuthor()
      {
        return $this->author;
      }
    public function setContent($content)
      {
        if (is_string($content))
        {
          $this->content = $content;
        }
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
        $validation = (int)$validation;
        if ($validation >= 0)
        {
          return $this->validation;
        }
      }
}