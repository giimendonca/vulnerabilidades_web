<?php

if (session_status() === PHP_SESSION_NONE) {

    session_set_cookie_params([
        'httponly' => true,
        'secure' => false,
        'samesite' => 'Lax'
    ]);

    session_start();
}