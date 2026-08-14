<?php

session_start();

include "../includes/conexao.php";
include "./includes/csrf.php";
include "./includes/security.php";


verificarTokenCSRF();


$nome = trim($_POST['nome'] ?? '');
$email = trim($_POST['email'] ?? '');
$senha = $_POST['senha'] ?? '';


if ($nome === '' || $email === '' || $senha === '') {
    die("Preencha todos os campos.");
}


if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("E-mail inválido.");
}


$senha_hash = password_hash(
    $senha,
    PASSWORD_DEFAULT
);


$stmt = $conexao->prepare("
    INSERT INTO usuarios (nome, email, senha)
    VALUES (?, ?, ?)
");

$stmt->bind_param(
    "sss",
    $nome,
    $email,
    $senha_hash
);


if (!$stmt->execute()) {
    die("Erro ao cadastrar usuário.");
}


header("Location: login.php");
exit;