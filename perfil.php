<?php
require_once 'sesion.php';
require_once 'conexion.php';

if (!is_logged_in()) {
    header("Location: login.html");
    exit();
}

$usuario_id = get_current_user_id();
$nombre_usuario = get_current_username();

$compras = [];

if ($conexion instanceof mysqli && !$conexion->connect_error) {
    // Asegúrate de que la columna 'id' también se selecciona si la usas en algún lugar (aunque no se usa directamente en este snippet)
    $stmt = $conexion->prepare("SELECT id, fecha_compra, detalles_productos, total_compra FROM compras WHERE usuario_id = ? ORDER BY fecha_compra DESC");

    if ($stmt) {
        $stmt->bind_param("i", $usuario_id);
        
        if ($stmt->execute()) {
            $resultado = $stmt->get_result();
            
            if ($resultado instanceof mysqli_result) {
                if ($resultado->num_rows > 0) {
                    while ($fila = $resultado->fetch_assoc()) {
                        $compras[] = $fila;
                    }
                }
                $resultado->free();
            } else {
                error_log("Error: get_result() no devolvió un objeto mysqli_result en perfil.php. Posiblemente un error de ejecución.");
            }
        } else {
            error_log("Error al ejecutar la consulta en perfil.php: " . $stmt->error);
        }
        $stmt->close();
    } else {
        error_log("Error al preparar la consulta en perfil.php: " . $conexion->error);
    }
} else {
    error_log("Error: La conexión a la base de datos no es válida en perfil.php o falló la conexión.");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil - Burger Place</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="sidebar">
        <img src="img/Logo/HamburguesaLOGO2.png" alt="Logo">
        <nav>
            <ul>
                <li><a href="Home.php">Home</a></li>
                <li><a href="Nosotros.php">Nosotros</a></li>
                <li><a href="Menu.php">Menú</a></li>
                <li><a href="Contacto.php">Contacto</a></li>
                <?php if (is_logged_in()): ?>
                    <li><a class="active" href="perfil.php">Mi Perfil</a></li>
                    <li><a href="Home.php?action=logout">Cerrar Sesión</a></li>
                <?php else: ?>
                    <li><a href="login.html">Iniciar Sesión</a></li>
                    <li><a href="registro.html">Registrarse</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
    <header class="header">
        <h1>Mi Perfil</h1>
    </header>

    <div class="main-content profile-container">
        <div class="profile-info">
            <p>Nombre de Usuario: <strong><?php echo htmlspecialchars($nombre_usuario); ?></strong></p>
            <p>ID de Usuario: <strong><?php echo htmlspecialchars($usuario_id); ?></strong></p>
        </div>

        <div class="purchase-history">
            <h2>Historial de Compras</h2>
            <?php if (!empty($compras)): ?>
                <?php foreach ($compras as $compra): ?>
                    <div class="purchase-item">
                        <p class="date">Fecha: <?php echo date("d/m/Y H:i", strtotime($compra['fecha_compra'])); ?></p>
                        <p>Detalles:</p>
                        <ul>
                            <?php
                            $detalles_productos = json_decode($compra['detalles_productos'], true);
                            if (json_last_error() === JSON_ERROR_NONE && is_array($detalles_productos)) {
                                foreach ($detalles_productos as $producto) {
                                    $nombre_producto = htmlspecialchars($producto['name'] ?? 'Producto Desconocido');
                                    $cantidad_producto = htmlspecialchars($producto['quantity'] ?? 1);
                                    $precio_producto = htmlspecialchars($producto['price'] ?? 0);
                                    // Muestra la cantidad, el nombre del producto y el precio unitario
                                    echo "<li>{$cantidad_producto} x {$nombre_producto} - €" . number_format($precio_producto, 2) . " c/u</li>";
                                }
                            } else {
                                echo "<li>Error al cargar los detalles del producto.</li>";
                                // Log el error para depuración
                                error_log("Error al decodificar JSON en perfil.php para compra ID " . ($compra['id'] ?? 'desconocido') . ": " . json_last_error_msg());
                            }
                            ?>
                        </ul>
                        <p class="total">Total: €<?php echo number_format($compra['total_compra'], 2); ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="no-purchases">Aún no has realizado ninguna compra.</p>
            <?php endif; ?>
        </div>
    </div>

    <footer>
        <nav>
            <ul>
                <li><a href="Home.php">Home</a></li>
                <li><a href="Nosotros.php">About</a></li>
                <li><a href="Menu.php">Menú</a></li>
                <li><a href="Contacto.php">Contact</a></li>
            </ul>
        </nav>
        <p>© 2023 All rights reserved - PastaBurger House</p>
    </footer>
</body>
</html>