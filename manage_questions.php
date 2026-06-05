<?php
session_start();

// Only admin can access
if (!isset($_SESSION['role']) || $_SESSION['role'] !== "admin") {
    header("Location: login.php");
    exit();
}

include 'db_connect.php';

// Delete Question
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    mysqli_query($conn, "DELETE FROM questions WHERE id=$id");
    header("Location: manage_questions.php");
    exit;
}

// Fetch Questions
$result = mysqli_query($conn, "SELECT * FROM questions ORDER BY set_id, id");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Questions</title>
</head>
<style>
    body{
        background: url('assets/img/gallery/section_bg02.png') no-repeat center center fixed; 
        background-size: cover;}

.row{
    background-color: rgba
(0, 94, 255, 1);
}
        </style>
<body>
    <h2>Manage Questions</h2>
    <a href="add_question.php"> ➕ Add New Question</a><br><br>
    <table border="1" cellpadding="5">
        <tr id="row">
            <th>ID</th>
            <th>Set ID</th>
            <th>Question</th>
            <th>Correct Answer</th>
            <th>Action</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['set_id']; ?></td>
            <td><?php echo $row['question_text']; ?></td>
            <td><?php echo $row['correct_option']; ?></td>
            <td>
                <a href="edit_question.php?id=<?php echo $row['id']; ?>">✏ Edit</a> | 
                <a href="?delete=<?php echo $row['id']; ?>" onclick="return confirm('Delete this question?')">❌ Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
