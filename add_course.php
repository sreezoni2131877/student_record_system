<?php
session_start();
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['course_name'];
    $code = $_POST['course_code'];
    $credits = $_POST['credit_hours'];
    $dept = $_POST['department'];

    $sql = "INSERT INTO course (CourseName, CourseCode, CreditHours, Department, AdminID)
            VALUES ('$name', '$code', '$credits', '$dept', 1)";
    if (mysqli_query($conn, $sql)) {
        header("Location: view_course.php");
        exit();
    } else {
        $error = "Error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Add Course</title></head>
<body>
<h2>Add Course</h2>
<form method="POST">
    <input type="text" name="course_name" placeholder="Course Name" required><br>
    <input type="text" name="course_code" placeholder="Course Code" required><br>
    <input type="number" name="credit_hours" placeholder="Credit Hours" required><br>
    <input type="text" name="department" placeholder="Department" required><br>
    <button type="submit">Save</button>
</form>
<?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
</body>
</html>
