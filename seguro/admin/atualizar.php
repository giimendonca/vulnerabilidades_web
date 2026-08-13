<?php

session_start();

include "../../includes/conexao.php";
include "../../includes/csrf.php";
include "../../includes/autenticacao.php";
include "../../includes/autorizacao.php";
include "../../includes/security.php";
include "../../includes/sessao.php";

if (!isset($_SESSION['id'])) {
    die("Acesso negado.");
}

if ($_SESSION['tipo'] !== 'admin') {
    die("Acesso negado.");
}

verificarTokenCSRF();

$enquete_id = filter_input(
    INPUT_POST,
    'id',
    FILTER_VALIDATE_INT
);

$titulo = trim($_POST['titulo'] ?? '');
$descricao = trim($_POST['descricao'] ?? '');

$opcoes = $_POST['opcoes'] ?? [];
$opcao_ids = $_POST['opcao_ids'] ?? [];


if (!$enquete_id) {
    die("Enquete inválida.");
}


if ($titulo === '' || $descricao === '') {
    die("Preencha todos os campos.");
}


if (count($opcoes) !== count($opcao_ids)) {
    die("Dados das opções inválidos.");
}


$conexao->begin_transaction();

try {

    $stmt = $conexao->prepare("
        UPDATE enquetes
        SET titulo = ?, descricao = ?
        WHERE id = ?
    ");

    $stmt->bind_param(
        "ssi",
        $titulo,
        $descricao,
        $enquete_id
    );

    $stmt->execute();


    $stmt = $conexao->prepare("
        UPDATE opcoes
        SET texto = ?
        WHERE id = ?
        AND enquete_id = ?
    ");


    for ($i = 0; $i < count($opcoes); $i++) {

        $texto = trim($opcoes[$i]);

        $opcao_id = filter_var(
            $opcao_ids[$i],
            FILTER_VALIDATE_INT
        );


        if (!$opcao_id || $texto === '') {
            throw new Exception();
        }


        $stmt->bind_param(
            "sii",
            $texto,
            $opcao_id,
            $enquete_id
        );

        $stmt->execute();
    }


    $conexao->commit();

} catch (Exception $e) {

    $conexao->rollback();

    die("Erro ao atualizar enquete.");
}


header("Location: index.php");
exit;