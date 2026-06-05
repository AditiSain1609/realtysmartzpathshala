<?php
$host = "localhost";
$user = "realtysm_pathshala";
$password ="realtysmartzpathshala";
$database ="realtysm_pathshala";

$conn = mysqli_connect($host, $user, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


