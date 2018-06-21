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
namespace Philippe\Blog\Src\Model;

use \PDO;
/**
 * Class Manager is for our database
 */
class Manager
{
    protected $dbProjet5;
    /**
     * Connect to the database
     * 
     * @return mixed
     */
    protected function dbConnect()
    {
        $dbProjet5 = new PDO('mysql:host=localhost;dbname=Projet5;charset=utf8', 'root', 'root');
        return $dbProjet5;
    }
}