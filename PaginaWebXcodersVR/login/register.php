<?php
require_once 'config.php';
redirectIfLoggedIn();

$error = '';
$success = '';
$full_name = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = sanitizeInput($_POST['full_name']);
    $email = sanitizeInput($_POST['email']);
    $password = sanitizeInput($_POST['password']);
    $confirm_password = sanitizeInput($_POST['confirm_password']);
    
    // Validaciones
    if (empty($full_name) || empty($email) || empty($password) || empty($confirm_password)) {
        $error = 'Todos los campos son obligatorios.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Por favor, ingresa un correo electrónico válido.';
    } elseif ($password !== $confirm_password) {
        $error = 'Las contraseñas no coinciden.';
    } elseif (strlen($password) < 8) {
        $error = 'La contraseña debe tener al menos 8 caracteres.';
    } else {
        // Verificar si el email ya existe
        $stmt = $pdo->prepare('SELECT id FROM users WHERE email = ?');
        $stmt->execute([$email]);
        
        if ($stmt->rowCount() > 0) {
            $error = 'Este correo electrónico ya está registrado.';
        } else {
            // Crear usuario
            $hashed_password = hashPassword($password);
            $activation_token = generateToken();
            
            $stmt = $pdo->prepare('INSERT INTO users (full_name, email, password, activation_token, created_at) 
                                  VALUES (?, ?, ?, ?, NOW())');
            if ($stmt->execute([$full_name, $email, $hashed_password, $activation_token])) {
                // Enviar email de activación
                $activation_link = APP_URL . "/activate.php?token=$activation_token";
                $subject = "Activa tu cuenta en " . APP_NAME;
                $body = "Hola $full_name,<br><br>";
                $body .= "Por favor, haz clic en el siguiente enlace para activar tu cuenta:<br>";
                $body .= "<a href='$activation_link'>$activation_link</a><br><br>";
                $body .= "Gracias,<br>El equipo de " . APP_NAME;
                
                if (sendEmail($email, $subject, $body)) {
                    $success = '¡Registro exitoso! Por favor, revisa tu correo para activar tu cuenta.';
                    $full_name = '';
                    $email = '';
                } else {
                    $error = 'Error al enviar el correo de activación. Por favor, contacta al administrador.';
                }
            } else {
                $error = 'Error al registrar el usuario. Por favor, intenta nuevamente.';
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
    <title>Registro | <?= APP_NAME ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" href="img/ICONO 1.png" type="image/x-icon">
</head>
<body>
    <div class="auth-container animate__animated animate__fadeIn">
        <div class="auth-card">
            <div class="auth-header">
                <img src="<?= LOGO_URL ?>" alt="<?= APP_NAME ?>" class="auth-logo">
                <h2>Crear Cuenta</h2>
                <p>Completa el formulario para registrarte</p>
            </div>
            
            <?php if ($error): ?>
                <div class="alert alert-danger animate__animated animate__shakeX"><?= $error ?></div>
            <?php endif; ?>
            
            <?php if ($success): ?>
                <div class="alert alert-success animate__animated animate__fadeIn"><?= $success ?></div>
            <?php endif; ?>
            
            <form action="register.php" method="POST" class="auth-form">
                <div class="form-group">
                    <label for="full_name">Nombre Completo</label>
                    <div class="input-group">
                        <span class="input-group-icon"><i class="fas fa-user"></i></span>
                        <input type="text" id="full_name" name="full_name" value="<?= htmlspecialchars($full_name) ?>" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="email">Correo Electrónico</label>
                    <div class="input-group">
                        <span class="input-group-icon"><i class="fas fa-envelope"></i></span>
                        <input type="email" id="email" name="email" value="<?= htmlspecialchars($email) ?>" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="password">Contraseña</label>
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
                    <label for="confirm_password">Confirmar Contraseña</label>
                    <div class="input-group">
                        <span class="input-group-icon"><i class="fas fa-lock"></i></span>
                        <input type="password" id="confirm_password" name="confirm_password" required>
                        <button type="button" class="toggle-password" aria-label="Mostrar contraseña">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary btn-block">Registrarse</button>
                
                <div class="auth-footer">
                    <p>¿Ya tienes una cuenta? <a href="login.php" class="auth-link">Inicia sesión aquí</a></p>
                </div>
            </form>
        </div>
    </div>

    <script src="assets/js/auth.js"></script>
</body>
</html>