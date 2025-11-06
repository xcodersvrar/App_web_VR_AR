<?php
require_once 'config.php';

$token = isset($_GET['token']) ? sanitizeInput($_GET['token']) : '';

if (empty($token)) {
    header('Location: register.php');
    exit();
}

$stmt = $pdo->prepare('SELECT id, email, full_name FROM users WHERE activation_token = ? AND is_active = 0');
$stmt->execute([$token]);
$user = $stmt->fetch();

if ($user) {
    $stmt = $pdo->prepare('UPDATE users SET is_active = 1, activation_token = NULL WHERE id = ?');
    if ($stmt->execute([$user->id])) {
        // Enviar email de bienvenida
        $subject = "¡Bienvenido a " . APP_NAME . "!";
        $body = "Hola {$user->full_name},<br><br>";
        $body .= "Tu cuenta ha sido activada exitosamente.<br>";
        $body .= "Ahora puedes iniciar sesión y comenzar a usar nuestros servicios.<br><br>";
        $body .= "Gracias,<br>El equipo de " . APP_NAME;
        
        sendEmail($user->email, $subject, $body);
        
        $success = '¡Tu cuenta ha sido activada exitosamente! Ahora puedes iniciar sesión.';
    } else {
        $error = 'Error al activar tu cuenta. Por favor, contacta al administrador.';
    }
} else {
    $error = 'El enlace de activación es inválido o ya ha sido utilizado.';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activación de Cuenta | <?= APP_NAME ?></title>
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
                <h2>Activación de Cuenta</h2>
            </div>
            
            <?php if (isset($error)): ?>
                <div class="alert alert-danger animate__animated animate__shakeX"><?= $error ?></div>
                <div class="auth-footer">
                    <a href="register.php" class="btn btn-primary btn-block">Registrarse</a>
                </div>
            <?php elseif (isset($success)): ?>
                <div class="alert alert-success animate__animated animate__fadeIn"><?= $success ?></div>
                <div class="auth-footer">
                    <a href="login.php" class="btn btn-primary btn-block">Iniciar Sesión</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>