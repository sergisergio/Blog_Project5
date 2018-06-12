<?php

namespace Philippe\Blog\Model;
require_once "model/Manager.php";

use \Philippe\Blog\Model\Entities\PostEntity;
class PostManager extends Manager
{
    /**
     * Function getPosts
     * 
     * @param start        $start        start
     * @param postsPerPage $postsPerPage postsPerPage
     * 
     * @return [type]
     */
    public function getPosts($start, $postsPerPage)
    {
        $dbProjet5 = $this->dbConnect();
        $getPosts = $dbProjet5->query(
            'SELECT p.id, p.title, p.chapo, p.intro, p.content, u.pseudo AS author, p.category_id, p.file_extension, DATE_FORMAT(p.creation_date, \'%d/%m/%Y à %Hh%i\') AS creation_date_fr, DATE_FORMAT(p.last_updated, \'%d/%m/%Y à %Hh%i\') AS last_updated_fr 
			FROM Posts p
            INNER JOIN Users u ON u.id = p.author
			ORDER BY creation_date DESC LIMIT '.$start.', '.$postsPerPage
        );
        $posts = [];
        while ($data = $getPosts->fetch()) {
            $posts[] = new PostEntity($data);
        }
        $getPosts->closeCursor();
        return $posts;
    }
    /**
     * Function getPost
     * 
     * @param postId $postId post's id
     * 
     * @return [type]
     */
    public function getPost($postId)
    {
        $dbProjet5 = $this->dbConnect();
        $getPost = $dbProjet5->prepare(
            'SELECT p.id, p.title, p.chapo, p.intro, p.content, u.pseudo AS author, p.category_id, p.file_extension, DATE_FORMAT(p.creation_date, \'%d/%m/%Y à %Hh%i\') AS creation_date_fr, DATE_FORMAT(p.last_updated, \'%d/%m/%Y à %Hh%i\') AS last_updated_fr 
			FROM Posts p
            INNER JOIN Users u ON u.id = p.author
			WHERE p.id = :id'
        );
        $getPost->bindParam(':id', $postId);
        $getPost->execute();
        $data = $getPost->fetch();
        $post = new PostEntity($data);
        return $post;
    }
    /**
     * Function addPostRequest
     * 
     * @param title    $title    title
     * @param chapo    $chapo    chapo
     * @param author   $author   author
     * @param content  $content  content
     * @param category $category category
     * @param image    $image    image
     *
     * @return [type]
     */
    public function addPostRequest($title, $chapo, $author, $content, $category, $image)
    {
        $dbProjet5 = $this->dbConnect();
        $getIdCat = $dbProjet5->query('SELECT c.category_id AS category_id FROM Posts p INNER JOIN Category c ON c.category_id = p.category_id ');
        $addPost = $dbProjet5->prepare('INSERT INTO Posts(title, chapo, intro, author, content, category_id, file_extension, creation_date) VALUES(:title, :chapo, :intro, :author, :content, :category, :image,  NOW()) ');
        $category = (int)$category;
        $intro = substr($content, 0, 600);
        $addPost->bindParam(':title', $title);
        $addPost->bindParam(':chapo', $chapo);
        $addPost->bindParam(':intro', $intro);
        $addPost->bindParam(':author', $author);
        $addPost->bindParam(':content', $content);
        $addPost->bindParam(':category', $category);
        $addPost->bindParam(':image', $image);
        $addPost->execute();
         
        $data = $addPost->fetch();
        $addedPost = new PostEntity($data);
        return $addedPost;
    }
    /**
     * Function modifyPostRequest
     * 
     * @param postId  $postId  the post's id
     * @param title   $title   title
     * @param chapo   $chapo   chapo
     * @param author  $author  author
     * @param content $content content
     * 
     * @return [type]
     */
    public function modifyPostRequest($postId, $title, $chapo, $author, $content)
    {
        $dbProjet5 = $this->dbConnect();
        $modifyPost = $dbProjet5->prepare('UPDATE Posts SET title = :title, intro = :intro, chapo = :chapo, author = :author, content = :content, last_updated = NOW() WHERE id = :id');
        $intro = substr($content, 0, 600);
        $modifyPost->bindParam(':title', $title);
        $modifyPost->bindParam(':intro', $intro);
        $modifyPost->bindParam(':chapo', $chapo);
        $modifyPost->bindParam(':author', $author);
        $modifyPost->bindParam(':content', $content);
        $modifyPost->bindParam(':id', $postId);
        $modifyPost->execute();
        $data = $modifyPost->fetch();
        $modifiedPost = new PostEntity($data);
        return $modifiedPost;
    }
    /**
     * Function deletePostRequest
     * 
     * @param postId $postId the post's id
     * 
     * @return [type]
     */
    public function deletePostRequest($postId)
    {
        $dbProjet5 = $this->dbConnect();
        $deletePost = $dbProjet5->prepare('DELETE FROM Posts WHERE id = :id');
        $deletePost->bindParam(':id', $postId);
        $deletePost->execute();
        $data = $deletePost->fetch();
        $deletedPost = new PostEntity($data);
        return $deletedPost;
    }
    /**
     * Function countPosts
     * 
     * @return [type]
     */
    public function countPosts()
    {
        $dbProjet5 = $this->dbConnect();
        $postsTotalReq  = $dbProjet5->query('SELECT id FROM Posts');
        $postsTotal = $postsTotalReq->rowCount();
        return $postsTotal;
    }
    /**
     * Function countSearchRequest
     * 
     * @param search $search search
     * 
     * @return [type]
     */
    public function countSearchRequest($search)
    {
        $dbProjet5 = $this->dbConnect();
        $countSearchResults  = $dbProjet5->query("SELECT id, title, chapo, content FROM Posts WHERE content LIKE '%$search%' ");
        return $countSearchResults;
    }
    /**
     * Function searchRequest
     * 
     * @param search $search search
     * 
     * @return [type]
     */
    public function searchRequest($search)
    {
        $dbProjet5 = $this->dbConnect();
        $results  = $dbProjet5->prepare(" SELECT id, title, intro, chapo, content, author, file_extension, creation_date AS creation_date_fr, last_updated AS last_updated_fr FROM Posts WHERE content LIKE '%$search%' ORDER BY id DESC ");
        $results->execute();
        $searchResults = [];
        while ($data = $results->fetch()) {
            $searchResults[] = new PostEntity($data);
        }
        $results->closeCursor(); 
        return $searchResults;
    }
    /**
     * Function checkExistPost
     * 
     * @param postId $postId postId
     * 
     * @return [type]
     */
    public function checkExistPost($postId)
    {
        $dbProjet5 = $this->dbConnect();
        $existPost = $dbProjet5->prepare('SELECT * FROM Posts WHERE id = :id');
        $existPost->bindParam(':id', $postId);
        $existPost->execute();
        $isPost = $existPost->fetch();
        return $isPost;
    }
    /**
     * Function categoryResultsRequest
     * 
     * @param categoryId $categoryId categoryId
     * 
     * @return [type]
     */
    function categoryResultsRequest($categoryId)
    {
        $dbProjet5 = $this->dbConnect();
        $catResults  = $dbProjet5->prepare(' SELECT id, title, author, file_extension, category_id, chapo, intro, content, creation_date AS creation_date_fr, last_updated AS last_updated_fr FROM Posts WHERE category_id = :id ORDER BY id DESC ');
        $catResults->bindParam(':id', $categoryId);
        $catResults->execute();
        $cResults = [];
        while ($data = $catResults->fetch()) {
            $cResults[] = new PostEntity($data);
        }
        $catResults->closeCursor(); 
        return $cResults;
    }
}