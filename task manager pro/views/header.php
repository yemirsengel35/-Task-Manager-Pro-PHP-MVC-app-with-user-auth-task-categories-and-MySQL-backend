<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Personal Task Manager Pro</title>
</head>
<body>
    <header>
        <h1>Personal Task Manager Pro</h1>
        <?php if (isset($_SESSION['user_id'])): ?>
            <nav>
                <a href="index.php?action=tasks">Tasks</a> |
                <a href="index.php?action=category_list">Categories</a> |
                <a href="index.php?action=report">Report</a> |
                <a href="index.php?action=logout">Logout</a>
            </nav>
        <?php endif; ?>
        <hr>
    </header>
