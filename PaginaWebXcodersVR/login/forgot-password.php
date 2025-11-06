<?php
require_once 'config.php';
redirectIfLoggedIn();

$error = '';
$success = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = sanitizeInput($_POST['email']);
    
    if (empty($email)) {
        $error = 'Por favor, ingresa tu correo electrónico.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Por favor, ingresa un correo electrónico válido.';
    } else {
        $stmt = $pdo->prepare('SELECT id, full_name FROM users WHERE email = ?');
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        
        if ($user) {
            $reset_token = generateToken();
            $expires_at = date('Y-m-d H:i:s', strtotime('+1 hour'));
            
            $stmt = $pdo->prepare('UPDATE users SET reset_token = ?, reset_expires = ? WHERE id = ?');
            if ($stmt->execute([$reset_token, $expires_at, $user->id])) {
                $reset_link = APP_URL . "/reset-password.php?token=$reset_token";
                $subject = "Restablecer tu contraseña en " . APP_NAME;
                $body = "Hola {$user->full_name},<br><br>";
                $body .= "Hemos recibido una solicitud para restablecer tu contraseña.<br>";
                $body .= "Por favor, haz clic en el siguiente enlace para continuar:<br>";
                $body .= "<a href='$reset_link'>$reset_link</a><br><br>";
                $body .= "Este enlace expirará en 1 hora.<br>";
                $body .= "Si no solicitaste este cambio, por favor ignora este mensaje.<br><br>";
                $body .= "Gracias,<br>El equipo de " . APP_NAME;
                
                if (sendEmail($email, $subject, $body)) {
                    $success = 'Hemos enviado un enlace para restablecer tu contraseña a tu correo electrónico.';
                    $email = '';
                } else {
                    $error = 'Error al enviar el correo de recuperación. Por favor, intenta nuevamente.';
                }
            } else {
                $error = 'Error al procesar tu solicitud. Por favor, intenta nuevamente.';
            }
        } else {
            $error = 'No encontramos una cuenta asociada a este correo electrónico.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña | <?= APP_NAME ?></title>
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
                <h2>Recuperar Contraseña</h2>
                <p>Ingresa tu correo electrónico para recibir instrucciones</p>
            </div>
            
            <?php if ($error): ?>
                <div class="alert alert-danger animate__animated animate__shakeX"><?= $error ?></div>
            <?php endif; ?>
            
            <?php if ($success): ?>
                <div class="alert alert-success animate__animated animate__fadeIn"><?= $success ?></div>
            <?php endif; ?>
            
            <form action="forgot-password.php" method="POST" class="auth-form">
                <div class="form-group">
                    <label for="email">Correo Electrónico</label>
                    <div class="input-group">
                        <span class="input-group-icon"><i class="fas fa-envelope"></i></span>
                        <input type="email" id="email" name="email" value="<?= htmlspecialchars($email) ?>" required>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary btn-block">Enviar Instrucciones</button>
                
                <div class="auth-footer">
                    <p>¿Recordaste tu contraseña? <a href="login.php" class="auth-link">Inicia sesión aquí</a></p>
                </div>
            </form>
        </div>
    </div>

    <script src="assets/js/auth.js"></script>
</body>
</html>