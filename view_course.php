<?php
session_start();
include("db.php");

// Fetch all courses
$result = mysqli_query($conn, "SELECT * FROM course ORDER BY CourseID ASC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Courses</title>
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
        .btn-add { background-color: #007BFF; }   /* Blue */
        .btn-edit { background-color: #28a745; }  /* Green */
        .btn-delete { background-color: #dc3545; }/* Red */
        .btn:hover { opacity: 0.85; }
    </style>
</head>
<body>
<h2 style="text-align:center;">Course Records</h2>
<div style="text-align:center;">
    <a href="add_course.php" class="btn btn-add">➕ Add Course</a>
</div>
<?php if ($result && mysqli_num_rows($result) > 0) { ?>
<table>
<tr>
    <th>ID</th><th>Name</th><th>Code</th><th>Credit Hours</th><th>Department</th><th>Actions</th>
</tr>
<?php while ($row = mysqli_fetch_assoc($result)) { ?>
<tr>
    <td><?php echo $row['CourseID']; ?></td>
    <td><?php echo $row['CourseName']; ?></td>
    <td><?php echo $row['CourseCode']; ?></td>
    <td><?php echo $row['CreditHours']; ?></td>
    <td><?php echo $row['Department']; ?></td>
    <td>
        <a href="edit_course.php?id=<?php echo $row['CourseID']; ?>" class="btn btn-edit">✏️ Edit</a>
        <a href="delete_course.php?id=<?php echo $row['CourseID']; ?>" class="btn btn-delete" onclick="return confirm('Delete this course?');">🗑️ Delete</a>
    </td>
</tr>
<?php } ?>
</table>
<?php } else { echo "<p style='text-align:center;'>No courses found.</p>"; } ?>
</body>
</html>
