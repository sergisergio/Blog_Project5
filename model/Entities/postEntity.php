<?php 
namespace Philippe\Blog\Model\Entities;
class PostEntity
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
          $this->setTitle($datas['title']);
          $this->setChapo($datas['chapo']);
          $this->setIntro($datas['intro']);
          $this->setContent($datas['content']);
          $this->setAuthor($datas['author']);
          $this->setCreationDate($datas['creation_date_fr']);
          $this->setLastUpdated($datas['last_updated_fr']);
          $this->setFileExtension($datas['file_extension']);
          $this->setCategory($datas['category_id']);
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
     * Setter Title
     * 
     * @param title $title title
     *
     * @return [type] [<description>]
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
     * @param chapo $chapo chapo
     *
     * @return [type] [<description>]
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
     * @param intro $intro intro
     *
     * @return [type] [<description>]
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
     * @param content $content content
     *
     * @return [type] [<description>]
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
     * @param author $author author
     *
     * @return [type] [<description>]
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
     * @param creation_date $creation_date creation date
     *
     * @return [type] [<description>]
     */
    public function setCreationDate($creation_date)
    {
        $this->creation_date = $creation_date;
    }
    /**
     * Setter lastupdated
     * 
     * @param last_updated $last_updated last_updated
     *
     * @return [type] [<description>]
     */
    public function setLastUpdated($last_updated)
    {
        $this->last_updated = $last_updated;
    }
    /**
     * Setter image
     * 
     * @param file_extension $file_extension file_extension
     *
     * @return [type] [<description>]
     */
    public function setFileExtension($file_extension)
    {
        if (is_string($file_extension)) {
            $this->file_extension = $file_extension;
        }
    }
    /**
     * Setter category
     * 
     * @param category $category category
     *
     * @return [type] [<description>]
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
     * @return [type]
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * Getter Title
     * 
     * @return [type]
     */
    public function getTitle()
    {
        return $this->title;
    }
    /**
     * Getter Chapo
     * 
     * @return [type]
     */
    public function getChapo()
    {
        return $this->chapo;
    }
    /**
     * Getter Intro
     * 
     * @return [type]
     */
    public function getIntro()
    {
        return $this->intro;
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
     * Getter Author
     * 
     * @return [type]
     */
    public function getAuthor()
    {
        return $this->author;
    }
    /**
     * Getter Creationdate
     * 
     * @return [type]
     */
    public function getCreationDate()
    {
        return $this->creation_date;
    }
    /**
     * Getter lastUpdated
     * 
     * @return [type]
     */
    public function getLastUpdated()
    {
        return $this->last_updated;
    }
    /**
     * Getter Image
     * 
     * @return [type]
     */
    public function getFileExtension()
    {
        return $this->file_extension;
    }
    /**
     * Getter category
     * 
     * @return [type]
     */
    public function getCategory()
    {
        return $this->category;
    }
}