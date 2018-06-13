<?php
/**
 * My own blog.
 *
 * Main manager
 *
 * @category PHP
 * @package  Default
 * @author   Philippe Traon <ptraon@gmail.com>
 * @license  http://projet5.philippetraon.com Phil Licence
 * @version  PHP 7.1.14
 * @link     http://projet5.philippetraon.com
 */
namespace Philippe\Blog\Model;

class Manager
{
    
    /**
     * Function dbConnect
     * 
     * @return mixed
     */
    protected function dbConnect()
    {
        $dbProjet5 = new \PDO('mysql:host=localhost;dbname=Projet5;charset=utf8', 'root', 'root');
        return $dbProjet5;
    }
}