<?php
/**
 * Trait Construct
 *
 * PHP Version 7
 * 
 * @category PHP
 * @package  Default
 * @author   Philippe Traon <ptraon@gmail.com>
 * @license  http://projet5.philippetraon.com Phil Licence
 * @version  GIT: $Id$ In development.
 * @link     http://projet5.philippetraon.com
 */
namespace Philippe\Blog\Src\Entities;
/**
 *  Trait Constructor
 *
 * @category PHP
 * @package  Default
 * @author   Philippe Traon <ptraon@gmail.com>
 * @license  http://projet5.philippetraon.com Phil Licence
 * @link     http://projet5.philippetraon.com
 */   
trait Constructor
{
   
    /**
     * Data
     * 
     * @var array $data array of datas
     */
    private $data;
    /**
     * Construct
     * 
     * @param array $data datas
     *
     * @return array 
     */
    public function __construct($data) 
    {
        $this->hydrate($data);
    }
}