<?php 
/**
 * My own blog.
 *
 * PHP Version 7
 * 
 * Category Entity
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
 *  Class CategoryEntity
 *
 * @category PHP
 * @package  Default
 * @author   Philippe Traon <ptraon@gmail.com>
 * @license  http://projet5.philippetraon.com Phil Licence
 * @link     http://projet5.philippetraon.com
 */
class CategoryEntity extends Entity
{
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