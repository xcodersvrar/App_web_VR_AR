<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto - XcodersVR</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="icon" href="img/ICONO 1.png" type="image/png">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="../inicio/inicio.php">
                <i class="fas fa-vr-cardboard logo-icon"></i>
                XcodersVR
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php"><i class="fas fa-home me-1"></i> Inicio</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="contact-header">
        <div class="container">
            <img src="img/logo1_sinfondo.png" alt="XcodersVR Logo" class="company-logo">
            <h1>Contáctanos</h1>
            <p>Somos XcodersVR, tu empresa inmobiliaria de bienes raíces que revoluciona la búsqueda de propiedades con tecnología de realidad virtual. Estamos aquí para ayudarte con cualquier consulta sobre propiedades, agendar tours virtuales o brindar soporte técnico.</p>
        </div>
    </section>

    <section class="contact-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-6 mb-4 mb-md-0">
                    <div class="contact-card">
                        <div class="contact-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <h3>Nuestra Ubicación</h3>
                        <p>Visítanos en nuestra oficina principal en Leòn Guanajuato.</p>
                        <div class="map-container mt-4">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3733.2435422787834!2d-101.69176162590216!3d20.659972392769493!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x842bbe0c1284d72d%3A0xc6e4b85d341b2c45!2sReal%20Estate%20Leon!5e0!3m2!1sen!2smx!4v1719543639145!5m2!1sen!2smx" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="contact-card">
                        <div class="contact-icon">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <h3>Información de Contacto</h3>
                        <p><strong>Teléfono:</strong> +52 477 786 7679</p>
                        <p><strong>Horario:</strong> Lunes a Viernes: 9:00 AM - 7:00 PM<br>Sábados: 10:00 AM - 3:00 PM<br>Domingos: Cerrado</p>
                        <p><strong>Email:</strong> info@xcodersvr.com</p>
                        
                        <div class="manager-card mt-4">
                            <img src="img/yo.jpg" alt="Gerente" class="manager-photo">
                            <h4>Emiliano Rodrìguez Medina</h4>
                            <p>Gerente de Operaciones VR</p>
                            <p>Listo para guiarte en tu próxima experiencia inmobiliaria virtual.</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="contact-form">
                        <h2 class="text-center mb-4">Envíanos un Mensaje</h2>
                        <p class="text-center mb-4">Completa el siguiente formulario y nuestro equipo de XcodersVR se pondrá en contacto contigo a la brevedad.</p>
                        
                        <form id="contactForm">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="nombre" placeholder="Nombre completo" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="email" class="form-control" id="email" placeholder="Correo electrónico" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <input type="tel" class="form-control" id="telefono" placeholder="Teléfono (opcional)">
                            </div>
                            
                            <div class="form-group">
                                <textarea class="form-control" id="mensaje" rows="5" placeholder="Describe tu consulta o problema..." required></textarea>
                            </div>
                            
                            <div class="form-group form-check mb-4">
                                <input type="checkbox" class="form-check-input" id="newsletter">
                                <label class="form-check-label" for="newsletter">Deseo recibir actualizaciones sobre nuevas propiedades y tours VR</label>
                            </div>
                            
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary me-2">Enviar Mensaje</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <img src="img/logo1_sinfondo.png" alt="XcodersVR Logo" class="footer-logo">
                    <p>Revolucionando la búsqueda de bienes raíces con experiencias inmersivas de realidad virtual.</p>
                    <div class="social-icons mt-3">
                    </div>
                </div>

                <div class="col-md-4 col-lg-4">
                    <div class="footer-links">
                        <h5>Contacto</h5>
                        <ul class="contact-info">
                            <li><i class="fas fa-map-marker-alt me-2"></i>Call 5 de Mayo col.Centro : León, Guanajuato</li>
                            <li><i class="fas fa-phone-alt me-2"></i> +52 477 786 7679</li>
                            <li><i class="fas fa-envelope me-2"></i> xcodersvr@gmail.com</li>
                            <li><i class="fas fa-clock me-2"></i> Lunes-Viernes: 9AM - 8PM, Sábado: 9AM - 6PM</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="copyright text-center">
                        <p class="mb-0">&copy; 2025 XcodersVR. Todos los derechos reservados.</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>