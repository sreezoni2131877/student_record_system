<?php
session_start();
include("db.php");

$id = (int)$_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM students WHERE id=$id");
$student = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST['student_id'];
    $course = $_POST['course'];
    $enrol_date = $_POST['enrol_date'];
    $cgpa = $_POST['cgpa'];
    $attendance = $_POST['attendance'];
    $department = $_POST['department'];

    mysqli_query($conn, "UPDATE students SET 
        student_id='$student_id',
        course='$course',
        enrol_date='$enrol_date',
        cgpa='$cgpa',
        attendance='$attendance',
        department='$department'
        WHERE id=$id");

    header("Location: view_student.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="card">
    <h2>Edit Student</h2>
    <form method="POST">
        <input type="text" name="student_id" value="<?php echo htmlspecialchars($student['student_id']); ?>" required><br>
        <input type="text" name="course" value="<?php echo htmlspecialchars($student['course']); ?>" required><br>
        <input type="date" name="enrol_date" value="<?php echo htmlspecialchars($student['enrol_date']); ?>" required><br>
        <input type="number" step="0.01" name="cgpa" value="<?php echo htmlspecialchars($student['cgpa']); ?>" required><br>
        <input type="number" name="attendance" value="<?php echo htmlspecialchars($student['attendance']); ?>" required><br>
        <input type="text" name="department" value="<?php echo htmlspecialchars($student['department']); ?>" required><br>
        <button type="submit">Save Changes</button>
    </form>
    <br>
    <a href="view_student.php" class="btn">⬅ Back to Students</a>
</div>
</body>
</html>