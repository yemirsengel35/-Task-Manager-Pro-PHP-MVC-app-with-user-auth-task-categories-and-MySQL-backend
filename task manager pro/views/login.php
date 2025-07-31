<?php session_start(); ?>
<?php include 'header.php'; ?>
<h2>Login</h2>
<?php if (isset($errors) && !empty($errors)): ?>
    <ul style="color:red;">
        <?php foreach ($errors as $error): ?>
            <li><?php echo htmlspecialchars($error); ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
<form method="POST" action="index.php?action=login">
    <label>Username: <input type="text" name="username" required></label><br>
    <label>Password: <input type="password" name="password" required></label><br>
    <button type="submit">Login</button>
</form>
<p>Don't have an account? <a href="index.php?action=register">Register</a></p>
<?php include 'footer.php'; ?>
