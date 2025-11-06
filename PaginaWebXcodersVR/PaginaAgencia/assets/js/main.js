// Inicializar WOW.js para animaciones
new WOW().init();

// Back to Top Button
const backToTopButton = document.getElementById('backToTop');
window.addEventListener('scroll', () => {
    if (window.pageYOffset > 300) {
        backToTopButton.classList.add('show');
    } else {
        backToTopButton.classList.remove('show');
    }
});

backToTopButton.addEventListener('click', (e) => {
    e.preventDefault();
    window.scrollTo({ top: 0, behavior: 'smooth' });
});

// Smooth scrolling for navigation links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        e.preventDefault();
        
        const targetId = this.getAttribute('href');
        if (targetId === '#') return;
        
        const targetElement = document.querySelector(targetId);
        if (targetElement) {
            const navbarHeight = document.querySelector('.navbar').offsetHeight;
            const targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset - navbarHeight;
            
            window.scrollTo({
                top: targetPosition,
                behavior: 'smooth'
            });
            
            // Cerrar navbar en móviles
            const navbarToggler = document.querySelector('.navbar-toggler');
            const navbarCollapse = document.querySelector('.navbar-collapse');
            if (navbarCollapse.classList.contains('show')) {
                navbarToggler.click();
            }
        }
    });
});

// Formulario de contacto
const contactForm = document.getElementById('contactForm');
if (contactForm) {
    contactForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Validación simple
        const name = document.getElementById('contactName').value.trim();
        const email = document.getElementById('contactEmail').value.trim();
        const subject = document.getElementById('contactSubject').value.trim();
        const message = document.getElementById('contactMessage').value.trim();
        
        if (!name || !email || !subject || !message) {
            alert('Por favor completa todos los campos del formulario.');
            return;
        }
        
        // Simular envío (en producción debería ser una petición AJAX)
        alert('Gracias por tu mensaje. Nos pondremos en contacto contigo pronto.');
        this.reset();
    });
}

// Mostrar modal de éxito si se envió el formulario correctamente
document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('success') === 'true') {
        const successModal = new bootstrap.Modal(document.getElementById('successModal'));
        successModal.show();
    }
});

// Validación de fechas en el formulario de propiedad
const deliveryDateInput = document.getElementById('deliveryDate');
if (deliveryDateInput) {
    const today = new Date();
    const minDate = new Date();
    minDate.setDate(today.getDate() + 3);
    
    const formattedDate = minDate.toISOString().split('T')[0];
    deliveryDateInput.min = formattedDate;
}

// Previsualización de imágenes antes de subir
const propertyImagesInput = document.getElementById('propertyImages');
if (propertyImagesInput) {
    propertyImagesInput.addEventListener('change', function() {
        const files = this.files;
        const previewContainer = document.createElement('div');
        previewContainer.className = 'image-preview-container mt-3';
        
        // Limpiar previsualizaciones anteriores
        const existingPreview = document.querySelector('.image-preview-container');
        if (existingPreview) {
            existingPreview.remove();
        }
        
        if (files.length > 0) {
            previewContainer.innerHTML = '<h6 class="fw-bold mb-2">Vista previa de imágenes:</h6><div class="d-flex flex-wrap gap-2"></div>';
            const previewImages = previewContainer.querySelector('div');
            
            for (let i = 0; i < Math.min(files.length, 5); i++) {
                const file = files[i];
                if (file.type.match('image.*')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.className = 'img-thumbnail';
                        img.style.width = '100px';
                        img.style.height = '100px';
                        img.style.objectFit = 'cover';
                        previewImages.appendChild(img);
                    }
                    reader.readAsDataURL(file);
                }
            }
            
            this.parentNode.appendChild(previewContainer);
        }
    });
}

// Generar PDF y manejar el envío del formulario
const generatePdfBtn = document.getElementById('generatePdfBtn');
if (generatePdfBtn) {
    generatePdfBtn.addEventListener('click', function() {
        // Validar formulario primero
        const form = document.getElementById('propertyForm');
        const requiredFields = form.querySelectorAll('[required]');
        let isValid = true;
        
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                isValid = false;
                field.classList.add('is-invalid');
            } else {
                field.classList.remove('is-invalid');
            }
        });
        
        if (!isValid) {
            alert('Por favor completa todos los campos requeridos.');
            return;
        }
        
        // Obtener datos del formulario
        const formData = new FormData(form);
        const data = {};
        formData.forEach((value, key) => {
            data[key] = value;
        });
        
        // Generar PDF
        generatePropertyPdf(data);
        
        // Mostrar modal
        const pdfModal = new bootstrap.Modal(document.getElementById('pdfModal'));
        pdfModal.show();
        
        // Enviar formulario después de generar PDF
        form.submit();
    });
}

// Función para generar PDF sin librerías
function generatePropertyPdf(formData) {
    // Crear contenido del PDF
    const pdfContent = `
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <title>Formato de Propiedad - ${formData.agencyName}</title>
            <style>
                body { font-family: Arial, sans-serif; margin: 0; padding: 20px; color: #333; }
                .ticket { width: 100%; max-width: 500px; margin: 0 auto; border: 1px solid #ddd; padding: 20px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
                .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #28a745; padding-bottom: 10px; }
                .header h1 { color: #28a745; margin: 0; font-size: 24px; }
                .section { margin-bottom: 15px; }
                .section-title { background-color: #f8f9fa; padding: 5px 10px; font-weight: bold; border-left: 3px solid #28a745; margin-bottom: 10px; }
                .row { display: flex; margin-bottom: 5px; }
                .label { font-weight: bold; width: 40%; }
                .value { width: 60%; }
                .footer { text-align: center; margin-top: 20px; padding-top: 10px; border-top: 1px dashed #ddd; font-size: 12px; color: #666; }
                .logo { max-width: 150px; margin-bottom: 10px; }
            </style>
        </head>
        <body>
            <div class="ticket">
                <div class="header">
                    <h1>FORMATO DE PROPIEDAD</h1>
                    <p>${new Date().toLocaleDateString()}</p>
                </div>
                
                <div class="section">
                    <div class="section-title">INFORMACIÓN DE LA AGENCIA</div>
                    <div class="row"><div class="label">Nombre de la Agencia:</div><div class="value">${formData.agencyName}</div></div>
                    <div class="row"><div class="label">Persona de Contacto:</div><div class="value">${formData.contactPerson}</div></div>
                    <div class="row"><div class="label">Correo Electrónico:</div><div class="value">${formData.email}</div></div>
                    <div class="row"><div class="label">Teléfono:</div><div class="value">${formData.phone}</div></div>
                </div>
                
                <div class="section">
                    <div class="section-title">INFORMACIÓN DE LA PROPIEDAD</div>
                    <div class="row"><div class="label">Tipo de Propiedad:</div><div class="value">${formData.propertyType}</div></div>
                    <div class="row"><div class="label">Dirección:</div><div class="value">${formData.propertyAddress}</div></div>
                    <div class="row"><div class="label">Tamaño (m²):</div><div class="value">${formData.propertySize}</div></div>
                    <div class="row"><div class="label">Habitaciones:</div><div class="value">${formData.bedrooms || 'N/A'}</div></div>
                    <div class="row"><div class="label">Baños:</div><div class="value">${formData.bathrooms || 'N/A'}</div></div>
                    <div class="row"><div class="label">Descripción:</div><div class="value">${formData.propertyDescription}</div></div>
                </div>
                
                <div class="section">
                    <div class="section-title">PREFERENCIAS DE MODELADO</div>
                    <div class="row"><div class="label">Nivel de Detalle VR:</div><div class="value">${formData.vrLevel}</div></div>
                    <div class="row"><div class="label">Fecha Requerida:</div><div class="value">${formData.deliveryDate}</div></div>
                    <div class="row"><div class="label">Instrucciones Especiales:</div><div class="value">${formData.specialInstructions || 'Ninguna'}</div></div>
                </div>
                
                <div class="footer">
                    <p>Este documento ha sido generado automáticamente por el sistema de ${formData.agencyName}</p>
                    <p>Por favor, envíe este formato al correo: <?php echo $company_email; ?></p>
                </div>
            </div>
        </body>
        </html>
    `;
    
    // Crear blob del PDF
    const blob = new Blob([pdfContent], { type: 'application/pdf' });
    const url = URL.createObjectURL(blob);
    
    // Crear enlace para descarga
    const a = document.createElement('a');
    a.href = url;
    a.download = `Formato_Propiedad_${formData.agencyName}_${new Date().toISOString().slice(0,10)}.pdf`;
    
    // Descargar automáticamente
    document.body.appendChild(a);
    a.click();
    
    // Limpiar
    setTimeout(() => {
        document.body.removeChild(a);
        window.URL.revokeObjectURL(url);
    }, 100);
}