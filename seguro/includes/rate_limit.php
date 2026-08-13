<?php

function verificarTentativasLogin()
{
    $limite = 5;
    $tempoBloqueio = 60;

    if (!isset($_SESSION['login_tentativas'])) {
        $_SESSION['login_tentativas'] = 0;
    }


    // Verifica se ainda está dentro do período de bloqueio
    if (
        isset($_SESSION['login_bloqueio']) &&
        time() < $_SESSION['login_bloqueio']
    ) {
        die("Muitas tentativas. Aguarde um minuto.");
    }


    // Se o bloqueio terminou, libera novas tentativas
    if (
        isset($_SESSION['login_bloqueio']) &&
        time() >= $_SESSION['login_bloqueio']
    ) {
        unset($_SESSION['login_bloqueio']);
        $_SESSION['login_tentativas'] = 0;
    }


    // Verifica se atingiu o limite
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