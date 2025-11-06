<?php
session_start(); // ¡IMPORTANTE! Solo una vez y como primera línea

// Verificar si el usuario está logueado (esta parte ya la tienes)
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login/login.php');
    exit();
}

// Obtener datos del usuario de la sesión
$user_name = $_SESSION['user_name'] ?? 'Usuario';
$user_email = $_SESSION['user_email'] ?? '';
$user_initials = getInitials($user_name);

// Función para obtener iniciales del nombre
function getInitials($name) {
    $initials = '';
    $words = explode(' ', $name);
    foreach ($words as $word) {
        $initials .= strtoupper(substr($word, 0, 1));
    }
    return substr($initials, 0, 2);
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XCODERSVR - Bienes Raíces con Tecnología VR</title>
<link rel="icon" href="img/ICONO 1.png" type="image/png">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap">
    <meta name="description" content="XCODERSVR revoluciona el mercado inmobili">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#home">
                <i class="fas fa-vr-cardboard logo-icon"></i>
                <span class="logo-text">XCODERSVR</span>
            </a>
             <div class="user-info ms-auto d-flex align-items-center">
                <div class="user-avatar me-2" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="avatar-initials"><?= $user_initials ?></div>
                </div>
                <div class="dropdown">
                    <button class="btn btn-link dropdown-toggle user-name" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <?= $user_name ?>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item text-danger" href="logout.php">
                                <i class="fas fa-sign-out-alt me-2"></i>Cerrar sesión
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <section class="hero-section" id="home">
        <div class="floating-elements">
            <div class="floating-element"></div>
            <div class="floating-element"></div>
            <div class="floating-element"></div>
            <div class="floating-element"></div>
        </div>
        
        <div class="container">
            <div class="hero-logo-container">
                <div class="hero-logo">
                    <i class="fas fa-vr-cardboard hero-logo-icon"></i>
                    <div class="hero-logo-text">XCODERSVR</div>
                    <div class="hero-logo-subtext">BIENES RAÍCES CON REALIDAD VIRTUAL</div>
                </div>
            </div>
            
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="hero-content text-center text-lg-start">
                        <h1 class="hero-title">Descubre tu hogar ideal con Realidad Virtual</h1>
                        <p class="hero-subtitle">XCODERSVR revoluciona el mercado inmobiliario con experiencias VR inmersivas que te permiten recorrer propiedades desde cualquier lugar.</p>
                    </div>
                </div>
                <div class="col-lg-6 mt-5 mt-lg-0">
                    <div class="hero-image-container">
                        <img src="https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="VR Experience" class="hero-image">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="features-section" id="services">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="section-title">Nuestros Servicios</h2>
                    <p class="section-subtitle">Transformamos la experiencia de compra de bienes raíces con tecnología innovadora</p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card text-center">
                        <div class="feature-icon-container">
                            <i class="fas fa-vr-cardboard feature-icon"></i>
                        </div>
                        <h3 class="feature-title">Tours VR Inmersivos</h3>
                        <p class="feature-text">Recorre propiedades desde la comodidad de tu hogar con experiencias de realidad virtual 360°.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card text-center">
                        <div class="feature-icon-container">
                            <i class="fas fa-home feature-icon"></i>
                        </div>
                        <h3 class="feature-title">Amplio Catálogo</h3>
                        <p class="feature-text">Propiedades exclusivas en playas, zonas privadas y residenciales de alto nivel.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card text-center">
                        <div class="feature-icon-container">
                            <i class="fas fa-edit feature-icon"></i>
                        </div>
                        <h3 class="feature-title">Personalización</h3>
                        <p class="feature-text">Diseña y visualiza tu futuro hogar con diferentes acabados y decoraciones en tiempo real.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card text-center">
                        <div class="feature-icon-container">
                            <i class="fas fa-chart-line feature-icon"></i>
                        </div>
                        <h3 class="feature-title">Asesoría de Inversión</h3>
                        <p class="feature-text">Expertos que te guiarán para tomar la mejor decisión en bienes raíces.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card text-center">
                        <div class="feature-icon-container">
                            <i class="fas fa-handshake feature-icon"></i>
                        </div>
                        <h3 class="feature-title">Proceso Transparente</h3>
                        <p class="feature-text">Desde la selección hasta el cierre, te acompañamos en cada paso.</p>
                    </div>
                </div>
        </div>
    </section>

    <section class="cta-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2>¿Listo para encontrar tu hogar ideal?</h2>
                    <p>Descubre cómo la tecnología VR puede transformar tu búsqueda inmobiliaria. Agenda una demostración gratuita con uno de nuestros especialistas.</p>
                    <a href="../../PaginaWebXcodersVR/catalogo/catalog.php" class="btn btn-primary-custom me-2 me-md-3 mb-3 mb-md-0">
                        <i class="fas fa-calendar-check"></i> Catalogo de Casas Disponibles
                    </a>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer" id="contact">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-4">
                    <div class="footer-logo">
                        <i class="fas fa-vr-cardboard footer-logo-icon"></i>
                        <div class="footer-logo-text">XCODERSVR</div>
                    </div>
                    <p class="footer-text">Líderes en soluciones inmobiliarias con tecnología VR. Transformamos la forma de comprar, vender y diseñar propiedades.</p>
                    <div class="social-icons">
                    </div>
                </div>
                <div class="col-lg-2">
                    <h3 class="footer-title">Enlaces Rápidos</h3>
                    <ul class="footer-links">
                        <li><a href="../../PaginaWebXcodersVR/contacto/contacto.php"><i class="fas fa-chevron-right"></i> Contacto</a></li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <h3 class="footer-title">Contacto</h3>
                    <ul class="footer-contact">
                        <li>
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Cal. 5 de Mayo #227 - Leon Gto</span>
                        </li>
                        <li>
                            <i class="fas fa-phone"></i>
                            <span>+52 477 786 7679</span>
                        </li>
                        <li>
                            <i class="fas fa-envelope"></i>
                            <span>xcodersvr@gmail.com</span>
                        </li>
                        <li>
                            <i class="fas fa-clock"></i>
                            <span>Lun-Sab: 9:00am - 8:00pm</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <p class="copyright">© 2025 XCODERSVR. Todos los derechos reservados.</p>
                </div>
            </div>
        </div>
    </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>
    <script src="../comentarios/js/script.js"></script> 
    <script>
        // Asegúrate de que loadTestimonials se llame después de que el DOM esté listo
        document.addEventListener('DOMContentLoaded', loadTestimonials);
    </script>
</body>
</html>