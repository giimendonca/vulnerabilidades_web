<?php

include "../../includes/conexao.php";

session_start();

if(!isset($_SESSION['id'])){
    die("Acesso negado.");
}

$titulo = $_POST['titulo'];
$descricao = $_POST['descricao'];
$opcoes = $_POST['opcoes'];

$conexao->query("INSERT INTO enquetes (titulo, descricao) VALUES ('$titulo', '$descricao' )");

$enquete_id = $conexao->insert_id;

$conexao->query("INSERT INTO opcoes (texto, enquete_id) VALUES ('$opcoes[0]', $enquete_id )");
$conexao->query("INSERT INTO opcoes (texto, enquete_id) VALUES ('$opcoes[1]', $enquete_id )");
$conexao->query("INSERT INTO opcoes (texto, enquete_id) VALUES ('$opcoes[2]', $enquete_id )");

header("Location: index.php");
?>