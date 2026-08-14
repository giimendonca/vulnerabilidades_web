<?php

include "./includes/sessao.php";
include "../includes/conexao.php";
include "../includes/header.php";
include "./includes/security.php";


if (!isset($_SESSION['id'])) {
    die("Acesso negado.");
}


$enquetes = $conexao->query("
    SELECT 
        enquetes.id AS enquete_id,
        enquetes.titulo AS enquete,
        opcoes.texto AS opcao,
        COUNT(votos.id) AS total_votos
    FROM enquetes
    INNER JOIN opcoes
        ON opcoes.enquete_id = enquetes.id
    LEFT JOIN votos
        ON votos.opcao_id = opcoes.id
    GROUP BY enquetes.id, opcoes.id
    ORDER BY enquetes.id ASC, total_votos DESC
");

?>

<section>

    <h1>Resultados das enquetes</h1>

    <br>

    <?php

    $enquete_atual = null;

    while ($resultado = $enquetes->fetch_assoc()):

        if ($enquete_atual !== $resultado['enquete_id']):

            if ($enquete_atual !== null):
                echo "</div>";
                echo "</div>";
            endif;

            $enquete_atual = $resultado['enquete_id'];

    ?>

            <br>

            <div class="enquete-card">

                <h2>
                    <?= htmlspecialchars(
                        $resultado['enquete'],
                        ENT_QUOTES,
                        'UTF-8'
                    ) ?>
                </h2>

                <div>

        <?php endif; ?>

                <p>
                    <?= htmlspecialchars(
                        $resultado['opcao'],
                        ENT_QUOTES,
                        'UTF-8'
                    ) ?>

                    &nbsp;

                    <strong>
                        <?= (int) $resultado['total_votos'] ?>
                        votos
                    </strong>
                </p>

                <hr>

    <?php endwhile; ?>

                </div>

            </div>

            <br>

            <a href="enquetes.php" class="btn">
                Voltar para enquetes
            </a>

</section>

<?php

include "../includes/footer.php";

?>