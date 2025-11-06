<?php
require_once 'config.php';
redirectIfLoggedIn();

$error = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = sanitizeInput($_POST['email']);
    $password = sanitizeInput($_POST['password']);
    
    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    
    if ($user && verifyPassword($password, $user->password)) {
        if ($user->is_active) {
            $_SESSION['user_id'] = $user->id;
            $_SESSION['user_email'] = $user->email;
            $_SESSION['user_name'] = $user->full_name;
            $_SESSION['user_role'] = $user->role;
            
            header('Location: ../terminos/terms.php');
            exit();
        } else {
            $error = 'Tu cuenta no está activa. Por favor, contacta al administrador.';
        }
    } else {
        $error = 'Email o contraseña incorrectos.';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión | <?= APP_NAME ?></title>
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
                <h2>Iniciar Sesión - Usuario</h2>
                <p>Ingresa tus credenciales para acceder al sistema</p>
            </div>
            
            <?php if ($error): ?>
                <div class="alert alert-danger animate__animated animate__shakeX"><?= $error ?></div>
            <?php endif; ?>
            
            <form action="login.php" method="POST" class="auth-form">
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
                </div>
                
                <div class="form-options">
                    <div class="remember-me">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember">Recordar sesión</label>
                    </div>
                    <a href="forgot-password.php" class="forgot-password">¿Olvidaste tu contraseña?</a>
                </div>
                
                <button type="submit" class="btn btn-primary btn-block">Iniciar Sesión</button>
                
                <div class="auth-footer">
                    <p>¿No tienes una cuenta? <a href="register.php" class="auth-link">Regístrate aquí</a></p>
                </div>
            </form>
        </div>
    </div>

    <script src="assets/js/auth.js"></script>
</body>
</html>