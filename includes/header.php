<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>VoteSafe</title>

    <link rel="stylesheet" href="/vulnerabilidades_web/assets/css/style.css">
</head>

<body>

<header class="header">

    <div class="header-container">

        <a href="index.php" class="logo">
            VoteSafe
        </a>

        <nav class="nav">

            <a href="index.php">Início</a>

            <a href="enquetes.php">Enquetes</a>

            <?php if (isset($_SESSION['id'])): ?>

                <?php if (isset($_SESSION['tipo']) && $_SESSION['tipo'] === 'admin'): ?>
                    <a href="admin/index.php">Administração</a>
                <?php endif; ?>

                <a href="logout.php">Sair</a>

            <?php else: ?>

                <a href="login.php">Entrar</a>
                <a href="cadastro.php">Criar conta</a>

            <?php endif; ?>

        </nav>

    </div>

</header>

<main class="main-container">