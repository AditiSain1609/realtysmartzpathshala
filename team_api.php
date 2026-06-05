<?php
include 'db_connect.php';
header("Content-Type: application/json");

$result = $conn->query("SELECT id, name, role, type, department, photo_url FROM team ORDER BY department, type DESC, id DESC");

$members = [];
while ($row = $result->fetch_assoc()) {
    $members[] = $row;
}

echo json_encode($members);
?>
