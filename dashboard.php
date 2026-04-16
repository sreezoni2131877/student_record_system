<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .dashboard {
            max-width: 600px;
            margin: 60px auto;
        }
        .dashboard h2 {
            margin-bottom: 20px;
        }
        .dashboard .btn {
            margin: 10px;
        }
    </style>
</head>
<body>
<div class="dashboard">
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
    <a href="add_student.php" class="btn">➕ Add Student</a>
    <a href="view_student.php" class="btn">📋 View Students</a>
    <a href="logout.php" class="btn">🚪 Logout</a>
</div>
</body>
</html>