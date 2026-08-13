# 🔐 VoteSafe — Guia de Vulnerabilidades e Testes

## 1. Sobre este documento

Este documento apresenta as vulnerabilidades de segurança abordadas pelo projeto **VoteSafe**, explicando:

* o que é cada vulnerabilidade;
* como ela pode surgir em uma aplicação web;
* onde ela pode ser observada no VoteSafe;
* como realizar um teste no ambiente local;
* o comportamento esperado na versão vulnerável;
* o comportamento esperado na versão segura.

Os testes devem ser realizados somente no ambiente local do projeto.

---

# 🔴🟢 Como utilizar o guia

O VoteSafe possui duas versões da aplicação:

```text
🔴 vulneravel/
🟢 seguro/
```

A metodologia de teste consiste em executar a mesma ação nas duas versões.

### Resultado esperado

**Versão vulnerável:**

A entrada ou requisição pode produzir o comportamento inseguro demonstrado.

**Versão segura:**

O mecanismo de proteção deve impedir ou tratar adequadamente a tentativa.

---

# 1. SQL Injection

## O que é?

SQL Injection ocorre quando dados fornecidos pelo usuário são inseridos diretamente em uma consulta SQL sem tratamento adequado.

Isso pode permitir que a entrada altere a estrutura ou a lógica da consulta.

## Onde testar?

* Login
* Parâmetros de enquete
* Operações administrativas
* API

## Teste no VoteSafe

Na versão vulnerável, teste parâmetros que são utilizados diretamente em consultas SQL.

Por exemplo, em uma página que recebe:

```text
?id=1
```

teste uma entrada que altere a condição da consulta.

Também é possível testar o campo de login com entradas que contenham caracteres utilizados em manipulação de consultas.

## Versão vulnerável

A aplicação pode:

* executar uma consulta diferente da esperada;
* retornar dados inesperados;
* permitir autenticação indevida;
* apresentar erros do banco de dados.

## Versão segura

A aplicação deve utilizar:

```php
$stmt = $conexao->prepare(...);
```

e parâmetros vinculados com `bind_param()`.

Entradas destinadas a representar IDs também devem ser validadas.

---

# 2. Cross-Site Scripting (XSS)

## O que é?

XSS ocorre quando conteúdo fornecido pelo usuário é posteriormente inserido em uma página HTML sem o tratamento adequado.

O navegador pode interpretar esse conteúdo como HTML ou JavaScript.

## Onde testar?

* Título da enquete
* Descrição
* Opções
* Nome de usuário
* Resultados

## Teste

Na versão vulnerável, utilize conteúdo HTML simples em um campo de texto, por exemplo:

```html
<em>TESTE XSS</em>
```

Observe como o conteúdo é exibido posteriormente.

Também pode ser utilizado um teste controlado de execução de JavaScript no ambiente local, como:

```html
<script>alert(1)</script>
```

## Versão vulnerável

O navegador pode interpretar a entrada como código HTML ou JavaScript.

## Versão segura

A saída deve ser escapada:

```php
htmlspecialchars(
    $valor,
    ENT_QUOTES,
    'UTF-8'
)
```

O conteúdo deve aparecer como texto, e não ser interpretado pelo navegador.

---

# 3. Cross-Site Request Forgery (CSRF)

## O que é?

CSRF ocorre quando uma aplicação aceita uma requisição que modifica dados sem verificar se ela foi realmente originada por uma ação legítima do usuário.

## Onde testar?

Principalmente em ações que modificam dados:

* votação;
* criação de enquete;
* edição;
* exclusão.

## Teste

Na versão segura, remova o token CSRF do formulário ou envie um token inválido.

A requisição deve ser recusada.

## Versão vulnerável

A ação pode ser processada mesmo sem um token válido.

## Versão segura

O formulário envia um token:

```html
<input
    type="hidden"
    name="csrf_token"
    value="..."
>
```

E o processamento verifica esse token antes de executar a ação.

---

# 4. Força Bruta

## O que é?

Força bruta consiste na realização repetida de tentativas de autenticação para tentar descobrir credenciais válidas.

## Onde testar?

```text
login.php
```

## Teste

Realize várias tentativas consecutivas utilizando credenciais incorretas.

## Versão vulnerável

O sistema continua aceitando novas tentativas sem uma limitação adequada.

## Versão segura

O sistema deve aplicar uma política de limitação de tentativas.

---

# 5. Sequestro e Fixação de Sessão

## O que é?

Problemas de sessão podem permitir que identificadores de sessão sejam reutilizados ou permaneçam válidos de maneira inadequada.

Uma proteção importante é regenerar o identificador da sessão após a autenticação.

## Onde testar?

```text
verificar_login.php
logout.php
```

## Teste

1. Observe o cookie `PHPSESSID` antes do login.
2. Faça login.
3. Observe novamente o `PHPSESSID`.
4. Verifique se o identificador foi regenerado.
5. Faça logout.
6. Tente acessar novamente uma página protegida.

## Versão segura

O login utiliza:

```php
session_regenerate_id(true);
```

O logout também deve invalidar a sessão.

Além disso, os cookies de sessão devem possuir configurações de segurança adequadas.

---

# 6. Falhas de Autenticação

## O que é?

Falhas de autenticação ocorrem quando a aplicação não verifica corretamente a identidade do usuário.

## Onde testar?

* páginas protegidas;
* login;
* operações administrativas.

## Teste

Sem realizar login, tente acessar diretamente:

```text
enquetes.php
enquete.php
resultado.php
votar.php
```

## Versão vulnerável

Uma página protegida pode ficar acessível sem autenticação.

## Versão segura

A aplicação deve verificar a sessão antes de permitir o acesso.

---

# 7. Controle de Acesso

## O que é?

Autenticação responde:

> "Quem é o usuário?"

Autorização responde:

> "O que esse usuário pode fazer?"

Uma falha de controle de acesso ocorre quando um usuário consegue executar uma ação que deveria estar restrita a outro nível de privilégio.

## Onde testar?

```text
seguro/admin/
vulneravel/admin/
```

## Teste

1. Crie ou utilize uma conta comum.
2. Faça login.
3. Tente acessar diretamente:

```text
admin/index.php
admin/criar.php
admin/editar.php
admin/excluir.php
```

4. Tente também executar diretamente os arquivos responsáveis pelas ações.

## Versão segura

O sistema deve verificar o tipo do usuário antes de executar operações administrativas.

---

# 8. Upload de Arquivos

## O que é?

Uploads inseguros podem permitir o envio de arquivos inadequados, excessivamente grandes ou potencialmente perigosos.

## Onde testar?

```text
seguro/admin/criar.php
vulneravel/admin/criar.php
```

## Testes

Realize testes com:

* imagem JPEG válida;
* imagem PNG válida;
* imagem WebP, quando permitida;
* arquivo muito grande;
* arquivo de tipo não permitido;
* arquivo que não corresponde ao tipo esperado.

## Versão vulnerável

A aplicação pode aceitar arquivos sem validações suficientes.

## Versão segura

A aplicação deve:

* limitar o tamanho;
* verificar o tipo real do arquivo;
* restringir extensões permitidas;
* gerar nomes de arquivos próprios;
* não confiar apenas no nome enviado pelo usuário.

No VoteSafe, a versão segura utiliza validação do MIME type e nomes gerados aleatoriamente.

---

# 9. Clickjacking

## O que é?

Clickjacking ocorre quando uma página legítima é carregada em uma interface manipulada para induzir o usuário a clicar em elementos que não percebe corretamente.

## Onde testar?

Verifique os headers HTTP da aplicação.

No navegador:

```text
F12
→ Network
→ selecione uma requisição
→ Response Headers
```

Procure mecanismos como:

```text
X-Frame-Options
```

ou uma política equivalente através de:

```text
Content-Security-Policy
```

## Versão segura

A aplicação deve possuir uma política que restrinja o carregamento da página em frames conforme a necessidade do sistema.

---

# 10. Segurança de APIs

## O que é?

APIs também precisam validar entradas, controlar acesso e evitar exposição de informações internas.

## Onde testar?

### Vulnerável

```text
vulneravel/api/enquetes.php
```

### Seguro

```text
seguro/api/resultado.php
```

## Testes

Verifique:

* resposta com parâmetros válidos;
* parâmetros inválidos;
* IDs inexistentes;
* entradas inesperadas;
* mensagens de erro;
* exposição de informações internas.

## Versão segura

A API deve:

* validar entradas;
* utilizar consultas parametrizadas;
* controlar acesso quando necessário;
* retornar respostas consistentes;
* evitar expor erros internos do banco.

---

# 11. Rate Limiting

## O que é?

Rate limiting limita a quantidade de requisições que um usuário pode realizar em determinado período.

Ele ajuda a reduzir abuso automatizado e tentativas repetitivas de autenticação.

## Onde testar?

Principalmente no login.

## Teste

Realize várias tentativas consecutivas em um curto intervalo.

## Versão vulnerável

As requisições continuam sendo processadas normalmente.

## Versão segura

Depois de atingir o limite configurado, novas tentativas devem ser temporariamente bloqueadas ou limitadas.

---

# 12. Criptografia e Hash de Senhas

## O que é?

Senhas não devem ser armazenadas diretamente no banco de dados.

O sistema deve armazenar um hash produzido por um algoritmo apropriado para senhas.

## Onde testar?

```text
cadastrar_usuario.php
verificar_login.php
```

## Teste

Após cadastrar um usuário, consulte a tabela:

```text
usuarios
```

### Versão vulnerável

A senha pode aparecer diretamente no banco.

### Versão segura

A senha deve aparecer como um hash, por exemplo:

```text
$2y$...
```

A autenticação deve utilizar:

```php
password_verify()
```

e o cadastro deve utilizar:

```php
password_hash()
```

---

# 🧪 Checklist de testes

## SQL Injection

* [ ] Testar login
* [ ] Testar parâmetros de enquete
* [ ] Testar operações administrativas
* [ ] Testar API

## XSS

* [ ] Testar título
* [ ] Testar descrição
* [ ] Testar opções
* [ ] Testar nome do usuário
* [ ] Verificar resultados

## CSRF

* [ ] Testar votação sem token
* [ ] Testar criação sem token
* [ ] Testar edição sem token
* [ ] Testar exclusão sem token
* [ ] Testar token inválido

## Autenticação

* [ ] Acessar página protegida sem login
* [ ] Testar login com credenciais inválidas
* [ ] Testar logout
* [ ] Verificar regeneração da sessão

## Controle de acesso

* [ ] Usuário comum acessando admin
* [ ] Usuário comum tentando criar enquete
* [ ] Usuário comum tentando editar
* [ ] Usuário comum tentando excluir

## Upload

* [ ] JPEG válido
* [ ] PNG válido
* [ ] WebP válido
* [ ] Arquivo grande
* [ ] Tipo não permitido
* [ ] Arquivo que não corresponde ao tipo esperado

## API

* [ ] Requisição válida
* [ ] Parâmetro inválido
* [ ] ID inexistente
* [ ] Entrada inesperada
* [ ] Verificar mensagens de erro

## Rate Limiting

* [ ] Várias tentativas de login
* [ ] Verificar bloqueio após limite
* [ ] Verificar retorno após período definido

## Senhas

* [ ] Verificar armazenamento no banco
* [ ] Confirmar uso de `password_hash()`
* [ ] Confirmar uso de `password_verify()`

## Clickjacking

* [ ] Verificar `X-Frame-Options`
* [ ] Verificar `Content-Security-Policy`

---

# 📌 Conclusão

O objetivo do VoteSafe é demonstrar que segurança deve ser aplicada principalmente no lado do servidor.

Validações feitas apenas no HTML ou JavaScript podem ser modificadas pelo usuário e, portanto, não devem ser consideradas mecanismos suficientes de proteção.

A comparação entre as duas versões permite observar diretamente a diferença entre:

```text
Entrada do usuário
       ↓
🔴 aplicação vulnerável
       ↓
comportamento inesperado
```

e:

```text
Entrada do usuário
       ↓
🟢 validação + autenticação
       ↓
autorização + proteção
       ↓
processamento seguro
```

Dessa forma, o projeto demonstra não apenas a existência das vulnerabilidades, mas também como práticas de desenvolvimento seguro podem reduzir seus riscos.
