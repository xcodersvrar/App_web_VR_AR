<?php
require_once 'config.php';
checkAuth();

// Obtener información del usuario
$stmt = $pdo->prepare('SELECT full_name, email, role, created_at FROM users WHERE id = ?');
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control | <?= APP_NAME ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <div class="sidebar animate__animated animate__fadeInLeft">
            <div class="sidebar-header">
                <img src="<?= LOGO_URL ?>" alt="<?= APP_NAME ?>" class="sidebar-logo">
                <h3><?= APP_NAME ?></h3>
            </div>
            
            <nav class="sidebar-nav">
                <ul>
                    <li class="active"><a href="dashboard.php"><i class="fas fa-home"></i> Inicio</a></li>
                    <li><a href="#"><i class="fas fa-building"></i> Propiedades</a></li>
                    <li><a href="#"><i class="fas fa-vr-cardboard"></i> Tours VR</a></li>
                    <li><a href="#"><i class="fas fa-users"></i> Clientes</a></li>
                    <li><a href="#"><i class="fas fa-chart-line"></i> Reportes</a></li>
                    <li><a href="#"><i class="fas fa-cog"></i> Configuración</a></li>
                </ul>
            </nav>
            
            <div class="sidebar-footer">
                <a href="logout.php" class="btn btn-logout"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="main-content animate__animated animate__fadeIn">
            <header class="main-header">
                <div class="header-left">
                    <button class="sidebar-toggle"><i class="fas fa-bars"></i></button>
                    <h2>Bienvenido, <?= htmlspecialchars($user->full_name) ?></h2>
                </div>
                <div class="header-right">
                    <div class="user-dropdown">
                        <button class="user-btn">
                            <img src="https://ui-avatars.com/api/?name=<?= urlencode($user->full_name) ?>&background=4CAF50&color=fff" alt="User Avatar">
                            <span><?= htmlspecialchars($user->full_name) ?></span>
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <div class="dropdown-content">
                            <a href="#"><i class="fas fa-user"></i> Mi Perfil</a>
                            <a href="#"><i class="fas fa-cog"></i> Configuración</a>
                            <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
                        </div>
                    </div>
                </div>
            </header>
            
            <main class="content">
                <div class="welcome-banner">
                    <div class="welcome-text">
                        <h1>Bienvenido al Sistema de <?= APP_NAME ?></h1>
                        <p>Gestiona tus propiedades y tours virtuales desde este panel de control.</p>
                    </div>
                    <div class="welcome-image">
                        <img src="assets/img/vr-house.png" alt="Realidad Virtual">
                    </div>
                </div>
                
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon" style="background-color: #4CAF50;">
                            <i class="fas fa-home"></i>
                        </div>
                        <div class="stat-info">
                            <h3>25</h3>
                            <p>Propiedades Activas</p>
                        </div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-icon" style="background-color: #2196F3;">
                            <i class="fas fa-vr-cardboard"></i>
                        </div>
                        <div class="stat-info">
                            <h3>18</h3>
                            <p>Tours VR</p>
                        </div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-icon" style="background-color: #FF9800;">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-info">
                            <h3>42</h3>
                            <p>Clientes</p>
                        </div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-icon" style="background-color: #9C27B0;">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <div class="stat-info">
                            <h3>7</h3>
                            <p>Citas Hoy</p>
                        </div>
                    </div>
                </div>
                
                <div class="recent-activities">
                    <h3>Actividad Reciente</h3>
                    <div class="activity-list">
                        <div class="activity-item">
                            <div class="activity-icon">
                                <i class="fas fa-home"></i>
                            </div>
                            <div class="activity-content">
                                <p>Nueva propiedad agregada: "Casa en la playa"</p>
                                <small>Hace 2 horas</small>
                            </div>
                        </div>
                        
                        <div class="activity-item">
                            <div class="activity-icon">
                                <i class="fas fa-vr-cardboard"></i>
                            </div>
                            <div class="activity-content">
                                <p>Tour VR actualizado para "Departamento en centro"</p>
                                <small>Hace 5 horas</small>
                            </div>
                        </div>
                        
                        <div class="activity-item">
                            <div class="activity-icon">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="activity-content">
                                <p>Nuevo cliente registrado: María González</p>
                                <small>Ayer a las 3:45 PM</small>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="assets/js/main.js"></script>
</body>
</html>