<?php
session_name("login");
session_start();
if (isset($_SESSION['login'])) {
    header("Location: index.php");
}

include "crearBD.php";
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: sans-serif;
        }

        .container {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .form-login {
            border: 1px dotted blue;
            padding: 10px;
        }
        form input {
            margin: 5px;
        }

    </style>
</head>

<body>
    <div class="container">
        <div class="login">
            <p>Esta zona tiene el acceso restringido.</p>
            <p>Para entrar debe identificarse</p>
            <div class="form-login">
                <form action="accion-login.php" method="post">
                    <table>
                        <tr>
                            <td><strong>Usuario:</strong></td>
                            <td><input type="text" name="usuario" id="usuario"></td>
                        </tr>
                        <tr>
                            <td><strong>Clave:</strong></td>
                            <td><input type="text" name="clave" id="clave"></td>
                        </tr>
                    </table>
                    <input type="submit" value="Entrar" name="enviar">
                </form>
            </div>
        </div>
    </div>
</body>

</html>