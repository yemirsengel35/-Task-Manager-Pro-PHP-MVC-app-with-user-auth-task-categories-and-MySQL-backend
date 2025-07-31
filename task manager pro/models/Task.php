<?php
// models/Task.php
require_once __DIR__ . '/../config.php';

class Task {
    public static function add($user_id, $category_id, $title, $description, $priority, $due_date) {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO tasks (user_id, category_id, title, description, priority, due_date, status) VALUES (:user_id, :category_id, :title, :description, :priority, :due_date, 'todo')");
        return $stmt->execute([
            ':user_id' => $user_id,
            ':category_id' => $category_id ? $category_id : null,
            ':title' => $title,
            ':description' => $description,
            ':priority' => $priority,
            ':due_date' => $due_date ? $due_date : null
        ]);
    }

    // Updated method: now uses SQL ORDER BY for sorting.
    public static function getUserTasks($user_id, $sortField = 'created_at') {
        global $pdo;
        // Define valid sort fields to prevent SQL injection.
        $validSortFields = ['priority', 'due_date', 'status', 'created_at'];
        if (!in_array($sortField, $validSortFields)) {
            $sortField = 'created_at';
        }
        // ORDER BY is used directly in the SQL query.
        $stmt = $pdo->prepare("
            SELECT tasks.*, categories.name AS category_name 
            FROM tasks 
            LEFT JOIN categories ON tasks.category_id = categories.id 
            WHERE tasks.user_id = :user_id 
            ORDER BY $sortField ASC
        ");
        $stmt->execute([':user_id' => $user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getTaskById($id, $user_id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM tasks WHERE id = :id AND user_id = :user_id");
        $stmt->execute([':id' => $id, ':user_id' => $user_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function update($id, $user_id, $category_id, $title, $description, $priority, $due_date, $status) {
        global $pdo;
        $completed_at = ($status == 'done') ? date("Y-m-d H:i:s") : null;
        $stmt = $pdo->prepare("UPDATE tasks SET category_id = :category_id, title = :title, description = :description, priority = :priority, due_date = :due_date, status = :status, completed_at = :completed_at WHERE id = :id AND user_id = :user_id");
        return $stmt->execute([
            ':category_id' => $category_id ? $category_id : null,
            ':title' => $title,
            ':description' => $description,
            ':priority' => $priority,
            ':due_date' => $due_date ? $due_date : null,
            ':status' => $status,
            ':completed_at' => $completed_at,
            ':id' => $id,
            ':user_id' => $user_id
        ]);
    }

    public static function delete($id, $user_id) {
        global $pdo;
        $stmt = $pdo->prepare("DELETE FROM tasks WHERE id = :id AND user_id = :user_id");
        return $stmt->execute([':id' => $id, ':user_id' => $user_id]);
    }

    public static function setStatus($id, $user_id, $status) {
        global $pdo;
        $completed_at = ($status == 'done') ? date("Y-m-d H:i:s") : null;
        $stmt = $pdo->prepare("UPDATE tasks SET status = :status, completed_at = :completed_at WHERE id = :id AND user_id = :user_id");
        return $stmt->execute([':status' => $status, ':completed_at' => $completed_at, ':id' => $id, ':user_id' => $user_id]);
    }

    public static function search($user_id, $term, $category = null, $priority = null, $status = null) {
        global $pdo;
        $sql = "SELECT tasks.*, categories.name AS category_name FROM tasks LEFT JOIN categories ON tasks.category_id = categories.id WHERE tasks.user_id = :user_id AND (title LIKE :term OR description LIKE :term)";
        $params = [':user_id' => $user_id, ':term' => '%' . $term . '%'];
        
        if ($category) {
            $sql .= " AND category_id = :category";
            $params[':category'] = $category;
        }
        if ($priority) {
            $sql .= " AND priority = :priority";
            $params[':priority'] = $priority;
        }
        if ($status) {
            $sql .= " AND status = :status";
            $params[':status'] = $status;
        }
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Reporting methods
    public static function countByStatus($user_id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT status, COUNT(*) as count FROM tasks WHERE user_id = :user_id GROUP BY status");
        $stmt->execute([':user_id' => $user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function countOverdue($user_id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT COUNT(*) as count FROM tasks WHERE user_id = :user_id AND due_date < NOW() AND status != 'done'");
        $stmt->execute([':user_id' => $user_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    }

    public static function categorySummary($user_id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT c.name, COUNT(t.id) as total, SUM(CASE WHEN t.status = 'done' THEN 1 ELSE 0 END) as done FROM categories c LEFT JOIN tasks t ON c.id = t.category_id WHERE c.user_id = :user_id GROUP BY c.id");
        $stmt->execute([':user_id' => $user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
