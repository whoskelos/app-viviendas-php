<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>borrar viviendas</title>
</head>
<style>
    table tr td {
        border: 1px solid black;
    }
</style>

<body>
    <h1>Eliminacion de viviendas</h1>
    <form action="eliminar-viviendas.php" method="post">
        <table style="border: 1px solid black;">
            <thead style="background-color: blue;color:white">
                <th>Tipo</th>
                <th>Zona</th>
                <th>Dormitorios</th>
                <th>Precio</th>
                <th>Tamano</th>
                <th>Extras</th>
                <th>Foto</th>
                <th>Borrar</th>
            </thead>
            <tbody>
                <?php
                include "conexion.php";
                $db = conectaDB();
                $db->query("USE marzo");
                $result = $db->query("SELECT * FROM VIVIENDAS");
                //si hay viviendas mostramos
                if ($result->rowCount() > 0 ) {
                $viviendas = $result->fetchAll(PDO::FETCH_OBJ);
                foreach ($viviendas as $vivienda) : ?>
                <tr>
                    <td><?php echo $vivienda->tipo ?></td>
                    <td><?php echo $vivienda->zona ?></td>
                    <td><?php echo $vivienda->dormitorios ?></td>
                    <td><?php echo $vivienda->precio ?></td>
                    <td><?php echo $vivienda->tamanyo ?></td>
                    <td><?php echo $vivienda->extras ?></td>
                    <td><a href="<?php echo $vivienda->foto ?>"><img src="file-img-ico.png" width="20" /></a></td>
                    <td><input type="checkbox" name="idViviendas[]" value="<?php echo $vivienda->id ?>"></td>
                </tr>
                <?php endforeach; } else { echo "<h4 style='color:red'>No hay viviendas para mostrar</h4>";
                include "funciones.php";
                registrarErrorBD("No hay registros para borrar");
                echo "<a href='index.php'>[ Volver ] </a>";}?>
            </tbody>
        </table>
        <input style="margin-top: 5px;" type="submit" value="Eliminar viviendas marcadas" name="enviar">
    </form>
</body>

</html>