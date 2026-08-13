<?php

session_start();

include "../includes/conexao.php";
include "../includes/csrf.php";
include "../includes/autenticacao.php";
include "includes/sessao.php";

verificarTokenCSRF();


$usuario_id = $_SESSION['id'];

$opcao_id = filter_input(
    INPUT_POST,
    'opcao_id',
    FILTER_VALIDATE_INT
);


if (!$opcao_id) {
    die("Opção inválida.");
}


$stmt = $conexao->prepare("
    SELECT id
    FROM opcoes
    WHERE id = ?
");

$stmt->bind_param(
    "i",
    $opcao_id
);

$stmt->execute();

$resultado = $stmt->get_result();

if ($resultado->num_rows === 0) {
    die("Opção inexistente.");
}


$stmt = $conexao->prepare("
    INSERT INTO votos (usuario_id, opcao_id)
    VALUES (?, ?)
");

$stmt->bind_param(
    "ii",
    $usuario_id,
    $opcao_id
);

if (!$stmt->execute()) {
    die("Erro ao registrar voto.");
}


header("Location: resultado.php");
exit;