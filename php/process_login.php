<?php
$servername  = "localhost";
$username    = "root";
$password    = "12345";
$dbname      = "darkbox";
$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}
$email      = $_POST['email'];
$passw      = $_POST['passw'];
$sql        = "SELECT * FROM users WHERE email = '$email' AND passw = '$passw'";
$result     = $conn->query($sql);

$sql = "SELECT * FROM users WHERE email = '$email' AND passw = '$passw'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    session_start();
    $_SESSION['user'] = $email; 
    header("Location: home_page.php");
} else {
    header("Location: login.php?error=Credenciales incorrectas.");
}

$conn->close();
?>