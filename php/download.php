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




 $file_url       =   $files[0]['file_address'];#'https://media.geeksforgeeks.org/wp-content/uploads/gfg-40.png';
//  $file_url = 'http://www.myremoteserver.com/file.exe';
header('Content-Type: application/octet-stream');
header("Content-Transfer-Encoding: Binary"); 
header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\"");
readfile($file_url);

// Insertar JavaScript para cerrar la página
#echo '<script type="text/javascript">window.close();</script>';
 echo "
<script>
alert('Registro exitoso, Inicia Sesión');
window.location.href = 'login.php';
</script>
";