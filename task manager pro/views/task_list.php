<?php session_start(); ?>
<?php include 'header.php'; ?>
<h2>Tasks</h2>
<a href="index.php?action=add_task">Add New Task</a> | 
<a href="index.php?action=search">Search Tasks</a>
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
<br>
<a href="index.php?action=tasks&sort=priority">Sort by Priority</a> |
<a href="index.php?action=tasks&sort=due_date">Sort by Due Date</a> |
<a href="index.php?action=tasks&sort=status">Sort by Status</a>
<?php include 'footer.php'; ?>
