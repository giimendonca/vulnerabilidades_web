<?php
$host = 'localhost';
$user = 'root';
$senha = 'Home@spSENAI2025!';
$banco = 'voteSafe';

$conexao = new mysqli($host, $user, $senha, $banco);

if($conexao->connect_error){
    die("Falha na conexao: " . $conexao->connect_error);
}

$conexao->set_charset("utf8mb4");
?>