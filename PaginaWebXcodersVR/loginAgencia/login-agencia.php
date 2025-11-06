<?php
require_once 'config.php';
redirectIfAgenciaLoggedIn();

$error = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = sanitizeInput($_POST['email']);
    $password = sanitizeInput($_POST['password']);
    
    $stmt = $pdo->prepare('SELECT * FROM agencias WHERE email = ?');
    $stmt->execute([$email]);
    $agencia = $stmt->fetch();
    
    if ($agencia && verifyPassword($password, $agencia->password)) {
        if ($agencia->is_active) {
            $_SESSION['agencia_id'] = $agencia->id;
            $_SESSION['agencia_email'] = $agencia->email;
            $_SESSION['agencia_name'] = $agencia->nombre_completo;
            $_SESSION['agencia_nombre'] = $agencia->nombre_agencia;
            
                header('Location: ../terminosAgencias/terms.php'); }
            exit();
        } else {
            $error = 'Tu cuenta no está activa. Por favor, contacta al administrador.';
        }
    } else {
        $error = 'Email o contraseña incorrectos.';
    }
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión Agencia | <?= APP_NAME ?></title>
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
                <h2>Iniciar Sesión - Colaborador</h2>
                <p class="text-muted">Acceso para agencias colaboradoras</p>
            </div>
            
            <?php if ($error): ?>
                <div class="alert alert-danger animate__animated animate__shakeX"><?= $error ?></div>
            <?php endif; ?>
            
            <form action="login-agencia.php" method="POST" class="auth-form">
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
                </div>
                
                <div class="d-flex justify-content-between mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Recordar sesión</label>
                    </div>
                    <a href="forgot-password-agencia.php" class="text-decoration-none">¿Olvidaste tu contraseña?</a>
                </div>
                
                <button type="submit" class="btn btn-primary w-100 mb-3">Iniciar Sesión</button>
                
                <div class="text-center mt-3">
                    <p>¿No tienes una cuenta? <a href="register-agencia.php" class="text-decoration-none">Regístrate aquí</a></p>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/auth.js"></script>
</body>
</html>