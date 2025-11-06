<?php
// includes/config.php
session_start();

// Configuración de la aplicación
define('APP_NAME', 'XcodersVR - Agencias');
define('APP_URL', 'http://localhost/xcoder_vr_agencias');
define('LOGO_URL', 'img/logo1_sinfondo.png');

// Configuración de la base de datos
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'xcoder_vr_agencias');

// Configuración de emails
define('MAIL_FROM', 'no-reply@xcoder-vr.com');
define('MAIL_FROM_NAME', 'XcoderVR Agencias');

// Seguridad
define('PEPPER', 'tu_valor_unico_secreto_pepper'); // Cambiar por un valor único

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
    die('Error de conexión: ' . $e->getMessage());
}

// Funciones de autenticación
function isAgenciaLoggedIn() {
    return isset($_SESSION['agencia_id']);
}

function redirectIfAgenciaLoggedIn() {
    if (isAgenciaLoggedIn()) { 
    {
    header('Location: ');
    }
        exit();
    }
}

function checkAuth() {
    if (!isAgenciaLoggedIn()) {
        header('Location: login-agencia.php');
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

function sendAgenciaEmail($to, $subject, $body) {
    $headers = "From: " . MAIL_FROM_NAME . " <" . MAIL_FROM . ">\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    return mail($to, $subject, $body, $headers);
}
?>