<?php
require_once 'sesion.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú - Burger Place</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body class="menu-page"> <div class="sidebar">
        <img src="img/Logo/HamburguesaLOGO2.png" alt="Logo">
        <nav>
            <ul>
                <li><a href="Home.php">Home</a></li>
                <li><a href="Nosotros.php">Nosotros</a></li>
                <li><a class="active" href="Menu.php">Menú</a></li>
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
	<!--Botones para ir a cada zona del menú><-->
    <header class="header">
        <h1>Menú</h1>
        <div class="nav-buttons">
            <button class="nav-button" onclick="scrollToSection('entrantes')">Entrantes</button>
            <button class="nav-button" onclick="scrollToSection('hamburguesas')">Hamburguesas</button>
            <button class="nav-button" onclick="scrollToSection('wraps')">Wraps y Sándwiches</button>
            <button class="nav-button" onclick="scrollToSection('perritos')">Perritos Calientes</button>
            <button class="nav-button" onclick="scrollToSection('ensaladas')">Ensaladas</button>
            <button class="nav-button" onclick="scrollToSection('pizzas')">Pizzas</button>
            <button class="nav-button" onclick="scrollToSection('alitas')">Alitas y Tiras de Pollo</button>
            <button class="nav-button" onclick="scrollToSection('bebidas')">Bebidas</button>
            <button class="nav-button" onclick="scrollToSection('postres')">Postres</button>
        </div>
		<!--Botón del carrito que activa el carro><-->
        <button id="view-cart-button" class="cart-button-image">
            <img src="img/Carrito/Carrito.png" alt="Carrito de Compras"> <span id="cart-count" class="cart-count">0</span>
        </button>
    </header>
	<!--Básicamente el menú dónde se pone todo, divido por secciones, se pueden meter imágenes, título, descripción y precio><-->
    <div class="main-content" style="padding-top: 80px;">
        <div class="category" id="entrantes">
            <h2>Entrantes y Acompañamientos</h2>
            <div class="menu-items">
                <div class="menu-item">
                    <img src="img/Menu/Entrantes/PapasFritas.png" alt="Papas Fritas Clásicas">
                    <h3>Papas Fritas Clásicas</h3>
                    <div class="price">€1.99</div>
                    <p>Crujientes papas fritas clásicas.</p>
                    <button class="add-to-cart">Añadir al carrito</button>
                </div>
                <div class="menu-item">
                    <img src="img/Menu/Entrantes/PatatasBaconChedar.png" alt="Papas Gajo con Queso y Bacon">
                    <h3>Papas Gajo con Queso y Bacon</h3>
                    <div class="price">€2.99</div>
                    <p>Papas gajo cubiertas con queso y bacon.</p>
                    <button class="add-to-cart">Añadir al carrito</button>
                </div>
                <div class="menu-item">
                    <img src="img/Menu/Entrantes/ArosCebolla.png" alt="Aros de Cebolla Crujientes">
                    <h3>Aros de Cebolla Crujientes</h3>
                    <div class="price">€2.49</div>
                    <p>Aros de cebolla crujientes y dorados.</p>
                    <button class="add-to-cart">Añadir al carrito</button>
                </div>
                <div class="menu-item">
                    <img src="img/Menu/Entrantes/Niggers_de_polla.png" alt="Nuggets de Pollo">
                    <h3>Nuggets de Pollo (6 o 10 unidades)</h3>
                    <div class="price">€1.99</div>
                    <p>Nuggets de pollo crujientes.</p>
                    <button class="add-to-cart">Añadir al carrito</button>
                </div>
                <div class="menu-item">
                    <img src="img/Menu/Entrantes/Palillos_mozarella.jpg" alt="Palitos de Mozzarella">
                    <h3>Palitos de Mozzarella</h3>
                    <div class="price">€1.49</div>
                    <p>Palitos de mozzarella fritos y crujientes.</p>
                    <button class="add-to-cart">Añadir al carrito</button>
                </div>
            </div>
        </div>

        <div class="category" id="hamburguesas">
            <h2>Hamburguesas</h2>
            <div class="menu-items">
                <div class="menu-item">
                    <img src="img/Menu/Hamburguesas/Hambur_normal.jpg" alt="Clásica Deluxe">
                    <h3>Clásica Deluxe</h3>
                    <div class="price">€4.99</div>
                    <p>Carne de res, queso cheddar, lechuga, tomate y salsa especial.</p>
                    <button class="add-to-cart">Añadir al carrito</button>
                </div>
                <div class="menu-item">
                    <img src="img/Menu/Hamburguesas/Hambur_BBQ.jpg" alt="BBQ Bacon Burger">
                    <h3>BBQ Bacon Burger</h3>
                    <div class="price">€4.99</div>
                    <p>Carne, doble queso, bacon crujiente y salsa barbacoa.</p>
                    <button class="add-to-cart">Añadir al carrito</button>
                </div>
                <div class="menu-item">
                    <img src="img/Menu/Hamburguesas/hambur_polla.jpg" alt="Chicken Crunch">
                    <h3>Chicken Crunch</h3>
                    <div class="price">€3.49</div>
                    <p>Filete de pollo empanizado, lechuga y mayonesa.</p>
                    <button class="add-to-cart">Añadir al carrito</button>
                </div>
                <div class="menu-item">
                    <img src="img/Menu/Hamburguesas/hambur_vegana_vomito.webp" alt="Veggie Burger">
                    <h3>Veggie Burger</h3>
                    <div class="price">€18.99</div>
                    <p>Hamburguesa vegetal, tomate, lechuga y alioli de ajo.</p>
                    <button class="add-to-cart">Añadir al carrito</button>
                </div>
            </div>
        </div>

        <div class="category" id="wraps">
            <h2>Wraps y Sándwiches</h2>
            <div class="menu-items">
                <div class="menu-item">
                    <img src="img/Menu/Wraps y Sandwiches/Crypsi_warp.png" alt="Wrap de Pollo Crispy">
                    <h3>Wrap de Pollo Crispy</h3>
                    <div class="price">€1.49</div>
                    <p>Pollo empanizado, lechuga, tomate y mayonesa.</p>
                    <button class="add-to-cart">Añadir al carrito</button>
                </div>
                <div class="menu-item">
                    <img src="img/Menu/Wraps y Sandwiches/wrap_vergamo.jpg" alt="Wrap Vegano">
                    <h3>Wrap Vegano</h3>
                    <div class="price">€0.99</div>
                    <p>Falafel, vegetales frescos y salsa de yogur vegano.</p>
                    <button class="add-to-cart">Añadir al carrito</button>
                </div>
                <div class="menu-item">
                    <img src="img/Menu/Wraps y Sandwiches/rap_mejicano.png" alt="Wrap Mexicano">
                    <h3>Wrap Mexicano</h3>
                    <div class="price">€1.99</div>
                    <p>Tiras de pollo, guacamole, lechuga y maíz.</p>
                    <button class="add-to-cart">Añadir al carrito</button>
                </div>
                <div class="menu-item">
                    <img src="img/Menu/Wraps y Sandwiches/Wrap_Ranchero.jpg" alt="Wrap Ranchero">
                    <h3>Wrap Ranchero</h3>
                    <div class="price">€2.49</div>
                    <p>Pollo a la parrilla, bacon, queso y salsa ranch.</p>
                    <button class="add-to-cart">Añadir al carrito</button>
                </div>
                <div class="menu-item">
                    <img src="img/Menu/Wraps y Sandwiches/Sándwich_Club.jpg" alt="Sándwich Club">
                    <h3>Sándwich Club</h3>
                    <div class="price">€2.99</div>
                    <p>Pavo, jamón, queso, lechuga y tomate en pan tostado.</p>
                    <button class="add-to-cart">Añadir al carrito</button>
                </div>
                <div class="menu-item">
                    <img src="img/Menu/Wraps y Sandwiches/sandwich-caprese.jpg" alt="Sándwich Caprese">
                    <h3>Sándwich Caprese</h3>
                    <div class="price">€1.99</div>
                    <p>Mozzarella fresca, tomate, albahaca y pesto.</p>
                    <button class="add-to-cart">Añadir al carrito</button>
                </div>
                <div class="menu-item">
                    <img src="img/Menu/Wraps y Sandwiches/Sándwichdepolla.jpg" alt="Sándwich de Pollo BBQ">
                    <h3>Sándwich de Pollo BBQ</h3>
                    <div class="price">€1.49</div>
                    <p>Pollo desmenuzado con salsa barbacoa y cebolla caramelizada.</p>
                    <button class="add-to-cart">Añadir al carrito</button>
                </div>
            </div>
        </div>

        <div class="category" id="perritos">
            <h2>Perritos Calientes</h2>
            <div class="menu-items">
                <div class="menu-item">
                    <img src="img/Menu/Perritos Calientes/1425large.jpg" alt="Perrito Clásico">
                    <h3>Perrito Clásico</h3>
                    <div class="price">€1.99</div>
                    <p>Salchicha, kétchup y mostaza.</p>
                    <button class="add-to-cart">Añadir al carrito</button>
                </div>
                <div class="menu-item">
                    <img src="img/Menu/Perritos Calientes/Perra_calientebaconqueso.webp" alt="Perrito con Queso y Bacon">
                    <h3>Perrito con Queso y Bacon</h3>
                    <div class="price">€2.99</div>
                    <p>Salchicha, queso fundido y bacon crujiente.</p>
                    <button class="add-to-cart">Añadir al carrito</button>
                </div>
                <div class="menu-item">
                    <img src="img/Menu/Perritos Calientes/perra_picante.avif" alt="Perrito Picante">
                    <h3>Perrito Picante</h3>
                    <div class="price">€2.49</div>
                    <p>Salchicha, jalapeños, salsa picante y cebolla frita.</p>
                    <button class="add-to-cart">Añadir al carrito</button>
                </div>
                <div class="menu-item">
                    <img src="img/Menu/Perritos Calientes/polla_de_hippy.jpg" alt="Perrito Veggie">
                    <h3>Perrito Veggie</h3>
                    <div class="price">€14.99</div>
                    <p>Salchicha vegetal, lechuga, tomate y mostaza.</p>
                    <button class="add-to-cart">Añadir al carrito</button>
                </div>
            </div>
        </div>

        <div class="category" id="ensaladas">
            <h2>Ensaladas</h2>
            <div class="menu-items">
                <div class="menu-item">
                    <img src="img/Menu/Ensaladas/EnsaladaCesar.avif" alt="Ensalada César">
                    <h3>Ensalada César</h3>
                    <div class="price">€16.99</div>
                    <p>Lechuga, pollo a la plancha, queso parmesano y croutons.</p>
                    <button class="add-to-cart">Añadir al carrito</button>
                </div>
                <div class="menu-item">
                    <img src="img/Menu/Ensaladas/EnsaladaGriega.jpg" alt="Ensalada Griega">
                    <h3>Ensalada Griega</h3>
                    <div class="price">€16.49</div>
                    <p>Tomate, pepino, cebolla roja, aceitunas y queso feta.</p>
                    <button class="add-to-cart">Añadir al carrito</button>
                </div>
                <div class="menu-item">
                    <img src="img/Menu/Ensaladas/EnsaladaMixta.jpg" alt="Ensalada Mixta">
                    <h3>Ensalada Mixta</h3>
                    <div class="price">€15.99</div>
                    <p>Lechuga, tomate, zanahoria, maíz y huevo duro.</p>
                    <button class="add-to-cart">Añadir al carrito</button>
                </div>
                <div class="menu-item">
                    <img src="img/Menu/Ensaladas/EnsaladaVegana.jpg" alt="Ensalada Vegana">
                    <h3>Ensalada Vegana</h3>
                    <div class="price">€16.49</div>
                    <p>Mezcla de verdes, garbanzos, aguacate y vinagreta balsámica.</p>
                    <button class="add-to-cart">Añadir al carrito</button>
                </div>
            </div>
        </div>

        <div class="category" id="pizzas">
            <h2>Pizzas</h2>
            <div class="menu-items">
                <div class="menu-item">
                    <img src="img/Menu/Pizzas/margarita_pizza.avif" alt="Margarita">
                    <h3>Margarita</h3>
                    <div class="price">€4.99</div>
                    <p>Pizza clásica con tomate, mozzarella y albahaca.</p>
                    <button class="add-to-cart">Añadir al carrito</button>
                </div>
                <div class="menu-item">
                    <img src="img/Menu/Pizzas/pizza-de-peperoni.webp" alt="Pepperoni">
                    <h3>Pepperoni</h3>
                    <div class="price">€4.49</div>
                    <p>Pizza con pepperoni y queso fundido.</p>
                    <button class="add-to-cart">Añadir al carrito</button>
                </div>
                <div class="menu-item">
                    <img src="img/Menu/Pizzas/Cuatro_Quesos.jpg" alt="Cuatro Quesos">
                    <h3>Cuatro Quesos</h3>
                    <div class="price">€4.99</div>
                    <p>Pizza con cuatro tipos de queso.</p>
                    <button class="add-to-cart">Añadir al carrito</button>
                </div>
                <div class="menu-item">
                    <img src="img/Menu/Pizzas/dia_bola.jpg" alt="Diábola">
                    <h3>Diábola</h3>
                    <div class="price">€4.49</div>
                    <p>Salami picante, pimiento y salsa de tomate.</p>
                    <button class="add-to-cart">Añadir al carrito</button>
                </div>
            </div>
        </div>

        <div class="category" id="alitas">
            <h2>Alitas y Tiras de Pollo</h2>
            <div class="menu-items">
                <div class="menu-item">
                    <img src="img/Menu/Alitas y Tiras de Pollo/Alitas_BBQ.jpg" alt="Alitas BBQ">
                    <h3>Alitas BBQ (6 o 12 unidades)</h3>
                    <div class="price">€2.99</div>
                    <p>Alitas de pollo con salsa barbacoa.</p>
                    <button class="add-to-cart">Añadir al carrito</button>
                </div>
                <div class="menu-item">
                    <img src="img/Menu/Alitas y Tiras de Pollo/Alitas_picantes.jpg" alt="Alitas Picantes">
                    <h3>Alitas Picantes</h3>
                    <div class="price">€3.49</div>
                    <p>Alitas de pollo con salsa picante.</p>
                    <button class="add-to-cart">Añadir al carrito</button>
                </div>
                <div class="menu-item">
                    <img src="img/Menu/Alitas y Tiras de Pollo/Alitas_crujientes.jpg" alt="Tiras de Pollo Crujiente">
                    <h3>Tiras de Pollo Crujiente (4 o 6 unidades)</h3>
                    <div class="price">€1.99</div>
                    <p>Tiras de pollo crujientes.</p>
                    <button class="add-to-cart">Añadir al carrito</button>
                </div>
                <div class="menu-item">
                    <img src="img/Menu/Alitas y Tiras de Pollo/Alitas_strips.jfif" alt="Mix Wings and Strips">
                    <h3>Mix Wings and Strips</h3>
                    <div class="price">€2.99</div>
                    <p>Combinado de alitas y tiras con papas y salsa.</p>
                    <button class="add-to-cart">Añadir al carrito</button>
                </div>
            </div>
        </div>

        <div class="category" id="bebidas">
            <h2>Bebidas</h2>
            <div class="menu-items">
                <div class="menu-item">
                    <img src="img/Menu/Bebidas/marca_blanca.jfif" alt="Refrescos">
                    <h3>Refrescos (cola, naranja, limón)</h3>
                    <div class="price">€0.49</div>
                    <p>Refrescos en varios sabores.</p>
                    <button class="add-to-cart">Añadir al carrito</button>
                </div>
                <div class="menu-item">
                    <img src="img/Menu/Bebidas/NCI_iced_tea.jpg" alt="Té helado">
                    <h3>Té helado</h3>
                    <div class="price">€0.99</div>
                    <p>Té helado refrescante.</p>
                    <button class="add-to-cart">Añadir al carrito</button>
                </div>
                <div class="menu-item">
                    <img src="img/Menu/Bebidas/agua-filtrada-1024x731.jpg" alt="Agua mineral">
                    <h3>Agua mineral</h3>
                    <div class="price">€0.25</div>
                    <p>Agua mineral natural.</p>
                    <button class="add-to-cart">Añadir al carrito</button>
                </div>
                <div class="menu-item">
                    <img src="img/Menu/Bebidas/cerveza.jpg" alt="Cervezas">
                    <h3>Cervezas (con alcohol y sin alcohol)</h3>
                    <div class="price">€0.59</div>
                    <p>Variedad de cervezas.</p>
                    <button class="add-to-cart">Añadir al carrito</button>
                </div>
            </div>
        </div>

        <div class="category" id="postres">
            <h2>Postres</h2>
            <div class="menu-items">
                <div class="menu-item">
                    <img src="img/Menu/Postres/heladocaramelo.webp" alt="Helado Sundae">
                    <h3>Helado Sundae (chocolate o caramelo)</h3>
                    <div class="price">€0.99</div>
                    <p>Helado sundae con salsa de chocolate o caramelo.</p>
                    <button class="add-to-cart">Añadir al carrito</button>
                </div>
                <div class="menu-item">
                    <img src="img/Menu/Postres/bwornnie.webp" alt="Brownie con helado">
                    <h3>Brownie con helado</h3>
                    <div class="price">€0.49</div>
                    <p>Brownie caliente con una bola de helado.</p>
                    <button class="add-to-cart">Añadir al carrito</button>
                </div>
                <div class="menu-item">
                    <img src="img/Menu/Postres/Tarta-de-queso-Antonio.webp" alt="Cheesecake">
                    <h3>Cheesecake</h3>
                    <div class="price">€1.49</div>
                    <p>Cheesecake cremoso.</p>
                    <button class="add-to-cart">Añadir al carrito</button>
                </div>
                <div class="menu-item">
                    <img src="img/Menu/Postres/galleta.webp" alt="Galleta de chocolate caliente">
                    <h3>Galleta de chocolate caliente</h3>
                    <div class="price">€0.39</div>
                    <p>Galleta de chocolate caliente y crujiente.</p>
                    <button class="add-to-cart">Añadir al carrito</button>
                </div>
                <div class="menu-item">
                    <img src="img/Menu/Postres/batido.webp" alt="Batidos">
                    <h3>Batidos (vainilla, chocolate, fresa)</h3>
                    <div class="price">€0.49</div>
                    <p>Batidos cremosos en varios sabores.</p>
                    <button class="add-to-cart">Añadir al carrito</button>
                </div>
            </div>
        </div>
    </div>

    <div id="cart-modal" class="modal">
        <div class="modal-content">
            <span class="close-button">&times;</span>
            <h2>Tu Carrito</h2>
            <div id="cart-items">
            </div>
            <div class="cart-summary">
                <p>Total: <span id="cart-total">€0.00</span></p>
                <p id="discount-message" style="color: green; font-weight: bold; display: none;">¡Tienes un 10% de descuento!</p>
            </div>
            <button id="checkout-btn" class="btn">Comprar</button>
            <?php if (!is_logged_in()): ?>
                <p style="text-align: center; margin-top: 15px;">Para finalizar la compra, por favor <a href="login.html">inicia sesión</a> o <a href="registro.html">regístrate</a>.</p>
            <?php endif; ?>
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

    <script>
	//rellenar comentario más tarde
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.nav-button').forEach(button => {
                button.addEventListener('click', function() {
                    const targetId = this.getAttribute('onclick').replace("scrollToSection('", "").replace("')", "");
                    const targetElement = document.getElementById(targetId);
                    if (targetElement) {
                        targetElement.scrollIntoView({ behavior: 'smooth' });
                    }
                });
            });
			//constantes de botones para activar cosas
            const cartModal = document.getElementById('cart-modal');
            const closeButton = document.querySelector('.close-button');
            const addToCartButtons = document.querySelectorAll('.add-to-cart');
            const cartItemsContainer = document.getElementById('cart-items');
            const cartTotalSpan = document.getElementById('cart-total');
            const cartCountSpan = document.getElementById('cart-count');
            const viewCartButton = document.getElementById('view-cart-button');
            const checkoutBtn = document.getElementById('checkout-btn');
            const discountMessage = document.getElementById('discount-message');

            const customModal = document.getElementById('custom-modal');
            const customModalTitle = document.getElementById('custom-modal-title');
            const customModalMessage = document.getElementById('custom-modal-message');
            const closeCustomButton = document.querySelector('.close-custom-button');
            const okButton = document.querySelector('.ok-button');
			
			//array del carrito
            let cart = [];
			//constante para ver si está relleno el carro
            const isLoggedIn = <?php echo json_encode(is_logged_in()); ?>;

            function showCustomModal(title, message) {
                customModalTitle.textContent = title;
                customModalMessage.textContent = message;
                customModal.style.display = 'block';
            }

            closeCustomButton.addEventListener('click', () => {
                customModal.style.display = 'none';
            });

            okButton.addEventListener('click', () => {
                customModal.style.display = 'none';
            });

            window.addEventListener('click', (event) => {
                if (event.target == customModal) {
                    customModal.style.display = 'none';
                }
            });
			//carrito para ver las cosas que tienes para comprar
            function updateCartDisplay() {
                cartItemsContainer.innerHTML = '';
                let total = 0;
                let itemCount = 0;

                cart.forEach((item, index) => {
                    const itemDiv = document.createElement('div');
                    itemDiv.classList.add('cart-item-entry');
                    itemDiv.innerHTML = `
                        <span>${item.name} x ${item.quantity}</span>
                        <span>€${(item.price * item.quantity).toFixed(2)}</span>
                        <div class="cart-item-controls">
                            <button class="quantity-btn" data-index="${index}" data-action="decrease">-</button>
                            <button class="quantity-btn" data-index="${index}" data-action="increase">+</button>
                            <button class="remove-from-cart-btn" data-index="${index}">Eliminar</button>
                        </div>`;
                    cartItemsContainer.appendChild(itemDiv);
                    total += item.price * item.quantity;
                    itemCount += item.quantity;
                });
				//te da un 10% de descuento si estás registrado (un poco raro si para poder comprar necesitas estar registrado sí o sí)
                if (isLoggedIn) {
                    total *= 0.90;
                    discountMessage.style.display = 'block';
                    discountMessage.textContent = '¡Tienes un 10% de descuento aplicado por ser usuario registrado!';
                } else {
                    discountMessage.style.display = 'none';
                }

                cartTotalSpan.textContent = `€${total.toFixed(2)}`;
                cartCountSpan.textContent = itemCount;
				//comprueba si tienes items en el carrito
                if (itemCount > 0) {
                    viewCartButton.classList.add('has-items');
                } else {
                    viewCartButton.classList.remove('has-items');
                }
				//botón sumar cosas al carrito
                document.querySelectorAll('.quantity-btn').forEach(button => {
                    button.addEventListener('click', function() {
                        const index = parseInt(this.getAttribute('data-index'));
                        const action = this.getAttribute('data-action');
                        if (action === 'increase') {
                            cart[index].quantity++;
                        } else if (action === 'decrease') {
                            if (cart[index].quantity > 1) {
                                cart[index].quantity--;
                            } else {
                                cart.splice(index, 1);
                            }
                        }
                        updateCartDisplay();
                    });
                });
				//botón para quitar cosas al carrito
                document.querySelectorAll('.remove-from-cart-btn').forEach(button => {
                    button.addEventListener('click', function() {
                        const index = parseInt(this.getAttribute('data-index'));
                        cart.splice(index, 1);
                        updateCartDisplay();
                    });
                });
            }
			//otro botón
            addToCartButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const item = this.closest('.menu-item');
                    const itemName = item.querySelector('h3').textContent;
                    const itemPrice = parseFloat(item.querySelector('.price').textContent.replace('€', ''));

                    const existingItem = cart.find(cartItem => cartItem.name === itemName);
                    if (existingItem) {
                        existingItem.quantity++;
                    } else {
                        cart.push({ name: itemName, price: itemPrice, quantity: 1 });
                    }
                    updateCartDisplay();
                });
            });

            viewCartButton.addEventListener('click', () => {
                cartModal.style.display = 'block';
            });

            closeButton.addEventListener('click', () => {
                cartModal.style.display = 'none';
            });

            window.addEventListener('click', (event) => {
                if (event.target == cartModal) {
                    cartModal.style.display = 'none';
                }
            });
			//botón de ejecutar compra de lo que tengas, comprueba si tienes algo, si no no te deja, si no estás iniciado sesión tampoco, si cumples te registra la compra y te lo mete todo a una lista 
            checkoutBtn.addEventListener('click', async () => {
                if (cart.length === 0) {
                    showCustomModal('Carrito Vacío', 'Tu carrito está vacío. Añade algunos productos antes de proceder al pago.');
                    return;
                }

                if (!isLoggedIn) {
                    showCustomModal('Inicia Sesión para Comprar', 'Debes iniciar sesión para completar tu compra. Serás redirigido a la página de inicio de sesión.');
                    setTimeout(() => { window.location.href = 'login.html'; }, 3000);
                    return;
                }
				//se guardan los valores en las siguientes variables y se ajustan a lo que necesitamos para meterlos en la db
                //const totalCompra = parseFloat(cartTotalSpan.textContent.replace('€', ''));
				//cambio de la gestión de total compra, ahora mira por si hay texto raro y lo cambia por si se cambia el texto en el futuro
				const totalCompra = parseFloat(cartTotalSpan.textContent.replace(/[^\d.,]/g, '').replace(',', '.'));
                const detallesProductos = JSON.stringify(cart);
				//desactivamos el botón para que no se envíe 2 veces lo mismo, luego lo habilitamos
				checkoutBtn.disabled = true;
                try {
                    const response = await fetch('registrar_compra.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        //body: `total_compra=${totalCompra}&detalles_productos=${detallesProductos}`
						//cambiamos el código de arriba por el de abajo para solucionar posibles problemas con otros caracteres:
						body: `total_compra=${encodeURIComponent(totalCompra)}&detalles_productos=${encodeURIComponent(detallesProductos)}`
                    });
					//espera la respuesta y te dice si fue exitosa
                    const result = await response.text();
					//añadimos esto para verlo en la consola que nos dice el servidor si necesitamos ver qué ha sucedido con el error
					console.log('Respuesta del servidor:', result);
                    if (response.ok && result.includes("Compra registrada con éxito")) {
                        showCustomModal('¡Compra Exitosa!', 'Tu compra ha sido registrada con éxito. Puedes verla en tu historial de compras en tu perfil.');
                        cart = [];
                        updateCartDisplay();
                        cartModal.style.display = 'none';
						
                    } else {
                        showCustomModal('Error al Registrar Compra', 'Ocurrió un error al registrar tu compra: ' + result);
                    }
                } catch (error) {
                    console.error('Error al enviar la compra:', error);
                    showCustomModal('Error de Conexión', 'Ocurrió un error al procesar tu compra. Inténtalo de nuevo más tarde.');
                }
				checkoutBtn.disabled = false;
            });

            updateCartDisplay();
        });
    </script>
</body>
</html>
