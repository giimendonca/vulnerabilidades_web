<?php

session_start();

include "./includes/csrf.php";
include "../includes/header.php";
include "../includes/security.php";

?>

<section class="form-container">

    <h1>Criar conta</h1>

    <br>

    <form action="cadastrar_usuario.php" method="POST">

        <input
            type="hidden"
            name="csrf_token"
            value="<?= htmlspecialchars(gerarTokenCSRF(), ENT_QUOTES, 'UTF-8') ?>"
        >

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

        <button type="submit">
            Criar conta
        </button>

    </form>

</section>

<?php

include "../includes/footer.php";

?>