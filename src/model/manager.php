<?php
/**
 * My own blog.
 *
 * PHP Version 7
 * 
 * Main manager
 *
 * @category PHP
 * @package  Default
 * @author   Philippe Traon <ptraon@gmail.com>
 * @license  http://projet5.philippetraon.com Phil Licence
 * @version  GIT: $Id$ In development.
 * @link     http://projet5.philippetraon.com
 */
namespace Philippe\Blog\Src\Model;
use \Philippe\Blog\Src\Model\Manager;
use \PDO;
/**
 *  Class Manager
 *
 * @category PHP
 * @package  Default
 * @author   Philippe Traon <ptraon@gmail.com>
 * @license  http://projet5.philippetraon.com Phil Licence
 * @link     http://projet5.philippetraon.com
 */
abstract class Manager
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