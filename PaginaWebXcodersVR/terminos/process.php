<?php
header('Content-Type: application/json');

// Establecer la variable de sesión al aceptar los términos
$_SESSION['terms_accepted'] = true; // Esta línea es crucial

$response = [
    'success' => true,
    'message' => 'Términos aceptados correctamente',
    'redirect' => '../inicio/inicio.php',  // Asegúrate de que esta ruta sea correcta
];

// Simular un pequeño retraso
sleep(1);

echo json_encode($response);
?>