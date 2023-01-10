<?php
include "funciones.php";
include "validaciones.php";
include "sanear.php";
if (isset($_POST['insertar'])) {
    $errores = [];

    //valido direccion
    if (isset($_POST['direccion']) && $_POST["direccion"] != "") {
        $dir = sanear("direccion");
        if (!validarDir($dir)){
            $errores[] = "Formato direccion no valido";
            header("location: insertar.php?err=dir");
        }
    } else {
        $errores[] = "Campo direccion vacio";
        header("location: insertar.php?err=dir");
    }

    //valido precio
    if (isset($_POST['precio']) && $_POST["precio"] != "") {
        $precio = sanear("precio");
        if (!validaPrecio($precio)){
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
        if (!validaPrecio($tamano)){
            $errores[] = "Formato tamano no valido";
            header("location: insertar.php?err=tam");
        }
    } else {
        $errores[] = "Campo tamano vacio";
        header("location: insertar.php?err=tam");
    }

    //extras
    if (isset($_POST["extras"])) {
        $extras = sanear("extras");
    }


    //si no hay errores insertamos
    if (empty($errores)) {
        echo "ok";
    } else {
        foreach ($errores as $error) {
            registrarError($error);
        }
    }
}
?>