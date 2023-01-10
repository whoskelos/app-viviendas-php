<?php
$db = conectaDB();
$db->query("USE `marzo`");
//creamos tabla
$consulta = "CREATE TABLE IF NOT EXISTS `viviendas`(
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    tipo VARCHAR(100) NOT NULL DEFAULT 'piso',
    zona VARCHAR(100) NOT NULL DEFAULT 'centro',
    direccion VARCHAR(100) NOT NULL,
    dormitorios INT NOT NULL DEFAULT 3,
    precio INT NOT NULL,
    tamanyo INT NOT NULL,
    extras VARCHAR(100) NOT NULL,
    foto VARCHAR(100)
    )ENGINE=INNODB DEFAULT CHARSET=utf8;";

$db->query($consulta);
?>