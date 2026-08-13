<?php
include "../includes/header.php";
include "../includes/conexao.php";

$enquetes = $conexao->query("
    SELECT * FROM enquetes
");

?>

<section>

    <h1>Enquetes disponíveis</h1>

    <p>
        Escolha uma enquete para participar.
    </p>

    <div class="enquetes">

        <?php while($enquete = $enquetes->fetch_assoc()): ?>
        <article class="enquete-card">

            <h3>
                <?= $enquete['titulo'] ?>
            </h3>

            <p>
                <?= $enquete['descricao'] ?>
            </p>

            <a href="enquete.php?id=<?= $enquete['id'] ?>
" class="btn">
                Ver enquete
            </a>

        </article>
<?php endwhile; ?>
    </div>

</section>

<?php

include "../includes/footer.php";

?>