<?php 
/**
 * My own blog.
 *
 * Category Entity
 *
 * @category PHP
 * @package  Default
 * @author   Philippe Traon <ptraon@gmail.com>
 * @license  http://projet5.philippetraon.com Phil Licence
 * @version  PHP 7.1.14
 * @link     http://projet5.philippetraon.com
 */
namespace Philippe\Blog\Src\Entities;
class CategoryEntity
{
    use Constructor, Hydrator;

    private $category_id;
    private $category;

    /**
     * Setter Id
     * 
     * @param int $category_id category's id
     *
     * @return int
     */
    public function setCategory_id($category_id)
    {
        $category_id = (int)$category_id;
        if ($category_id > 0) {
            $this->category_id = $category_id;
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
        if (is_string($category)) {
            $this->category = $category;
        }
    }
    /**
     * Getter Id
     * 
     * @return id
     */
    public function getCategory_id()
    {
        return $this->category_id;
    }
    /**
     * Getter Category
     * 
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }
}