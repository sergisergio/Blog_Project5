<?php 
namespace Philippe\Blog\Model\Entities;
class PostEntity
{
    protected $id;
    protected $title;
    protected $chapo;
    protected $intro;
    protected $content;
    protected $author;
    protected $creation_date;
    protected $last_updated;
    protected $file_extension;

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
        $this->setTitle($datas['title']);
        $this->setChapo($datas['chapo']);
        $this->setIntro($datas['intro']);
        $this->setContent($datas['content']);
        $this->setAuthor($datas['author']);
        $this->setCreationDate($datas['creation_date_fr']);
        $this->setLastUpdated($datas['last_updated_fr']);
        $this->setFileExtension($datas['file_extension']);
    }

    public function setId($id)
      {
        $this->id = $id;
      }
    public function getId()
      {
        return $this->id;
      }
    public function setTitle($title)
      {
        $this->title = $title;
      }
    public function getTitle()
      {
        return $this->title;
      }
    public function setChapo($chapo)
      {
        $this->chapo = $chapo;
      }
    public function getChapo()
      {
        return $this->chapo;
      }
    public function setIntro($intro)
      {
        $this->intro = $intro;
      }
    public function getIntro()
      {
        return $this->intro;
      }
    public function setContent($content)
      {
        $this->content = $content;
      }
    public function getContent()
      {
        return $this->content;
      }
    public function setAuthor($author)
      {
        $this->author = $author;
      }
    public function getAuthor()
      {
        return $this->author;
      }
    public function setCreationDate($creation_date)
      {
        $this->creationDate = $creation_date;
      }
    public function getCreationDate()
      {
        return $this->creationDate;
      }
    public function setLastUpdated($last_updated)
      {
        $this->lastUpdated = $last_updated;
      }
    public function getLastUpdated()
      {
        return $this->lastUpdated;
      }
    public function setFileExtension($file_extension)
      {
        $this->fileExtension = $file_extension;
      }
    public function getFileExtension()
      {
        return $this->fileExtension;
      }
}