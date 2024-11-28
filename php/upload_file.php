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
if (isset($_FILES['fileToUpload'])) {
    $file = $_FILES['fileToUpload'];

    $fileName = basename($file['name']);
    $fileTmpName = $file['tmp_name'];
    $fileDestination = 'uploads' . $fileName;
    if (move_uploaded_file($fileTmpName, $fileDestination)) {
        $user_id = $_SESSION['user'];
        $stmt = $conn->prepare("INSERT INTO files (name_file, file_address, user_file) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $fileName, $fileDestination, $user_id);

        if ($stmt->execute()) {
            echo "Archivo subido y guardado en la base de datos";
        } else {
            echo "Error al guardar en la base de datos: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error al mover el archivo";
    }
} else {
    echo "No se ha seleccionado ningún archivo";
}

$conn->close();
?>
