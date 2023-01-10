<?php
include "conexion.php";
$db = conectaDB();
//creamos base de datos y creamos tabla
$consulta = "DROP DATABASE IF EXISTS marzo;
CREATE DATABASE marzo;
USE `marzo`;
CREATE TABLE `User`(
    `username` VARCHAR(20) PRIMARY KEY,
    `passwd` VARCHAR(50) NOT NULL,
    `email` VARCHAR(100) NOT NULL
)ENGINE=INNODB DEFAULT CHARSET=utf8;";
//ejecuto la consulta
$db->query($consulta);

//inserto usuarios
$consulta = "INSERT INTO `User` (username,passwd,email) VALUES ('User1','admin1','user1@gmail.com');
INSERT INTO `User` (username,passwd,email) VALUES ('User2','admin2','user2@gmail.com');
INSERT INTO `User` (username,passwd,email) VALUES ('User3','admin3','user3@gmail.com')";
$db->query($consulta);
?>