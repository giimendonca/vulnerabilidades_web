<?php

include "../../includes/header.php";
include "../../includes/conexao.php";

if(!isset($_SESSION['id'])){
    die("Acesso negado.");
}

$enquetes = $conexao->query("
    SELECT * FROM enquetes
");
?>

<section>

    <h1>Painel Administrativo</h1>

    <br>

    <a href="criar.php" class="btn">
        Nova enquete
    </a>

    <br><br>

    <div class="enquetes">

    <?php while($enquete = $enquetes->fetch_assoc()): ?>
        <article class="enquete-card">

            <h3><?= $enquete['titulo'] ?></h3>

            <p><?= $enquete['descricao'] ?></p>

            <a href="editar.php?id=<?= $enquete['id'] ?>" class="btn">
                Editar
            </a>

            <a href="excluir.php?id=<?= $enquete['id'] ?>" class="btn">
                Excluir
            </a>

        </article>
    <?php endwhile; ?>

    </div>

</section>

<?php

include "../../includes/footer.php";

?>