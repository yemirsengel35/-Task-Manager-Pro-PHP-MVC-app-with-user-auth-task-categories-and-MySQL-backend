<?php session_start(); ?>
<?php include 'header.php'; ?>
<h2>Edit Task</h2>
<?php if (isset($errors) && !empty($errors)): ?>
    <ul style="color:red;">
        <?php foreach ($errors as $error): ?>
            <li><?php echo htmlspecialchars($error); ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
<form method="POST" action="index.php?action=edit&id=<?php echo $task['id']; ?>">
    <label>Title: <input type="text" name="title" value="<?php echo htmlspecialchars($task['title']); ?>" required></label><br>
    <label>Description: <textarea name="description"><?php echo htmlspecialchars($task['description']); ?></textarea></label><br>
    <label>Category:
        <select name="category_id">
            <option value="">Select</option>
            <?php foreach ($categories as $cat): ?>
                <option value="<?php echo $cat['id']; ?>" <?php if ($task['category_id'] == $cat['id']) echo "selected"; ?>><?php echo htmlspecialchars($cat['name']); ?></option>
            <?php endforeach; ?>
        </select>
    </label><br>
    <label>Priority:
        <select name="priority">
            <option value="low" <?php if ($task['priority'] == 'low') echo "selected"; ?>>Low</option>
            <option value="medium" <?php if ($task['priority'] == 'medium') echo "selected"; ?>>Medium</option>
            <option value="high" <?php if ($task['priority'] == 'high') echo "selected"; ?>>High</option>
        </select>
    </label><br>
    <label>Due Date (YYYY-MM-DD HH:MM:SS): <input type="text" name="due_date" value="<?php echo htmlspecialchars($task['due_date']); ?>"></label><br>
    <label>Status:
        <select name="status">
            <option value="todo" <?php if ($task['status'] == 'todo') echo "selected"; ?>>Todo</option>
            <option value="in_progress" <?php if ($task['status'] == 'in_progress') echo "selected"; ?>>In Progress</option>
            <option value="done" <?php if ($task['status'] == 'done') echo "selected"; ?>>Done</option>
        </select>
    </label><br>
    <button type="submit">Update Task</button>
</form>
<?php include 'footer.php'; ?>
