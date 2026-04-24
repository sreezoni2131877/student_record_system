<?php
session_start();
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student = $_POST['student_id'];
    $course = $_POST['course_id'];
    $semester = $_POST['semester'];
    $year = $_POST['year'];
    $grade = $_POST['grade'];

    $sql = "INSERT INTO enrollment (StudentID, CourseID, Semester, Year, Grade)
            VALUES ('$student', '$course', '$semester', '$year', '$grade')";
    if (mysqli_query($conn, $sql)) {
        header("Location: view_enrollment.php");
        exit();
    } else {
        $error = "Error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Add Enrollment</title></head>
<body>
<h2>Add Enrollment</h2>
<form method="POST">
    <input type="number" name="student_id" placeholder="Student ID" required><br>
    <input type="number" name="course_id" placeholder="Course ID" required><br>
    <input type="text" name="semester" placeholder="Semester" required><br>
    <input type="number" name="year" placeholder="Year" required><br>
    <input type="text" name="grade" placeholder="Grade" required><br>
    <button type="submit">Save</button>
</form>
<?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
</body>
</html>