<?php

if (session_status() === PHP_SESSION_NONE) {

    session_set_cookie_params([
        'HttpOnly' => true,
        'Secure' => false,
        'SameSite' => 'Lax'
    ]);

    session_start();
}