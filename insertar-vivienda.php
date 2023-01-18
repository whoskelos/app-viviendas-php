<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado inserccion vivienda</title>
</head>

<body>
    <h1>Inserción de vivienda</h1>
    <?php
    include "funciones.php";
    include "validaciones.php";
    include "sanear.php";
    if (isset($_POST['insertar'])) {
        $errores = [];
        //tipo 
        if (isset($_POST["tipo"]) && $_POST["tipo"] != "") {
            $tipo = sanear("tipo");
        }
        //zona 
        if (isset($_POST["zona"]) && $_POST["zona"] != "") {
            $zona = $_POST["zona"];
        }
        //valido direccion
        if (isset($_POST['direccion']) && $_POST["direccion"] != "") {
            $dir = sanear("direccion");
            if (!validarDir($dir)) {
                $errores[] = "Formato direccion no valido";
                header("location: insertar.php?err=dir");
            }
        } else {
            $errores[] = "Campo direccion vacio";
            header("location: insertar.php?err=dir");
        }

        //numero dormitorios
        if (isset($_POST['ndormitorios']) && $_POST['ndormitorios'] != "") {
            $nDormitorios = sanear("ndormitorios");
        }

        //valido precio
        if (isset($_POST['precio']) && $_POST["precio"] != "") {
            $precio = sanear("precio");
            if (!validaPrecio($precio)) {
                $errores[] = "Formato precio no valido";
                header("location: insertar.php?err=pre");
            }
        } else {
            $errores[] = "Campo precio vacio";
            header("location: insertar.php?err=pre");
        }

        //valido tamano
        if (isset($_POST['tamano']) && $_POST["tamano"] != "") {
            $tamano = sanear("tamano");
            if (!validaPrecio($tamano)) {
                $errores[] = "Formato tamano no valido";
                header("location: insertar.php?err=tam");
            }
        } else {
            $errores[] = "Campo tamano vacio";
            header("location: insertar.php?err=tam");
        }

        //extras
        if (isset($_POST["extras"])) {
            $extras = $_POST["extras"];
        }

        //foto
        $foto = $_FILES['foto']['name'];

        //observaciones
        $observaciones = sanear("observaciones");


        //si no hay errores insertamos
        if (empty($errores)) {
            if (subirImagen()) {
                echo insertarViv($tipo, $zona, $dir, $nDormitorios, $precio, $tamano, $extras, $foto, $observaciones);
            } else {
                echo "<h4>No se inserta vivienda, error con la imagen </h4>";
            }
        } else {
            foreach ($errores as $error) {
                registrarError($error);
            }
        }
    }
    ?>
</body>

</html>