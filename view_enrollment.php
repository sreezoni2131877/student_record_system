<?php
session_start();
include("db.php");

$sql = "SELECT e.EnrollmentID, s.FirstName, s.LastName, c.CourseName, e.Semester, e.Year, e.Grade
        FROM enrollment e
        JOIN student s ON e.StudentID = s.StudentID
        JOIN course c ON e.CourseID = c.CourseID
        ORDER BY e.EnrollmentID ASC";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html>
<head><title>View Enrollments</title></head>
<body>
<h2>Enrollment Records</h2>
<a href="add_enrollment.php">➕ Add Enrollment</a>
<?php if ($result && mysqli_num_rows($result) > 0) { ?>
<table border="1" cellpadding="8">
<tr>
    <th>ID</th><th>Student</th><th>Course</th><th>Semester</th><th>Year</th><th>Grade</th>
</tr>
<?php while ($row = mysqli_fetch_assoc($result)) { ?>
<tr>
    <td><?php echo $row['EnrollmentID']; ?></td>
    <td><?php echo $row['FirstName']." ".$row['LastName']; ?></td>
    <td><?php echo $row['CourseName']; ?></td>
    <td><?php echo $row['Semester']; ?></td>
    <td><?php echo $row['Year']; ?></td>
    <td><?php echo $row['Grade']; ?></td>
</tr>
<?php } ?>
</table>
<?php } else { echo "<p>No enrollments found.</p>"; } ?>
</body>
</html>