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
?>