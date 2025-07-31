<?php
// config.php

$dbHost = 'localhost';
$dbName = 'task_manager_pro'; // Make sure to create this database in phpMyAdmin
$dbUser = 'root';             // Default XAMPP username
$dbPass = '';                 // Default XAMPP password is usually empty

try {
    $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUser, $dbPass);
    // Enable exceptions for errors
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
