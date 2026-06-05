<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'db_connect.php';

function respond($status, $message) {
    // Detect AJAX
    $isAjax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) 
              && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';

    if ($isAjax) {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(['status' => $status, 'message' => $message]);
    } else {
         echo $message;
    }
    exit;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name     = trim($_POST['name']);
    $email    = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($name === '' || $email === '' || $password === '' || $confirm_password === '') {
        respond('error', '⚠️ All fields are required.');
    }

    // server-side password strength check: min 8, upper, lower, number, special
    if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).{8,}$/", $password)) {
        respond('error', '⚠️ Password must be at least 8 characters long, with uppercase, lowercase, number and special character.');
    }

    if ($password !== $confirm_password) {
        respond('error', '⚠️ Password and Confirm Password do not match.');
    }

    // ✅ Check existing user
    $checkQuery = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($checkQuery);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $checkResult = $stmt->get_result();

    if ($checkResult->num_rows > 0) {
        echo "⚠️ User already registered with this email.";
        exit;
    }

    $verification_code = bin2hex(random_bytes(16));

    // ⚠️ Store as plain password (jaise tumne bola hai)
    $plainPassword = $password;

    $insertQuery = "INSERT INTO users (name, email, password, is_verified, is_approved, verification_code) VALUES (?, ?, ?, 0, 0, ?)";
    $stmt = $conn->prepare($insertQuery);
    $stmt->bind_param("ssss", $name, $email, $plainPassword, $verification_code);

    if ($stmt->execute()) {
        // Email to user
        $to = $email;
        $subject = "Please verify your email";
        $verify_link = "http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/verify.php?code=$verification_code";
        $message = "Hi $name,\n\nThank you for registering.\nPlease click the link below to verify your email address:\n$verify_link\n\nAfter verification, admin will approve your account.";
        $headers = "From: Realty Smartz <admin@realtysmartzpathshala.in>";

        mail($to, $subject, $message, $headers);

        // Email to admin
        $admin_email = "admin@realtysmartzpathshala.in";
        $admin_subject = "New User Registration - Approval Needed";
        $admin_message = "A new user has registered and is pending approval.\n\nName: $name\nEmail: $email\nPassword: $plainPassword\n\nPlease login to the admin panel to approve or reject.";
        mail($admin_email, $admin_subject, $admin_message, $headers);

        echo "✅ Registration successful! Please check your email to verify your account.";
    } else {
        echo "❌ Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
