<?php
/**
 * My own blog.
 *
 * Security manager
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
namespace Philippe\Blog\Src\Model;
use \Philippe\Blog\Src\Model\Manager;
/**
 *  Class SecurityManager
 *
 * @category PHP
 * @package  Default
 * @author   Philippe Traon <ptraon@gmail.com>
 * @license  http://projet5.philippetraon.com Phil Licence
 * @link     http://projet5.philippetraon.com
 */
class SecurityManager extends Manager
{
    /**
     * Function checkBruteForce
     * 
     * @param string $ip IP address
     * 
     * @return string
     */
    public function checkBruteForce($ip)
    {
        $dbProjet5 = $this->dbConnect();
        $search = $dbProjet5->prepare(" SELECT * FROM connexion WHERE ip = :ip ");
        $search->bindParam(':ip', $ip);
        $count = $search->execute();
        $count = $search->rowCount();
        return $count;
    }
    /**
     * Function registerAttempt
     * 
     * @param string $ip IP address
     * 
     * @return string
     */
    public function registerAttempt($ip) 
    {
        $dbProjet5 = $this->dbConnect();
        $req = $dbProjet5->prepare('INSERT INTO connexion(ip) VALUES(:ip)');
        $req->bindParam(':ip', $ip);
        $req->execute();
    }
    /**
     * Function str_random
     * 
     * @param int $length length
     * 
     * @return int
     */
    public function str_random($length)
        {
            $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
            return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length); 
        }
}