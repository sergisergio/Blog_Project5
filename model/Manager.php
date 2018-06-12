<?php
namespace Philippe\Blog\Model;

class Manager
{
    
    /**
     * Function dbConnect
     * 
     * @return [type]
     */
    protected function dbConnect()
    {
        $dbProjet5 = new \PDO('mysql:host=localhost;dbname=Projet5;charset=utf8', 'root', 'root');
        return $dbProjet5;
    }
}