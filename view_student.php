<?php
session_start();
include("db.php");

// Handle delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    mysqli_query($conn, "DELETE FROM students WHERE id=$id");
    header("Location: view_student.php");
    exit();
}

// Fetch students
$result = mysqli_query($conn, "SELECT * FROM students ORDER BY id ASC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Students</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .container { width: 90%; max-width: 1000px; margin: 40px auto; }
        .topbar { display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; }
        .empty { padding: 16px; background: #fff3cd; color: #7a5d00; border-radius: 8px; }
        .actions a { margin-right: 8px; }
    </style>
</head>
<body>
<div class="container">
    <div class="topbar">
        <h2>Student Records</h2>
        <div>
            <a href="dashboard.php" class="btn">🏠 Dashboard</a>
            <a href="add_student.php" class="btn">➕ Add Student</a>
        </div>
    </div>

    <?php if ($result && mysqli_num_rows($result) > 0) { ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Student ID</th>
                <th>Course</th>
                <th>Enrol Date</th>
                <th>CGPA</th>
                <th>Attendance</th>
                <th>Department</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['id']); ?></td>
                <td><?php echo htmlspecialchars($row['student_id']); ?></td>
                <td><?php echo htmlspecialchars($row['course']); ?></td>
                <td><?php echo htmlspecialchars($row['enrol_date']); ?></td>
                <td><?php echo htmlspecialchars($row['cgpa']); ?></td>
                <td><?php echo htmlspecialchars($row['attendance']); ?>%</td>
                <td><?php echo htmlspecialchars($row['department']); ?></td>
                <td class="actions">
                    <a class="btn" href="edit_student.php?id=<?php echo urlencode($row['id']); ?>">✏️ Edit</a>
                    <a class="btn" href="view_student.php?delete=<?php echo urlencode($row['id']); ?>" onclick="return confirm('Delete this student?');">🗑️ Delete</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <?php } else { ?>
        <div class="empty">No students found. Try adding some from the dashboard.</div>
    <?php } ?>
</div>
</body>
</html>