<?php 
/**
 * My own blog.
 *
 * PHP Version 7
 * 
 * Post Entity
 *
 * @category PHP
 * @package  Default
 * @author   Philippe Traon <ptraon@gmail.com>
 * @license  http://projet5.philippetraon.com Phil Licence
 * @version  GIT: $Id$ In development.
 * @link     http://projet5.philippetraon.com
 */
namespace Philippe\Blog\Src\Entities;
require_once "src/entities/entity.php";
/**
 *  Class PostEntity
 *
 * @category PHP
 * @package  Default
 * @author   Philippe Traon <ptraon@gmail.com>
 * @license  http://projet5.philippetraon.com Phil Licence
 * @link     http://projet5.philippetraon.com
 */
class PostEntity extends Entity
{
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