<?php session_start(); ?>
<?php include 'header.php'; ?>
<h2>Register</h2>
<?php if (isset($errors) && !empty($errors)): ?>
    <ul style="color:red;">
        <?php foreach ($errors as $error): ?>
            <li><?php echo htmlspecialchars($error); ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
<form method="POST" action="index.php?action=register">
    <label>Username: <input type="text" name="username" required></label><br>
    <label>Email: <input type="email" name="email" required></label><br>
    <label>Password: <input type="password" name="password" required></label><br>
    <button type="submit">Register</button>
</form>
<p>Already have an account? <a href="index.php?action=login">Login</a></p>
<?php include 'footer.php'; ?>
