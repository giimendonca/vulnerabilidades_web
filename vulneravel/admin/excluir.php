<?php
include "../../includes/header.php";
include "../../includes/conexao.php";

$id =  $_GET['id'];

$conexao->query("DELETE FROM enquetes WHERE id = $id");

header("Location: index.php");
?>