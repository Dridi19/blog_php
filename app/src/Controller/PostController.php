<?php

namespace App\Controller;

use App\Factory\PDOFactory;
use App\Manager\PostManager;
use App\Manager\UserManager;
use App\Route\Route;

class PostController extends AbstractController
{
    #[Route('/', name: "homepage", methods: ["GET","POST"])]
    public function home()
    {
        session_start();
        $manger = new PostManager(new PDOFactory());
        if (isset($_POST['content'])) {
            $id = $_SESSION["id"];
            $manger->createPost($id,$_POST['content']);
            header("Location: /");
            exit;
        }
        $posts = $manger->getAllPosts();
        $this->render("home.php", [
            "posts" => $posts,
            "trucs" => "Posts"
        ], "Tous les posts");


    }

    /**
     * @param $id
     * @param $task
     * @param $machin
     * @return void
     */
    #[Route('/post/{id}/{task}', name: "francis", methods: ["GET","POST"])]
    public function showOne($id, $task)
    {
        session_start();
        $manger = new PostManager(new PDOFactory());
        if ($task === 'delete') {
            $manger->deletePost($id);
            header("Location: /");
            exit;
        }
        if ($task === 'update') {
            $post = $manger->getPost($id);
            $postContent =  $post->getContent();
            if (isset($_POST['newPostContent'])) {
                $manger->updatePost($id,$_POST['newPostContent']);
                header("Location: /");
                exit;
            }
            $this->render("updatePost.php", [
                "postContent" => $postContent,
            ], "Tous les posts");
            
        }
        // var_dump($id, $task);
    }
}
