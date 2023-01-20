<?php
session_name("login");
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar viviendas</title>
</head>
<style>
    h1 {
        color: blue;
    }

    table tr td {
        border: 1px solid black;
    }
</style>

<body>
    <h1>Consulta de viviendas</h1>
    <table style="border: 1px solid black;">
        <thead style="background-color: blue;color:white">
            <th>Tipo</th>
            <th>Zona</th>
            <th>Dormitorios</th>
            <th>Precio</th>
            <th>Tamano</th>
            <th>Extras</th>
            <th>Foto</th>
        </thead>
        <tbody>
            <?php
            include "conexion.php";
            $db = conectaDB();
            $db->query("USE marzo");

            $tamanyoPaginas = 5; //numero de registros por pagina

            if (isset($_GET['pagina'])) {
                if ($_GET['pagina'] == 1) {
                    header("location: consultar.php");
                } else {
                    $pagina = $_GET['pagina'];
                }
            } else {
                $pagina = 1;
            }

            $empezarDesde = ($pagina - 1) * $tamanyoPaginas;
            $query = "SELECT * FROM viviendas";
            $resultado = $db->prepare($query);
            $resultado->execute(array());
            $numRegistros = $resultado->rowCount(); // numero de filas que nos devuelve la consulta
            $total_paginas = ceil($numRegistros / $tamanyoPaginas);
            $resultado->closeCursor();


            $sqlLimit = "SELECT * FROM viviendas LIMIT $empezarDesde, $tamanyoPaginas"; //consulta para mostrar de 5 en 5
            $resultado = $db->prepare($sqlLimit);
            $resultado->execute(array());
            if ($resultado->rowCount() > 0) {
                echo "<h4>Mostrando viviendas " . ($empezarDesde + 1) . " a " . $empezarDesde . " de un total de " . $numRegistros . " .";
                echo " [ <a>Anterior</a> | <a href='consultar.php?pagina=" . ($pagina + 1) . "'>Siguiente</a> ]</h4>";

                $viviendas = $resultado->fetchAll(PDO::FETCH_OBJ);
                foreach ($viviendas as $vivienda) : ?>
                    <tr>
                        <td><?php echo $vivienda->tipo ?></td>
                        <td><?php echo $vivienda->zona ?></td>
                        <td><?php echo $vivienda->dormitorios ?></td>
                        <td><?php echo $vivienda->precio ?></td>
                        <td><?php echo $vivienda->tamanyo ?></td>
                        <td><?php echo $vivienda->extras ?></td>
                        <td><a href="img/<?php echo $vivienda->foto ?>"><img src="file-img-ico.png" width="20" /></a></td>
                    </tr>
            <?php endforeach;
            } else {
                echo "<h4 style='color:red'>No hay viviendas para consultar</h4>";
                include "funciones.php";
                registrarErrorBD("No hay registros para consultar");
                echo "<a href='index.php'>[ Volver ] </a>";
            } ?>
        </tbody>
    </table>
    <p><a href="index.php">Volver</a></p>
</body>

</html>