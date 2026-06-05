<?php
include 'db_user.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $is_verified = $_POST['is_verified'];
    $is_approved = $_POST['is_approved'];

    $sql = "UPDATE users SET 
                name='$name', 
                email='$email', 
                password='$password', 
                is_verified='$is_verified', 
                is_approved='$is_approved'
            WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location:admin_user.php");
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>
