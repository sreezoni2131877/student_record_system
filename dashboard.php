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
            text-align: center;
        }
        .dashboard h2 {
            margin-bottom: 20px;
        }
        .dashboard .btn {
            display: inline-block;
            margin: 10px;
            padding: 10px 20px;
            background: #007BFF;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }
        .dashboard .btn:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
<div class="dashboard">
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>

    <!-- Student Section -->
    <a href="add_student.php" class="btn">➕ Add Student</a>
    <a href="view_student.php" class="btn">📋 View Students</a>

    <!-- Course Section -->
    <a href="add_course.php" class="btn">➕ Add Course</a>
    <a href="view_course.php" class="btn">📚 View Courses</a>

    <!-- Enrollment Section -->
    <a href="add_enrollment.php" class="btn">➕ Add Enrollment</a>
    <a href="view_enrollment.php" class="btn">📖 View Enrollments</a>

    <!-- Logout -->
    <a href="logout.php" class="btn">🚪 Logout</a>
</div>
</body>
</html>
