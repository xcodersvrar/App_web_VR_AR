<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XCODERSVR - Secciones</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="icon" href="img/ICONO 1.png" type="image/x-icon">
</head>
<body>
    <div id="particles-js"></div>
    
    <div class="container">
        <header class="header animate__animated animate__fadeInDown">
            <div class="logo-container">
                <img src="img/logo1_sinfondo.png" alt="XCODERSVR Logo" class="logo">
            </div>
            <h1 class="welcome-message">Bienvenido a XCODERSVR</h1>
            <p class="welcome-subtitle">Tu solución en bienes raíces</p>
        </header>
        
        <main class="main-content animate__animated animate__fadeInUp">
            <div class="login-options">
                <h2 class="options-title">Selecciona tu tipo de acceso</h2>
                
                <div class="options-container">
                    <div class="option-card" id="user-option">
                        <div class="option-icon">
                            <i class="fas fa-user"></i>
                        </div>
                        <h3 class="option-title">Usuario</h3>
                        <p class="option-description">Accede para buscar propiedades, guardar favoritos y más.</p>
                        <button class="option-btn" onclick="redirectToUserLogin()">Iniciar Sesión</button>
                    </div>
                    
                    <div class="option-card" id="agency-option">
                        <div class="option-icon">
                            <i class="fas fa-building"></i>
                        </div>
                        <h3 class="option-title">Agente Inmobiliario</h3>
                        <p class="option-description">Acceso para profesionales de otras agencias asociadas.</p>
                        <button class="option-btn" onclick="redirectToAgencyLogin()">Iniciar Sesión</button>
                    </div>
                </div>
            </div>
        </main>
        
        <footer class="footer animate__animated animate__fadeIn - col-12">
            <p>&copy; 2025 XCODERSVR - Todos los derechos reservados</p>
            <div class="social-links">
            </div>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <script src="js/particles.js"></script>
    <script src="js/script.js"></script>
</body>
</html>