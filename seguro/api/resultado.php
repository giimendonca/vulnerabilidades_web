<?php

session_start();

header("Content-Type: application/json; charset=UTF-8");

include "../../includes/conexao.php";
include "../includes/security.php";

if (!isset($_SESSION['id'])) {

    http_response_code(401);

    echo json_encode([
        "erro" => "Não autenticado."
    ]);

    exit;
}


$sql = "
    SELECT
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

$dados = [];

while ($linha = $resultado->fetch_assoc()) {

    $dados[] = [
        "enquete" => $linha["enquete"],
        "opcao" => $linha["opcao"],
        "total_votos" => (int) $linha["total_votos"]
    ];
}


echo json_encode(
    $dados,
    JSON_UNESCAPED_UNICODE
);