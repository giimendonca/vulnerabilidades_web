<?php

header("Content-Type: application/json");

include "../../includes/conexao.php";

$resultado = $conexao->query("
    SELECT *
    FROM enquetes
");

$enquetes = [];

while ($enquete = $resultado->fetch_assoc()) {

    $enquetes[] = $enquete;

}

echo json_encode($enquetes);
?>