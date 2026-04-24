<?php
session_start();
include("db.php");

$id = (int)$_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM course WHERE CourseID=$id");
$course = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['course_name'];
    $code = $_POST['course_code'];
    $credits = $_POST['credit_hours'];
    $dept = $_POST['department'];

    $sql = "UPDATE course SET 
            CourseName='$name',
            CourseCode='$code',
            CreditHours='$credits',
            Department='$dept'
            WHERE CourseID=$id";
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
<head><title>Edit Course</title></head>
<body>
<h2>Edit Course</h2>
<form method="POST">
    <input type="text" name="course_name" value="<?php echo $course['CourseName']; ?>" required><br>
    <input type="text" name="course_code" value="<?php echo $course['CourseCode']; ?>" required><br>
    <input type="number" name="credit_hours" value="<?php echo $course['CreditHours']; ?>" required><br>
    <input type="text" name="department" value="<?php echo $course['Department']; ?>" required><br>
    <button type="submit">Update</button>
</form>
<?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
</body>
</html>