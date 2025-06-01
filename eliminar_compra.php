<?php
require_once 'conexion.php';
require_once 'sesion.php';

if (!is_logged_in()) {
    header('Location: login.html');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['compra_id'])) {
    $compra_id = $_POST['compra_id'];
    $usuario_id = get_current_user_id();

    // Prepara la consulta para eliminar SOLO si pertenece al usuario actual
    $stmt = $conexion->prepare("DELETE FROM compras WHERE id = ? AND usuario_id = ?");
    if ($stmt) {
        $stmt->bind_param("ii", $compra_id, $usuario_id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            // Éxito al eliminar
            header('Location: perfil.php?eliminado=1');
        } else {
            // No se eliminó nada (puede no ser dueño de la compra)
            header('Location: perfil.php?error=1');
        }

        $stmt->close();
    } else {
        // Error al preparar consulta
        header('Location: perfil.php?error=2');
    }
} else {
    header('Location: perfil.php');
}
?>