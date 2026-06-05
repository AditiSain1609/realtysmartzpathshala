<?php
include 'db_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

$message = "";
$showForm = false;
$token = "";

// --- STEP 1: If user clicked the email link (GET request) ---
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['token'])) {
    $token = urldecode(trim($_GET['token'])); // ✅ Decode token from URL

    $stmt = $conn->prepare("SELECT id, email, token_expiry FROM users WHERE reset_token = ?");
   // <!-- if (!$stmt) {
      //  die("DB Error: " . $conn->error);
   // }-->
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $email, $expiry);
        $stmt->fetch();
        if (strtotime($expiry) > time()) {
            $showForm = true; // ✅ Token valid → show form
        } else {
            $message = "<p style='color:red;'>❌ Token expired. Please request a new password reset.</p>";
        }
    } else {
        $message = "<p style='color:red;'>❌ Invalid token. Please check your reset link.</p>";
    }
    $stmt->close();
}

// --- STEP 2: If user submitted new password (POST request) ---
elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $token = urldecode(trim($_POST['token']));
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // ✅ Password policy check
    if (strlen($new_password) < 8 ||
        !preg_match("/[A-Z]/", $new_password) ||
        !preg_match("/[0-9]/", $new_password) ||
        !preg_match("/[^a-zA-Z0-9]/", $new_password)) {
        $message = "<p style='color:orange;'>⚠️ Password must be at least 8 characters long, include an uppercase letter, a number, and a special character.</p>";
        $showForm = true;
    } elseif ($new_password !== $confirm_password) {
        $message = "<p style='color:orange;'>⚠️ Passwords do not match.</p>";
        $showForm = true;
    } else {
        $stmt = $conn->prepare("SELECT id, email FROM users WHERE reset_token = ? AND token_expiry > NOW()");
        if (!$stmt) {
            die("DB Error: " . $conn->error);
        }
        $stmt->bind_param("s", $token);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($user_id, $email);
            $stmt->fetch();
            $stmt->close();

            $update = $conn->prepare("UPDATE users SET password = ?, reset_token = NULL, token_expiry = NULL WHERE id = ?");
            $update->bind_param("si", $new_password, $user_id);


            if ($update->execute()) {
                // ✅ Send email notification
                $subject = "Password Reset Confirmation";
                $body = "Hello,\n\nYour password has been successfully reset.\n\nIf you did not request this, please contact support immediately.\n\nThanks,\nTeam";
                $headers = "From: no-reply@yourdomain.com\r\n";
                
                @mail($email, $subject, $body, $headers);

                $message = "<p style='color:green;'>✅ Password reset successfully. Redirecting to login...</p>
                <script>setTimeout(function(){ window.location.href='/Users/aditisaini/Desktop/realtysmartzpathshala/main/login.html'; }, 3000);</script>";
            } else {
                $message = "<p style='color:red;'>❌ Failed to update password.</p>";
                $showForm = true;
            }
            $update->close();
        } else {
            $message = "<p style='color:red;'>❌ Invalid or expired token.</p>";
            $stmt->close();
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial; background: #f4f4f4; }
        .container {
            width: 350px; margin: 80px auto; background: #fff; padding: 20px; border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
        }
        h2 { text-align: center; }
        input[type="password"], button {
            width: 94%; padding: 10px; margin: 26px -8px;
        }
        button { background: #28a745; color: white; border: none; cursor: pointer; padding:15px; margin:10px; }
        button:hover { background: #218838; }
        p { text-align: center; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Reset Password</h2>
        <?php if (!empty($message)) echo $message; ?>

        <?php if ($showForm): ?>
        <form method="POST">
            <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">

            <label>New Password:</label>
            <input type="password" name="new_password" required>

            <label>Confirm Password:</label>
            <input type="password" name="confirm_password" required>

            <button type="submit">Reset Password</button>
        </form>
        <?php endif; ?>
    </div>
</body>
</html>
