<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "12345";
$dbname = "darkbox";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$user_id = $_SESSION['user'];

$sql = "SELECT name_file, file_address FROM files WHERE user_file = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$files = [];
while ($row = $result->fetch_assoc()) {
    $files[] = $row;
}

echo json_encode($files);

$conn->close();
?>