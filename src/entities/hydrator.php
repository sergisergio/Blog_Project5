<?php
/**
 * Trait Hydrate
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
 *  Trait Hydrator
 *
 * @category PHP
 * @package  Default
 * @author   Philippe Traon <ptraon@gmail.com>
 * @license  http://projet5.philippetraon.com Phil Licence
 * @link     http://projet5.philippetraon.com
 */   
trait Hydrator
{
    /**
     * Data
     * 
     *  array $data array of datas
     */
    protected $data;
    /**
     * Hydrate
     * 
     * @param array $data datas
     * 
     * @return array
     */    
    public function hydrate($data)
    {
        foreach ((array)$data as $key => $value) {
            $method = 'set'.ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }
}