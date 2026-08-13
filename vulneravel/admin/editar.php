<?php

include "../../includes/header.php";
include "../../includes/conexao.php";

$id =  $_GET['id'];

$enquete = $conexao->query("SELECT * FROM enquetes WHERE id = $id");
$enquete =  $enquete->fetch_assoc();

$opcoes = $conexao->query("SELECT * FROM opcoes WHERE enquete_id = $id");

$count = 1;

?>

<section class="form-container">

    <h1>Editar enquete</h1>

    <br>

    <form action="atualizar.php" method="POST" >

        <input
            type="hidden"
            name="id"
            value="<?= $enquete['id'] ?>">

        <div class="form-group">

            <label for="titulo">
                Título
            </label>

            <input
                type="text"
                id="titulo"
                name="titulo"
                value="<?= $enquete['titulo'] ?>"
                required>

        </div>

        <div class="form-group">

            <label for="descricao">
                Descrição
            </label>

            <textarea
                id="descricao"
                name="descricao"
                rows="5"
                required><?= $enquete['descricao'] ?></textarea>

        </div>

        <?php while ($opcao = $opcoes->fetch_assoc()): ?>
            <div class="form-group">

                <label for="opcao1">
                    Opção <?= $count ?>
                </label>
                
                <input type="hidden" name="opcao_ids[]" value="<?= $opcao['id'] ?>">

                <input
                    type="text"
                    id="opcao<?= $count ?>"
                    name="opcoes[]"
                    value="<?= $opcao['texto'] ?>"
                    required>

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