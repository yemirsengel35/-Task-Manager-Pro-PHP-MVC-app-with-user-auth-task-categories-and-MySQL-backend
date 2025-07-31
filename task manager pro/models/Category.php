<?php
// models/Category.php
require_once __DIR__ . '/../config.php';

class Category {
    public static function add($user_id, $name) {
        global $pdo;
        // Ensure the category name is unique per user
        $stmt = $pdo->prepare("SELECT id FROM categories WHERE user_id = :user_id AND name = :name");
        $stmt->execute([':user_id' => $user_id, ':name' => $name]);
        if ($stmt->fetch()) {
            return false;
        }
        $stmt = $pdo->prepare("INSERT INTO categories (user_id, name) VALUES (:user_id, :name)");
        return $stmt->execute([':user_id' => $user_id, ':name' => $name]);
    }

    public static function getUserCategories($user_id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM categories WHERE user_id = :user_id");
        $stmt->execute([':user_id' => $user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
