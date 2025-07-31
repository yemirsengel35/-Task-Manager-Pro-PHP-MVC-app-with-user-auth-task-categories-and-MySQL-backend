<?php
// controllers/CategoryController.php
require_once __DIR__ . '/../models/Category.php';

class CategoryController {
    public function list() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?action=login");
            exit;
        }
        $categories = Category::getUserCategories($_SESSION['user_id']);
        include __DIR__ . '/../views/category_list.php';
    }
    
    public function add() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?action=login");
            exit;
        }
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = trim($_POST['name']);
            if (strlen($name) < 3 || strlen($name) > 50) {
                $errors[] = "Category name must be between 3 and 50 characters.";
            }
            if (empty($errors)) {
                if (Category::add($_SESSION['user_id'], $name)) {
                    header("Location: index.php?action=category_list");
                    exit;
                } else {
                    $errors[] = "This category already exists.";
                }
            }
        }
        include __DIR__ . '/../views/add_category.php';
    }
}
?>
