<?php
include "../../includes/header.php";
include "../../includes/conexao.php";

if(!isset($_SESSION['id'])){
    die("Acesso negado.");
}

$id =  $_GET['id'];

$conexao->query("DELETE FROM enquetes WHERE id = $id");

header("Location: index.php");
?>