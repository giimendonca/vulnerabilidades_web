<?php
include "../../includes/conexao.php";

session_start();

if(!isset($_SESSION['id'])){
    die("Acesso negado.");
}

$titulo = $_POST['titulo'];
$descricao = $_POST['descricao'];

$opcoes = $_POST['opcoes'];
$opcao_ids = $_POST['opcao_ids'];

$enquete_id = $_POST['id'];

$conexao->query("UPDATE enquetes SET titulo = '$titulo', descricao = '$descricao' WHERE id = $enquete_id");

for ($i = 0; $i < count($opcoes); $i++){
    $opcao_id = $opcao_ids[$i];
    $texto = $opcoes[$i];

    $conexao->query("
        UPDATE opcoes SET texto = '$texto' WHERE id = $opcao_id AND enquete_id = $enquete_id
    ");
}
header("Location: index.php");
?>