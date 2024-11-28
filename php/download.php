<?php 
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "darkbox";
$conn = new mysqli($servername, $username, $password, $dbname);
$sql = "SELECT * FROM files WHERE id_file = ?";

$id        =   $_GET["id"]?? 1;

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$files = $result->fetch_all(MYSQLI_ASSOC);

  


 $file_url       =   $files[0]['file_address'];
header('Content-Type: application/octet-stream');
header("Content-Transfer-Encoding: Binary"); 
header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\"");
readfile($file_url);
 echo "
<script>
alert('Registro exitoso, Inicia Sesión');
window.location.href = 'login.php';
</script>
";