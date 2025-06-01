<?php
require_once 'sesion.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nosotros - Burger Place</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="sidebar">
        <img src="img/Logo/HamburguesaLOGO2.png" alt="Logo">
        <nav>
            <ul>
                <li><a href="Home.php">Home</a></li>
                <li><a class="active" href="Nosotros.php">Nosotros</a></li>
                <li><a href="Menu.php">Menú</a></li>
                <li><a href="Contacto.php">Contacto</a></li>
                <?php if (is_logged_in()): ?>
                    <li><a href="perfil.php">Mi Perfil</a></li>
                    <li><a href="logout.php">Cerrar Sesión</a></li>
                <?php else: ?>
                    <li><a href="login.html">Iniciar Sesión</a></li>
                    <li><a href="registro.html">Registrarse</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
    <div class="main-content">
        <h1>Sobre Nosotros</h1>
        <div class="about-section">
            <div class="about-item">
                <img src="img/Nosotros/res_1.jpg" alt="Imagen del Restaurante 1">
                <div class="text-content">
                    <h3>Nuestra Historia</h3>
                    <p>Burger Place fue fundado con la pasión de ofrecer comida rápida de alta calidad y deliciosa. Nuestro viaje comenzó con una idea sencilla: servir las mejores hamburguesas de la ciudad.</p>
                </div>
            </div>
            <div class="about-item">
                <iframe src="https://www.youtube.com/embed/VIDEO_ID_AQUI" frameborder="0" allowfullscreen></iframe>
                <div class="text-content">
                    <h3>Conoce a Nuestro Equipo</h3>
                    <p>Nuestro equipo está dedicado a brindar un servicio excepcional y crear un ambiente acogedor para todos nuestros clientes.</p>
                </div>
            </div>
            <div class="about-item">
                <img src="img/Nosotros/granja.jpg" alt="Imagen del Restaurante 2">
                <div class="text-content">
                    <h3>Nuestro Compromiso</h3>
                    <p>Estamos comprometidos a utilizar ingredientes frescos y locales para garantizar el mejor sabor y calidad en cada bocado.</p>
                </div>
            </div>
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
