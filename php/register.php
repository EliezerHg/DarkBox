<html>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/png" href="../images/Darkbox_W.png">
        <title>Registro - DarkBox</title>
        <link rel="stylesheet" href="../css/styles_login-Register.css?v=1.6">
        <link rel="stylesheet" href="../css/style_layout.css?v=1.10">
    </head>
    <body>
        <header>
            <nav class="nav">
               <div class="logo">
               <a href="./index.php">
                   <img src="../images/DarkBox_B.png" alt="Drarkbox"> 
               </a>
                   <div>
                       <h1>DarkBox</h1>
                   </div> 
                </div>
            </nav>
        </header>
        <div class="div_register">
            <form action="register_api.php" method="POST" onsubmit="return validateEmail()" class="register_form">
                <h2>Regístrate</h2>
                <input type="text" required id="first_name" name="first_name" pattern="[A-Za-z ]{3,45}"  placeholder="Nombre">
                <input type="text" required id="last_name" name="last_name" pattern="[A-Za-z ]{3,45}"  placeholder="Apellido Paterno">
                <input type="text" required id="last_name2" name="last_name2" pattern="[A-Za-z ]{3,45}" placeholder="Apellido Materno">
                <input type="email" required id="email" name="email" placeholder="Correo electrónico">
                <input type="password" required id="passw" name="passw" placeholder="Contraseña">
                <div>
                    <label for="Message">¿Ya tienes cuenta?</label>
                    <a href="./login.php">Inicia Sesión</a>
                </div>
                <button type="submit">Registrarse</button>
            </form>
        </div>
        <footer>
            <p>©DarkBox 2024 | Todos los derechos reservados | <a href="./index.php"> Terminos de uso</a></p>
        </footer>
    </body>
    </html>
    <script>
        function validateEmail() {
            const emailInput = document.getElementById("email");
            const emailError = document.getElementById("emailError");
            const email = emailInput.value;
            if (email === "") {
                emailError.textContent = "El correo electrónico no puede estar vacío.";
                return false;
            }
            const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            if (!emailRegex.test(email)) {
                emailError.textContent = "El correo electrónico no tiene un formato válido.";
                return false;
            }
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "verificar_email.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    if (xhr.responseText === "existe") {
                        emailError.textContent = "El correo electrónico ya está registrado.";
                    } else {
                        emailError.textContent = "";
                    }
                }
            };
            xhr.send("email=" + encodeURIComponent(email));
            return true;
        }
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("email").addEventListener("blur", validateEmail);
        });
    </script>   
    
</html>