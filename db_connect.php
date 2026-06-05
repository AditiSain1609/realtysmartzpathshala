<?php
$host = "localhost";
$dbname = "realtysm_pathshala";
$username = "realtysm_pathshala";
$password = "realtysmartzpathshala";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>