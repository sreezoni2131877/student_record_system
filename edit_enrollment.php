<?php
session_start();
include("db.php");

$id = (int)$_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM enrollment WHERE EnrollmentID=$id");
$enrollment = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student = $_POST['student_id'];
    $course = $_POST['course_id'];
    $semester = $_POST['semester'];
    $year = $_POST['year'];
    $grade = $_POST['grade'];

    $sql = "UPDATE enrollment SET 
            StudentID='$student',
            CourseID='$course',
            Semester='$semester',
            Year='$year',
            Grade='$grade'
            WHERE EnrollmentID=$id";

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
<head><title>Edit Enrollment</title></head>
<body>
<h2>Edit Enrollment</h2>
<form method="POST">
    <label>Student ID:</label><br>
    <input type="number" name="student_id" value="<?php echo $enrollment['StudentID']; ?>" required><br>

    <label>Course ID:</label><br>
    <input type="number" name="course_id" value="<?php echo $enrollment['CourseID']; ?>" required><br>

    <label>Semester:</label><br>
    <input type="text" name="semester" value="<?php echo $enrollment['Semester']; ?>" required><br>

    <label>Year:</label><br>
    <input type="number" name="year" value="<?php echo $enrollment['Year']; ?>" required><br>

    <label>Grade:</label><br>
    <input type="text" name="grade" value="<?php echo $enrollment['Grade']; ?>" required><br><br>

    <button type="submit">Update</button>
</form>
<?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
</body>
</html>