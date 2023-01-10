<?php
//Validar solo letras
function validarDir($var) {
    $regex1= "/^[A-Za-z0-9º ]+$/";
    if (preg_match($regex1,$var)) {
        return $var;
    }
}

function validaPrecio($var) {
    $regex2 = "/^[0-9]+$/";
    if (preg_match($regex2,$var)) {
        return $var;
    }
}
?>