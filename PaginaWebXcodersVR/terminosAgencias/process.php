<?php
session_start(); // Faltaba iniciar la sesión
header('Content-Type: application/json');

// Establecer la variable de sesión al aceptar los términos
$_SESSION['terms_accepted'] = true;

$response = [
    'success' => true,
    'message' => 'Términos aceptados correctamente',
    'redirect' => '../../PaginaWebXcodersVR/PaginaAgencia/index.php', // Ruta relativa corregida
];

// Simular un pequeño retraso
sleep(1);

echo json_encode($response);
?>