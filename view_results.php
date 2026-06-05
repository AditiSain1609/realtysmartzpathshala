<?php
session_start();

// 🔹 Sirf admin hi access kar sake
if (!isset($_SESSION['role']) || $_SESSION['role'] !== "admin") {
    header("Location: login.php");
    exit();
}

include 'db_connect.php';

// 🔹 Delete action
if(isset($_GET['delete'])){
    $delete_id = (int)$_GET['delete'];
    mysqli_query($conn, "DELETE FROM user_attempts WHERE id=$delete_id");
    header("Location: view_results.php");
    exit();
}

// Default query
$where = "1=1";

// Filters
if(isset($_GET['search']) && !empty($_GET['search'])){
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $where .= " AND (u.name LIKE '%$search%' OR u.email LIKE '%$search%')";
}

if(isset($_GET['set_no']) && $_GET['set_no'] != ""){
    $set_no = (int)$_GET['set_no'];
    $where .= " AND ua.set_no = $set_no";
}

if(!empty($_GET['from_date']) && !empty($_GET['to_date'])){
    $from = $_GET['from_date'];
    $to   = $_GET['to_date'];
    $where .= " AND DATE(ua.submitted_at) BETWEEN '$from' AND '$to'";
}

// Final query
$sql = "SELECT ua.*, u.name, u.email 
        FROM user_attempts ua
        JOIN users u ON ua.user_id = u.id
        WHERE $where
        ORDER BY ua.submitted_at DESC";

$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html>
<head>
  <title>Test Results Report</title>
  <style>
    body{
      background: url('/assets/img/gallery/section_bg02.png') no-repeat center center fixed; 
        background-size: cover;
    }
    .row{
      background-color: rgba
(0, 94, 255, 1);
    }
    table { border-collapse: collapse; width: 100%; margin-top:15px; }
    th, td { border: 1px solid #ccc; padding: 8px; text-align: center; }
    th { background: #f2f2f2; }
    form { margin-bottom: 15px; }
    .actions a { margin: 0 5px; text-decoration: none; color: red; }
  </style>
</head>
<body>
  <h2>📊 Test Results Report</h2>
  <a href="manage_questions.php">⬅ Back to Manage Questions</a>
  <br><br>

  <!-- 🔍 Filters Form -->
  <form method="get">
    <label>Search:</label>
    <input type="text" name="search" placeholder="Search user/email" 
           value="<?php echo $_GET['search'] ?? ''; ?>">
    <button type="submit">Search</button>
    <a href="view_results.php" style="margin-left:10px;">Reset</a>
  </form>
  

  <!-- Results Table -->
  <table>
    <tr id="row">
      <th>User</th>
      <th>Email</th>
      <th>Set No</th>
      <th>Score</th>
      <th>Submitted At</th>
      <th>Action</th>
    </tr>
    
    <?php if(mysqli_num_rows($result) > 0){ ?>
        <?php while($row = mysqli_fetch_assoc($result)){ ?>
        <tr>
          <td><?php echo $row['name']; ?></td>
          <td><?php echo $row['email']; ?></td>
          <td><?php echo $row['set_no']; ?></td>
          <td><?php echo $row['score']; ?></td>
          <td><?php echo $row['submitted_at']; ?></td>
          <td class="actions">
            <a href="view_results.php?delete=<?php echo $row['id']; ?>" 
               onclick="return confirm('Are you sure you want to delete this result?');">🗑 Delete</a>
          </td>
        </tr>
        <?php } ?>
    <?php } else { ?>
        <tr><td colspan="6">No results found!</td></tr>
    <?php } ?>
  </table>
</body>
</html>
