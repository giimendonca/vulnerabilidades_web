<?php

include "includes/autenticacao.php";
include "includes/csrf.php";
include "includes/sessao.php";
include "../includes/header.php";
include "../includes/conexao.php";
include "/includes/security.php";


$id = filter_input(
    INPUT_GET,
    'id',
    FILTER_VALIDATE_INT
);

if (!$id) {
    die("Enquete inválida.");
}


$stmt = $conexao->prepare("
    SELECT *
    FROM enquetes
    WHERE id = ?
");

$stmt->bind_param("i", $id);
$stmt->execute();

$resultado = $stmt->get_result();

$enquete = $resultado->fetch_assoc();

if (!$enquete) {
    die("Enquete não encontrada.");
}


$stmt = $conexao->prepare("
    SELECT *
    FROM opcoes
    WHERE enquete_id = ?
");

$stmt->bind_param("i", $id);
$stmt->execute();

$opcoes = $stmt->get_result();

?>

<section>

    <h1>
        <?= htmlspecialchars(
            $enquete['titulo'],
            ENT_QUOTES,
            'UTF-8'
        ) ?>
    </h1>

    <p>
        <?= htmlspecialchars(
            $enquete['descricao'],
            ENT_QUOTES,
            'UTF-8'
        ) ?>
    </p>

    <br>

    <form action="votar.php" method="POST">

        <input
            type="hidden"
            name="csrf_token"
            value="<?= htmlspecialchars(
                gerarTokenCSRF(),
                ENT_QUOTES,
                'UTF-8'
            ) ?>"
        >

        <input
            type="hidden"
            name="enquete_id"
            value="<?= $enquete['id'] ?>"
        >

        <?php while ($opcao = $opcoes->fetch_assoc()): ?>

            <div class="opcao">

                <label>

                    <input
                        type="radio"
                        name="opcao_id"
                        value="<?= $opcao['id'] ?>"
                        required
                    >

                    <?= htmlspecialchars(
                        $opcao['texto'],
                        ENT_QUOTES,
                        'UTF-8'
                    ) ?>

                </label>

            </div>

        <?php endwhile; ?>

        <button type="submit">
            Votar
        </button>

    </form>

</section>

<?php

include "../includes/footer.php";

?>