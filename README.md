# 🗳️ VoteSafe

> Sistema web desenvolvido para demonstrar, na prática, vulnerabilidades de segurança em aplicações web e suas respectivas correções.

O **VoteSafe** é uma aplicação de votação criada com finalidade educacional. O projeto apresenta uma mesma aplicação em duas versões: uma propositalmente vulnerável e outra protegida por boas práticas de segurança.

A proposta é permitir a comparação direta entre uma implementação insegura e sua respectiva correção.

---

## 🎯 Objetivo

Demonstrar de forma prática como vulnerabilidades comuns podem surgir durante o desenvolvimento de aplicações web e como mecanismos de segurança podem reduzir ou impedir esses problemas.

O projeto possui duas versões:

### 🔴 Versão Vulnerável

Contém implementações propositalmente inseguras para permitir a demonstração controlada das vulnerabilidades.

### 🟢 Versão Segura

Apresenta as mesmas funcionalidades utilizando mecanismos de proteção e boas práticas de desenvolvimento.

> **Aviso:** a versão vulnerável existe exclusivamente para fins educacionais e deve ser executada apenas em ambiente controlado.

---

## 🛠️ Tecnologias utilizadas

* **HTML5**
* **CSS3**
* **JavaScript**
* **PHP**
* **MySQL**

---

## 📋 Funcionalidades

* Cadastro de usuários
* Autenticação por login
* Controle de sessão
* Listagem de enquetes
* Visualização de enquetes
* Votação
* Visualização de resultados
* Cadastro de enquetes
* Edição de enquetes
* Exclusão de enquetes
* Controle de acesso administrativo
* Upload de imagens
* API para consulta de dados

---

## 🔐 Vulnerabilidades abordadas

O projeto implementa demonstrações das seguintes vulnerabilidades e mecanismos de proteção:

| #  | Vulnerabilidade                   | Proteção demonstrada                           |
| -- | --------------------------------- | ---------------------------------------------- |
| 1  | SQL Injection                     | Prepared Statements e validação de entradas    |
| 2  | Cross-Site Scripting (XSS)        | `htmlspecialchars()` e tratamento de saída     |
| 3  | Cross-Site Request Forgery (CSRF) | Tokens CSRF                                    |
| 4  | Força Bruta                       | Limitação de tentativas de autenticação        |
| 5  | Sequestro de Sessão               | Configuração e gerenciamento seguro de sessões |
| 6  | Falhas de Autenticação            | Validação de credenciais e autenticação        |
| 7  | Controle de Acesso                | Autorização por tipo de usuário                |
| 8  | Upload de Arquivos                | Validação de tipo, tamanho e nome do arquivo   |
| 9  | Clickjacking                      | Headers de segurança                           |
| 10 | Segurança de APIs                 | Validação e proteção das requisições           |
| 11 | Rate Limiting                     | Limitação de requisições                       |
| 12 | Criptografia e Hash de Senhas     | `password_hash()` e `password_verify()`        |

---

## 🏗️ Estrutura do projeto

```text
sistema-votacao/
│
├── index.php
├── README.md
│
├── assets/
│   └── css/
│       ├── index.css
│       └── style.css
│
├── banco/
│   └── script.sql
│
├── includes/
│   ├── conexao.php
│   ├── footer.php
│   └── header.php
│
├── seguro/
│   ├── cadastrar_usuario.php
│   ├── cadastro.php
│   ├── enquete.php
│   ├── enquetes.php
│   ├── index.php
│   ├── login.php
│   ├── logout.php
│   ├── resultado.php
│   ├── verificar_login.php
│   ├── votar.php
│   │
│   ├── admin/
│   │   ├── atualizar.php
│   │   ├── criar.php
│   │   ├── editar.php
│   │   ├── excluir.php
│   │   ├── index.php
│   │   └── salvar.php
│   │
│   ├── api/
│   │   └── resultado.php
│   │
│   └── includes/
│       ├── autenticacao.php
│       ├── autorizacao.php
│       ├── csrf.php
│       ├── rate_limit.php
│       ├── security.php
│       └── sessao.php
│
└── vulneravel/
    ├── cadastrar_usuario.php
    ├── cadastro.php
    ├── enquete.php
    ├── enquetes.php
    ├── index.php
    ├── login.php
    ├── logout.php
    ├── resultado.php
    ├── verificar_login.php
    ├── votar.php
    │
    ├── admin/
    │   ├── atualizar.php
    │   ├── criar.php
    │   ├── editar.php
    │   ├── excluir.php
    │   ├── index.php
    │   └── salvar.php
    │
    └── api/
        └── enquetes.php
```

---

## 🗄️ Banco de dados

O banco de dados utilizado pelo projeto é o **MySQL**.

O script de criação e população inicial encontra-se em:

```text
banco/script.sql
```

Principais tabelas:

* `usuarios`
* `enquetes`
* `opcoes`
* `votos`

---

## 🚀 Execução local

### Requisitos

Para executar o projeto localmente, é necessário possuir:

* XAMPP ou ambiente equivalente
* Apache
* PHP
* MySQL
* Navegador web

### Instalação

1. Clone ou copie o projeto para a pasta do servidor web.

2. Inicie o **Apache** e o **MySQL**.

3. Crie o banco de dados utilizando:

```text
banco/script.sql
```

4. Configure as credenciais do banco em:

```text
includes/conexao.php
```

5. Acesse a aplicação pelo navegador.

A página inicial permite escolher entre:

```text
🔴 Versão Vulnerável
🟢 Versão Segura
```

---

## 🧪 Testes de segurança

Os testes podem ser realizados nas duas versões para comparar diretamente seus comportamentos.

Para cada vulnerabilidade, recomenda-se:

1. Executar o teste na versão vulnerável.
2. Observar o comportamento da aplicação.
3. Repetir o mesmo teste na versão segura.
4. Verificar se o mecanismo de proteção impede o comportamento anterior.

Um guia detalhado dos conceitos e procedimentos de teste está disponível em:

```text
docs/guia-de-testes.md
```

---

## 📚 Finalidade educacional

O VoteSafe foi desenvolvido exclusivamente para estudo de segurança no desenvolvimento web.

A versão vulnerável deve permanecer restrita a ambientes de laboratório e desenvolvimento controlados.

O objetivo do projeto não é ensinar a atacar sistemas reais, mas compreender como vulnerabilidades surgem e como podem ser prevenidas durante o desenvolvimento de aplicações.

---

## 👩‍💻 Projeto acadêmico

**VoteSafe — Demonstração Prática de Segurança em Aplicações Web**

Projeto desenvolvido para fins acadêmicos, utilizando desenvolvimento web com PHP e MySQL.
