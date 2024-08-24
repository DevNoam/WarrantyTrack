<?php
namespace App\controllers;
use Framework\Database;
use Framework\Router;
use Framework\Session;


/**
 * Home controller
 * Related to home page
*/
class HomeController
{
    protected $db;
    
    public function __construct()
    {
        $this->db = Database::$db;
    }

    public function index()
    {
        $postController = new PostController();
        $posts = $postController->GetPosts(3);
        loadView('home', ['posts' => $posts, 'database' => $this->db]);
    }

    /**
     * Load archive
     * 
     * @return void
     */
    function archive()
    {
        $query = "SELECT * FROM posts WHERE publish = 1 ORDER BY sticky DESC, publish_date DESC;";
        $stmt = $this->db->query($query);
        $posts = $stmt->fetchAll();
    
        loadView('archive', ['posts' => $posts, 'database' => $this->db]);
    }

    /**
     * Fetch specific post and show
     * 
     * @param array $params (postId)
     * 
     * @return void
     */
    function fetchPost($params)
    {
        $postId = $params[0] ?? null;
    
        $query = "SELECT posts.*, users.displayName AS authorDisplayName, users.authorImage AS authorImage,  users.favLink AS authorfavLink FROM posts JOIN users ON posts.author = users.id WHERE posts.postName = '$postId';;";
        $stmt =  $this->db->query($query);
        $post = $stmt->fetch();
        
        if (isset($post->publish) && $post->publish == 1 || Session::get('user')['displayName'] == $post->authorDisplayName) 
        {
            loadView('post', ['post' => $post, 'database' => $this->db]);
        } 
        else 
        {
            (new Router)->error(404);
        }
    }
    function thanks(){
        loadView('thanks', ['database' => $this->db]);
    }
}