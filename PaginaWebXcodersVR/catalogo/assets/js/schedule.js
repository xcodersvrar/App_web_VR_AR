document.addEventListener('DOMContentLoaded', function() {
    // Validación del formulario
    const appointmentForm = document.getElementById('appointmentForm');
    
    if (appointmentForm) {
        appointmentForm.addEventListener('submit', function(e) {
            const termsCheckbox = document.getElementById('terms');
            
            if (!termsCheckbox.checked) {
                e.preventDefault();
                alert('Debes aceptar los términos y condiciones para agendar tu cita.');
                termsCheckbox.focus();
            }
        });
    }
    
    // Configurar fecha mínima (hoy)
    const dateInput = document.getElementById('date');
    if (dateInput) {
        const today = new Date();
        const dd = String(today.getDate()).padStart(2, '0');
        const mm = String(today.getMonth() + 1).padStart(2, '0');
        const yyyy = today.getFullYear();
        
        dateInput.min = `${yyyy}-${mm}-${dd}`;
    }
    
    // Validar teléfono
    const phoneInput = document.getElementById('phone');
    if (phoneInput) {
        phoneInput.addEventListener('input', function() {
            this.value = this.value.replace(/[^0-9+]/g, '');
        });
    }
    
    // Mostrar animación al cargar
    const card = document.querySelector('.card');
    if (card) {
        card.classList.add('animate__animated', 'animate__slideInUp');
    }
});