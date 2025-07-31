Personal Task Manager Pro - README

Project by Yiğit Emir Şengel  

Setup:
1. Install XAMPP (or a similar web server stack) on your machine.
2. Copy the project folder (task_manager_pro) into the XAMPP "htdocs" directory.
3. Open phpMyAdmin (http://localhost/phpmyadmin) and create a new database called "task_manager_pro".
4. Run the provided SQL queries to create the tables (users, categories, tasks).
5. In the config.php file, update the database connection settings if necessary.
6. Set the document root to the "public" folder of the project.
7. Open your browser and navigate to: http://localhost/task_manager_pro/public/index.php
8. Register a new user and test the application features (user authentication, category and task management, search, and reporting).

Features:
- User registration, login, and logout.
- Category management (add and list categories).
- Task management (create, update, delete tasks; change task status).
- Task search (by title, description, category, priority, and status).
- Task reporting (counts by status, overdue tasks, category summary).

Security:
- Passwords are hashed using password_hash().
- All database queries use PDO prepared statements to prevent SQL injection.
- Output is escaped using htmlspecialchars() to prevent XSS.

Happy coding and enjoy building your task manager!

