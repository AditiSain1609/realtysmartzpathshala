<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$db_user   = "realtysm_pathshala";
$db_pass   = "realtysmartzpathshala";
$db_name   = "realtysm_pathshala";

$conn = new mysqli($servername, $db_user, $db_pass, $db_name);
if ($conn->connect_error) {
    http_response_code(500);
    die("DB Connection failed: " . $conn->connect_error);
}

// 🔹 Handle Approve/Reject/Delete via AJAX
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'], $_POST['id'])) {
    header('Content-Type: application/json');
    $id = intval($_POST['id']);
    $action = $_POST['action'];

    if ($action === 'approve' || $action === 'reject') {
        if ($action === 'approve') {
            $status = 'approved';
            $is_approved = 1;
        } else {
            $status = 'rejected';
            $is_approved = 0;
        }

        // Update status in admin_approve_reject
        $stmt1 = $conn->prepare("UPDATE admin_approve_reject SET `status` = ? WHERE id = ?");
        $stmt1->bind_param("si", $status, $id);
        $ok1 = $stmt1->execute();
        $stmt1->close();

        // Update users table is_approved
        $stmt2 = $conn->prepare("
            UPDATE users 
            SET is_approved = ? 
            WHERE email = (SELECT email FROM admin_approve_reject WHERE id = ? LIMIT 1)
        ");
        $stmt2->bind_param("ii", $is_approved, $id);
        $ok2 = $stmt2->execute();
        $stmt2->close();

        // Fetch email for notification
        $emailQuery = $conn->prepare("SELECT email, name FROM admin_approve_reject WHERE id = ? LIMIT 1");
        $emailQuery->bind_param("i", $id);
        $emailQuery->execute();
        $emailQuery->bind_result($userEmail, $userName);
        $emailQuery->fetch();
        $emailQuery->close();

        // Send email notification
        if (!empty($userEmail)) {
            $subject = "Your Account Has Been " . ucfirst($status);

            $htmlMessage = '
            <html><head><style>
            .email-box { font-family: Arial; background:#fff; border-radius:8px; padding:20px; max-width:500px; margin:auto; }
            .title { color:' . ($status === "approved" ? "#2ecc71" : "#e74c3c") . '; font-size:20px; }
            </style></head><body>
            <div class="email-box">
                <div class="title">Account ' . ucfirst($status) . '</div>
                <p>Hello ' . htmlspecialchars($userName) . ',<br><br>
                Your account has been <strong>' . ucfirst($status) . '</strong> by our admin team.<br>
                ' . ($status === "approved" ? "You can now log in and access all features." : "Unfortunately, you cannot log in at the moment.") . '</p>
                <p>Regards,<br>Team RealtySmartz Pathshala</p>
            </div>
            </body></html>';

            $headers  = "MIME-Version: 1.0\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8\r\n";
            $headers .= "From: Admin@realtysmartzpathshala.in";
            $headers .= "Reply-To: Admin@realtysmartzpathshala.in";

            @mail($userEmail, $subject, $htmlMessage, $headers);
        }

        if ($ok1 && $ok2) {
            echo json_encode(['success' => true, 'status' => $status]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Database update failed']);
        }
    } 
    elseif ($action === 'delete') {
        // Delete user completely from admin_approve_reject
        $stmt = $conn->prepare("DELETE FROM admin_approve_reject WHERE id = ?");
        $stmt->bind_param("i", $id);
        $ok = $stmt->execute();
        $stmt->close();

        if ($ok) {
            echo json_encode(['success' => true, 'deleted' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Delete failed']);
        }
    }

    $conn->close();
    exit;
}

// Fetch data
$sql = "SELECT id, name, email, is_verified, `status` FROM admin_approve_reject ORDER BY id DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Approve / Reject Users</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; 
        background: url('assets/img/gallery/section_bg02.png') no-repeat center center fixed; 
        background-size: cover;}
        h1 { text-align: center; }
        table { border-collapse: collapse; width: 95%; margin: 20px auto; }
        .row{
            background-color: rgba
(0, 94, 255, 1);
        }
        th, td { border: 1px solid #ddd; padding: 12px; text-align:center; }
        th { background:#f7f7f7; }
        .btn { padding:6px 10px; border-radius:4px; color:#fff; text-decoration:none; cursor:pointer; }
        .approve { background: #2ecc71; }
        .reject  { background: #e74c3c; }
        .delete  { background: #555; }
        .approved { color: #2ecc71; font-weight:600; }
        .rejected { color: #e74c3c; font-weight:600; }
        .pending  { color: #f39c12; font-weight:600; }
        .small { font-size:13px; color:#555; }
    </style>
</head>
<body>
    <h1>Approve / Reject Users</h1>

    <table>
        <tr id="row">
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Verified</th>
            <th>Status</th>
            <th>Action</th>
        </tr>

        <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): 
                $id = (int)$row['id'];
                $name = htmlspecialchars($row['name']);
                $email = htmlspecialchars($row['email']);
                $is_verified = $row['is_verified'] ? 'Yes' : 'No';
                $status = isset($row['status']) ? strtolower($row['status']) : 'pending';
            ?>
            <tr id="row-<?= $id ?>">
                <td><?= $id ?></td>
                <td><?= $name ?></td>
                <td><?= $email ?></td>
                <td class="small"><?= $is_verified ?></td>
                <td id="status-cell-<?= $id ?>">
                    <?php if ($status === 'pending'): ?>
                        <button class="btn approve" onclick="updateStatus(<?= $id ?>, 'approve')">Approve</button>
                        <button class="btn reject"  onclick="updateStatus(<?= $id ?>, 'reject')">Reject</button>
                    <?php else: ?>
                        <span class="<?= $status ?>"><?= ucfirst($status) ?></span>
                    <?php endif; ?>
                </td>
                <td>
                    <button class="btn delete" onclick="updateStatus(<?= $id ?>, 'delete')">Delete</button>
                </td>
            </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="6">No records found</td></tr>
        <?php endif; ?>
    </table>

<script>
function updateStatus(id, action) {
    if (!confirm("Are you sure you want to " + action + " this user?")) return;

    const fd = new FormData();
    fd.append('id', id);
    fd.append('action', action);

    fetch('', { method: 'POST', body: fd })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            if (action === 'delete') {
                document.getElementById('row-' + id).remove();
            } else {
                const cell = document.getElementById('status-cell-' + id);
                cell.innerHTML = '<span class="' + data.status + '">' + data.status.charAt(0).toUpperCase() + data.status.slice(1) + '</span>';
            }
        } else {
            alert('Action failed: ' + (data.error || 'Unknown error'));
        }
    })
    .catch(err => {
        console.error(err);
        alert('Server error, check console.');
    });
}
</script>
</body>
</html>
<?php $conn->close(); ?>
