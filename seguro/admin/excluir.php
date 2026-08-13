<?php

include "../includes/autenticacao.php";
include "../includes/autorizacao.php";
include "../includes/csrf.php";
include "../includes/security.php";
include "../includes/sessao_segura.php";
include "../../includes/header.php";
include "../../includes/conexao.php";

if (!isset($_SESSION['id'])) {
    die("Acesso negado.");
}

if ($_SESSION['tipo'] !== 'admin') {
    die("Acesso negado.");
}

verificarTokenCSRF();

$id = filter_input(
    INPUT_POST,
    'id',
    FILTER_VALIDATE_INT
);

if (!$id) {
    die("Enquete inválida.");
}


$stmt = $conexao->prepare("
    DELETE FROM enquetes
    WHERE id = ?
");

$stmt->bind_param(
    "i",
    $id
);

if (!$stmt->execute()) {
    die("Erro ao excluir enquete.");
}


header("Location: index.php");
exit;