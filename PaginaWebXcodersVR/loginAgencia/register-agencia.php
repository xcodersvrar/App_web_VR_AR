<?php
require_once 'config.php';
redirectIfAgenciaLoggedIn();

$error = '';
$success = '';
$nombre_completo = '';
$nombre_agencia = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre_completo = sanitizeInput($_POST['nombre_completo']);
    $nombre_agencia = sanitizeInput($_POST['nombre_agencia']);
    $email = sanitizeInput($_POST['email']);
    $password = sanitizeInput($_POST['password']);
    $confirm_password = sanitizeInput($_POST['confirm_password']);
    
    // Validaciones
    if (empty($nombre_completo) || empty($nombre_agencia) || empty($email) || empty($password) || empty($confirm_password)) {
        $error = 'Todos los campos son obligatorios.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Por favor, ingresa un correo electrónico válido.';
    } elseif ($password !== $confirm_password) {
        $error = 'Las contraseñas no coinciden.';
    } elseif (strlen($password) < 8) {
        $error = 'La contraseña debe tener al menos 8 caracteres.';
    } else {
        // Verificar si el email ya existe
        $stmt = $pdo->prepare('SELECT id FROM agencias WHERE email = ?');
        $stmt->execute([$email]);
        
        if ($stmt->rowCount() > 0) {
            $error = 'Este correo electrónico ya está registrado.';
        } else {
            // Crear agencia
            $hashed_password = hashPassword($password);
            
            $stmt = $pdo->prepare('INSERT INTO agencias (nombre_completo, nombre_agencia, email, password) VALUES (?, ?, ?, ?)');
            if ($stmt->execute([$nombre_completo, $nombre_agencia, $email, $hashed_password])) {
                $success = '¡Registro exitoso! Ahora puedes iniciar sesión.';
                // Limpiar campos
                $nombre_completo = '';
                $nombre_agencia = '';
                $email = '';
            } else {
                $error = 'Error al registrar la agencia. Por favor, intenta nuevamente.';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Agencia | <?= APP_NAME ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="assets/css/auth.css">
    <link rel="icon" href="img/ICONO 1.png" type="image/x-icon">
</head>
<body>
    <div class="auth-container">
        <div class="auth-card animate__animated animate__fadeIn">
            <div class="auth-header text-center mb-4">
                <img src="<?= LOGO_URL ?>" alt="<?= APP_NAME ?>" class="auth-logo mb-3">
                <h2>Registro - Colaborador</h2>
                <p class="text-muted">Completa el formulario para registrarte</p>
            </div>
            
            <?php if ($error): ?>
                <div class="alert alert-danger animate__animated animate__shakeX"><?= $error ?></div>
            <?php endif; ?>
            
            <?php if ($success): ?>
                <div class="alert alert-success animate__animated animate__fadeIn"><?= $success ?></div>
            <?php endif; ?>
            
            <form action="register-agencia.php" method="POST" class="auth-form">
                <div class="mb-3">
                    <label for="nombre_completo" class="form-label">Nombre Completo</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input type="text" class="form-control" id="nombre_completo" name="nombre_completo" value="<?= htmlspecialchars($nombre_completo) ?>" required>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="nombre_agencia" class="form-label">Nombre de la Agencia</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-building"></i></span>
                        <input type="text" class="form-control" id="nombre_agencia" name="nombre_agencia" value="<?= htmlspecialchars($nombre_agencia) ?>" required>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($email) ?>" required>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" class="form-control" id="password" name="password" required>
                        <button type="button" class="btn btn-outline-secondary toggle-password">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <div class="form-text">Mínimo 8 caracteres</div>
                </div>
                
                <div class="mb-4">
                    <label for="confirm_password" class="form-label">Confirmar Contraseña</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                        <button type="button" class="btn btn-outline-secondary toggle-password">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary w-100 mb-3">Registrarse</button>
                
                <div class="text-center mt-3">
                    <p>¿Ya tienes una cuenta? <a href="login-agencia.php" class="text-decoration-none">Inicia sesión aquí</a></p>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/auth.js"></script>
</body>
</html>