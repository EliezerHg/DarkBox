<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "darkbox";
$conn = new mysqli($servername, $username, $password, $dbname);

// var_dump($_SERVER);die();

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
if (isset($_FILES['fileToUpload'])) {
    $file = $_FILES['fileToUpload'];
    $fileName = basename($file['name']);
    $fileTmpName = $file['tmp_name'];
    $id         =   $_SESSION['id'];
    // Definir directorio de subida
    $uploadDirectory = $_SERVER["DOCUMENT_ROOT"]."/DarkBox/uploads/";

    // Generar la ruta completa
    $fileDestination = $uploadDirectory . $fileName;

    if (move_uploaded_file($fileTmpName, $fileDestination)) {
        $stmt = $conn->prepare("INSERT INTO files (name_file, file_address, user_file) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $fileName, $fileDestination, $id);

        if ($stmt->execute()) {
            echo "Archivo subido y guardado en la base de datos.";
        } else {
            echo "Error al guardar en la base de datos: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error al mover el archivo.";
    }
} else {
    echo "No se ha seleccionado ningún archivo.";
}

$conn->close();
?>