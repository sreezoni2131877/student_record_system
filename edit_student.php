<?php
session_start();
include("db.php");

$id = (int)$_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM student WHERE StudentID=$id");
$student = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName   = $_POST['first_name'];
    $lastName    = $_POST['last_name'];
    $dob         = $_POST['date_of_birth'];
    $gender      = $_POST['gender'];
    $email       = $_POST['email'];
    $phone       = $_POST['phone'];
    $address     = $_POST['address'];

    $sql = "UPDATE student SET 
        FirstName='$firstName',
        LastName='$lastName',
        DateOfBirth='$dob',
        Gender='$gender',
        Email='$email',
        Phone='$phone',
        Address='$address'
        WHERE StudentID=$id";

    if (mysqli_query($conn, $sql)) {
        header("Location: view_student.php");
        exit();
    } else {
        $error = "Error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="card">
    <h2>Edit Student</h2>
    <form method="POST">
        <input type="text" name="first_name" value="<?php echo htmlspecialchars($student['FirstName']); ?>" required><br>
        <input type="text" name="last_name" value="<?php echo htmlspecialchars($student['LastName']); ?>" required><br>
        <input type="date" name="date_of_birth" value="<?php echo htmlspecialchars($student['DateOfBirth']); ?>" required><br>
        <select name="gender" required>
            <option value="Male" <?php if($student['Gender']=="Male") echo "selected"; ?>>Male</option>
            <option value="Female" <?php if($student['Gender']=="Female") echo "selected"; ?>>Female</option>
            <option value="Other" <?php if($student['Gender']=="Other") echo "selected"; ?>>Other</option>
        </select><br>
        <input type="email" name="email" value="<?php echo htmlspecialchars($student['Email']); ?>" required><br>
        <input type="text" name="phone" value="<?php echo htmlspecialchars($student['Phone']); ?>" required><br>
        <input type="text" name="address" value="<?php echo htmlspecialchars($student['Address']); ?>"><br>
        <button type="submit">Save Changes</button>
    </form>
    <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <br>
    <a href="view_student.php" class="btn">⬅ Back to Students</a>
</div>
</body>
</html>
