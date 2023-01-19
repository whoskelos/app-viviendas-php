<?php
if (isset($_POST["enviar"])) {
    include "funciones.php";
    if (isset($_POST["idViviendas"]) && $_POST["idViviendas"] != "") {
        $idVivienda = $_POST["idViviendas"];
        include "conexion.php";
        $db = conectaDB();
        $db->query("USE marzo");
        $query = $db->prepare("DELETE FROM viviendas WHERE id = ?");
        foreach ($idVivienda as $id) {
            $result = $query->execute(array($id));
        }
        if ($result == true) {
            header("Location: borrar.php");
        }

    } else {
        registrarErrorBD("No ha seleccionado registros para borrar");
        echo "<h4 style='color:red'>No ha seleccionado registros para borrar</h4>";
        echo "<a href='borrar.php'>[ Volver ] </a>";
    }
}
?>