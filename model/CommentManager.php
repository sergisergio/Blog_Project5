<?php

namespace Philippe\Blog\Model;

require_once("model/Manager.php");

class CommentManager extends Manager
{
	public function getComments($postId)
	{
		$db = $this->dbConnect();
		$comments = $db->prepare('SELECT id, member_pseudo, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr 
			FROM Comment 
			WHERE post_id = ?
			ORDER BY creation_date DESC LIMIT 0, 5');
		$comments->execute(array($postId));
		return $comments;
	}

	public function getComment($postId){
		$db = $this->dbConnect();
		
	}

	public function postComment($postId, $memberPseudo, $comment){
		$db = $this->dbConnect();
		$postedcomment = $db->prepare('INSERT INTO Comment(post_id, member_pseudo, comment, creation_date) VALUES(?, ?, ?, NOW())');
		$addedComment = $postedcomment->execute(array($postId, $memberPseudo, $comment));

        return $addedComment;
	}

	public function modifyComment(){
		$db = $this->dbConnect();
	}

	public function deleteComment(){
		$db = $this->dbConnect();
	}
}