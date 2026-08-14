<?php 
include "./includes/sessao.php";
include "../includes/header.php";
include "./includes/security.php";

if(!isset($_SESSION['id'])){
    die("Acesso negado.");
}
?>

<section class="hero">

    <h1>Bem-vindo ao VoteSafe</h1>

    <p>
        Participe de enquetes, registre seu voto e acompanhe os resultados.
    </p>

    <br>

    <a href="enquetes.php" class="btn">
        Ver enquetes
    </a>

</section>

<?php include "../includes/footer.php" ?>