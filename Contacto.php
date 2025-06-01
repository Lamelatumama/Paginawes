<?php
require_once 'sesion.php';
require_once 'conexion.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto - Burger Place</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="sidebar">
        <img src="img/Logo/HamburguesaLOGO2.png" alt="Logo">
        <nav>
            <ul>
                <li><a href="Index.php">Home</a></li>
                <li><a href="Nosotros.php">Nosotros</a></li>
                <li><a href="Menu.php">Menú</a></li>
                <li><a class="active" href="Contacto.php">Contacto</a></li>
                <?php if (is_logged_in()): ?>
                    <li><a href="perfil.php">Mi Perfil</a></li>
                    <li><a href="Index.php?action=logout">Cerrar Sesión</a></li>
                <?php else: ?>
                    <li><a href="login.html">Iniciar Sesión</a></li>
                    <li><a href="registro.html">Registrarse</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
    <div class="main-content">
        <h1>Contacto</h1>
        <div class="contact-section">
            <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
                <tr>
                    <td style="vertical-align: middle; text-align: center;">
                        <button class="reserve-button" onclick="window.location.href='reserva.php'">Reserva ya</button>
                    </td>
                    <td style="vertical-align: middle; padding-left: 20px; border-left: 1px solid #ddd;">
                        <div class="contact-info">
                            <p>Aquí está nuestra Información de Contacto</p>
                            <p>Teléfono: +123 456 789</p>
                            <p>Correo electrónico: contacto@burgerplace.com</p>
                            <p>Facebook: @BurgerPlace</p>
                            <p>Instagram: @BurgerPlace</p>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <div class="map-container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2933.894599175214!2d-6.258457684069771!3d53.34980538798214!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48fffb96f87d5a2f%3A0x9e377fe2f8c2f80a!2sEastpoint%20Business%20Park!5e0!3m2!1sen!2sie!4v1698789447225!5m2!1sen!2sie" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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