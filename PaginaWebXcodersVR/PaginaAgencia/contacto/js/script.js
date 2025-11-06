// Form submission handling
document.getElementById('contactForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Get form values
    const nombre = document.getElementById('nombre').value;
    const email = document.getElementById('email').value;
    const telefono = document.getElementById('telefono').value;
    const motivo = document.getElementById('motivo').value;
    const mensaje = document.getElementById('mensaje').value;
    const newsletter = document.getElementById('newsletter').checked;
    
    // Here you would typically send this data to a server
    // For demonstration, we'll just show an alert
    let motivoTexto = '';
    
    switch(motivo) {
        case 'propiedad':
            motivoTexto = 'consulta sobre propiedades';
            break;
        case 'tour_vr':
            motivoTexto = 'solicitud para agendar un tour virtual';
            break;
        case 'soporte_tecnico':
            motivoTexto = 'solicitud de soporte técnico';
            break;
        case 'asistencia_compra':
            motivoTexto = 'solicitud de asistencia en el proceso de compra/venta';
            break;
        default:
            motivoTexto = 'consulta general';
    }
    
    alert(`Gracias ${nombre} por tu mensaje. Hemos recibido tu ${motivoTexto} y nos pondremos en contacto contigo pronto.`);
    
    // Reset form
    this.reset();
    
    // Smooth scroll to top
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
});

// Animation on scroll
document.addEventListener('DOMContentLoaded', function() {
    const animatedElements = document.querySelectorAll('.contact-card, .contact-form, .manager-card');
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, { threshold: 0.1 });
    
    animatedElements.forEach(element => {
        element.style.opacity = '0';
        element.style.transform = 'translateY(30px)';
        element.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(element);
    });
});

// Navbar scroll effect
window.addEventListener('scroll', function() {
    const navbar = document.querySelector('.navbar');
    if (window.scrollY > 50) {
        navbar.style.boxShadow = '0 4px 12px rgba(0, 0, 0, 0.15)';
        navbar.style.padding = '10px 0';
    } else {
        navbar.style.boxShadow = '0 4px 12px rgba(0, 0, 0, 0.1)';
        navbar.style.padding = '15px 0';
    }
});