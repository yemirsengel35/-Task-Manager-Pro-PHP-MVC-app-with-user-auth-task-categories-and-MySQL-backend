<?php
// controllers/UserController.php
require_once __DIR__ . '/../models/User.php';

class UserController {
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = trim($_POST['username']);
            $email = trim($_POST['email']);
            $password = $_POST['password'];
            $errors = [];
            
            if (strlen($username) < 3 || strlen($username) > 50) {
                $errors[] = "Username must be between 3 and 50 characters.";
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Please enter a valid email address.";
            }
            if (strlen($password) < 6) {
                $errors[] = "Password must be at least 6 characters long.";
            }
            
            if (empty($errors)) {
                if (User::register($username, $email, $password)) {
                    header("Location: index.php?action=login");
                    exit;
                } else {
                    $errors[] = "Username or email is already taken.";
                }
            }
        }
        include __DIR__ . '/../views/register.php';
    }
    
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = trim($_POST['username']);
            $password = $_POST['password'];
            $errors = [];
            
            if (empty($username) || empty($password)) {
                $errors[] = "All fields are required.";
            } else {
                $user_id = User::login($username, $password);
                if ($user_id) {
                    session_start();
                    $_SESSION['user_id'] = $user_id;
                    header("Location: index.php?action=tasks");
                    exit;
                } else {
                    $errors[] = "Incorrect username or password.";
                }
            }
        }
        include __DIR__ . '/../views/login.php';
    }
    
    public function logout() {
        session_start();
        session_destroy();
        header("Location: index.php?action=login");
        exit;
    }
}
?>
