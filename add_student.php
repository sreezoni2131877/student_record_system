<?php
session_start();
include("db.php");

// Only allow logged-in users
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName   = $_POST['first_name'];
    $lastName    = $_POST['last_name'];
    $dob         = $_POST['date_of_birth'];
    $gender      = $_POST['gender'];
    $email       = $_POST['email'];
    $phone       = $_POST['phone'];
    $address     = $_POST['address'];
    $adminID     = 1; // link to existing admin (adjust if needed)

    $sql = "INSERT INTO student (FirstName, LastName, DateOfBirth, Gender, Email, Phone, Address, AdminID) 
            VALUES ('$firstName','$lastName','$dob','$gender','$email','$phone','$address','$adminID')";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: view_student.php"); // redirect to student list
        exit();
    } else {
        $error = "Error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="card">
    <h2>Add Student</h2>
    <form method="POST">
        <input type="text" name="first_name" placeholder="First Name" required><br>
        <input type="text" name="last_name" placeholder="Last Name" required><br>
        <input type="date" name="date_of_birth" required><br>
        <select name="gender" required>
            <option value="">Select Gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
        </select><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="text" name="phone" placeholder="Phone" required><br>
        <input type="text" name="address" placeholder="Address"><br>
        <button type="submit">Add Student</button>
    </form>
    <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <br>
    <a href="dashboard.php" class="btn">⬅ Back to Dashboard</a>
</div>
</body>
</html>
