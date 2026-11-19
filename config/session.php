<?php
// Sesión segura (TP8): cookies HttpOnly + SameSite + modo estricto.
// Se inicia solo si no hay una sesión activa.
if (session_status() === PHP_SESSION_NONE) {
    $https = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off');

    ini_set('session.use_strict_mode', '1');   // rechaza IDs de sesión no generados por el servidor
    ini_set('session.use_only_cookies', '1');  // el ID nunca viaja por URL
    ini_set('session.cookie_httponly', '1');   // JS no puede leer la cookie (mitiga XSS)

    session_set_cookie_params([
        'lifetime' => 0,                       // expira al cerrar el navegador
        'path'     => '/',
        'secure'   => $https,                  // solo HTTPS cuando esté disponible
        'httponly' => true,
        'samesite' => 'Lax',                   // mitiga CSRF
    ]);

    session_start();
}
