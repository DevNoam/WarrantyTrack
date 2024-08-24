<?php
namespace App\controllers;

class PublicAPI
{

    private $apiVersion = 'v1';
    public function RequestHandler($request = [])
    {
        if (method_exists($this, $request[0])) {
            $method = $request[0];
            $params = array_slice($request, 1);
            
            $this->$method($params);
        } else {
            redirect('/404', 404);
        }
    }
    public function APIList()
    {
        //Get all the private methods in this class
        $methods = get_class_methods($this);
        foreach ($methods as $method) {
            if (substr($method, 0, 3) == 'Get') {
                echo "<a href='/api/$this->apiVersion/" . $method . "'>" . "● " . $method . "</a><br>";
            }
        }
    }

    
    function GetPostsAsJson()
    {
        header('Access-Control-Allow-Origin: https://noamsapir.me');
        $postController = new PostController();
        $posts = $postController->GetPosts(1000);
        echo json_encode($posts);
    }
}
