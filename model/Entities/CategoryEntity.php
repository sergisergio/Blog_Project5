<?php 
namespace Philippe\Blog\Model\Entities;
class CategoryEntity
{
    private $category_id;
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
          $this->setCategoryId($datas['category_id']);
          $this->setCategory($datas['category']);
    }
    /**
     * Setter Id
     * 
     * @param category_id $category_id category's id
     *
     * @return [type]
     */
    public function setCategoryId($category_id)
    {
        $category_id = (int)$category_id;
        if ($category_id > 0) {
            $this->category_id = $category_id;
        }  
    }
    /**
     * Setter category
     * 
     * @param category $category category
     *
     * @return [type]
     */
    public function setCategory($category)
    {
        if (is_string($category)) {
            $this->category = $category;
        }
    }
    /**
     * Getter Id
     * 
     * @return [type]
     */
    public function getCategoryId()
    {
        return $this->category_id;
    }
    /**
     * Getter Category
     * 
     * @return [type]
     */
    public function getCategory()
    {
        return $this->category;
    }
}