<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>VoteSafe | Segurança Web</title>

    <link
        rel="stylesheet"
        href="assets/css/index.css"
    >
</head>

<body>

    <main class="hero">

        <div class="hero-content">

            <span class="badge">
                Projeto de Segurança Web
            </span>

            <h1>
                Vote<span>Safe</span>
            </h1>

            <p class="subtitle">
                Sistema de votação para demonstração
                prática de vulnerabilidades e mecanismos
                de proteção em aplicações web.
            </p>

            <div class="systems">

                <article class="system-card vulnerable-card">

                    <div class="card-icon">
                        ⚠️
                    </div>

                    <span class="card-label">
                        AMBIENTE DE TESTE
                    </span>

                    <h2>
                        Versão Vulnerável
                    </h2>

                    <p>
                        Aplicação desenvolvida propositalmente
                        sem os mecanismos de proteção,
                        permitindo observar as falhas de segurança.
                    </p>

                    <a
                        href="vulneravel/index.php"
                        class="btn btn-danger"
                    >
                        Acessar vulnerável
                    </a>

                </article>


                <article class="system-card secure-card">

                    <div class="card-icon">
                        🛡️
                    </div>

                    <span class="card-label">
                        AMBIENTE PROTEGIDO
                    </span>

                    <h2>
                        Versão Segura
                    </h2>

                    <p>
                        Aplicação com mecanismos de proteção
                        e boas práticas de desenvolvimento seguro.
                    </p>

                    <a
                        href="seguro/index.php"
                        class="btn btn-success"
                    >
                        Acessar versão segura
                    </a>

                </article>

            </div>


            <section class="topics">

                <h3>
                    Vulnerabilidades abordadas
                </h3>

                <div class="topic-list">

                    <span>SQL Injection</span>
                    <span>XSS</span>
                    <span>CSRF</span>
                    <span>Força Bruta</span>
                    <span>Sequestro de Sessão</span>
                    <span>Autenticação</span>
                    <span>Controle de Acesso</span>
                    <span>Upload</span>
                    <span>Clickjacking</span>
                    <span>API</span>
                    <span>Rate Limiting</span>
                    <span>Hash de Senhas</span>

                </div>

            </section>

        </div>

    </main>

</body>

</html>