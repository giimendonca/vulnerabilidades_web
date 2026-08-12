<?php

include "../includes/header.php";

?>

<section class="form-container">

    <h1>Criar conta</h1>

    <br>

    <form action="cadastrar_usuario.php" method="POST">

        <div class="form-group">

            <label for="nome">
                Nome
            </label>

            <input
                type="text"
                id="nome"
                name="nome"
                required
            >

        </div>

        <div class="form-group">

            <label for="email">
                E-mail
            </label>

            <input
                type="email"
                id="email"
                name="email"
                required
            >

        </div>

        <div class="form-group">

            <label for="senha">
                Senha
            </label>

            <input
                type="password"
                id="senha"
                name="senha"
                required
            >

        </div>

        <div class="form-group">

            <label for="confirmar_senha">
                Confirmar senha
            </label>

            <input
                type="password"
                id="confirmar_senha"
                name="confirmar_senha"
                required
            >

        </div>

        <button type="submit">
            Criar conta
        </button>

    </form>

</section>

<?php

include "../includes/footer.php";

?>