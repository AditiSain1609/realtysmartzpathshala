<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = "localhost";
$dbname = "realtysm_pathshala";
$username = "realtysm_pathshala";
$password = "realtysmartzpathshala";

// MySQL connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect form data
$message = $_POST['message'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];

// Insert into table
$sql = "INSERT INTO contact_form (first_name, last_name, email, message) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $first_name, $last_name, $email, $message);

if ($stmt->execute()) {
    // ✅ Redirect to success page
    header("Location: contact_success.php");
    exit(); // Very important to stop script here
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
