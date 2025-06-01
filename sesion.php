<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function is_logged_in() {
    return isset($_SESSION['usuario_id']);
}

function get_current_user_id() {
    return is_logged_in() ? $_SESSION['usuario_id'] : null;
}

function get_current_username() {
    return is_logged_in() ? $_SESSION['nombre_usuario'] : null;
}

function get_current_correo_electronico() {
    return is_logged_in() ? $_SESSION['correo_electronico'] : null;
}

function get_current_fecha_registro() {
    return is_logged_in() ? $_SESSION['fecha_registro'] : null;
}
/*
Warning
: Undefined array key "fecha_registro" in
D:\Documentos PROfesionales\achetemle\xampp\Xam\htdocs\Pagina Web Prueba4\sesion.php
on line
23

*/
function logout() {
    session_unset();
    session_destroy();
    header("Location: Home.php?logout=success");
    exit();
}
