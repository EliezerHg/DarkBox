<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "darkbox";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["email"])) {
    $email = $_POST["email"];

    $sql = "SELECT email FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        echo "existe";
    }

    $stmt->close();
}
$conn->close();
?>
