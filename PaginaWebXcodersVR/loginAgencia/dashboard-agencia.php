<?php
require_once 'config.php';
requireAgenciaAuth();

// Verificar si la agencia aceptó los términos
if (!$_SESSION['terms_accepted']) {
    header('Location: terms-agencia.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Agencia | <?= APP_NAME ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="icon" href="<?= LOGO_URL ?>">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="<?= LOGO_URL ?>" alt="<?= APP_NAME ?>" height="40" class="d-inline-block align-top">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="dashboard-agencia.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Propiedades</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Tours VR</a>
                    </li>
                </ul>
                <div class="d-flex align-items-center">
                    <div class="dropdown">
                        <button class="btn btn-outline-light dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle me-1"></i> <?= $_SESSION['agencia_nombre'] ?>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i> Perfil</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i> Configuración</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="logout-agencia.php"><i class="fas fa-sign-out-alt me-2"></i> Cerrar sesión</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <div class="avatar bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px; font-size: 2rem;">
                            <?= substr($_SESSION['agencia_nombre'], 0, 2) ?>
                        </div>
                        <h4><?= $_SESSION['agencia_nombre'] ?></h4>
                        <p class="text-muted"><?= $_SESSION['agencia_email'] ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Bienvenida, <?= $_SESSION['agencia_name'] ?></h5>
                    </div>
                    <div class="card-body">
                        <p>Aquí puedes gestionar tus propiedades y tours virtuales en colaboración con XcoderVR.</p>
                        <div class="row mt-4">
                            <div class="col-md-6 mb-3">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h6 class="card-title"><i class="fas fa-home me-2 text-primary"></i> Propiedades</h6>
                                        <p class="card-text">Administra las propiedades que has registrado en nuestra plataforma.</p>
                                        <a href="#" class="btn btn-sm btn-outline-primary">Ver propiedades</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h6 class="card-title"><i class="fas fa-vr-cardboard me-2 text-primary"></i> Tours VR</h6>
                                        <p class="card-text">Gestiona los tours de realidad virtual de tus propiedades.</p>
                                        <a href="#" class="btn btn-sm btn-outline-primary">Ver tours</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>