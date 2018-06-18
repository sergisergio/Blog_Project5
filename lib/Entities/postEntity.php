<?php 
/**
 * My own blog.
 *
 * Post Entity
 *
 * @category PHP
 * @package  Default
 * @author   Philippe Traon <ptraon@gmail.com>
 * @license  http://projet5.philippetraon.com Phil Licence
 * @version  PHP 7.1.14
 * @link     http://projet5.philippetraon.com
 */
namespace Philippe\Blog\Lib\Entities;

class PostEntity
{

    use Constructor, Hydrator;

    private $id;
    private $title;
    private $chapo;
    private $intro;
    private $content;
    private $author;
    private $creation_date;
    private $last_updated;
    private $file_extension;
    private $category;

    /**
     * Construct
     * 
     * @param array $datas datas
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
     * @param array $datas datas
     * 
     * @return array
     */
    /*public function hydrate($data) 
    {
          foreach ((array)$data as $key => $value) {
              $method = 'set'.ucfirst($key);
              
              if (method_exists($this, $method)) {
                  $this->$method($value);
              }
          }
          $this->setId($data['id']);
          $this->setTitle($data['title']);
          $this->setChapo($data['chapo']);
          $this->setIntro($data['intro']);
          $this->setContent($data['content']);
          $this->setAuthor($data['author']);
          $this->setCreation_date($data['creation_date']);
          $this->setLast_updated($data['last_updated']);
          $this->setFile_extension($data['file_extension']);
          $this->setCategory($data['category_id']);
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
     * Setter Title
     * 
     * @param string $title title
     *
     * @return string
     */
    public function setTitle($title)
    {
        if (is_string($title)) {
            $this->title = $title;
        }
    }
    /**
     * Setter Chapo
     * 
     * @param string $chapo chapo
     *
     * @return string
     */
    public function setChapo($chapo)
    {
        if (is_string($chapo)) {
            $this->chapo = $chapo;
        }
    }
    /**
     * Setter Intro
     * 
     * @param string $intro intro
     *
     * @return string
     */
    public function setIntro($intro)
    {
        if (is_string($intro)) {
            $this->intro = $intro;
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
     * Setter Creationdate
     * 
     * @param string $creation_date creation date
     *
     * @return string
     */
    public function setCreation_date($creation_date)
    {
        $this->creation_date = $creation_date;
    }
    /**
     * Setter lastupdated
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
     * Setter image
     * 
     * @param string $file_extension file_extension
     *
     * @return string
     */
    public function setFile_extension($file_extension)
    {
        if (is_string($file_extension)) {
            $this->file_extension = $file_extension;
        }
    }
    /**
     * Setter category
     * 
     * @param string $category category
     *
     * @return string
     */
    public function setCategory($category)
    {
        $category = (int)$category;
        if ($category > 0) {
            $this->category = $category;
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
     * Getter Title
     * 
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
    /**
     * Getter Chapo
     * 
     * @return string
     */
    public function getChapo()
    {
        return $this->chapo;
    }
    /**
     * Getter Intro
     * 
     * @return string
     */
    public function getIntro()
    {
        return $this->intro;
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
     * Getter Author
     * 
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }
    /**
     * Getter Creationdate
     * 
     * @return string
     */
    public function getCreation_date()
    {
        return $this->creation_date;
    }
    /**
     * Getter lastUpdated
     * 
     * @return string
     */
    public function getLast_updated()
    {
        return $this->last_updated;
    }
    /**
     * Getter Image
     * 
     * @return string
     */
    public function getFile_extension()
    {
        return $this->file_extension;
    }
    /**
     * Getter category
     * 
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }
}