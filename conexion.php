<?php
function conectaDB() {
    try {
        $user = "root";
        $password = "";
        $dsn = "mysql:host=localhost";
        $dbh = new PDO($dsn,$user,$password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $dbh;
    } catch (PDOException $e) {
        print $e->getMessage();
    }
}
?>