<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "darkbox";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
// var_dump($_POST);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $last_name2 = $_POST['last_name2'];
    $email = $_POST['email'];
    $passw = $_POST['passw'];
    if (empty($email)) {
        echo "El campo de email no puede estar vacío.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "El email no tiene un formato válido.";
    } else {
        $sql_check = "SELECT * FROM users WHERE email = ?";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->bind_param("s", $email);
        $stmt_check->execute();
        $stmt_check->store_result();
        if ($stmt_check->num_rows > 0) {
            echo "El email ya está registrado.";
        } else {
            $sql = "INSERT INTO users    (first_name, last_name, last_name2, email, passw) 
            VALUES (?, ?, ?, ?, ?)";       
            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param("sssss", $first_name, $last_name, $last_name2, $email, $passw);
                if ($stmt->execute()) {
                   echo "
                    <script>
                        alert('Registro exitoso, Inicia Sesión');
                        window.location.href = 'login.php';
                    </script>
                   "; 
                } else {
                    echo "Error al registrar: " . $stmt->error;
                }
                $stmt->close();
            }
        }
        $stmt_check->close();
    }
}
$conn->close();
?>
