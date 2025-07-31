<?php
// controllers/TaskController.php
require_once __DIR__ . '/../models/Task.php';
require_once __DIR__ . '/../models/Category.php';

class TaskController {
    public function list() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?action=login");
            exit;
        }
        // Get the sort parameter from the URL; default is 'created_at'
        $sort = isset($_GET['sort']) ? $_GET['sort'] : 'created_at';
        // Get tasks using SQL ORDER BY through the getUserTasks method.
        $tasks = Task::getUserTasks($_SESSION['user_id'], $sort);
        include __DIR__ . '/../views/task_list.php';
    }
    
    public function add() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?action=login");
            exit;
        }
        $categories = Category::getUserCategories($_SESSION['user_id']);
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = trim($_POST['title']);
            $description = trim($_POST['description']);
            $category_id = isset($_POST['category_id']) ? $_POST['category_id'] : null;
            $priority = $_POST['priority'];
            $due_date = trim($_POST['due_date']);
            
            if (strlen($title) < 3 || strlen($title) > 100) {
                $errors[] = "Title must be between 3 and 100 characters.";
            }
            if (empty($errors)) {
                if (Task::add($_SESSION['user_id'], $category_id, $title, $description, $priority, $due_date)) {
                    header("Location: index.php?action=tasks");
                    exit;
                } else {
                    $errors[] = "Task could not be added.";
                }
            }
        }
        include __DIR__ . '/../views/add_task.php';
    }
    
    public function edit() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?action=login");
            exit;
        }
        $errors = [];
        $task = Task::getTaskById($_GET['id'], $_SESSION['user_id']);
        if (!$task) {
            die("Task not found.");
        }
        $categories = Category::getUserCategories($_SESSION['user_id']);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = trim($_POST['title']);
            $description = trim($_POST['description']);
            $category_id = isset($_POST['category_id']) ? $_POST['category_id'] : null;
            $priority = $_POST['priority'];
            $due_date = trim($_POST['due_date']);
            $status = $_POST['status'];
            
            if (strlen($title) < 3 || strlen($title) > 100) {
                $errors[] = "Title must be between 3 and 100 characters.";
            }
            if (empty($errors)) {
                if (Task::update($task['id'], $_SESSION['user_id'], $category_id, $title, $description, $priority, $due_date, $status)) {
                    header("Location: index.php?action=tasks");
                    exit;
                } else {
                    $errors[] = "Task could not be updated.";
                }
            }
        }
        include __DIR__ . '/../views/edit_task.php';
    }
    
    public function setStatus() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?action=login");
            exit;
        }
        if (isset($_GET['id']) && isset($_GET['status'])) {
            Task::setStatus($_GET['id'], $_SESSION['user_id'], $_GET['status']);
        }
        header("Location: index.php?action=tasks");
        exit;
    }
    
    public function delete() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?action=login");
            exit;
        }
        if (isset($_GET['id'])) {
            Task::delete($_GET['id'], $_SESSION['user_id']);
        }
        header("Location: index.php?action=tasks");
        exit;
    }
    
    public function search() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?action=login");
            exit;
        }
        $categories = Category::getUserCategories($_SESSION['user_id']);
        $tasks = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $term = trim($_POST['term']);
            $category = isset($_POST['category']) ? $_POST['category'] : null;
            $priority = isset($_POST['priority']) ? $_POST['priority'] : null;
            $status = isset($_POST['status']) ? $_POST['status'] : null;
            
            if (!empty($term)) {
                $tasks = Task::search($_SESSION['user_id'], $term, $category, $priority, $status);
            } else {
                header("Location: index.php?action=tasks");
                exit;
            }
        }
        include __DIR__ . '/../views/search_tasks.php';
    }
    
    public function report() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?action=login");
            exit;
        }
        $statusCounts = Task::countByStatus($_SESSION['user_id']);
        $overdueCount = Task::countOverdue($_SESSION['user_id']);
        $categorySummary = Task::categorySummary($_SESSION['user_id']);
        include __DIR__ . '/../views/report.php';
    }
}
?>
