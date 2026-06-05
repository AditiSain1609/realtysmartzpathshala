<?php
session_start();

// Sirf admin hi access kare
if (!isset($_SESSION['role']) || $_SESSION['role'] !== "admin") {
    header("Location: login.php");
    exit();
}

include 'db_connect.php';

$message = "";

// Agar id nahi di gayi to manage page par redirect
if (!isset($_GET['id'])) {
    header("Location: manage_questions.php");
    exit();
}

$id = intval($_GET['id']);

// Pehle existing question fetch kare
$stmt = $conn->prepare("SELECT * FROM questions WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    header("Location: manage_questions.php");
    exit();
}

$question = $result->fetch_assoc();
$stmt->close();

// Agar form submit hua hai
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $set_name       = $_POST['set_name'];
    $set_id         = $_POST['set_id'];
    $question_text  = $_POST['question_text'];
    $option_a       = $_POST['option_a'];
    $option_b       = $_POST['option_b'];
    $option_c       = $_POST['option_c'];
    $option_d       = $_POST['option_d'];
    $correct_option = $_POST['correct_option'];

    $stmt = $conn->prepare("UPDATE questions SET 
        set_name=?, set_id=?, question_text=?, option_a=?, option_b=?, option_c=?, option_d=?, correct_option=? 
        WHERE id=?");
    $stmt->bind_param("sissssssi", $set_name, $set_id, $question_text, $option_a, $option_b, $option_c, $option_d, $correct_option, $id);

    if ($stmt->execute()) {
        $message = "✅ Question updated successfully!";
        // Refresh data
        $question = [
            'set_name' => $set_name,
            'set_id' => $set_id,
            'question_text' => $question_text,
            'option_a' => $option_a,
            'option_b' => $option_b,
            'option_c' => $option_c,
            'option_d' => $option_d,
            'correct_option' => $correct_option
        ];
    } else {
        $message = "❌ Error: " . $stmt->error;
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Question</title>
    <style>
        body { font-family: Arial; background: url('assets/img/gallery/section_bg02.png') no-repeat center center fixed; 
        background-size: cover; padding: 20px; }
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
        <h2>Edit Question (ID: <?php echo $id; ?>)</h2>
        <?php if($message) echo "<p class='msg'>$message</p>"; ?>
        <form method="post">
            <label>Set Name:</label>
            <input type="text" name="set_name" value="<?php echo htmlspecialchars($question['set_name']); ?>" required>

            <label>Set ID:</label>
            <input type="number" name="set_id" value="<?php echo htmlspecialchars($question['set_id']); ?>" required>

            <label>Question:</label>
            <textarea name="question_text" required><?php echo htmlspecialchars($question['question_text']); ?></textarea>

            <label>Option A:</label>
            <input type="text" name="option_a" value="<?php echo htmlspecialchars($question['option_a']); ?>" required>

            <label>Option B:</label>
            <input type="text" name="option_b" value="<?php echo htmlspecialchars($question['option_b']); ?>" required>

            <label>Option C:</label>
            <input type="text" name="option_c" value="<?php echo htmlspecialchars($question['option_c']); ?>" required>

            <label>Option D:</label>
            <input type="text" name="option_d" value="<?php echo htmlspecialchars($question['option_d']); ?>" required>

            <label>Correct Option (A/B/C/D):</label>
            <select name="correct_option" required>
                <option value="A" <?php if($question['correct_option']=="A") echo "selected"; ?>>A</option>
                <option value="B" <?php if($question['correct_option']=="B") echo "selected"; ?>>B</option>
                <option value="C" <?php if($question['correct_option']=="C") echo "selected"; ?>>C</option>
                <option value="D" <?php if($question['correct_option']=="D") echo "selected"; ?>>D</option>
            </select>

            <input type="submit" value="Update Question">
        </form>
        <br>
        <a href="manage_questions.php">⬅ Back to Manage Questions</a>
    </div>
</body>
</html>
