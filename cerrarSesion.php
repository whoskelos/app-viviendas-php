<?php
if (isset($_SESSION["login"])) {
    session_unset();
    session_destroy();
} else {
    echo "<p>Sesion finalizada</p>";
    echo "<p><a href='login.php'>[ Conectar ]</a></p>";
}
?>