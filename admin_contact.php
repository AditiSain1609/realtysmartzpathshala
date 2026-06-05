<?php
include 'db_connect.php';

$search = '';
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $stmt = $conn->prepare("SELECT * FROM contact_form WHERE 
        first_name LIKE ? OR 
        last_name LIKE ? OR 
        email LIKE ? OR 
        message LIKE ?");
    $searchTerm = "%$search%";
    $stmt->bind_param("ssss", $searchTerm, $searchTerm, $searchTerm, $searchTerm);
} else {
    $stmt = $conn->prepare("SELECT * FROM contact_form");
}

$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Contact Form Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
            background: url('assets/img/gallery/section_bg02.png') no-repeat center center fixed; 
        background-size: cover;
        }
        h2 {
            color: black;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #aaa;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        form {
            margin-bottom: 20px;
        }
        input[type="text"] {
            padding: 8px;
            width: 250px;
        }
        input[type="submit"], .reset-btn {
            padding: 8px 15px;
            background-color: black;
            color: white;
            border: none;
            cursor: pointer;
            margin-left: 5px;
        }
        .delete-btn {
            background-color: crimson;
            color: white;
            border: none;
            padding: 6px 12px;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <h2>Contact Form Submissions</h2>

    <form method="GET" action="">
        <input type="text" name="search" placeholder="Search..." value="<?php echo htmlspecialchars($search); ?>">
        <input type="submit" value="Search">
        <a href="admin_contact.php" class="reset-btn">Reset</a>
    </form>

    <p>Total Records: <?php echo $result->num_rows; ?></p>

    <table>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Message</th>
            <th>Created At</th>
            <th>Action</th>
        </tr>

        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo htmlspecialchars($row['first_name']); ?></td>
            <td><?php echo htmlspecialchars($row['last_name']); ?></td>
            <td><?php echo htmlspecialchars($row['email']); ?></td>
            <td><?php echo htmlspecialchars($row['message']); ?></td>
            <td><?php echo $row['created_at']; ?></td>
            <td>
                <form method="POST" action="delete_contact.php" onsubmit="return confirm('Delete this record?');" style="display:inline;">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <button type="submit" class="delete-btn">Delete</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>

    </table>
</body>
</html>
