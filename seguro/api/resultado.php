<?php

session_start();

header("Content-Type: application/json; charset=UTF-8");

include "../../includes/conexao.php";
include "../includes/security.php";

if (!isset($_SESSION['id'])) {

    http_response_code(401);

    echo json_encode([
        "erro" => "Não autenticado."
    ], JSON_UNESCAPED_UNICODE);

    exit;
}

$id = $_GET['id'] ?? null;

if ($id !== null) {

    if (!filter_var($id, FILTER_VALIDATE_INT)) {

        http_response_code(400);

        echo json_encode([
            "erro" => "ID inválido."
        ], JSON_UNESCAPED_UNICODE);

        exit;
    }

    $sql = "
        SELECT
            enquetes.id AS enquete_id,
            enquetes.titulo AS enquete,
            opcoes.texto AS opcao,
            COUNT(votos.id) AS total_votos
        FROM enquetes
        INNER JOIN opcoes
            ON opcoes.enquete_id = enquetes.id
        LEFT JOIN votos
            ON votos.opcao_id = opcoes.id
        WHERE enquetes.id = ?
        GROUP BY enquetes.id, opcoes.id
        ORDER BY total_votos DESC
    ";

    $stmt = $conexao->prepare($sql);

    $stmt->bind_param("i", $id);

    $stmt->execute();

    $resultado = $stmt->get_result();

} else {

    $sql = "
        SELECT
            enquetes.id AS enquete_id,
            enquetes.titulo AS enquete,
            opcoes.texto AS opcao,
            COUNT(votos.id) AS total_votos
        FROM enquetes
        INNER JOIN opcoes
            ON opcoes.enquete_id = enquetes.id
        LEFT JOIN votos
            ON votos.opcao_id = opcoes.id
        GROUP BY enquetes.id, opcoes.id
        ORDER BY enquetes.id, total_votos DESC
    ";

    $resultado = $conexao->query($sql);
}

$dados = [];

while ($linha = $resultado->fetch_assoc()) {

    $dados[] = [
        "enquete_id" => (int) $linha["enquete_id"],
        "enquete" => $linha["enquete"],
        "opcao" => $linha["opcao"],
        "total_votos" => (int) $linha["total_votos"]
    ];
}

echo json_encode(
    $dados,
    JSON_UNESCAPED_UNICODE
);