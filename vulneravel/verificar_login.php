<?php
include "../includes/conexao.php";

session_start();

$email = $_POST['email'];
$senha = $_POST['senha'];

$usuario = $conexao->query("
    SELECT * FROM usuarios WHERE email = '$email'
");

$usuario = $usuario->fetch_assoc();

if(!$usuario){
    die("Usuário não encontrado.");
}

if($usuario['senha'] !== $senha){
    die("Senha inválida.");
}

$_SESSION['id'] = $usuario['id'];
$_SESSION['nome'] = $usuario['nome'];
$_SESSION['email'] = $usuario['email'];
$_SESSION['tipo'] = $usuario['tipo'];

header("Location: index.php");
?>