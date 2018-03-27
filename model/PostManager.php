<?php

namespace Philippe\Blog\Model;

require_once("model/Manager.php");

class PostManager extends Manager
{
	public function getPosts()
	{
		$db = $this->dbConnect();
		$req = $db->query('SELECT id, title, intro, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr, DATE_FORMAT(last_updated, \'%d/%m/%Y à %Hh%imin%ss\') AS last_updated_fr 
			FROM Post 
			ORDER BY creation_date DESC LIMIT 0, 5');
		return $req;
	}

	public function getPost($postId){
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT id, title, intro, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr, DATE_FORMAT(last_updated, \'%d/%m/%Y à %Hh%imin%ss\') AS last_updated_fr 
			FROM Post 
			WHERE id = ?
			');
		$req->execute(array($postId));
		$post = $req->fetch();
		return $post;
	}
}