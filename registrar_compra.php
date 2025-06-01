<?php
require_once 'sesion.php';
require_once 'conexion.php';

header('Content-Type: text/plain');
//coprueba lo típico, si estña logeado, y luego si el método es post
if (!is_logged_in()) {
    echo "Error: Debes iniciar sesión para registrar una compra.";
    exit();
}
//aquí lo del post
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //guarda lo importante de la compra
	$usuario_id = get_current_user_id();
    $total_compra = $_POST['total_compra'] ?? 0;
    $detalles_productos = $_POST['detalles_productos'] ?? '[]';
	
    $total_compra = filter_var($total_compra, FILTER_VALIDATE_FLOAT);
	//comprueba que no sea negativo
    if ($total_compra === false || $total_compra < 0) {
        echo "Error: El total de la compra no es válido.";
        exit();
    }
	//algunas comprobaciones para ver si está todo bien
    json_decode($detalles_productos);
    if (json_last_error() !== JSON_ERROR_NONE) {
        echo "Error: Los detalles de los productos no son un JSON válido.";
        exit();
    }

    if (!$conexion instanceof mysqli || $conexion->connect_error) {
        echo "Error: Conexión a la base de datos no disponible.";
        error_log("Error en registrar_compra.php: Conexión a DB no disponible.");
        exit();
    }
	//introducción datos y te pone fallos si algo va mal.
    $stmt = $conexion->prepare("INSERT INTO compras (usuario_id, detalles_productos, total_compra) VALUES (?, ?, ?)");

    if ($stmt) {
        $stmt->bind_param("isd", $usuario_id, $detalles_productos, $total_compra);

        if ($stmt->execute()) {
            echo "Compra registrada con éxito.";
        } else {
            echo "Error al registrar la compra: " . $stmt->error;
            error_log("[$usuario_id] Error al ejecutar INSERT: " . $stmt->error);
        }
        $stmt->close();
    } else {
        echo "Error al preparar la consulta de compra: " . $conexion->error;
        error_log("Error al preparar INSERT en compras: " . $conexion->error);
    }
    $conexion->close();
} else {
    echo "Método de solicitud no permitido.";
}
