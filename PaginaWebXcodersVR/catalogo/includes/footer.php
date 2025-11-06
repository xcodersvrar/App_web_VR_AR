        </main>
        
        <!-- Footer -->
        <footer class="bg-success text-white py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 mb-4 mb-md-0">
                    <i class="fas fa-vr-cardboard logo-icon"></i>
                    <span class="logo-text">XCODERSVR</span>
                        <p>Revolucionando la forma en que experimentas y compras propiedades con tecnología de realidad virtual.</p>
                        <div class="social-icons">
                        </div>
                    </div>
                    <div class="col-md-4 mb-4 mb-md-0">
                        <h5 class="mb-3">Enlaces Rápidos</h5>
                        <ul class="list-unstyled">
                             <li class="mb-2"><a href="../../../PaginaWebXcodersVR/inicio/inicio.php" class="text-white">Inicio</a></li>
                            <li class="mb-2"><a href="../../../PaginaWebXcodersVR/personal/personal.php" class="text-white">Personal XcodersVR</a></li>
                            <li><a href="../../../PaginaWebXcodersVR/contacto/contacto.php" class="text-white">Contacto</a></li>
                        </ul>
                    </div>
                </div>
                <hr class="my-4 bg-light">
                <div class="text-center">
                    <p class="mb-0">&copy; <?php echo date('Y'); ?> XcodersVR. Todos los derechos reservados.</p>
                </div>
            </div>
        </footer>
        
        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        
        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        
        <!-- JS Personalizado -->
        <script src="assets/js/main.js"></script>
        
        <!-- Scripts específicos de página -->
        <?php if (isset($customScript)): ?>
            <script src="assets/js/<?php echo $customScript; ?>"></script>
        <?php endif; ?>
    </body>
</html>