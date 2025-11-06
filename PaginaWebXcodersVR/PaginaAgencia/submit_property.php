<?php
// Configuración básica
$company_name = "XcoderVR";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Propiedad Enviada - <?php echo $company_name; ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-success fixed-top shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="index.php">
                <img src="assets/images/logo.png" alt="<?php echo $company_name; ?>" height="40" class="me-2">
                <span class="fw-bold"><?php echo $company_name; ?></span>
            </a>
        </div>
    </nav>

    <!-- Success Section -->
    <section class="success-section py-5 mt-5">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <?php if (isset($_GET["success"]) && $_GET["success"] == "true"): ?>
                        <div class="icon-box bg-success bg-opacity-10 text-success rounded-circle mx-auto mb-4">
                            <i class="fas fa-check fa-3x"></i>
                        </div>
                        <h1 class="display-5 fw-bold mb-4">¡Propiedad Enviada con Éxito!</h1>
                        <p class="lead mb-4">Hemos recibido la información de tu propiedad. Nuestro equipo revisará los detalles y se pondrá en contacto contigo en un plazo de 24 horas para confirmar los siguientes pasos.</p>
                        <div class="d-flex flex-wrap justify-content-center gap-3">
                            <a href="index.php" class="btn btn-success btn-lg rounded-pill px-4 py-2 fw-bold">
                                <i class="fas fa-home me-2"></i> Volver al Inicio
                            </a>
                            <a href="#submit-property" class="btn btn-outline-success btn-lg rounded-pill px-4 py-2">
                                <i class="fas fa-plus me-2"></i> Subir Otra Propiedad
                            </a>
                        </div>
                    <?php else: ?>
                        <div class="icon-box bg-danger bg-opacity-10 text-danger rounded-circle mx-auto mb-4">
                            <i class="fas fa-exclamation-triangle fa-3x"></i>
                        </div>
                        <h1 class="display-5 fw-bold mb-4">Acceso No Autorizado</h1>
                        <p class="lead mb-4">Parece que has intentado acceder a esta página directamente. Por favor, utiliza el formulario para enviar una propiedad.</p>
                        <a href="index.php#submit-property" class="btn btn-success btn-lg rounded-pill px-4 py-2 fw-bold">
                            <i class="fas fa-paper-plane me-2"></i> Ir al Formulario
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    <p class="small mb-0">© <?php echo date('Y'); ?> <?php echo $company_name; ?>. Todos los derechos reservados.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="small mb-0">
                        <a href="#" class="text-white text-decoration-none me-3">Términos de Servicio</a>
                        <a href="#" class="text-white text-decoration-none">Política de Privacidad</a>
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>