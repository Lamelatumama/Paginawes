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

function logout() {
    session_unset();
    session_destroy();
    header("Location: Home.php?logout=success");
    exit();
}
