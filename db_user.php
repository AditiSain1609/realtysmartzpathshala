<?php
$conn = new mysqli("localhost", "realtysm_pathshala", "realtysmartzpathshala", "realtysm_pathshala");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
