<?php

include "../../includes/sessao.php";
include "../../includes/header.php";
include "../../includes/conexao.php";
include "../../includes/security.php";

if (!isset($_SESSION['id'])) {
    die("Acesso negado.");
}

if ($_SESSION['tipo'] !== 'admin') {
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

        <?php while ($enquete = $enquetes->fetch_assoc()): ?>
            <article class="enquete-card">

                <h3><?= $enquete['titulo'] ?></h3>

                <p><?= $enquete['descricao'] ?></p>

                <a href="editar.php?id=<?= $enquete['id'] ?>" class="btn">
                    Editar
                </a>

                <form action="excluir.php" method="POST">

                    <input
                        type="hidden"
                        name="csrf_token"
                        value="<?= htmlspecialchars(
                                    gerarTokenCSRF(),
                                    ENT_QUOTES,
                                    'UTF-8'
                                ) ?>">

                    <input
                        type="hidden"
                        name="id"
                        value="<?= $enquete['id'] ?>">

                    <button type="submit" onclick="return confirm('Deseja realmente excluir esta enquete?')">
                        Excluir
                    </button>

                </form>

            </article>
        <?php endwhile; ?>

    </div>

</section>

<?php

include "../../includes/footer.php";

?>