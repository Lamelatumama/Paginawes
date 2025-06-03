<?php
require_once 'sesion.php';
require_once 'conexion.php';

if (!is_logged_in()) {
    header("Location: login.html");
    exit();
}

$usuario_id = get_current_user_id();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fecha_evento = $_POST['fecha_evento'];
    $hora_evento = $_POST['hora_evento'];
    $numero_adultos = $_POST['numero_adultos'];
    $numero_ninos = $_POST['numero_ninos'];

    error_log("Fecha: $fecha_evento, Hora: $hora_evento, Adultos: $numero_adultos, Niños: $numero_ninos");

    $detalles_reserva = "Reserva para $numero_adultos adultos y $numero_ninos niños";

    $sql = "INSERT INTO reservas (usuario_id, fecha_evento, hora_evento, numero_adultos, numero_ninos, detalles_reserva) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("isssis", $usuario_id, $fecha_evento, $hora_evento, $numero_adultos, $numero_ninos, $detalles_reserva);
        if ($stmt->execute()) {
            header("Location: Contacto.php");
            exit();
        } else {
            echo "<script>alert('Error al registrar la reserva: " . $stmt->error . "');</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('Error al preparar la consulta: " . $conexion->error . "');</script>";
    }

    $conexion->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservas Burger Place</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #0d1117;
            color: #e6edf3;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .sidebar {
            width: 180px;
            background-color: #161b22;
            padding: 20px 0;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.7);
            height: 100%;
            position: fixed;
            z-index: 10;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .sidebar img {
            max-width: 80%;
            height: auto;
            margin-bottom: 40px;
            filter: drop-shadow(0 0 5px rgba(255, 99, 71, 0.4));
        }

        .sidebar nav ul {
            list-style: none;
            padding: 0;
            width: 100%;
            text-align: center;
        }

        .sidebar nav ul li {
            margin: 30px 0;
        }

        .sidebar nav ul li a {
            text-decoration: none;
            color: #b0b0b0;
            font-size: 19px;
            font-weight: 500;
            transition: color 0.3s ease, transform 0.3s ease;
            padding: 8px 0;
            display: block;
        }

        .sidebar nav ul li a:hover {
            color: #ff7f50;
            transform: translateX(5px);
        }

        .sidebar nav ul li a.active {
            color: #ff6347;
            border-bottom: 2px solid #ff6347;
            font-weight: 600;
            transform: none;
        }

        .main-content {
            margin-left: 180px;
            padding: 0 20px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            padding-top: 100px;
            padding-bottom: 60px;
        }

        .reservation-container {
            background-color: rgba(30, 30, 30, 0.9);
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            padding: 20px;
            width: 100%;
            max-width: 500px;
            text-align: center;
            margin-top: 20px;
        }

        .reservation-container h1 {
            color: #ff6347;
            margin-bottom: 5px;
        }

        .reservation-container p {
            color: #aaa;
            margin-bottom: 20px;
        }

        .counter {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }

        .counter button {
            background-color: #333;
            border: none;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            font-size: 20px;
            cursor: pointer;
            margin: 0 10px;
            color: #fff;
        }

        .counter span {
            font-size: 18px;
            width: 30px;
            text-align: center;
        }

        .date-selector {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            width: 100%;
        }

        .date-selector button {
            background-color: #333;
            border: none;
            border-radius: 5px;
            padding: 8px;
            cursor: pointer;
            margin: 0 2px;
            color: #fff;
            font-size: 12px;
            flex: 1;
        }

        .date-selector button.active {
            background-color: #ff6347;
        }

        .selected-date {
            background-color: #333;
            border: none;
            border-radius: 5px;
            padding: 10px;
            cursor: pointer;
            margin-bottom: 20px;
            color: #fff;
            display: none;
        }

        .time-slot {
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 10px;
            cursor: pointer;
            width: 100%;
        }

        .time-slot.active {
            background-color: #ff6347;
        }

        .time-slot-container {
            margin-bottom: 20px;
        }

        .time-options {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 10px;
        }

        .time-options.hidden {
            display: none;
        }

        .time-option {
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px;
            cursor: pointer;
        }

        .time-option.active {
            background-color: #ff6347;
        }

        .continue-button {
            background-color: #ff6347;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 15px;
            cursor: pointer;
            width: 100%;
            font-weight: bold;
            margin-top: 20px;
        }

        .error-message {
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 20px;
            display: none;
            text-align: center;
        }

        .calendar-container {
            display: none;
            background-color: rgba(30, 30, 30, 0.9);
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            padding: 20px;
            width: 100%;
            max-width: 500px;
            text-align: center;
            position: absolute;
            z-index: 100;
        }

        .calendar {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .calendar-header {
            display: flex;
            justify-content: space-between;
            width: 100%;
            margin-bottom: 10px;
        }

        .calendar-header button {
            background: none;
            border: none;
            color: #fff;
            font-size: 20px;
            cursor: pointer;
        }

        .calendar-days {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .calendar-day {
            width: 40px;
            height: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 5px;
            cursor: pointer;
            background-color: #333;
            color: #fff;
            border-radius: 5px;
        }

        .calendar-day:hover {
            background-color: #ff6347;
        }

        .calendar-day.active {
            background-color: #ff6347;
        }

        .close-calendar {
            background-color: #ff6347;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px;
            cursor: pointer;
            width: 100%;
            margin-top: 10px;
        }

        .error-message {
            background-color: #f8f8f8;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
            margin: 20px 0;
            text-align: center;
        }

        .error-message button {
            background-color: #333;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            margin: 10px;
            cursor: pointer;
        }

        .error-message button:hover {
            background-color: #555;
        }

    </style>
</head>
<body>
    <div class="sidebar">
        <img src="img/Logo/HamburguesaLOGO2.png" alt="Logo">
        <nav>
            <ul>
            <li><a href="Index.php">Home</a></li>
            <li><a href="Nosotros.php">Nosotros</a></li>
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
        <div class="reservation-container">
            <h1>Reserve en Burger Place.</h1>
            <p>Calle Menorca, 33, Madrid</p>
            <p>Si desea reservar en las mesas de terraza llámenos por teléfono.</p>

            <div>
                <div class="counter">
                    <button onclick="decrement('adults')" id="decrement-adults">-</button>
                    <span id="adults">1</span>
                    <button onclick="increment('adults')">+</button>
                </div>
                <p>Adultos</p>
            </div>

            <div>
                <div class="counter">
                    <button onclick="decrement('children')">-</button>
                    <span id="children">0</span>
                    <button onclick="increment('children')">+</button>
                </div>
                <p>Niños</p>
            </div>

            <div class="date-selector" id="date-selector">
                <button id="today-button" class="active" onclick="selectDate(this)">HOY 1 JUN</button>
                <button onclick="selectDate(this)">LUN 2 JUN</button>
                <button onclick="selectDate(this)">MAR 3 JUN</button>
                <button onclick="selectDate(this)">MIÉ 4 JUN</button>
                <button onclick="selectDate(this)">JUE 5 JUN</button>
                <button onclick="selectDate(this)">VIE 6 JUN</button>
                <button onclick="showCalendar()">...</button>
            </div>

            <div id="selected-date-container" class="selected-date" onclick="showCalendar()">
            </div>

            <div id="calendar-container" class="calendar-container">
                <div class="calendar">
                    <div class="calendar-header">
                        <button onclick="prevMonth()">←</button>
                        <h2 id="month-year">Junio 2025</h2>
                        <button onclick="nextMonth()">→</button>
                    </div>
                    <div class="calendar-days" id="calendar-days">
                    </div>
                    <button class="close-calendar" onclick="hideCalendar()">Cerrar</button>
                </div>
            </div>

            <div class="time-slot-container">
                <button class="time-slot" onclick="selectTime(this, 'comida')">COMIDA 13:00 - 17:00</button>
                <button class="time-slot" onclick="selectTime(this, 'cena')">CENA 20:00 - 23:00</button>
            </div>

            <div id="comida-time-options" class="time-options hidden">
                <button class="time-option" onclick="selectTimeOption(this)">13:00</button>
                <button class="time-option" onclick="selectTimeOption(this)">13:30</button>
                <button class="time-option" onclick="selectTimeOption(this)">14:00</button>
                <button class="time-option" onclick="selectTimeOption(this)">14:30</button>
                <button class="time-option" onclick="selectTimeOption(this)">15:00</button>
                <button class="time-option" onclick="selectTimeOption(this)">15:30</button>
                <button class="time-option" onclick="selectTimeOption(this)">16:00</button>
                <button class="time-option" onclick="selectTimeOption(this)">16:30</button>
                <button class="time-option" onclick="selectTimeOption(this)">17:00</button>
            </div>

            <div id="cena-time-options" class="time-options hidden">
                <button class="time-option" onclick="selectTimeOption(this)">20:00</button>
                <button class="time-option" onclick="selectTimeOption(this)">20:30</button>
                <button class="time-option" onclick="selectTimeOption(this)">21:00</button>
                <button class="time-option" onclick="selectTimeOption(this)">21:30</button>
                <button class="time-option" onclick="selectTimeOption(this)">22:00</button>
                <button class="time-option" onclick="selectTimeOption(this)">22:30</button>
                <button class="time-option" onclick="selectTimeOption(this)">23:00</button>
            </div>


            <div id="error-message" class="error-message">
                <p>Lo sentimos, demasiados comensales en la mesa</p>
                <p>Para gestionar esta reserva llamenos al telefono que ponemos a continuación</p>
                <p>Teléfono: +123 456 789</p>
                <button onclick="modifySearch()">MODIFICAR BÚSQUEDA</button>
            </div>

            <form method="post" action="">
                <input type="hidden" id="fecha_evento" name="fecha_evento">
                <input type="hidden" id="hora_evento" name="hora_evento">
                <input type="hidden" id="numero_adultos" name="numero_adultos">
                <input type="hidden" id="numero_ninos" name="numero_ninos">
                <button type="submit" class="continue-button">CONTINUAR</button>
            </form>

        </div>
    </div>

    <script>
    let selectedDate = '';
    let selectedTime = '';
    let currentMonthIndex = 5;
    let currentYear = 2025;
    let isFutureConfirmation = false;

    function increment(id) {
        const element = document.getElementById(id);
        let value = parseInt(element.textContent);
        element.textContent = value + 1;
    }

    function decrement(id) {
        const element = document.getElementById(id);
        let value = parseInt(element.textContent);
        if (id === 'adults' && value <= 1) {
            return;
        }
        if (value > 0) {
            element.textContent = value - 1;
        }
    }

    function selectDate(button) {
        const buttons = document.querySelectorAll('#date-selector button');
        buttons.forEach(btn => btn.classList.remove('active'));
        button.classList.add('active');

        const dateText = button.textContent.trim();
        selectedDate = formatDate(dateText);
        document.getElementById('fecha_evento').value = selectedDate;
    }

    function showCalendar() {
        document.getElementById('calendar-container').style.display = 'block';
        renderCalendar();
    }

    function hideCalendar() {
        document.getElementById('calendar-container').style.display = 'none';
    }

    function selectTime(button, mealType) {
        const buttons = document.querySelectorAll('.time-slot');
        buttons.forEach(btn => btn.classList.remove('active'));
        button.classList.add('active');

        document.querySelectorAll('.time-options').forEach(option => option.classList.add('hidden'));

        if (mealType === 'comida') {
            document.getElementById('comida-time-options').classList.remove('hidden');
            selectedTime = 'Comida';
        } else if (mealType === 'cena') {
            document.getElementById('cena-time-options').classList.remove('hidden');
            selectedTime = 'Cena';
        }
    }

    function selectTimeOption(button) {
        const buttons = document.querySelectorAll('.time-option');
        buttons.forEach(btn => btn.classList.remove('active'));
        button.classList.add('active');

        selectedTime = `${selectedTime} ${button.textContent}`;
        document.getElementById('hora_evento').value = selectedTime;
    }

    function formatDate(dateText) {
        const parts = dateText.split(' ');
        let day = parts[1];
        const monthName = parts[2];

        const monthMap = {
            "JUN": "06",
        };

        const year = new Date().getFullYear();

        return `${year}-${monthMap[monthName]}-${String(day).padStart(2, '0')}`;
    }

    function selectCalendarDate(day, month, year) {
        const monthNames = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
        selectedDate = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
        document.getElementById('selected-date-container').textContent = `Fecha seleccionada: ${day} ${monthNames[month]}`;
        document.getElementById('selected-date-container').style.display = 'block';
        document.getElementById('date-selector').style.display = 'none';
        document.getElementById('fecha_evento').value = selectedDate;
        hideCalendar();
    }

    function renderCalendar() {
        const calendarDays = document.getElementById('calendar-days');
        calendarDays.innerHTML = '';

        const monthYearElement = document.getElementById('month-year');
        const monthNames = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
        monthYearElement.textContent = `${monthNames[currentMonthIndex]} ${currentYear}`;

        const daysInMonth = new Date(currentYear, currentMonthIndex + 1, 0).getDate();
        for (let i = 1; i <= daysInMonth; i++) {
            const dayElement = document.createElement('div');
            dayElement.className = 'calendar-day';
            dayElement.textContent = i;
            dayElement.onclick = function() {
                selectCalendarDate(i, currentMonthIndex, currentYear);
            };
            calendarDays.appendChild(dayElement);
        }
    }

    function prevMonth() {
        if (isFutureConfirmation) {
            isFutureConfirmation = false;
            currentMonthIndex = 8; // Septiembre
            renderCalendar();
        } else if (currentMonthIndex > 5) { // No retroceder más allá de junio
            currentMonthIndex--;
            renderCalendar();
        }
    }

    function nextMonth() {
        if (isFutureConfirmation) {
            return;
        }

        if (currentMonthIndex < 8) { // No avanzar más allá de septiembre
            currentMonthIndex++;
            renderCalendar();
        } else {
            isFutureConfirmation = true;
            renderCalendar();
        }
    }

    function continueReservation(event) {
        event.preventDefault(); // Previene el envío automático del formulario

        const adults = parseInt(document.getElementById('adults').textContent);
        const children = parseInt(document.getElementById('children').textContent);
        const selectedDateButton = document.querySelector('#date-selector button.active');
        const selectedTimeOption = document.querySelector('.time-option.active');

        if (!selectedDateButton && !document.getElementById('fecha_evento').value) {
            alert('Por favor, selecciona una fecha.');
            return;
        }

        if (!selectedTimeOption && !document.getElementById('hora_evento').value) {
            alert('Por favor, selecciona una hora.');
            return;
        }

        if (adults <= 0) {
            alert('Por favor, selecciona al menos un adulto.');
            return;
        }

        if (adults + children > 9) {
            document.getElementById('error-message').style.display = 'block';
            return;
        }

        document.getElementById('numero_adultos').value = adults;
        document.getElementById('numero_ninos').value = children;

        alert(`La reserva se ha realizado correctamente para el día ${selectedDate} a las ${selectedTime}.`);
        document.querySelector('form').submit();
    }

    document.querySelector('.continue-button').addEventListener('click', continueReservation);

    function hideError() {
        document.getElementById('error-message').style.display = 'none';
    }

    function modifySearch() {
        hideError();
    }
</script>

</body>
</html>
