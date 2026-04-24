<?php
// Database connection settings
$host = "localhost";   // XAMPP runs MySQL on localhost
$user = "root";        // default username in XAMPP
$pass = "";            // default password is empty
$dbname = "project";   // <-- IMPORTANT: use your actual database name

// Create connection
$conn = mysqli_connect($host, $user, $pass, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
