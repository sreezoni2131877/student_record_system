<?php
session_start();
include("db.php");

// Only allow logged-in users
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST['student_id'];
    $course = $_POST['course'];
    $enrol_date = $_POST['enrol_date'];
    $cgpa = $_POST['cgpa'];
    $attendance = $_POST['attendance'];
    $department = $_POST['department'];

    $sql = "INSERT INTO students (student_id, course, enrol_date, cgpa, attendance, department) 
            VALUES ('$student_id','$course','$enrol_date','$cgpa','$attendance','$department')";
    if (mysqli_query($conn, $sql)) {
        header("Location: view_student.php"); // redirect to student list
        exit();
    } else {
        $error = "Error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="card">
    <h2>Add Student</h2>
    <form method="POST">
        <input type="text" name="student_id" placeholder="Student ID" required><br>
        <input type="text" name="course" placeholder="Course" required><br>
        <input type="date" name="enrol_date" required><br>
        <input type="number" step="0.01" name="cgpa" placeholder="CGPA" required><br>
        <input type="number" name="attendance" placeholder="Attendance %" required><br>
        <input type="text" name="department" placeholder="Department" required><br>
        <button type="submit">Add Student</button>
    </form>
    <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <br>
    <a href="dashboard.php" class="btn">⬅ Back to Dashboard</a>
</div>
</body>
</html>