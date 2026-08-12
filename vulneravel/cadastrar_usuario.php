<?php
include "../includes/conexao.php";

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];

$conexao->query("
    INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senha')
");

header("Location: login.php");
?>