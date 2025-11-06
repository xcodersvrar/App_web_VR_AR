document.addEventListener('DOMContentLoaded', function() {
    // Mostrar/ocultar filtros en móviles
    const filtersCollapse = document.getElementById('filtersCollapse');
    const filterBtn = document.querySelector('[data-bs-target="#filtersCollapse"]');
    
    if (window.innerWidth < 768) {
        filtersCollapse.classList.remove('show');
    } else {
        filtersCollapse.classList.add('show');
    }
    
    window.addEventListener('resize', function() {
        if (window.innerWidth < 768) {
            filtersCollapse.classList.remove('show');
        } else {
            filtersCollapse.classList.add('show');
        }
    });
    
    // Validación de precios
    const minPriceInput = document.getElementById('min_price');
    const maxPriceInput = document.getElementById('max_price');
    
    if (minPriceInput && maxPriceInput) {
        minPriceInput.addEventListener('change', function() {
            if (maxPriceInput.value && parseInt(this.value) > parseInt(maxPriceInput.value)) {
                this.value = maxPriceInput.value;
            }
        });
        
        maxPriceInput.addEventListener('change', function() {
            if (minPriceInput.value && parseInt(this.value) < parseInt(minPriceInput.value)) {
                this.value = minPriceInput.value;
            }
        });
    }
    
    // Animación al aplicar filtros
    const filterForm = document.getElementById('filterForm');
    if (filterForm) {
        filterForm.addEventListener('submit', function(e) {
            const propertyCards = document.querySelectorAll('.property-card');
            
            propertyCards.forEach(card => {
                card.classList.add('animate__animated', 'animate__fadeOut');
            });
            
            setTimeout(() => {
                propertyCards.forEach(card => {
                    card.classList.remove('animate__fadeOut');
                });
            }, 500);
        });
    }
    
    // Mostrar mensaje si hay filtros aplicados
    function checkAppliedFilters() {
        const urlParams = new URLSearchParams(window.location.search);
        const appliedFilters = Array.from(urlParams.entries()).filter(
            ([key, value]) => key !== 'page' && value !== ''
        );
        
        if (appliedFilters.length > 0) {
            const filterBtn = document.querySelector('[data-bs-target="#filtersCollapse"]');
            if (filterBtn) {
                filterBtn.innerHTML = '<i class="fas fa-filter me-2"></i>Filtros Aplicados';
                filterBtn.classList.add('btn-success', 'text-white');
                filterBtn.classList.remove('btn-outline-success');
            }
        }
    }
    
    checkAppliedFilters();
});