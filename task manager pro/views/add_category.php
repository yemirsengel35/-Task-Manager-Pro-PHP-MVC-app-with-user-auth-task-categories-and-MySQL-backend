<?php session_start(); ?>
<?php include 'header.php'; ?>
<h2>Add New Category</h2>
<?php if (isset($errors) && !empty($errors)): ?>
    <ul style="color:red;">
        <?php foreach ($errors as $error): ?>
            <li><?php echo htmlspecialchars($error); ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
<form method="POST" action="index.php?action=add_category">
    <label>Category Name: <input type="text" name="name" required></label><br>
    <button type="submit">Add</button>
</form>
<?php include 'footer.php'; ?>
