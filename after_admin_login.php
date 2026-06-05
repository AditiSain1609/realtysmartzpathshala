<?php
session_start();

// 🔹 Check if admin is logged in
if (!isset($_SESSION['role']) || $_SESSION['role'] !== "admin") {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            margin: 0;
            padding: 0;
            background: url('assets/img/gallery/section_bg02.png') no-repeat center center fixed; 
        background-size: cover;
        }
        .dashboard-container {
            width: 80%;
            margin: 50px auto;
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px #aaa;
        }
        h2 {
            text-align: center;
            margin-bottom: 40px;
            color: rgba(0, 94, 255, 1); 
        }
        .dashboard-menu {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .menu-card {
            width: 45%;
            background: #e6e6e6ff;
            margin: 10px 0;
            padding: 20px;
            text-align: center;
            border-radius: 10px;
            cursor: pointer;
            transition: 0.3s ease;
            font-size: 18px;
        }
        .menu-card:hover {
            background: #ccc;
        }
        a {
            text-decoration: none;
            color: #000;
            display: block;
        }
        .logout {
            text-align: center;
            margin-top: 20px;
        }
        .logout a {
            background:rgba(0, 94, 255, 1); 
            color: white;
            padding: 10px 20px;
            border-radius: 6px;
            text-decoration: none;
        }
        .logout a:hover {
            background: rgba(0, 94, 255, 1); 
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <h2>Welcome, Admin 👋 </h2>
        <div class="dashboard-menu">
            <div class="menu-card"><a href="admin_user.php">1. User Details</a></div>
            <div class="menu-card"><a href="admin_approve_reject.php">2. Admin Status</a></div>
            <div class="menu-card"><a href="manage_questions.php">3. Test Details</a></div>
            <div class="menu-card"><a href="admin_contact.php">4. Contact Messages</a></div>
            <div class="menu-card"><a href="admin_profiles.php">5. Profile Details </a></div>
            <div class="menu-card"><a href="view_results.php">6. View Test result</a></div>
             <div class="menu-card"><a href="admin_team.php">6. View Team </a></div>
        </div>

        <div class="logout">
            <a href="index.php">Logout</a>
        </div>
    </div>
</body>
</html>
