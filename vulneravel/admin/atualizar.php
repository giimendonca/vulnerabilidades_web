<?php
include "../../includes/conexao.php";

session_start();

if(!isset($_SESSION['id'])){
    die("Acesso negado.");
}

$titulo = $_POST['titulo'];
$descricao = $_POST['descricao'];
$opcoes = $_POST['opcoes'];
$enquete_id = $_POST['id'];

$conexao->query("UPDATE enquetes SET titulo = '$titulo', descricao = '$descricao' WHERE id = $enquete_id");

$conexao->query("UPDATE opcoes SET texto = '$opcoes[0]', enquete_id = $enquete_id WHERE enquete_id = $enquete_id");

$conexao->query("UPDATE opcoes SET texto = '$opcoes[1]', enquete_id = $enquete_id WHERE enquete_id = $enquete_id");

$conexao->query("UPDATE opcoes SET texto = '$opcoes[2]', enquete_id = $enquete_id WHERE enquete_id = $enquete_id");

header("Location: index.php");
?>