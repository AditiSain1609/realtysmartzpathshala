<?php
$host = "localhost";         
$username = "realtysm_pathshala";  
$password = "realtysm_pathshala";  
$database = "realtysmartzpathshala";  

$conn = mysqli_connect($host, $username, $password, $database);

// Connection check
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
