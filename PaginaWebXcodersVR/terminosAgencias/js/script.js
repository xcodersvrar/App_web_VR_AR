document.addEventListener('DOMContentLoaded', function() {
    // Set current date and year
    const currentDate = new Date();
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    document.getElementById('current-date').textContent = currentDate.toLocaleDateString('es-ES', options);
    document.getElementById('current-year').textContent = currentDate.getFullYear();

    // Terms acceptance logic
    const acceptTerms = document.getElementById('acceptTerms');
    const acceptPrivacy = document.getElementById('acceptPrivacy');
    const acceptButton = document.getElementById('acceptButton');

    function checkAcceptance() {
        if (acceptTerms.checked && acceptPrivacy.checked) {
            acceptButton.disabled = false;
            acceptButton.classList.add('btn-pulse');
        } else {
            acceptButton.disabled = true;
            acceptButton.classList.remove('btn-pulse');
        }
    }

    acceptTerms.addEventListener('change', checkAcceptance);
    acceptPrivacy.addEventListener('change', checkAcceptance);

    // Handle form submission
    acceptButton.addEventListener('click', function(e) {
        e.preventDefault();
        
        // Show loading state
        acceptButton.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Procesando...';
        acceptButton.disabled = true;
        
        // Send data to server
        fetch('../process.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                termsAccepted: acceptTerms.checked,
                privacyAccepted: acceptPrivacy.checked
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = data.redirect;
            } else {
                alert('Error al procesar la aceptación de términos');
                acceptButton.innerHTML = '<i class="fas fa-check-circle me-2"></i>Aceptar Términos y Continuar';
                acceptButton.disabled = false;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al conectar con el servidor');
            acceptButton.innerHTML = '<i class="fas fa-check-circle me-2"></i>Aceptar Términos y Continuar';
            acceptButton.disabled = false;
        });
    });

    // Scroll animations
    const animateOnScroll = function() {
        const termsSections = document.querySelectorAll('.terms-text section');
        
        termsSections.forEach(section => {
            const sectionPosition = section.getBoundingClientRect().top;
            const screenPosition = window.innerHeight / 1.3;
            
            if (sectionPosition < screenPosition) {
                section.classList.add('animate__animated', 'animate__fadeIn');
            }
        });
    };

    window.addEventListener('scroll', animateOnScroll);
    animateOnScroll(); // Trigger on load for visible elements
});