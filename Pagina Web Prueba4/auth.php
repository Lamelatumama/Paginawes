<?php
ob_start();
require_once 'conexion.php';
require_once 'sesion.php';

header('Content-Type: application/json');

if (isset($_POST['accion']) && $_POST['accion'] == 'registro') {
    $nombre_usuario = $_POST['nombre_usuario'] ?? '';
    $correo_electronico = $_POST['correo_electronico'] ?? '';
    $contrasena = $_POST['contrasena'] ?? '';

    if (empty($nombre_usuario) || empty($correo_electronico) || empty($contrasena)) {
        echo json_encode(['success' => false, 'message' => 'Por favor, completa todos los campos.']);
        exit();
    }

    if (strlen($nombre_usuario) < 3) {
        echo json_encode(['success' => false, 'message' => 'El nombre de usuario debe tener al menos 3 caracteres.']);
        exit();
    }

    if (strlen($contrasena) < 8) {
        echo json_encode(['success' => false, 'message' => 'La contraseña debe tener al menos 8 caracteres.']);
        exit();
    }

    $stmt_check = $conexion->prepare("SELECT COUNT(*) FROM usuarios WHERE nombre_usuario = ? OR correo_electronico = ?");
    if ($stmt_check) {
        $stmt_check->bind_param("ss", $nombre_usuario, $correo_electronico);
        $stmt_check->execute();
        $stmt_check->bind_result($count);
        $stmt_check->fetch();
        $stmt_check->close();

        if ($count > 0) {
            echo json_encode(['success' => false, 'message' => 'El nombre de usuario o correo electrónico ya están registrados.']);
            exit();
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al preparar la verificación de usuario/correo.']);
        exit();
    }

    $contrasena_hash = password_hash($contrasena, PASSWORD_DEFAULT);

    $stmt = $conexion->prepare("INSERT INTO usuarios (nombre_usuario, correo_electronico, contrasena) VALUES (?, ?, ?)");

    if ($stmt) {
        $stmt->bind_param("sss", $nombre_usuario, $correo_electronico, $contrasena_hash);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Registro exitoso. Ahora puedes iniciar sesión.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al registrar el usuario: ' . $stmt->error]);
        }
        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al preparar la consulta de registro.']);
    }
    $conexion->close();
} elseif (isset($_POST['accion']) && $_POST['accion'] == 'login') {
    $correo_o_usuario = $_POST['correo_o_usuario'] ?? '';
    $contrasena = $_POST['contrasena'] ?? '';

    if (empty($correo_o_usuario) || empty($contrasena)) {
        echo json_encode(['success' => false, 'message' => 'Por favor, completa todos los campos.']);
        exit();
    }

    $stmt = $conexion->prepare("SELECT id, nombre_usuario, contrasena, correo_electronico, fecha_registro FROM usuarios WHERE correo_electronico = ? OR nombre_usuario = ?");
    if ($stmt) {
        $stmt->bind_param("ss", $correo_o_usuario, $correo_o_usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows === 1) {
            $usuario = $resultado->fetch_assoc();
            if (password_verify($contrasena, $usuario['contrasena'])) {
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['nombre_usuario'] = $usuario['nombre_usuario'];
				/*
				estaba probando para meter lo del email y la fecha de registro
				*/
				$_SESSION['correo_electronico'] = $usuario['correo_electronico'];
				$_SESSION['fecha_registro'] = $usuario['fecha_registro'];
				
                echo json_encode(['success' => true, 'message' => 'Inicio de sesión exitoso.']);
                exit();
            } else {
                echo json_encode(['success' => false, 'message' => 'Contraseña incorrecta.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Usuario no encontrado.']);
        }
        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al preparar la consulta de inicio de sesión.']);
    }
    $conexion->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Acción no válida.']);
}
?>
