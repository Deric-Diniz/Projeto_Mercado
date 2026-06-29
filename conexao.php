<?php
$host = "localhost:3307"; // Porta correta do seu ambiente XAMPP
$usuario = "root";
$senha = "";
$banco = "bd_minimercado";

$conn = mysqli_connect($host, $usuario, $senha, $banco);

if (!$conn) {
    die("Erro na conexão: " . mysqli_connect_error());
}
mysqli_set_charset($conn, "utf8mb4");
?>