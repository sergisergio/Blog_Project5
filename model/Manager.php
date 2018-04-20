<?php

/* Je crée un emplacement pour éviter les conflits avec d'autres développeurs */
namespace Philippe\Blog\Model;

/* Puis je crée ma classe principale de connexion à ma base de données */ 
class Manager
{
	/* J'utilise la visibilité protected de façon à ce que les enfants puissent hériter de cette classe */
	protected function dbConnect()
	{
		/* Je crée une variable db qui est une instance de la classe PDO (voir DOC !!!!! )*/
		$db = new \PDO('mysql:host=localhost;dbname=Projet5;charset=utf8', 'root', 'root');
		return $db;
	}
}