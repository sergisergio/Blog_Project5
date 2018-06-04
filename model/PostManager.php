<?php
/* **************** SUM UP *******************************
1 . GET ALL POSTS.
2 . GET ONLY ONE POST.
3 . ADD A POST.
4 . DELETE A POST.
5 . EFFACER UN ARTICLE.
6 . COUNT POSTS.
7 . SEARCH RESULTS.
******************* END SUMP UP *************************/

namespace Philippe\Blog\Model;
require_once "model/Manager.php";
// l'autoloader n'arrive pas à charger les entités en production
require_once "model/Entities/commentEntity.php";
require_once "model/Entities/postEntity.php";
require_once "model/Entities/userEntity.php";

use \Philippe\Blog\Model\Entities\PostEntity;
class PostManager extends Manager
{
 
    /* ************ 1 . GET ALL POSTS *******************/
    public function getPosts($start, $postsPerPage)
    {
        $dbProjet5 = $this->dbConnect();
        $req = $dbProjet5->query(
            'SELECT p.id, p.title, p.chapo, p.intro, p.content, u.pseudo AS author, p.file_extension, DATE_FORMAT(p.creation_date, \'%d/%m/%Y à %Hh%i\') AS creation_date_fr, DATE_FORMAT(p.last_updated, \'%d/%m/%Y à %Hh%i\') AS last_updated_fr 
			FROM Posts p
            INNER JOIN Users u ON u.id = p.author
			ORDER BY creation_date DESC LIMIT '.$start.', '.$postsPerPage
        );
        $posts = [];
        while ($data = $req->fetch()) {
            $posts[] = new PostEntity($data);
        }
        $posts1 = [];
        while ($data = $req->fetch()) {
            $posts1[] = new PostEntity($data);
        }
        $req->closeCursor();
        return $posts;
        
        $req->closeCursor();  
        return $posts1;
    }
    /* ************ 2 . GET ONLY ONE POST ***************/
    public function getPost($postId)
    {
        $dbProjet5 = $this->dbConnect();
        $req = $dbProjet5->prepare(
            'SELECT p.id, p.title, p.chapo, p.intro, p.content, u.pseudo AS author, p.file_extension, DATE_FORMAT(p.creation_date, \'%d/%m/%Y à %Hh%i\') AS creation_date_fr, DATE_FORMAT(p.last_updated, \'%d/%m/%Y à %Hh%i\') AS last_updated_fr 
			FROM Posts p
            INNER JOIN Users u ON u.id = p.author
			WHERE p.id = :id'
        );
        $req->bindParam(':id', $postId);
        $req->execute();
        $data = $req->fetch();
        $post = new PostEntity($data);
        return $post;
    }
    /* ************ 3 . ADD A POST **********************/
    public function addPostRequest($title, $chapo, $author, $content, $image)
    {
        $dbProjet5 = $this->dbConnect();
        $post = $dbProjet5->prepare('INSERT INTO Posts(title, chapo, intro, author, content, file_extension, creation_date) VALUES(:title, :chapo, :intro, :author, :content, :image, NOW()) ');
        $intro = substr($content, 0, 600);
        $post->bindParam(':title', $title);
        $post->bindParam(':chapo', $chapo);
        $post->bindParam(':intro', $intro);
        $post->bindParam(':author', $author);
        $post->bindParam(':content', $content);
        $post->bindParam(':image', $image);
        $affectedPost = $post->execute();
        return $affectedPost;
    }
    /* ************ 4 . MODIFY A POST *******************/
    public function modifyPostRequest($postId, $title, $chapo, $author, $content)
    {
        $dbProjet5 = $this->dbConnect();
        $post = $dbProjet5->prepare('UPDATE Posts SET title = :title, intro = :intro, chapo = :chapo, author = :author, content = :content, last_updated = NOW() WHERE id = :id');
        $intro = substr($content, 0, 600);
        $post->bindParam(':title', $title);
        $post->bindParam(':intro', $intro);
        $post->bindParam(':chapo', $chapo);
        $post->bindParam(':author', $author);
        $post->bindParam(':content', $content);
        $post->bindParam(':id', $postId);
        $affectedPost = $post->execute();
        return $affectedPost;
    }
    /* ************ 5 . DELETE A POST *******************/
    public function deletePostRequest($postId)
    {
        $dbProjet5 = $this->dbConnect();
        $post = $dbProjet5->prepare('DELETE FROM Posts WHERE id = :id');
        $post->bindParam(':id', $postId);
        $affectedPost = $post->execute();
        return $affectedPost;
    }
    /* ************ 6 . COUNT POSTS *********************/
    public function countPosts()
    {
        $dbProjet5 = $this->dbConnect();
        $postsTotalReq  = $dbProjet5->query('SELECT id FROM Posts');
        $postsTotal = $postsTotalReq->rowCount();
        return $postsTotal;
    }
    /* ************ 7 . COUNT SEARCH RESULTS ************/
    public function countSearchRequest($search)
    {

        $dbProjet5 = $this->dbConnect();

        $countSearchResults  = $dbProjet5->query("SELECT id, title, chapo, content FROM Posts WHERE content LIKE '%$search%' ");

        return $countSearchResults;
    }
    /* ************ 8 . SEARCH RESULTS ******************/
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
}