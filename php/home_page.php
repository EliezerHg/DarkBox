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

?>
<html>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/png" href="../images/Darkbox_W.png">
        <title>Iniciar Sesión - DarkBox</title>
        <link rel="stylesheet" href="../css/styles_login-Register.css?v=1.10">
        <link rel="stylesheet" href="../css/style_layout.css?v=1.8">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <body>
        
        <section class="layout">
            <div class="logo">
                <a href="./index.php">
                    <img src="../images/DarkBox_W.png" alt="DarkBox" href="../index.php">
                </a>
                <div>
                    <h1 style="color:white">DarkBox</h1>
                </div>
            </div>
            <div class="nav">
            </div>
            <div class="nav_left">
                <ul> 
                    <li><button class="btn-nav_left" onclick="upload()">Subir Archivo</button></li>
                    <li><button class="btn-nav_left" onclick="getFiles()">Archivos</button></li>
                    <li><button class="btn-nav_left" onclick="window.location.href='./logout.php'">Salir</button></li>
                </ul>
            </div>
            </div>
            <div class="content_home">AQUI VA EL CONTENIDO DE LA PAGINA DE INICIO</div>
    </section>
    </body>
    </html>
    <script>
        var_dump($_POST);
        async function upload() {
        const { value: file } = await Swal.fire({
            title: "Subir archivo",
            input: "file",
            inputAttributes: {
                "accept": "*",
                "aria-label": "Sube un archivo"
            }
        });
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    Swal.fire({
                    title: "Archivo subido",
                    text: `Nombre: ${file.name}`,
                    footer: `Tamaño: ${(file.size / 1024).toFixed(2)} MB`,
                    icon: "success"
                });
                console.log("Contenido del archivo:", e.target.result);
            };
            reader.readAsText(file);
        }
    }
</script>
l
    
</html>