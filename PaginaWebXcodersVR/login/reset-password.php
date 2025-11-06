<?php
require_once 'config.php';
redirectIfLoggedIn();

$error = '';
$success = '';
$token = isset($_GET['token']) ? sanitizeInput($_GET['token']) : '';

if (empty($token)) {
    header('Location: forgot-password.php');
    exit();
}

$stmt = $pdo->prepare('SELECT id, reset_expires FROM users WHERE reset_token = ?');
$stmt->execute([$token]);
$user = $stmt->fetch();

if (!$user || strtotime($user->reset_expires) < time()) {
    $error = 'El enlace de recuperación es inválido o ha expirado. Por favor, solicita uno nuevo.';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !$error) {
    $password = sanitizeInput($_POST['password']);
    $confirm_password = sanitizeInput($_POST['confirm_password']);
    
    if (empty($password) || empty($confirm_password)) {
        $error = 'Todos los campos son obligatorios.';
    } elseif ($password !== $confirm_password) {
        $error = 'Las contraseñas no coinciden.';
    } elseif (strlen($password) < 8) {
        $error = 'La contraseña debe tener al menos 8 caracteres.';
    } else {
        $hashed_password = hashPassword($password);
        
        $stmt = $pdo->prepare('UPDATE users SET password = ?, reset_token = NULL, reset_expires = NULL WHERE id = ?');
        if ($stmt->execute([$hashed_password, $user->id])) {
            // Obtener email del usuario para notificación
            $stmt = $pdo->prepare('SELECT email, full_name FROM users WHERE id = ?');
            $stmt->execute([$user->id]);
            $user_data = $stmt->fetch();
            
            // Enviar email de confirmación
            $subject = "Tu contraseña ha sido restablecida";
            $body = "Hola {$user_data->full_name},<br><br>";
            $body .= "Tu contraseña en " . APP_NAME . " ha sido restablecida exitosamente.<br>";
            $body .= "Si no realizaste este cambio, por favor contacta al administrador inmediatamente.<br><br>";
            $body .= "Gracias,<br>El equipo de " . APP_NAME;
            
            sendEmail($user_data->email, $subject, $body);
            
            $success = '¡Tu contraseña ha sido restablecida exitosamente! Ahora puedes iniciar sesión con tu nueva contraseña.';
        } else {
            $error = 'Error al restablecer la contraseña. Por favor, intenta nuevamente.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer Contraseña | <?= APP_NAME ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="auth-container animate__animated animate__fadeIn">
        <div class="auth-card">
            <div class="auth-header">
                <img src="<?= LOGO_URL ?>" alt="<?= APP_NAME ?>" class="auth-logo">
                <h2>Restablecer Contraseña</h2>
                <p>Crea una nueva contraseña para tu cuenta</p>
            </div>
            
            <?php if ($error): ?>
                <div class="alert alert-danger animate__animated animate__shakeX"><?= $error ?></div>
            <?php endif; ?>
            
            <?php if ($success): ?>
                <div class="alert alert-success animate__animated animate__fadeIn">
                    <?= $success ?>
                    <div class="mt-3">
                        <a href="login.php" class="btn btn-primary btn-block">Iniciar Sesión</a>
                    </div>
                </div>
            <?php else: ?>
                <form action="reset-password.php?token=<?= htmlspecialchars($token) ?>" method="POST" class="auth-form">
                    <div class="form-group">
                        <label for="password">Nueva Contraseña</label>
                        <div class="input-group">
                            <span class="input-group-icon"><i class="fas fa-lock"></i></span>
                            <input type="password" id="password" name="password" required>
                            <button type="button" class="toggle-password" aria-label="Mostrar contraseña">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <small class="form-text">Mínimo 8 caracteres</small>
                    </div>
                    
                    <div class="form-group">
                        <label for="confirm_password">Confirmar Nueva Contraseña</label>
                        <div class="input-group">
                            <span class="input-group-icon"><i class="fas fa-lock"></i></span>
                            <input type="password" id="confirm_password" name="confirm_password" required>
                            <button type="button" class="toggle-password" aria-label="Mostrar contraseña">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-block">Restablecer Contraseña</button>
                    
                    <div class="auth-footer">
                        <p>¿Recordaste tu contraseña? <a href="login.php" class="auth-link">Inicia sesión aquí</a></p>
                    </div>
                </form>
            <?php endif; ?>
        </div>
    </div>

    <script src="assets/js/auth.js"></script>
</body>
</html>