<?php session_start(); ?>
<?php include 'header.php'; ?>
<h2>Categories</h2>
<a href="index.php?action=add_category">Add New Category</a>
<ul>
    <?php foreach ($categories as $cat): ?>
        <li><?php echo htmlspecialchars($cat['name']); ?></li>
    <?php endforeach; ?>
</ul>
<?php include 'footer.php'; ?>
