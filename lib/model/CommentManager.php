<?php
/**
 * My own blog.
 *
 * Comment manager
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

use \Philippe\Blog\Lib\Entities\CommentEntity;
use \Philippe\Blog\Lib\Entities\UserEntity;
class CommentManager extends Manager
{
    /**
     * Get all comments
     * 
     * @param int $postId postId
     * 
     * @return int
     */
    public function getComments($postId)
    {
        $dbProjet5 = $this->dbConnect();
        $getComments = $dbProjet5->prepare(
            'SELECT c.id, c.post_id, u.pseudo AS author, u.avatar AS avatar, c.content, c.validation, DATE_FORMAT(c.creation_date, \'%d/%m/%Y à %Hh%i\') AS creation_date_fr, DATE_FORMAT(c.last_updated, \'%d/%m/%Y à %Hh%i\') AS last_updated_fr 
			FROM Comments c
            INNER JOIN Users u ON u.id = c.author
			WHERE c.post_id = :id
			AND c.validation = 1
			ORDER BY creation_date'
        );
        $getComments->bindParam(':id', $postId);
        $getComments->execute();
        $comment = [];
        while ($data = $getComments->fetch()) {
            $comment[] = new CommentEntity($data);
        }
        $getComments->closeCursor();
        return $comment;
    }
    /**
     * Get only one comment
     * 
     * @param int $commentId commentId
     * 
     * @return int
     */
    public function getComment($commentId)
    {
        $dbProjet5 = $this->dbConnect();
        $getComment = $dbProjet5->prepare(
            'SELECT c.id, c.post_id, u.pseudo AS author, u.avatar AS avatar, c.content, c.validation, DATE_FORMAT(c.creation_date, \'%d/%m/%Y à %Hh%i\') AS creation_date_fr, DATE_FORMAT(c.last_updated, \'%d/%m/%Y à %Hh%i\') AS last_updated_fr 
		 	FROM Comments c
            INNER JOIN Users u ON u.id = c.author
		 	WHERE c.id = :id'
        );
        $getComment->bindParam(':id', $commentId);
        $getComment->execute();
        $data = $getComment->fetch();
        $comment = new CommentEntity($data);
        return $comment;
    }
    /**
     * Add a comment
     * 
     * @param int    $postId  postId
     * @param string $author  author
     * @param string $content content
     * 
     * @return mixed
     */
    public function postComment($postId, $author, $content)
    {
        $dbProjet5 = $this->dbConnect();
        $postComment = $dbProjet5->prepare('INSERT INTO Comments (post_id, author, content, validation, creation_date) VALUES(:id, :author, :content, 0, NOW())');
        $postComment->bindParam(':id', $postId);
        $postComment->bindParam(':author', $author);
        $postComment->bindParam(':content', $content);
        $postComment->execute();
        $data = $postComment->fetch();
        $addedComment = new CommentEntity($data);
        return $addedComment;
    }
    /**
     * Delete a comment
     * 
     * @param int $commentId commentId
     * 
     * @return int
     */
    public function deleteCommentRequest($commentId)
    {
        $dbProjet5 = $this->dbConnect();
        $deleteComment = $dbProjet5->prepare('DELETE FROM Comments WHERE id = :id');
        $deleteComment->bindParam(':id', $commentId);
        $deleteComment->execute();
        $data = $deleteComment->fetch();
        $deletedComment = new CommentEntity($data);
        return $deletedComment;
    }
    /**
     * Modify a comment
     * 
     * @param int    $commentId commentId
     * @param string $author    author
     * @param string $content   content
     * 
     * @return mixed
     */
    public function modifyCommentRequest($commentId, $author, $content)
    {
        $dbProjet5 = $this->dbConnect();
        $modifyComment = $dbProjet5->prepare('UPDATE Comments SET author = :author, content = :content, validation = 0, last_updated = NOW() WHERE  id = :id');
        $modifyComment->bindParam(':author', $author);
        $modifyComment->bindParam(':content', $content);
        $modifyComment->bindParam(':id', $commentId);
        $modifyComment->execute();
        $data = $modifyComment->fetch();
        $modifiedComment = new CommentEntity($data);
        return $modifiedComment;
    }
    /**
     * View comments not yet validated
     * 
     * @return mixed
     */
    public function submittedCommentRequest()
    {
        $dbProjet5 = $this->dbConnect();
        $modifyComment = $dbProjet5->prepare(
            'SELECT c.id, u.pseudo AS author, p.title AS post_id, c.content, DATE_FORMAT(c.creation_date, \'%d/%m/%Y à %Hh%i\') AS creation_date_fr, DATE_FORMAT(c.last_updated, \'%d/%m/%Y à %Hh%i\') AS last_updated_fr, c.validation
			FROM Comments c
            INNER JOIN Users u ON u.id = c.author
            INNER JOIN Posts p ON p.id = c.post_id
			WHERE c.validation = 0
			ORDER BY c.creation_date'
        );
        $modifyComment->execute(array());
        $submittedComment = [];
        while ($data = $modifyComment->fetch()) {
            $submittedComment[] = new CommentEntity($data);
        }
        $modifyComment->closeCursor();
        return $submittedComment;
    }
    /**
     * Validate a comment
     * 
     * @param int $commentId commentId
     * 
     * @return mixed
     */
    public function validateCommentRequest($commentId)
    {
        $dbProjet5 = $this->dbConnect();
        $validateComment = $dbProjet5->prepare('UPDATE Comments SET validation = 1 WHERE  id = :id');
        $validateComment->bindParam(':id', $commentId);
        $validated = $validateComment->execute();
        return $validated;
    }
    /**
     * Count validated comments
     * 
     * @param int $postId postId
     * 
     * @return int
     */
    public function countCommentRequest($postId)
    {
        $dbProjet5 = $this->dbConnect();
        $countComment = $dbProjet5->prepare("SELECT id FROM Comments WHERE post_id = :id AND validation = 1 ");
        $countComment->bindParam(':id', $postId);
        $nbCount = $countComment->execute();
        $nbCount = $countComment->rowCount();
        return $nbCount;
    }
    /**
     * Count not yet validated comments
     * 
     * @return mixed
     */
    public function countCommentBackRequest()
    {
        $dbProjet5 = $this->dbConnect();
        $countCommentBack = $dbProjet5->query("SELECT id FROM Comments WHERE validation = 0 ");
        $nbCount = $countCommentBack->rowCount();
        return $nbCount;
    }
    /**
     * Get user by comment
     * 
     * @param string $commentAuthor commentAuthor
     * 
     * @return string
     */
    public function getUserByCommentRequest($commentAuthor)
    {
        $dbProjet5 = $this->dbConnect();
        $getUserByComment = $dbProjet5->prepare('SELECT id, first_name, last_name, pseudo, password, email, confirmation_token, DATE_FORMAT(registration_date, \'%d/%m/%Y à %Hh%i\') AS registration_date_fr, authorization, is_active, avatar, description, reset_token, reset_at FROM Users WHERE pseudo = :pseudo ');
        $getUserByComment->bindParam(':pseudo', $commentAuthor);
        $getUserByComment->execute();
        $data = $getUserByComment->fetch();
        $user = new UserEntity($data);
        return $user;
    }
    /**
     * Check exist Comment
     * 
     * @param int $commentId commentId
     * 
     * @return int
     */
    public function checkExistComment($commentId)
    {
        $dbProjet5 = $this->dbConnect();
        $existComment = $dbProjet5->prepare('SELECT * FROM Comments WHERE id = :id');
        $existComment->bindParam(':id', $commentId);
        $existComment->execute();
        $isComment = $existComment->fetch();
        return $isComment;
    }
}
