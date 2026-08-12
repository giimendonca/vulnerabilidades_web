<?php

include "../includes/header.php";

?>

<section class="form-container">

    <h1>Entrar</h1>

    <br>

    <form action="verificar_login.php" method="POST">

        <div class="form-group">
            <label for="email">E-mail</label>

            <input
                type="email"
                id="email"
                name="email"
                required
            >
        </div>

        <div class="form-group">
            <label for="senha">Senha</label>

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

    <br>

    <p>
        Ainda não possui uma conta?
        <a href="cadastro.php">Cadastre-se</a>
    </p>

</section>

<?php

include "../includes/footer.php";

?>