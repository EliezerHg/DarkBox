<html>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/png" href="../images/Darkbox_W.png">
        <title>Iniciar Sesión - DarkBox</title>
        <link rel="stylesheet" href="../css/styles_login-Register.css?v=1.6">
        <link rel="stylesheet" href="../css/style_layout.css?v=1.10">

    </head>
    <body>
        <header>
            <nav class="nav">
               <div class="logo">
                <a href="./index.php">
                    <img src="../images/DarkBox_B.png" alt="DarkBox" href="../index.php">
                </a>
                   <div>
                       <h1>DarkBox</h1>
                   </div> 
                </div>
        </header>
        <div class="div_login">
            <form action="process_login.php" method="POST" class="login_form">
                <h2>Iniciar Sesión</h2>
                <input type="email" required id="email" name="email" placeholder="Correo electrónico">
                <input type="password" required id="passw" name="passw" placeholder="Contraseña">
                <div>
                    <label for="Message">¿Aun no tienes cuenta?</label>
                    <a href="./register.php">Registrate</a>
                </div>
                <button type="submit">Iniciar Sesión</button>
            </form>
            <?php if (isset($_GET['error'])): ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
        <?php endif; ?>
        </div>
        <footer>
            <p>©DarkBox 2024 | Todos los derechos reservados | <a href="./index.php"> Terminos de uso</a></p>
        </footer>
    </body>
    </html>

    
</html>