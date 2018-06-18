<?php
/**
 * My own blog.
 *
 * Security manager
 *
 * @category PHP
 * @package  Default
 * @author   Philippe Traon <ptraon@gmail.com>
 * @license  http://projet5.philippetraon.com Phil Licence
 * @version  PHP 7.1.14
 * @link     http://projet5.philippetraon.com
 */
namespace Philippe\Blog\Lib\Model;
require_once "lib/model/Manager.php";
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
     * Function checkCSRF
     * 
     * @return mixed
     */
    public function checkCSRF() 
    {
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = md5(time()*rand(1, 1000));
        }
    }
}