<?php session_start(); ?>
<?php include 'header.php'; ?>
<h2>Add New Task</h2>
<?php if (isset($errors) && !empty($errors)): ?>
    <ul style="color:red;">
        <?php foreach ($errors as $error): ?>
            <li><?php echo htmlspecialchars($error); ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
<form method="POST" action="index.php?action=add_task">
    <label>Title: <input type="text" name="title" required></label><br>
    <label>Description: <textarea name="description"></textarea></label><br>
    <label>Category:
        <select name="category_id">
            <option value="">Select</option>
            <?php foreach ($categories as $cat): ?>
                <option value="<?php echo $cat['id']; ?>"><?php echo htmlspecialchars($cat['name']); ?></option>
            <?php endforeach; ?>
        </select>
    </label><br>
    <label>Priority:
        <select name="priority">
            <option value="low">Low</option>
            <option value="medium" selected>Medium</option>
            <option value="high">High</option>
        </select>
    </label><br>
    <label>Due Date (YYYY-MM-DD HH:MM:SS): <input type="text" name="due_date"></label><br>
    <button type="submit">Add Task</button>
</form>
<?php include 'footer.php'; ?>
