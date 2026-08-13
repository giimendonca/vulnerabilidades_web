<?php

session_start();

include "../../includes/autenticacao.php";
include "../../includes/autorizacao.php";
include "../../includes/csrf.php";
include "../../includes/security.php";
include "../includes/sessao_segura.php";
include "../includes/header.php";

if (!isset($_SESSION['id'])) {
    die("Acesso negado.");
}

if ($_SESSION['tipo'] !== 'admin') {
    die("Acesso negado.");
}

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

$count = 1;

?>

<section class="form-container">

    <h1>Editar enquete</h1>

    <br>

    <form action="atualizar.php" method="POST">

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
            name="id"
            value="<?= $enquete['id'] ?>"
        >

        <div class="form-group">

            <label for="titulo">
                Título
            </label>

            <input
                type="text"
                id="titulo"
                name="titulo"
                value="<?= htmlspecialchars(
                    $enquete['titulo'],
                    ENT_QUOTES,
                    'UTF-8'
                ) ?>"
                required
            >

        </div>

        <div class="form-group">

            <label for="descricao">
                Descrição
            </label>

            <textarea
                id="descricao"
                name="descricao"
                rows="5"
                required
            ><?= htmlspecialchars(
                $enquete['descricao'],
                ENT_QUOTES,
                'UTF-8'
            ) ?></textarea>

        </div>

        <?php while ($opcao = $opcoes->fetch_assoc()): ?>

            <div class="form-group">

                <label for="opcao<?= $count ?>">
                    Opção <?= $count ?>
                </label>

                <input
                    type="hidden"
                    name="opcao_ids[]"
                    value="<?= $opcao['id'] ?>"
                >

                <input
                    type="text"
                    id="opcao<?= $count ?>"
                    name="opcoes[]"
                    value="<?= htmlspecialchars(
                        $opcao['texto'],
                        ENT_QUOTES,
                        'UTF-8'
                    ) ?>"
                    required
                >

            </div>

            <?php $count++; ?>

        <?php endwhile; ?>

        <button type="submit">
            Salvar alterações
        </button>

    </form>

</section>

<?php

include "../../includes/footer.php";

?>