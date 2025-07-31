<?php
// public/index.php
require_once __DIR__ . '/../config.php';

// Autoload classes from controllers and models
spl_autoload_register(function($class){
    $paths = ['../controllers/', '../models/'];
    foreach ($paths as $path) {
        $file = $path . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

// Determine the action to perform
$action = isset($_GET['action']) ? $_GET['action'] : 'login';

switch ($action) {
    case 'register':
        $controller = new UserController();
        $controller->register();
        break;
    case 'login':
        $controller = new UserController();
        $controller->login();
        break;
    case 'logout':
        $controller = new UserController();
        $controller->logout();
        break;
    case 'category_list':
        $controller = new CategoryController();
        $controller->list();
        break;
    case 'add_category':
        $controller = new CategoryController();
        $controller->add();
        break;
    case 'tasks':
        $controller = new TaskController();
        $controller->list();
        break;
    case 'add_task':
        $controller = new TaskController();
        $controller->add();
        break;
    case 'edit':
        $controller = new TaskController();
        $controller->edit();
        break;
    case 'setStatus':
        $controller = new TaskController();
        $controller->setStatus();
        break;
    case 'delete':
        $controller = new TaskController();
        $controller->delete();
        break;
    case 'search':
        $controller = new TaskController();
        $controller->search();
        break;
    case 'report':
        $controller = new TaskController();
        $controller->report();
        break;
    default:
        echo "Invalid action.";
        break;
}
?>
