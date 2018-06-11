<?php 
namespace Philippe\Blog\Model\Entities;
class CategoryEntity
{
    private $category_id;
    private $category;

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
          $this->setCategoryId($datas['category_id']);
          $this->setCategory($datas['category']);
    }

    public function setCategoryId($category_id)
    {
        $category_id = (int)$category_id;
        if($category_id > 0) {
            $this->category_id = $category_id;
        }  
    }
    public function setCategory($category)
    {
        if (is_string($category)) {
            $this->category = $category;
        }
    }

    public function getCategoryId()
    {
        return $this->category_id;
    }
    public function getCategory()
    {
        return $this->category;
    }
}