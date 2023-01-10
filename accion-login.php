<!DOCTYPE html>
<html lang="en">

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

    </style>
</head>

<body>
    <?php
    if (isset($_POST['enviar'])) {
        $errores = [];
        include "sanear.php";
        $usuario = sanear("usuario");
        $password = sanear("clave");
        if ($usuario == "" || $password == "") {
            echo "<div class='container'>Acceso no autorizado
                <p>[<a href='login.php'>Conectar</a>]</p>
            </div>";
            $errores[] = "Usuario/Contraseñas vacío";
        }

        if (empty($errores)) {
            include "conexion.php";
            $db = conectaDB();
            $db->query("USE `marzo`");
            $result = $db->prepare("SELECT * FROM `User` WHERE `username` = ? AND `passwd` = ?");
            $result->execute(array($usuario,$password));

            //compruebo que me devuelva una coincidencia
            if ($result->rowCount() > 0) {
                //redirigo al index
                include 'crearTablaViv.php';
                header("Location: index.php");
            } else {
                echo "<div class='container'>Acceso no autorizado
                <p>[<a href='login.php'>Conectar</a>]</p>
            </div>";
            }
        }
    }
    ?>

</body>

</html>