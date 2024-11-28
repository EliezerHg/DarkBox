<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "darkbox";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
$user_id    =   $_SESSION['user'];
$id         =   $_SESSION['id'];

$sql = "SELECT * FROM files WHERE user_file = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$files = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
// var_dump($_SESSION);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../images/Darkbox_W.png">
    <title>Inicio - DarkBox</title>
    <link rel="stylesheet" href="../css/styles_login-Register.css?v=1.10">
    <link rel="stylesheet" href="../css/style_layout.css?v=1.0">
    <link rel="stylesheet" href="../css/style_home.css?v=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .btn{border-radius: 4px;border:solid #0075BD;}
        .descarga{background-color: #0075BD;list-style:none;text-decoration: none;}
    </style>
</head>
<body>
    <section class="layout">
        <div class="logo">
            <a href="./index.php">
                <img src="../images/DarkBox_W.png" alt="DarkBox">
            </a>
            <div>
                <h1 style="color:white">DarkBox</h1>
            </div>
        </div>
        <div class="nav">
        </div>
        <div class="nav_left">
            <ul>
                <li><button class="btn-nav_left" onclick="toggleUploadForm()">Subir Archivo</button></li>
                <li><button class="btn-nav_left" onclick="getFiles()">Archivos</button></li>
                <li><button class="btn-nav_left" onclick="window.location.href='./logout.php'">Salir</button></li>
            </ul>
        </div>
        <div class="content_home">
            <h2>Bienvenido a DarkBox</h2>
            <p>Aquí puedes subir y gestionar tus archivos.</p>
            <div id="uploadForm">
                <span class="cerrar" onclick="toggleUploadForm()">×</span>
                <form action="upload_file.php" method="POST" enctype="multipart/form-data">
                    <h2>Subir Archivo</h2>
                    <label style="color:Black" for="fileToUpload">Seleccionar archivo</label>
                    <input style="color:Black" type="file" name="fileToUpload" id="fileToUpload" required>
                    <button type="submit" name="submit">Subir Archivo</button>
                </form>
            </div>
            <h3>Archivos Cargados:</h3>
            <ul id="fileList">
                <?php
                if (count($files) > 0) {
                    foreach ($files as $file) {
                        echo '<li><a href="./download.php?id=' . $file['id_file'] . '" target="_blank">' . $file['name_file'] . '</a>  <a class="btn descarga" href="./download.php?id=' . $file['id_file'] . '">Descargar</a></li>';
                    }
                } else {
                    echo '<li>No tienes archivos cargados.</li>'; 
                }
                ?>
            </ul>
        </div>
    </section>
    <script>o
        function toggleUploadForm() {
            const uploadForm = document.getElementById('uploadForm');
            if (uploadForm.style.display === "none" || uploadForm.style.display === "") {
                uploadForm.style.display = "block";
            } else {
                uploadForm.style.display = "none";
            }
        }
        function getFiles() {
            fetch('fetch_files.php')
                .then(response => response.json())
                .then(data => {
                    const fileList = document.getElementById('fileList');
                    fileList.innerHTML = '';
                    data.forEach(file => {
                        const listItem = document.createElement('li');
                        listItem.innerHTML = `<a href="${file.file_address}" target="_blank">${file.name_file}</a>`;
                        fileList.appendChild(listItem);
                    });
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'No se pudieron cargar los archivos'
                    });
                    console.error('Error:', error);
                });
        }
        document.addEventListener('DOMContentLoaded', getFiles);
    </script>
</body>
</html>
