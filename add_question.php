<?php
session_start();

// Sirf admin hi access kare
if (!isset($_SESSION['role']) || $_SESSION['role'] !== "admin") {
    header("Location:login.php");
    exit();
}

include 'db_connect.php';

$message = "";

// Agar form submit hua
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $set_name       = $_POST['set_name'];
    $set_id         = $_POST['set_id'];
    $question_text  = $_POST['question_text'];
    $option_a       = $_POST['option_a'];
    $option_b       = $_POST['option_b'];
    $option_c       = $_POST['option_c'];
    $option_d       = $_POST['option_d'];
    $correct_option = $_POST['correct_option'];

    $stmt = $conn->prepare("INSERT INTO questions 
        (set_name, set_id, question_text, option_a, option_b, option_c, option_d, correct_option, created_at) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())");
    $stmt->bind_param("sissssss", $set_name, $set_id, $question_text, $option_a, $option_b, $option_c, $option_d, $correct_option);

    if ($stmt->execute()) {
        $message = "✅ Question added successfully!";
    } else {
        $message = "❌ Error: " . $stmt->error;
    }

    $stmt->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Question</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; padding: 20px; }
        .form-container {
            background: #fff; padding: 55px; border-radius: 8px;
            box-shadow: 0 0 10px #aaa; max-width: 600px; margin: auto;
        }
        input, textarea, select { width: 100%; padding: 8px; margin: 10px 0; }
        input[type="submit"] { background: #333; color: white; cursor: pointer; }
        .msg { text-align: center; margin: 10px 0; color: green; }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Add New Question</h2>
        <?php if($message) echo "<p class='msg'>$message</p>"; ?>
        <form method="post">
            <label>Set Name:</label>
            <input type="text" name="set_name" required>

            <label>Set ID:</label>
            <input type="number" name="set_id" required>

            <label>Question:</label>
            <textarea name="question_text" required></textarea>

            <label>Option A:</label>
            <input type="text" name="option_a" required>

            <label>Option B:</label>
            <input type="text" name="option_b" required>

            <label>Option C:</label>
            <input type="text" name="option_c" required>

            <label>Option D:</label>
            <input type="text" name="option_d" required>

            <label>Correct Option (A/B/C/D):</label>
            <select name="correct_option" required>
                <option value="">-- Select Correct Option --</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
            </select>

            <input type="submit" value="Add Question">
        </form>
        <br>
        <a href="manage_questions.php">⬅ Back to Manage Questions</a>
    </div>
</body>
</html>
