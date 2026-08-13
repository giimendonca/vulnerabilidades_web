<?php
session_start();

include "./includes/csrf.php";
include "../includes/conexao.php";
include "./includes/rate_limit.php";
include "/includes/security.php";


verificarTentativasLogin();

verificarTokenCSRF();

$email = trim($_POST['email'] ?? '');
$senha = trim($_POST['senha'] ?? '');

if(empty($email) || empty($senha)){
    die("Preencha todos os campos.");
}

$sql = "SELECT * FROM usuarios WHERE email = ?";

$stmt = $conexao->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();

$usuario = $stmt->get_result();
$usuario = $usuario->fetch_assoc();

if (
    !$usuario ||
    !password_verify($senha, $usuario['senha'])
) {
    registrarTentativaFalha();

    die("Acesso negado.");
}

limparTentativasLogin();

session_regenerate_id(true);

$_SESSION['id'] = $usuario['id'];
$_SESSION['nome'] = $usuario['nome'];
$_SESSION['email'] = $usuario['email'];
$_SESSION['tipo'] = $usuario['tipo'];

header("Location: index.php");
exit();
?>