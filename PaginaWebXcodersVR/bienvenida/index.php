<?php
// Configuración básica para la página
$company_name = "XcodersVR";
$slogan = "Transformando la experiencia inmobiliaria con Realidad Virtual";
$welcome_message = "Bienvenido a una nueva dimensión en bienes raíces";
$description = "En XcodersVR combinamos tecnología VR de vanguardia con el mercado inmobiliario para ofrecer experiencias inmersivas únicas. Ya sea que estés buscando tu hogar ideal o quieras ofrecer una experiencia excepcional a tus clientes, estamos aquí para revolucionar tu visión del sector.";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a <?php echo $company_name; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="icon/ICONO 1.png" type="image/x-icon">
</head>
<body>
    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand logo" href="#">
                <i class="fas fa-vr-cardboard logo-icon"></i>
                <?php echo $company_name; ?>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">

            </div>
        </div>
    </nav>

    <!-- Sección Hero -->
    <section class="hero-section">
        <div class="hero-bg"></div>
        <div class="container">
            <div class="hero-content" data-aos="fade-up" data-aos-duration="1000">
                <h1 class="hero-title"><?php echo $welcome_message; ?></h1>
                <h2 class="hero-subtitle"><?php echo $slogan; ?></h2>
                <p class="hero-description"><?php echo $description; ?></p>
                <a href="../seccion/index.php" class="btn btn-primary-custom pulse">
                    INICIAR SESION - USUARIO / AGENCIA  <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Sección de Características -->
    <section id="features" class="features-section">
        <div class="container">
            <h2 class="section-title" data-aos="fade-up">Nuestros Servicios</h2>
            <div class="row">
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-card text-center">
                        <i class="fas fa-home feature-icon"></i>
                        <h3 class="feature-title">Visitas Virtuales Inmersivas</h3>
                        <p class="feature-description">Explora propiedades desde la comodidad de tu hogar con nuestra tecnología VR de última generación, que te permite recorrer cada espacio como si estuvieras allí.</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-card text-center">
                        <i class="fas fa-vr-cardboard feature-icon"></i>
                        <h3 class="feature-title">Lentes VR para Agencias</h3>
                        <p class="feature-description">Ofrecemos a las agencias inmobiliarias nuestros lentes VR personalizados para que puedan mostrar propiedades de manera innovadora y cautivadora.</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-card text-center">
                        <i class="fas fa-chart-line feature-icon"></i>
                        <h3 class="feature-title">Soluciones Comerciales</h3>
                        <p class="feature-description">Paquetes completos para desarrolladores y empresas inmobiliarias que buscan incorporar la realidad virtual en su estrategia comercial.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección VR -->
    <section id="vr" class="vr-showcase">
        <div class="container">
            <div class="vr-text" data-aos="fade-right">
                "La realidad virtual está transformando la forma en que compramos y vendemos propiedades. Con XcoderVR, el futuro de los bienes raíces es ahora."
            </div>
            <i class="fas fa-vr-cardboard vr-headset"></i>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="footer-logo">
                        <i class="fas fa-vr-cardboard me-2"></i>XcodersVR
                    </div>
                    <p>Revolucionando el sector inmobiliario con tecnología de realidad virtual de última generación.</p>
                    <div class="social-icons">
                    </div>
                    </div>
                <div class="col-lg-3 col-md-4 mb-4">
                    <h5>Contacto</h5>
                    <div class="footer-links">
                        <a href="#"><i class="fas fa-map-marker-alt me-2"></i>5 Mayo #227</a>
                        <a href="#"><i class="fas fa-phone me-2"></i> 477 786 7679</a>
                        <a href="#"><i class="fas fa-envelope me-2"></i>xcodersvr@gmail.com</a>
                    </div>
                </div>
            </div>
            <div class="copyright">
                &copy; <?php echo date('Y'); ?> XcodersVR. Todos los derechos reservados.
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script> 
    <script src="js/script.js"></script>
</body>
</html>