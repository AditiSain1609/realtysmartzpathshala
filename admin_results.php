<?php

session_start();

// 1. Connect to DB
$conn = new mysqli("localhost", "realtysm_pathshala", "realtysm_pathshala", "realtysmartzpathshala");
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// 2. Fetch all results
$sql = "SELECT * FROM test_results ORDER BY submitted_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>All Test Results</title>
    <style>
        body { font-family: Arial; padding: 30px;background: url('assets/img/gallery/section_bg02.png') no-repeat center center fixed; 
        background-size: cover; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: center; }
        th { background-color: #f2f2f2; }
        h2 { text-align: center; }
    </style>
</head>
<body>

<h2>All Test Submissions</h2>

<?php if ($result && $result->num_rows > 0): ?>
    <table>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Score</th>
            <th>Total</th>
            <th>Submitted At</th>
        </tr>
        <?php $count = 1; while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $count++ ?></td>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><?= $row['score'] ?></td>
                <td><?= $row['total'] ?></td>
                <td><?= $row['submitted_at'] ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
<?php else: ?>
    <p>No submissions found.</p>
<?php endif; ?>

<?php $conn->close(); ?>

</body>
</html>
