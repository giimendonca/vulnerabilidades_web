<?php

function verificarTentativasLogin()
{
    $limite = 5;
    $tempoBloqueio = 60;

    if (!isset($_SESSION['login_tentativas'])) {
        $_SESSION['login_tentativas'] = 0;
    }

    if (
        isset($_SESSION['login_bloqueio']) &&
        time() < $_SESSION['login_bloqueio']
    ) {
        die("Muitas tentativas. Aguarde um minuto.");
    }

    if ($_SESSION['login_tentativas'] >= $limite) {

        $_SESSION['login_bloqueio'] =
            time() + $tempoBloqueio;

        die("Muitas tentativas. Aguarde um minuto.");
    }
}


function registrarTentativaFalha()
{
    if (!isset($_SESSION['login_tentativas'])) {
        $_SESSION['login_tentativas'] = 0;
    }

    $_SESSION['login_tentativas']++;
}


function limparTentativasLogin()
{
    unset($_SESSION['login_tentativas']);
    unset($_SESSION['login_bloqueio']);
}