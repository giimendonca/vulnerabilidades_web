<?php

session_start();

include "../includes/csrf.php";
include "../includes/header.php";
include "../includes/security.php";

?>

<section class="form-container">

    <h1>Login</h1>

    <br>

    <form action="verificar_login.php" method="POST">

        <input
            type="hidden"
            name="csrf_token"
            value="<?= htmlspecialchars(gerarTokenCSRF(), ENT_QUOTES, 'UTF-8') ?>"
        >

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
            Entrar
        </button>

    </form>

</section>

<?php

include "../includes/footer.php";

?>