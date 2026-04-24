<?php
session_start();
include("db.php");

// Fetch students
$result = mysqli_query($conn, "SELECT * FROM student ORDER BY StudentID ASC");
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
        table { width:100%; border-collapse: collapse; }
        th, td { border:1px solid #ccc; padding:8px; text-align:left; }
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
                <th>First Name</th>
                <th>Last Name</th>
                <th>Date of Birth</th>
                <th>Gender</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['StudentID']); ?></td>
                <td><?php echo htmlspecialchars($row['FirstName']); ?></td>
                <td><?php echo htmlspecialchars($row['LastName']); ?></td>
                <td><?php echo htmlspecialchars($row['DateOfBirth']); ?></td>
                <td><?php echo htmlspecialchars($row['Gender']); ?></td>
                <td><?php echo htmlspecialchars($row['Email']); ?></td>
                <td><?php echo htmlspecialchars($row['Phone']); ?></td>
                <td><?php echo htmlspecialchars($row['Address']); ?></td>
                <td class="actions">
                    <a class="btn" href="edit_student.php?id=<?php echo urlencode($row['StudentID']); ?>">✏️ Edit</a>
                    <a class="btn" href="delete_student.php?id=<?php echo urlencode($row['StudentID']); ?>" onclick="return confirm('Delete this student?');">🗑️ Delete</a>
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
