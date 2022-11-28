<?php

namespace App\Controller;

use App\Factory\PDOFactory;
use App\Manager\UserManager;
use App\Route\Route;

class SecurityController extends AbstractController
{
    #[Route('/login', name: "login", methods: ["GET","POST"])]
    public function login()
    {
        session_start();
        if (!($_SESSION|| isset($_POST['username']))) {
            $path = "src/ui/login.php";
            require_once $path;
        } else if($_SESSION) {
            header("Location: /");
            exit;
        }
        else {
        $formUsername = $_POST['username'];
        $formPwd = $_POST['password'];
        $userManager = new UserManager(new PDOFactory());
        $user = $userManager->getByUsername($formUsername);

        if (!$user) {
            header("Location: /?error=notfound");
            exit;
        }
        if ($user->passwordMatch($formPwd)) {
            $id = $user->getId();
            $_SESSION["admin"] = $user->getRoles();
            $_SESSION["id"] = $id;
        }

        header("Location: /");
        exit;
        }
    }
    #[Route('/signup', name: "signup", methods: ["GET","POST"])]
    public function signup() {
        session_start();
        if (!($_SESSION || isset($_POST['username']))) {
            $path = "src/ui/signup.php";
            require_once $path;
        } else if(isset($_POST['username'])){
            $formUsername = $_POST['username'];
            $formPwd = $_POST['password'];
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];
            $gender = $_POST['gender'];
            if (isset($_POST['admin'])) {
                $admin = 1;
            }else { $admin = 0; };
            $userManager = new UserManager(new PDOFactory());
            $userManager->insertUser($formUsername,$formPwd,$firstname,$lastname,$email,$admin,$gender);
            header("Location: /login");
            exit; 
            
        }
        else{
            header("Location: /");
            exit; 
        }
    }
    #[Route('/logout', name: "logout", methods: ["GET","POST"])]
    public function logout() {
        session_start();
        unset($_SESSION['id']);
        session_destroy();
        header('Location: /login');
        exit(); 
    }
    #[Route('/users', name: "users", methods: ["GET","POST"])]
    public function users() {
        session_start();
        if($_SESSION && $_SESSION['admin'] ==1 ) {
            $path = "src/views/users.php";
            require_once $path;
        }else {
            header('Location: /login');
            exit(); 
        }
    }
}
