<?php
include "../includes/conexao.php";

session_start();

if(!isset($_SESSION['id'])){
    die("Acesso negado.");
}

$usuario_id = $_SESSION['id'];
$opcao_id = $_POST['opcao_id'];

$conexao->query("
    INSERT INTO votos (usuario_id, opcao_id) VALUES ($usuario_id, $opcao_id)
");

header("Location: resultado.php");
?>