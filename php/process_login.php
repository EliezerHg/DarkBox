<?php
$servername  = "localhost";
$username    = "root";
$password    = "";
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
$user = $result->fetch_all(MYSQLI_ASSOC);
if ($result->num_rows > 0) {
    session_start();
    $_SESSION['user']   =   $email;
    $_SESSION['id']     =   $user[0]['id_user']; 
    header("Location: home_page.php");
} else {
    header("Location: login.php?error=Credenciales incorrectas.");
}

$conn->close();
?>