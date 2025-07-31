<?php session_start(); ?>
<?php include 'header.php'; ?>
<h2>Search Tasks</h2>
<form method="POST" action="index.php?action=search">
    <label>Search Term: <input type="text" name="term" required></label><br>
    <label>Category:
        <select name="category">
            <option value="">Select</option>
            <?php foreach ($categories as $cat): ?>
                <option value="<?php echo $cat['id']; ?>"><?php echo htmlspecialchars($cat['name']); ?></option>
            <?php endforeach; ?>
        </select>
    </label><br>
    <label>Priority:
        <select name="priority">
            <option value="">Select</option>
            <option value="low">Low</option>
            <option value="medium">Medium</option>
            <option value="high">High</option>
        </select>
    </label><br>
    <label>Status:
        <select name="status">
            <option value="">Select</option>
            <option value="todo">Todo</option>
            <option value="in_progress">In Progress</option>
            <option value="done">Done</option>
        </select>
    </label><br>
    <button type="submit">Search</button>
</form>
<?php if (!empty($tasks)): ?>
    <h3>Search Results</h3>
    <table border="1" cellspacing="0" cellpadding="5">
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Category</th>
            <th>Priority</th>
            <th>Due Date</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($tasks as $task): ?>
        <tr>
            <td><?php echo htmlspecialchars($task['title']); ?></td>
            <td><?php echo htmlspecialchars($task['description']); ?></td>
            <td><?php echo htmlspecialchars($task['category_name']); ?></td>
            <td><?php echo htmlspecialchars($task['priority']); ?></td>
            <td><?php echo htmlspecialchars($task['due_date']); ?></td>
            <td><?php echo htmlspecialchars($task['status']); ?></td>
            <td>
                <a href="index.php?action=edit&id=<?php echo $task['id']; ?>">Edit</a> |
                <a href="index.php?action=setStatus&id=<?php echo $task['id']; ?>&status=in_progress">In Progress</a> |
                <a href="index.php?action=setStatus&id=<?php echo $task['id']; ?>&status=done">Done</a> |
                <a href="index.php?action=delete&id=<?php echo $task['id']; ?>" onclick="return confirm('Are you sure you want to delete this task?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>
<?php include 'footer.php'; ?>
