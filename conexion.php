<?php
$host = "localhost";
$user = "root";
$password = "n0m3l0";
$dbname = "salas_db";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
