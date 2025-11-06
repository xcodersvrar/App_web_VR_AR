<?php
// includes/config.php
session_start();

// Configuración de la aplicación
define('APP_NAME', 'XcodersVR');
define('APP_URL', 'http://localhost/xcoder_vr_auth');
define('COMPANY_EMAIL', 'contacto@xcoder-vr.com');
define('LOGO_URL', 'img/logo1_sinfondo.png');

// Configuración de la base de datos
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'xcoder_vr_auth');

// Configuración de emails (usando mail() nativo)
define('MAIL_FROM', 'no-reply@xcoder-vr.com');
define('MAIL_FROM_NAME', 'XcoderVR');

// Otras configuraciones
define('PEPPER', 'tu_valor_unico_secreto_pepper'); // Cambiar por un valor único y secreto

// Conexión a la base de datos
try {
    $pdo = new PDO(
        'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8',
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
        ]
    );
} catch (PDOException $e) {
    die('Error de conexión a la base de datos: ' . $e->getMessage());
}

// Funciones de autenticación
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function redirectIfLoggedIn() {
    if (isLoggedIn()) {
        header('Location: dashboard.php');
        exit();
    }
}

function checkAuth() {
    if (!isLoggedIn()) {
        header('Location: login.php');
        exit();
    }
}

function sanitizeInput($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

function generateToken($length = 32) {
    return bin2hex(random_bytes($length));
}

function hashPassword($password) {
    return password_hash($password . PEPPER, PASSWORD_BCRYPT, ['cost' => 12]);
}

function verifyPassword($password, $hashedPassword) {
    return password_verify($password . PEPPER, $hashedPassword);
}

function sendEmail($to, $subject, $body) {
    // Simular envío de email (solo para desarrollo)
    error_log("Email simulado enviado a: $to - Asunto: $subject");
    return true; // Siempre retorna true para simular éxito
}
?>