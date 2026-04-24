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
<head>
    <title>View Enrollments</title>
    <style>
        table { border-collapse: collapse; width: 90%; margin: 20px auto; }
        th, td { border: 1px solid #333; padding: 8px; text-align: center; }
        th { background: #007BFF; color: white; }
        .btn {
            display: inline-block;
            padding: 6px 12px;
            margin: 2px;
            border-radius: 4px;
            text-decoration: none;
            color: #fff;
        }
        .btn-edit { background-color: #28a745; }   /* Green */
        .btn-delete { background-color: #dc3545; } /* Red */
        .btn-add { background-color: #007BFF; }    /* Blue */
        .btn:hover { opacity: 0.85; }
    </style>
</head>
<body>
<h2 style="text-align:center;">Enrollment Records</h2>
<div style="text-align:center;">
    <a href="add_enrollment.php" class="btn btn-add">➕ Add Enrollment</a>
</div>
<?php if ($result && mysqli_num_rows($result) > 0) { ?>
<table>
<tr>
    <th>ID</th><th>Student</th><th>Course</th><th>Semester</th><th>Year</th><th>Grade</th><th>Actions</th>
</tr>
<?php while ($row = mysqli_fetch_assoc($result)) { ?>
<tr>
    <td><?php echo $row['EnrollmentID']; ?></td>
    <td><?php echo $row['FirstName']." ".$row['LastName']; ?></td>
    <td><?php echo $row['CourseName']; ?></td>
    <td><?php echo $row['Semester']; ?></td>
    <td><?php echo $row['Year']; ?></td>
    <td><?php echo $row['Grade']; ?></td>
    <td>
        <a href="edit_enrollment.php?id=<?php echo $row['EnrollmentID']; ?>" class="btn btn-edit">✏️ Edit</a>
        <a href="delete_enrollment.php?id=<?php echo $row['EnrollmentID']; ?>" class="btn btn-delete" onclick="return confirm('Delete this enrollment?');">🗑️ Delete</a>
    </td>
</tr>
<?php } ?>
</table>
<?php } else { echo "<p style='text-align:center;'>No enrollments found.</p>"; } ?>
</body>
</html>
