<?php

/* ************************* RESUME *************************************

1 . RECUPERER TOUS LES ARTICLES.
2 . RECUPERER UN SEUL ARTICLE.
3 . AJOUTER UN ARTICLE.
4 . MODIFIER UN ARTICLE.
5 . EFFACER UN ARTICLE.

************************** FIN RESUME **********************************/

namespace Philippe\Blog\Model;

require_once("model/Manager.php");

class PostManager extends Manager
{
/* ************ 1 . RECUPERER TOUS LES ARTICLES *******************/
	public function getPosts()
	{
		$db = $this->dbConnect();

		$postsPerPage = 5;
		$postsTotalReq  = $db->query('SELECT id FROM Posts');
		$postsTotal = $postsTotalReq->rowCount();
		$totalPages = ceil($postsTotal / $postsPerPage);

	if(isset($_GET['page']) AND !empty($_GET['page']) AND ($_GET['page'] > 0 ) AND ($_GET['page'] <= $totalPages)){
		$_GET['page'] = intval($_GET['page']);
		$currentPage = $_GET['page'];
	}
	else {
		$currentPage = 1;
	}

	$depart = ($currentPage-1)*$postsPerPage;

		/* Fonction query à revoir */
		$req = $db->query('SELECT p.id, p.title, p.intro, p.content, u.pseudo AS author, p.file_extension, DATE_FORMAT(p.creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr, DATE_FORMAT(p.last_updated, \'%d/%m/%Y à %Hh%imin%ss\') AS last_updated_fr 
			FROM Posts p
            INNER JOIN Users u ON u.id = p.author
			ORDER BY creation_date DESC LIMIT '.$depart.', '.$postsPerPage);
		return $req;
	}

	public function countPosts(){
		
	}

/* ************ 2 . RECUPERER UN SEUL ARTICLE *********************/
	public function getPost($postId){

		$db = $this->dbConnect();

		$req = $db->prepare('SELECT p.id, p.title, p.intro, p.content, u.pseudo AS author, p.file_extension, DATE_FORMAT(p.creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr, DATE_FORMAT(p.last_updated, \'%d/%m/%Y à %Hh%imin%ss\') AS last_updated_fr 
			FROM Posts p
            INNER JOIN Users u ON u.id = p.author
			WHERE p.id = ?');

		$req->execute(array($postId));
		$post = $req->fetch();
		return $post;
	}

/* ************ 3 . AJOUTER UN ARTICLE ****************************/
	public function addPostRequest($title, $author, $content, $image){

		$db = $this->dbConnect();

		$post = $db->prepare('INSERT INTO Posts(title, intro, author, content, file_extension, creation_date) VALUES(?, ?, ?, ?, ?, NOW()) ');

		$affectedPost = $post->execute(array($title, substr($content, 0, 600), $author, $content, $image));
		
		return $affectedPost;
	}

/* ************ 4 . MODIFIER UN ARTICLE ***************************/
	public function modifyPostRequest($postId, $title, $author, $content){

		$db = $this->dbConnect();

		$post = $db->prepare('UPDATE Posts SET title = ?, intro = ?, author = ?, content = ?, last_updated = NOW() WHERE id = ?');

		$affectedPost = $post->execute(array($title, substr($content, 0, 600), $author, $content, $postId));
		
		return $affectedPost;
	}

/* ************ 5 . EFFACER UN ARTICLE ****************************/
	public function deletePostRequest($postId){

		$db = $this->dbConnect();

		$post = $db->prepare('DELETE FROM Posts WHERE id = ?');

		$affectedPost = $post->execute(array($postId));
		
		return $affectedPost;
	}
}