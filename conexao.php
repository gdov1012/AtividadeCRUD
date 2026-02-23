<?php
$mysqli = new mysqli("localhost", "root", "", "escola");
 
if ($mysqli->connect_error) {
    die("Erro na conexão: " . $mysqli->connect_error);
}
?>