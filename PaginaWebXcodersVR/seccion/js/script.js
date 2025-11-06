function redirectToUserLogin() {
    // Animación antes de redireccionar
    document.getElementById('user-option').classList.add('animate__pulse');
    
    setTimeout(() => {
        window.location.href = '../../../PaginaWebXcodersVR/login/login.php';
    }, 500);
}

function redirectToAgencyLogin() {
    // Animación antes de redireccionar
    document.getElementById('agency-option').classList.add('animate__pulse');
    
    setTimeout(() => {
        window.location.href = '../../../PaginaWebXcodersVR/loginAgencia/login-agencia.php';
    }, 500);
}

// Efecto hover mejorado para las tarjetas
document.querySelectorAll('.option-card').forEach(card => {
    card.addEventListener('mouseenter', () => {
        card.style.transform = 'translateY(-10px)';
        card.style.boxShadow = '0 15px 30px rgba(0, 0, 0, 0.1)';
    });
    
    card.addEventListener('mouseleave', () => {
        card.style.transform = 'translateY(0)';
        card.style.boxShadow = '0 5px 15px rgba(0, 0, 0, 0.05)';
    });
});

// Inicializar animaciones cuando el contenido está cargado
document.addEventListener('DOMContentLoaded', () => {
    // Efecto de carga inicial
    const elements = document.querySelectorAll('.animate__animated');
    elements.forEach((el, index) => {
        setTimeout(() => {
            el.style.opacity = 1;
        }, index * 200);
    });
});