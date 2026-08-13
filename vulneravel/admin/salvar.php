<?php

include "../../includes/conexao.php";

session_start();

$titulo = $_POST['titulo'];
$descricao = $_POST['descricao'];
$opcoes = $_POST['opcoes'];

$imagem = null;

if (isset($_FILES['imagem'])) {

    $nome = $_FILES['imagem']['name'];

    $destino = "../../assets/uploads/" . $nome;

    move_uploaded_file(
        $_FILES['imagem']['tmp_name'],
        $destino
    );

    $imagem = $nome;
}

$conexao->query("INSERT INTO enquetes (titulo, descricao, imagem) VALUES ('$titulo', '$descricao', '$imagem')");

$enquete_id = $conexao->insert_id;

$conexao->query("INSERT INTO opcoes (texto, enquete_id) VALUES ('$opcoes[0]', $enquete_id )");
$conexao->query("INSERT INTO opcoes (texto, enquete_id) VALUES ('$opcoes[1]', $enquete_id )");
$conexao->query("INSERT INTO opcoes (texto, enquete_id) VALUES ('$opcoes[2]', $enquete_id )");


header("Location: index.php");
?>