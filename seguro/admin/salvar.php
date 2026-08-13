<?php

include "../includes/sessao.php";

include "../../includes/conexao.php";
include "../includes/csrf.php";
include "../includes/autenticacao.php";
include "../includes/autorizacao.php";
include "../includes/security.php";


if (!isset($_SESSION['id'])) {
    die("Acesso negado.");
}

if ($_SESSION['tipo'] !== 'admin') {
    die("Acesso negado.");
}


verificarTokenCSRF();


$titulo = trim($_POST['titulo'] ?? '');
$descricao = trim($_POST['descricao'] ?? '');
$opcoes = $_POST['opcoes'] ?? [];


if ($titulo === '' || $descricao === '') {
    die("Preencha todos os campos.");
}


if (count($opcoes) !== 3) {
    die("A enquete deve possuir três opções.");
}


foreach ($opcoes as &$opcao) {

    $opcao = trim($opcao);

    if ($opcao === '') {
        die("Todas as opções devem ser preenchidas.");
    }
}

unset($opcao);


/*
|--------------------------------------------------------------------------
| UPLOAD SEGURO
|--------------------------------------------------------------------------
*/

$imagem = null;


if (
    isset($_FILES['imagem']) &&
    $_FILES['imagem']['error'] !== UPLOAD_ERR_NO_FILE
) {

    /*
    | Verifica se ocorreu algum erro no upload
    */

    if ($_FILES['imagem']['error'] !== UPLOAD_ERR_OK) {
        die("Erro ao enviar a imagem.");
    }


    /*
    | Limite de tamanho: 2 MB
    */

    $tamanhoMaximo = 2 * 1024 * 1024;

    if ($_FILES['imagem']['size'] > $tamanhoMaximo) {
        die("A imagem deve possuir no máximo 2 MB.");
    }


    /*
    | Tipos MIME permitidos
    */

    $tiposPermitidos = [
        'image/jpeg',
        'image/png',
        'image/webp'
    ];


    /*
    | Descobre o tipo REAL do arquivo
    | em vez de confiar na extensão enviada
    */

    $finfo = new finfo(FILEINFO_MIME_TYPE);

    $tipo = $finfo->file(
        $_FILES['imagem']['tmp_name']
    );


    if (!in_array($tipo, $tiposPermitidos, true)) {
        die("Tipo de imagem não permitido.");
    }


    /*
    | Define a extensão com base no MIME detectado
    */

    $extensoes = [
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
        'image/webp' => 'webp'
    ];


    /*
    | Gera um nome aleatório
    | Não usamos o nome enviado pelo usuário
    */

    $nomeArquivo = bin2hex(
        random_bytes(16)
    );


    $extensao = $extensoes[$tipo];

    $nomeFinal = $nomeArquivo . "." . $extensao;


    /*
    | Caminho da pasta uploads
    |
    | estamos em:
    | sistema-votacao/seguro/admin/
    |
    | então precisamos voltar duas pastas
    */

    $destino = "../../assets/uploads/" . $nomeFinal;


    /*
    | Move o arquivo para a pasta de uploads
    */

    if (!move_uploaded_file(
        $_FILES['imagem']['tmp_name'],
        $destino
    )) {
        die("Não foi possível salvar a imagem.");
    }


    /*
    | Nome que será armazenado no banco
    */

    $imagem = $nomeFinal;
}


/*
|--------------------------------------------------------------------------
| BANCO DE DADOS
|--------------------------------------------------------------------------
*/

$conexao->begin_transaction();


try {

    /*
    | Cria a enquete
    */

    $stmt = $conexao->prepare("
        INSERT INTO enquetes
        (titulo, descricao, imagem)
        VALUES (?, ?, ?)
    ");


    $stmt->bind_param(
        "sss",
        $titulo,
        $descricao,
        $imagem
    );


    $stmt->execute();


    /*
    | Recupera o ID da enquete criada
    */

    $enquete_id = $conexao->insert_id;


    /*
    | Prepara o INSERT das opções
    */

    $stmt = $conexao->prepare("
        INSERT INTO opcoes
        (enquete_id, texto)
        VALUES (?, ?)
    ");


    foreach ($opcoes as $opcao) {

        $stmt->bind_param(
            "is",
            $enquete_id,
            $opcao
        );

        $stmt->execute();
    }


    /*
    | Confirma todas as alterações
    */

    $conexao->commit();


} catch (Exception $e) {

    /*
    | Se alguma operação falhar,
    | desfaz as alterações no banco
    */

    $conexao->rollback();


    /*
    | Se uma imagem já tiver sido salva,
    | remove o arquivo para não deixar lixo
    */

    if ($imagem !== null) {

        $arquivo = "vulnerabilidades_web/assets/uploads/" . $imagem;

        if (file_exists($arquivo)) {
            unlink($arquivo);
        }
    }


    die("Erro ao criar enquete.");
}


header("Location: index.php");
exit;