<?php
$servername  = "localhost";
$username    = "root";
$password    = "12345";
$dbname      = "darkbox";
$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name_file = $_POST['name_file'];
    $file_address = $_POST['file_address'];
    $user_file = $_POST['user_file'];
}