<?php
require_once 'sesion.php';

if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    logout();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Burger Place</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="sidebar">
        <img src="img/Logo/HamburguesaLOGO2.png" alt="Logo">
        <nav>
            <ul>
                <li><a class="active" href="Home.php">Home</a></li>
                <li><a href="Nosotros.php">Nosotros</a></li>
                <li><a href="Menu.php">Menú</a></li>
                <li><a href="Contacto.php">Contacto</a></li>
                <?php if (is_logged_in()): ?>
                    <li><a href="perfil.php">Mi Perfil</a></li>
                    <li><a href="#" onclick="confirmLogout(event)">Cerrar Sesión</a></li>
                <?php else: ?>
                    <li><a href="login.html">Iniciar Sesión</a></li>
                    <li><a href="registro.html">Registrarse</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
    <header class="header">
        <h1>Bienvenidos a Burger Place</h1>
    </header>
    <div class="main-content">
        <div class="carousel">
            <div class="carousel-inner">
                <div class="carousel-item">
                    <img class="img-Fondo img-hamburguesa" src="img/Carrusel/HamburguesaFONDO.jpg" alt="Background 1">
                    <div class="promo-overlay">
                        <h2>Prueba nuestras excelentes Hamburguesas</h2>
                        <p>Ingredientes naturales, increíble sabor</p>
                        <a href="Menu.php">Order Now!</a>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="img-Fondo img-ensalada" src="img/Carrusel/EnsaladaFONDO.jpg" alt="Background 2">
                    <div class="promo-overlay">
                        <h2>Deliciosas Ensaladas</h2>
                        <p>Ensaladas frescas y saludables para todos los gustos</p>
                        <a href="Menu.php">Order Now!</a>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="img-Fondo img-pizza" src="img/Carrusel/PizzaFONDO.jpg" alt="Background 3">
                    <div class="promo-overlay">
                        <h2>Pizzas Irresistibles</h2>
                        <p>Pizzas con ingredientes de la mejor calidad</p>
                        <a href="Menu.php">Order Now!</a>
                    </div>
                </div>
            </div>
            <div class="carousel-controls">
                <button class="carousel-control" data-index="0"></button>
                <button class="carousel-control" data-index="1"></button>
                <button class="carousel-control" data-index="2"></button>
            </div>
        </div>
    </div>

    <div id="custom-modal" class="modal">
        <div class="modal-content">
            <span class="close-custom-button">&times;</span>
            <h2 id="custom-modal-title"></h2>
            <p id="custom-modal-message"></p>
            <button class="ok-button">OK</button>
        </div>
    </div>

    <script>
        function confirmLogout(event) {
            event.preventDefault();
            if (confirm("¿Estás seguro de que deseas cerrar sesión?")) {
                window.location.href = "Home.php?action=logout";
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            const carousel = document.querySelector('.carousel');
            const carouselInner = document.querySelector('.carousel-inner');
            const carouselItems = document.querySelectorAll('.carousel-item');
            const carouselControls = document.querySelectorAll('.carousel-control');
            let currentIndex = 0;

            function showItem(index) {
                const itemWidth = carouselItems[0].offsetWidth;
                carouselInner.style.transform = `translateX(-${index * itemWidth}px)`;
                carouselControls.forEach(control => control.classList.remove('active'));
                carouselControls[index].classList.add('active');
            }

            carouselControls.forEach(control => {
                control.addEventListener('click', function () {
                    const index = parseInt(control.getAttribute('data-index'), 10);
                    currentIndex = index;
                    showItem(currentIndex);
                });
            });

            setInterval(() => {
                currentIndex = (currentIndex + 1) % carouselItems.length;
                showItem(currentIndex);
            }, 5000);

            showItem(currentIndex);

            const customModal = document.getElementById('custom-modal');
            const customModalTitle = document.getElementById('custom-modal-title');
            const customModalMessage = document.getElementById('custom-modal-message');
            const closeCustomButton = document.querySelector('.close-custom-button');
            const okButton = document.querySelector('.ok-button');

            function showCustomModal(title, message) {
                customModalTitle.textContent = title;
                customModalMessage.textContent = message;
                customModal.style.display = 'flex';
            }

            function hideCustomModal() {
                customModal.style.display = 'none';
            }

            closeCustomButton.addEventListener('click', hideCustomModal);
            okButton.addEventListener('click', hideCustomModal);

            customModal.addEventListener('click', function(event) {
                if (event.target === customModal) {
                    hideCustomModal();
                }
            });

            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('logout') && urlParams.get('logout') === 'success') {
                showCustomModal('¡Sesión Cerrada!', 'Has cerrado tu sesión exitosamente.');
                urlParams.delete('logout');
                const newUrl = window.location.pathname + '?' + urlParams.toString();
                window.history.replaceState({}, document.title, newUrl);
            }
        });
    </script>
</body>
</html>
