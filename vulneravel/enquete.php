<?php

include "../includes/header.php";
include "../includes/conexao.php";

$id =  $_GET['id'];

$enquete = $conexao->query("SELECT * FROM enquetes WHERE id = $id");
$enquete =  $enquete->fetch_assoc();

$opcoes = $conexao->query("SELECT * FROM opcoes WHERE enquete_id = $id");

?>

<section>

    <h1><?= $enquete['titulo'] ?></h1>

    <p>
        Escolha uma das opções abaixo.
    </p>

    <br>

    <form action="votar.php" method="POST">

        <input
            type="hidden"
            name="enquete_id"
            value="<?= $enquete['id'] ?>"
        >

        <?php while($opcao =  $opcoes->fetch_assoc()): ?>
        <div class="opcao">

            <label>

                <input
                    type="radio"
                    name="opcao_id"
                    value="<?= $opcao['id'] ?>"
                    required
                >

                <?= $opcao['texto'] ?>

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