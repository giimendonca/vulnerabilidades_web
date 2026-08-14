<?php

header("Content-Type: application/json; charset=UTF-8");

include "../../includes/conexao.php";

$id = $_GET['id'] ?? null;

if ($id !== null) {

    $resultado = $conexao->query("
        SELECT *
        FROM enquetes
        WHERE id = $id
    ");

} else {

    $resultado = $conexao->query("
        SELECT *
        FROM enquetes
    ");
}

$enquetes = [];

while ($enquete = $resultado->fetch_assoc()) {

    $enquetes[] = $enquete;
}

echo json_encode(
    $enquetes,
    JSON_UNESCAPED_UNICODE
);