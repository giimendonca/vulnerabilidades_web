<?php

include "./includes/sessao.php";
include "./includes/security.php";
include "../includes/conexao.php";
include "../includes/header.php";


if (!isset($_SESSION['id'])) {
    die("Acesso negado.");
}


$enquetes = $conexao->query("
    SELECT *
    FROM enquetes
");

?>

<section>

    <h1>Enquetes disponíveis</h1>

    <p>
        Escolha uma enquete para participar.
    </p>

    <div class="enquetes">

        <?php while ($enquete = $enquetes->fetch_assoc()): ?>

            <article class="enquete-card">

                <h3>
                    <?= htmlspecialchars(
                        $enquete['titulo'],
                        ENT_QUOTES,
                        'UTF-8'
                    ) ?>
                </h3>

                <?php if (!empty($enquete['imagem'])): ?>

                    <img
                        src="../assets/uploads/<?= htmlspecialchars(
                                                    $enquete['imagem'],
                                                    ENT_QUOTES,
                                                    'UTF-8'
                                                ) ?>"
                        alt="Imagem da enquete">

                <?php endif; ?>

                <p>
                    <?= htmlspecialchars(
                        $enquete['descricao'],
                        ENT_QUOTES,
                        'UTF-8'
                    ) ?>
                </p>

                <a
                    href="enquete.php?id=<?= (int) $enquete['id'] ?>"
                    class="btn">
                    Ver enquete
                </a>

            </article>

        <?php endwhile; ?>

    </div>

</section>

<?php

include "../includes/footer.php";

?>