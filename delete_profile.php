<?php
include 'db_connect.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "DELETE FROM user_profiles WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        header("Location: admin_profiles.php?msg=Deleted");
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}
?>
