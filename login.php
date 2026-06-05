<?php
session_start();
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email    = $_POST['email'];
    $password = $_POST['password'];

    // 🔹 First check in admin table
    $query = "SELECT * FROM admin WHERE name = ? AND password = ?";
    $stmt  = $conn->prepare($query);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        // ✅ Admin login success
        $admin = $result->fetch_assoc();
        $_SESSION['admin_email'] = $admin['name'];
        $_SESSION['role']        = "admin";
        header("after_admin_login.php");
        exit;
    }

    // 🔹 Otherwise check normal users table
    $query = "SELECT * FROM users WHERE email = ?";
    $stmt  = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if ($password === $user['password']) {
            if ($user['is_approved'] != 1) {
                echo "⚠️ Your registration is pending admin approval.";
                exit;
            }

            $_SESSION['user_id']    = $user['id'];
            $_SESSION['user_name']  = $user['name'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['role']       = "user";

            header("Location: index.html");
            exit;
        } else {
            echo "❌ Incorrect password.";
        }
    } else {
        echo "❌ No account found with this email.";
    }

    $stmt->close();
}
$conn->close();
?>
