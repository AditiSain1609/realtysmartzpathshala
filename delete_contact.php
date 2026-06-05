<?php
// delete_contact.php
include 'db_connect.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $stmt = $conn->prepare("DELETE FROM contact_form WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        header("Location: contact_data.php");
    } else {
        echo "Error deleting record.";
    }
}
?>
