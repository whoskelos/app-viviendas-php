<?php
function registrarError($err) {
    $dir = "errores/";
    if (is_dir("errores")) {
        $manejador = fopen($dir."errores.txt","a+");
        fwrite($manejador,"$err\n\r");
    } else {
        mkdir("errores");
        $manejador = fopen($dir."errores.txt","a+");
        fwrite($manejador,"$err\r\n");
    }
    
}

function registrarErrorBD($err){
    $dir = "errores/";
    if (is_dir("errores")) {
        $manejador = fopen($dir."erroresBD.txt","a+");
        fwrite($manejador,"$err\n\r");
    } else {
        mkdir("errores");
        $manejador = fopen($dir."erroresBD.txt","a+");
        fwrite($manejador,"$err\r\n");
    }
}

function registrarErrorImg($err){
    $dir = "errores/";
    if (is_dir("errores")) {
        $manejador = fopen($dir."log_errores.txt","a+");
        fwrite($manejador,"$err\n\r");
    } else {
        mkdir("errores");
        $manejador = fopen($dir."log_errores.txt","a+");
        fwrite($manejador,"$err\r\n");
    }
}

function subirImagen(){
    $sizeImagen = $_FILES['foto']['size'];
    echo $sizeImagen;
    //si el tamano excede la directiva max_file_size puesta en html
    if ($sizeImagen <= $_POST['MAX_FILE_SIZE']) {
        $dir = "img/";
        //si existe el directorio
        if (is_dir("img")) {
            if (is_uploaded_file($_FILES['foto']['tmp_name'])) {
                $nombreFichero = $_FILES['foto']['name'];
                $nombreCompleto = $dir.$nombreFichero;
                if (is_file($nombreCompleto)) {
                    $idUnico = time();
                    $nombreFichero = $idUnico . "-" . $nombreFichero;
                    $nombreCompleto = $dir.$nombreFichero;
                }
                move_uploaded_file($_FILES['foto']['tmp_name'],$nombreCompleto);
            }
        } else {
            mkdir("img");
            if (is_uploaded_file($_FILES['foto']['tmp_name'])) {
                $nombreFichero = $_FILES['foto']['name'];
                $nombreCompleto = $dir.$nombreFichero;
                if (is_file($nombreCompleto)) {
                    $idUnico = time();
                    $nombreFichero = $idUnico . "-" . $nombreFichero;
                    $nombreCompleto = $dir.$nombreFichero;
                }
                move_uploaded_file($_FILES['foto']['tmp_name'],$nombreCompleto);
            }
        }
        return true;
    } else {
        //registrar error imagen
        registrarErrorImg("El fichero subido excede de la directiva max_file_size del formulario ");
        return false;
        // return "<p>Error al subir el fichero excede del tamano del max_file_size </p>";
    }
}

function insertarViv($tipo,$zona,$direccion,$dormitorios,$precio,$tamanyo,$extras,$foto,$observaciones){
    //subimos la imagen
    subirImagen();
    //convierto los extras a string
    $extrasString = implode(",",$extras);
    include 'conexion.php';
    //si hay foto
    if ($foto != "") {
        $db = conectaDB();
        $db->query("USE marzo");
        //comprobamos con la direccion si ya existe para comprobar si el registro esta duplicado
        $select = $db->query("SELECT * FROM viviendas where direccion = '$direccion'");
        if ($result = $select->rowCount() > 0) {
            registrarErrorBD("Registro duplicado");
            return "<p>Registro duplicado</p><a href='insertar.php'>[ Insertar otra vivienda ]</a>";
        } else {
            $query = $db->prepare("INSERT INTO viviendas (tipo,zona,direccion,dormitorios,precio,tamanyo,extras,foto) VALUES (?,?,?,?,?,?,?,?)");
            $result = $query->execute(array($tipo,$zona,$direccion,$dormitorios,$precio,$tamanyo,$extrasString,$foto));
            if ($result == true) {
                return "<p>Vivienda insertada correctamente</p>
                <p>Esto son los datos introducidos:</p>
                <ul>
                    <li>Tipo: $tipo</li>
                    <li>Zona: $zona</li>
                    <li>direccion: $direccion</li>
                    <li>dormitorios: $dormitorios</li>
                    <li>precio: $precio euros</li>
                    <li>tamano: $tamanyo</li>
                    <li>extras: $extrasString</li>
                    <li>foto: <a href='img/$foto'>$foto</a></li>
                    <li>extras: $extrasString</li>
                    <li>observaciones: $observaciones</li>
                </ul>
                <a href='insertar.php'>[ Insertar otra vivienda ]</a>";
            } else {
                registrarErrorBD("Error al registrar vivienda");
            }
        }
    //si no hay foto
    } else { 
        $db = conectaDB();
        $db->query("USE marzo");
        //comprobamos con la direccion si ya existe para comprobar si el registro esta duplicado
        $select = $db->query("SELECT * FROM viviendas where direccion = '$direccion'");
        if ($result = $select->rowCount() > 0) {
            registrarErrorBD("Registro duplicado");
            return "<p>Registro duplicado</p><a href='insertar.php'>[ Insertar otra vivienda ]</a>";
        } else {
            $query = $db->prepare("INSERT INTO viviendas (tipo,zona,direccion,dormitorios,precio,tamanyo,extras,foto) VALUES (?,?,?,?,?,?,?,?)");
            $result = $query->execute(array($tipo,$zona,$direccion,$dormitorios,$precio,$tamanyo,$extrasString,$foto));
            if ($result == true) {
                return "<p>Vivienda insertada correctamente</p>
                <p>Esto son los datos introducidos:</p>
                <ul>
                    <li>Tipo: $tipo</li>
                    <li>Zona: $zona</li>
                    <li>direccion: $direccion</li>
                    <li>dormitorios: $dormitorios</li>
                    <li>precio: $precio euros</li>
                    <li>tamano: $tamanyo</li>
                    <li>extras: $extrasString</li>
                    <li>foto:(no hay)</li>
                    <li>extras: $extrasString</li>
                    <li>observaciones: $observaciones</li>
                </ul>
                <a href='insertar.php'>[ Insertar otra vivienda ]</a>";
            } else {
                registrarErrorBD("Error al registrar vivienda");
            }
        }
    }

}
?>