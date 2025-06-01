<?php
require_once 'sesion.php';
require_once 'conexion.php';

if (!is_logged_in()) {
    header("Location: login.html");
    exit();
}

$usuario_id = get_current_user_id();
$nombre_usuario = get_current_username();
$correo_electronico = get_current_correo_electronico();
$fecha_registro = get_current_fecha_registro();


$compras = [];
$reservas = [];

if ($conexion instanceof mysqli && !$conexion->connect_error) {
    // Consulta para obtener las compras del usuario
    $stmt_compras = $conexion->prepare("SELECT id, fecha_compra, detalles_productos, total_compra FROM compras WHERE usuario_id = ? ORDER BY fecha_compra DESC");
    if ($stmt_compras) {
        $stmt_compras->bind_param("i", $usuario_id);
        if ($stmt_compras->execute()) {
            $resultado_compras = $stmt_compras->get_result();
            if ($resultado_compras instanceof mysqli_result) {
                while ($fila = $resultado_compras->fetch_assoc()) {
                    $compras[] = $fila;
                }
                $resultado_compras->free();
            } else {
                error_log("Error: get_result() no devolvió un objeto mysqli_result para compras en perfil.php.");
            }
        } else {
            error_log("Error al ejecutar la consulta de compras en perfil.php: " . $stmt_compras->error);
        }
        $stmt_compras->close();
    } else {
        error_log("Error al preparar la consulta de compras en perfil.php: " . $conexion->error);
    }

    // Consulta para obtener las reservas del usuario
    $stmt_reservas = $conexion->prepare("SELECT id, fecha_evento, hora_evento, numero_adultos, numero_ninos, detalles_reserva FROM reservas WHERE usuario_id = ? ORDER BY fecha_evento DESC");
    if ($stmt_reservas) {
        $stmt_reservas->bind_param("i", $usuario_id);
        if ($stmt_reservas->execute()) {
            $resultado_reservas = $stmt_reservas->get_result();
            if ($resultado_reservas instanceof mysqli_result) {
                while ($fila = $resultado_reservas->fetch_assoc()) {
                    $reservas[] = $fila;
                }
                $resultado_reservas->free();
            } else {
                error_log("Error: get_result() no devolvió un objeto mysqli_result para reservas en perfil.php.");
            }
        } else {
            error_log("Error al ejecutar la consulta de reservas en perfil.php: " . $stmt_reservas->error);
        }
        $stmt_reservas->close();
    } else {
        error_log("Error al preparar la consulta de reservas en perfil.php: " . $conexion->error);
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
			<p>Email de Usuario: <strong><?php echo htmlspecialchars($correo_electronico); ?></strong></p>
			<p>Fecha de Registro de Usuario: <strong><?php echo htmlspecialchars($fecha_registro); ?></strong></p>
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
						<!--Total de compra la compra><-->
                        <p class="total">Total: €<?php echo number_format($compra['total_compra'], 2); ?></p>
						<!--Eliminar compra, tuve que poner el estilo ahí porque no me lo cargaba el css, debe ser que está muy petao y no carga una mierda><-->
						<form method="POST" action="eliminar_compra.php" onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta compra? No hay reembolsos disponibles');">
							<input type="hidden" name="compra_id" value="<?php echo htmlspecialchars($compra['id']); ?>">
							<button 
								type="submit"
								style="
									background-color: #d32f2f;
									color: #fff;
									border: none;
									padding: 8px 16px;
									border-radius: 8px;
									font-size: 14px;
									cursor: pointer;
									font-weight: bold;
									box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
									transition: background-color 0.3s ease, transform 0.2s ease;
								"
								onmouseover="this.style.backgroundColor='#ff5252'; this.style.transform='scale(1.03)'"
								onmouseout="this.style.backgroundColor='#d32f2f'; this.style.transform='scale(1)'"
							>
								Eliminar
							</button>
						</form>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="no-purchases">Aún no has realizado ninguna compra.</p>
            <?php endif; ?>
        </div>
		<div class="reservation-history">
            <h2>Historial de Reservas</h2>
            <?php if (!empty($reservas)): ?>
                <?php foreach ($reservas as $reserva): ?>
                    <div class="reservation-item">
                        <p class="date">Fecha: <?php echo date("d/m/Y", strtotime($reserva['fecha_evento'])); ?></p>
                        <p>Hora: <?php echo htmlspecialchars($reserva['hora_evento']); ?></p>
                        <p>Adultos: <?php echo htmlspecialchars($reserva['numero_adultos']); ?></p>
                        <p>Niños: <?php echo htmlspecialchars($reserva['numero_ninos']); ?></p>
                        <p>Detalles: <?php echo htmlspecialchars($reserva['detalles_reserva']); ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="no-reservations">Aún no has realizado ninguna reserva.</p>
            <?php endif; ?>
        </div>
    </div>

    <footer>
        <nav>
            <ul>
                <li><a href="Home.php">Home</a></li>
                <li><a href="Nosotros.php">Nosotros</a></li>
                <li><a href="Menu.php">Menú</a></li>
                <li><a href="Contacto.php">Contacto</a></li>
            </ul>
        </nav>
        <p>© 2025 Todos los derechos reservados - Burger Place</p>
    </footer>
</body>
</html>