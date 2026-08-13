<?php

include "../../includes/header.php";
?>

<section class="form-container">

    <h1>Criar enquete</h1>

    <br>

    <form action="salvar.php" method="POST" enctype="multipart/form-data">

        <div class="form-group">

            <label for="titulo">
                Título
            </label>

            <input
                type="text"
                id="titulo"
                name="titulo"
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
                required></textarea>

        </div>

        <div class="form-group">

            <label for="imagem">
                Imagem da enquete
            </label>

            <input
                type="file"
                id="imagem"
                name="imagem">

        </div>

        <div class="form-group">

            <label for="opcao1">
                Opção 1
            </label>

            <input
                type="text"
                id="opcao1"
                name="opcoes[]"
                required>

        </div>

        <div class="form-group">

            <label for="opcao2">
                Opção 2
            </label>

            <input
                type="text"
                id="opcao2"
                name="opcoes[]"
                required>

        </div>

        <div class="form-group">

            <label for="opcao3">
                Opção 3
            </label>

            <input
                type="text"
                id="opcao3"
                name="opcoes[]"
                required>

        </div>

        <button type="submit">
            Criar enquete
        </button>

    </form>

</section>

<?php

include "../../includes/footer.php";

?>