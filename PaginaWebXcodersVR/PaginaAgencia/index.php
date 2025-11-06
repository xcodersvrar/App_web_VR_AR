




<?php
// Configuración básica
$company_name = "XcoderVR";
$company_email = "rodriguezmedinaemiliano982@gmail.com"; // Cambiar por el correo real
$upload_dir = "assets/uploads/";
?>

<?php
session_start(); // ¡IMPORTANTE! Solo una vez y como primera línea

// Verificar si el usuario está logueado (esta parte ya la tienes)
if (!isset($_SESSION['user_id'])) {
    header('Location: ../loginAgencia/login-agencia.php');
    exit();
}

// Obtener datos del usuario de la sesión
$user_name = $_SESSION['user_name'] ?? 'Agente';
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
    <title><?php echo $company_name; ?> - Portal Inmobiliario VR</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" href="img/ICONO 1.png" type="image/x-icon">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-success fixed-top shadow-sm animate__animated animate__fadeInDown">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="img/logo1_sinfondo.png" alt="<?php echo $company_name; ?>" height="60" class="me-2">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#services">Servicios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#how-it-works">Cómo Funciona</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#submit-property">Subir Propiedad</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contacto/contacto.php">Contacto</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero-section py-5 mt-5">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0 animate__animated animate__fadeInLeft">
                    <h1 class="display-4 fw-bold mb-4">Revoluciona el mercado inmobiliario con Realidad Virtual</h1>
                    <p class="lead mb-4">Visualiza propiedades como nunca antes con nuestra tecnología VR avanzada. Ofrece a tus clientes una experiencia inmersiva única.</p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="#services" class="btn btn-outline-light btn-lg rounded-pill px-4 py-2">Nuestros Servicios</a>
                    </div>
                </div>
                <div class="col-lg-6 animate__animated animate__fadeInRight">
                    <div class="position-relative">
                        <img src="assets/img/vr1.jpeg" alt="VR Headset" class="img-fluid rounded-4 shadow">
                        <div class="position-absolute top-0 start-0 w-100 h-100 bg-success bg-opacity-10 rounded-4"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-5 bg-light">
        <div class="container py-5">
            <div class="text-center mb-5 animate__animated animate__fadeInUp">
                <h2 class="display-5 fw-bold text-success mb-3">Nuestros Servicios</h2>
                <p class="lead">Transformamos la forma en que se presentan las propiedades</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4 animate__animated animate__fadeInUp" data-wow-delay="0.1s">
                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                        <div class="card-body p-4 text-center">
                            <div class="icon-box bg-success bg-opacity-10 text-success rounded-circle mx-auto mb-4">
                                <i class="fas fa-vr-cardboard fa-2x"></i>
                            </div>
                            <h4 class="fw-bold mb-3">Tours VR Inmersivos</h4>
                            <p class="text-muted">Creamos experiencias de realidad virtual completas para que los clientes exploren propiedades desde cualquier lugar.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 animate__animated animate__fadeInUp" data-wow-delay="0.2s">
                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                        <div class="card-body p-4 text-center">
                            <div class="icon-box bg-success bg-opacity-10 text-success rounded-circle mx-auto mb-4">
                                <i class="fas fa-cube fa-2x"></i>
                            </div>
                            <h4 class="fw-bold mb-3">Modelado 3D</h4>
                            <p class="text-muted">Convertimos tus propiedades en modelos 3D detallados para visualización en múltiples plataformas.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 animate__animated animate__fadeInUp" data-wow-delay="0.3s">
                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                        <div class="card-body p-4 text-center">
                            <div class="icon-box bg-success bg-opacity-10 text-success rounded-circle mx-auto mb-4">
                                <i class="fas fa-portrait fa-2x"></i>
                            </div>
                            <h4 class="fw-bold mb-3">Portales Personalizados</h4>
                            <p class="text-muted">Desarrollamos portales web exclusivos para mostrar tus propiedades con tecnología VR integrada.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section id="how-it-works" class="py-5">
        <div class="container py-5">
            <div class="text-center mb-5 animate__animated animate__fadeInUp">
                <h2 class="display-5 fw-bold text-success mb-3">Cómo Funciona</h2>
                <p class="lead">Proceso simple para llevar tus propiedades al mundo VR</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-6 animate__animated animate__fadeInLeft">
                    <div class="step-card p-4 p-lg-5 rounded-4 bg-success text-white shadow">
                        <div class="step-number">1</div>
                        <h3 class="fw-bold mb-3">Sube tus archivos</h3>
                        <p>Proporciona imágenes, planos o videos de la propiedad a través de nuestro portal seguro.</p>
                    </div>
                </div>
                <div class="col-lg-6 animate__animated animate__fadeInRight">
                    <div class="step-card p-4 p-lg-5 rounded-4 bg-success text-white shadow">
                        <div class="step-number">2</div>
                        <h3 class="fw-bold mb-3">Procesamos la información</h3>
                        <p>Nuestro equipo convierte los materiales en experiencias VR y modelos 3D de alta calidad.</p>
                    </div>
                </div>
                <div class="col-lg-6 animate__animated animate__fadeInLeft">
                    <div class="step-card p-4 p-lg-5 rounded-4 bg-success text-white shadow">
                        <div class="step-number">3</div>
                        <h3 class="fw-bold mb-3">Revisión y ajustes</h3>
                        <p>Te enviamos una versión preliminar para revisión y realizamos los ajustes necesarios.</p>
                    </div>
                </div>
                <div class="col-lg-6 animate__animated animate__fadeInRight">
                    <div class="step-card p-4 p-lg-5 rounded-4 bg-success text-white shadow">
                        <div class="step-number">4</div>
                        <h3 class="fw-bold mb-3">Entrega final</h3>
                        <p>Recibes los archivos finales y enlaces para compartir con tus clientes.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Submit Property Section -->
    <section id="submit-property" class="py-5 bg-light">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-8 animate__animated animate__fadeInUp">
                    <div class="card border-0 shadow rounded-4 overflow-hidden">
                        <div class="card-header bg-success text-white py-4">
                            <h2 class="fw-bold text-center mb-0">Subir Propiedad para VR</h2>
                        </div>
                        <div class="card-body p-4 p-lg-5">
                            <form id="propertyForm" action="process_submission.php" method="POST" enctype="multipart/form-data">
                                <div class="mb-4">
                                    <h4 class="fw-bold text-success mb-3">Información de la Agencia</h4>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="agencyName" class="form-label">Nombre de la Agencia</label>
                                            <input type="text" class="form-control" id="agencyName" name="agencyName" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="contactPerson" class="form-label">Persona de Contacto</label>
                                            <input type="text" class="form-control" id="contactPerson" name="contactPerson" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="email" class="form-label">Correo Electrónico</label>
                                            <input type="email" class="form-control" id="email" name="email" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="phone" class="form-label">Teléfono</label>
                                            <input type="tel" class="form-control" id="phone" name="phone" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h4 class="fw-bold text-success mb-3">Información de la Propiedad</h4>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="propertyType" class="form-label">Tipo de Propiedad</label>
                                            <select class="form-select" id="propertyType" name="propertyType" required>
                                                <option value="" selected disabled>Seleccionar...</option>
                                                <option value="casa">Casa</option>
                                                <option value="departamento">Departamento</option>
                                                <option value="terreno">Terreno</option>
                                                <option value="local">Local Comercial</option>
                                                <option value="oficina">Oficina</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="propertyAddress" class="form-label">Dirección</label>
                                            <input type="text" class="form-control" id="propertyAddress" name="propertyAddress" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="propertySize" class="form-label">Tamaño (m²)</label>
                                            <input type="number" class="form-control" id="propertySize" name="propertySize" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="bedrooms" class="form-label">Habitaciones</label>
                                            <input type="number" class="form-control" id="bedrooms" name="bedrooms">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="bathrooms" class="form-label">Baños</label>
                                            <input type="number" class="form-control" id="bathrooms" name="bathrooms">
                                        </div>
                                        <div class="col-12">
                                            <label for="propertyDescription" class="form-label">Descripción de la Propiedad</label>
                                            <textarea class="form-control" id="propertyDescription" name="propertyDescription" rows="3" required></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h4 class="fw-bold text-success mb-3">Archivos Multimedia</h4>
                                    <div class="alert alert-info">
                                        <i class="fas fa-info-circle me-2"></i> Sube imágenes, planos en PDF o videos de la propiedad. Las imágenes deben ser de alta calidad.
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="propertyImages" class="form-label">Imágenes de la Propiedad (JPEG, PNG)</label>
                                        <input type="file" class="form-control" id="propertyImages" name="propertyImages[]" multiple accept="image/jpeg, image/png" required>
                                        <div class="form-text">Puedes seleccionar múltiples imágenes (máx. 10MB cada una)</div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="propertyPDF" class="form-label">Documento PDF con Información (Opcional)</label>
                                        <input type="file" class="form-control" id="propertyPDF" name="propertyPDF" accept="application/pdf">
                                        <div class="form-text">Puedes subir un PDF con planos, especificaciones o información adicional (máx. 20MB)</div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="propertyVideo" class="form-label">Video de la Propiedad (Opcional)</label>
                                        <input type="file" class="form-control" id="propertyVideo" name="propertyVideo" accept="video/mp4, video/quicktime">
                                        <div class="form-text">Formatos aceptados: MP4, MOV (máx. 50MB)</div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="zoneVideo" class="form-label">Video de la Zona (Opcional)</label>
                                        <input type="file" class="form-control" id="zoneVideo" name="zoneVideo" accept="video/mp4, video/quicktime">
                                        <div class="form-text">Muestra el vecindario y alrededores de la propiedad (máx. 50MB)</div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h4 class="fw-bold text-success mb-3">Preferencias de Modelado 3D</h4>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="vrLevel" class="form-label">Nivel de Detalle VR</label>
                                            <select class="form-select" id="vrLevel" name="vrLevel" required>
                                                <option value="basic">Básico (solo recorrido)</option>
                                                <option value="standard" selected>Estándar (muebles básicos)</option>
                                                <option value="premium">Premium (decoración completa)</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="deliveryDate" class="form-label">Fecha Requerida de Entrega</label>
                                            <input type="date" class="form-control" id="deliveryDate" name="deliveryDate" required min="<?php echo date('Y-m-d', strtotime('+3 days')); ?>">
                                        </div>
                                        <div class="col-12">
                                            <label for="specialInstructions" class="form-label">Instrucciones Especiales</label>
                                            <textarea class="form-control" id="specialInstructions" name="specialInstructions" rows="2"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-check mb-4">
                                    <input class="form-check-input" type="checkbox" id="termsAgreement" name="termsAgreement" required>
                                    <label class="form-check-label" for="termsAgreement">Acepto los <a href="#" data-bs-toggle="modal" data-bs-target="#termsModal">términos y condiciones</a> del servicio</label>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success btn-lg px-5 py-3 fw-bold rounded-pill">
                                        <i class="fas fa-paper-plane me-2"></i> Enviar Propiedad
                                    </button>
                                </div>
                                <div class="modal fade" id="pdfModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title fw-bold">Confirmación de Envío</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center p-5">
                <div class="icon-box bg-success bg-opacity-10 text-success rounded-circle mx-auto mb-4">
                    <i class="fas fa-file-pdf fa-3x"></i>
                </div>
                <h4 class="fw-bold mb-3">¡Formato Generado!</h4>
                <p class="mb-4">Por favor, envía este documento PDF al correo de la empresa: <strong><?php echo $company_email; ?></strong></p>
                <p class="mb-4">El PDF se ha descargado automáticamente a tu dispositivo.</p>
                <div class="d-flex justify-content-center gap-3">
                    <button type="button" class="btn btn-outline-success rounded-pill px-4" data-bs-dismiss="modal">Cerrar</button>
                    <a href="mailto:<?php echo $company_email; ?>?subject=Formato de Propiedad" class="btn btn-success rounded-pill px-4">
                        <i class="fas fa-envelope me-2"></i> Enviar por Correo
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Footer -->
      <footer class="text-center py-4 mt-5 animate__animated animate__fadeInUp">
        <div class="container">
            <p class="mb-0">&copy; <span id="current-year"></span> XcodersVR. Todos los derechos reservados.</p>
        </div>
    </footer>

    <!-- Terms Modal -->
    <div class="modal fade" id="termsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title fw-bold">Términos y Condiciones</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6 class="fw-bold">1. Aceptación de los Términos</h6>
                    <p class="small text-muted mb-3">Al utilizar nuestros servicios, usted acepta cumplir con estos términos y condiciones. Si no está de acuerdo con alguno de estos términos, no utilice nuestros servicios.</p>
                    
                    <h6 class="fw-bold">2. Propiedad Intelectual</h6>
                    <p class="small text-muted mb-3">Todo el contenido proporcionado por XcoderVR, incluyendo modelos 3D, software y documentación, está protegido por derechos de autor y otras leyes de propiedad intelectual.</p>
                    
                    <h6 class="fw-bold">3. Uso de los Servicios</h6>
                    <p class="small text-muted mb-3">Usted acepta utilizar nuestros servicios solo para fines legales y de acuerdo con estos términos. No puede utilizar nuestros servicios para ningún propósito ilegal o no autorizado.</p>
                    
                    <h6 class="fw-bold">4. Contenido del Usuario</h6>
                    <p class="small text-muted mb-3">Usted es responsable de todo el contenido que envíe a través de nuestros servicios, incluyendo su exactitud y legalidad. Al enviar contenido, nos otorga una licencia mundial para usar dicho contenido para proporcionar nuestros servicios.</p>
                    
                    <h6 class="fw-bold">5. Limitación de Responsabilidad</h6>
                    <p class="small text-muted mb-3">XcoderVR no será responsable por ningún daño indirecto, incidental, especial o consecuente que resulte del uso o la incapacidad de usar nuestros servicios.</p>
                    
                    <h6 class="fw-bold">6. Modificaciones</h6>
                    <p class="small text-muted">Nos reservamos el derecho de modificar estos términos en cualquier momento. Las modificaciones entrarán en vigor inmediatamente después de su publicación en nuestro sitio web.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success rounded-pill px-4" data-bs-dismiss="modal">Entendido</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center p-5">
                    <div class="icon-box bg-success bg-opacity-10 text-success rounded-circle mx-auto mb-4">
                        <i class="fas fa-check fa-3x"></i>
                    </div>
                    <h4 class="fw-bold mb-3">¡Envío Exitoso!</h4>
                    <p class="mb-4">Hemos recibido la información de tu propiedad. Nuestro equipo se pondrá en contacto contigo en un plazo de 24 horas.</p>
                    <button type="button" class="btn btn-success rounded-pill px-4" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Back to Top Button -->
    <a href="#" class="btn btn-success btn-lg rounded-circle shadow back-to-top" id="backToTop">
        <i class="fas fa-arrow-up"></i>
    </a>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- WOW.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    <!-- Custom JS -->
    <script src="assets/js/main.js"></script>
</body>
</html>