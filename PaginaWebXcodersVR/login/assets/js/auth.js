// assets/js/auth.js

document.addEventListener('DOMContentLoaded', function() {
    // Toggle password visibility
    const togglePasswordButtons = document.querySelectorAll('.toggle-password');
    
    togglePasswordButtons.forEach(button => {
        button.addEventListener('click', function() {
            const input = this.parentElement.querySelector('input');
            const icon = this.querySelector('i');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    });
    
    // Form validation
    const forms = document.querySelectorAll('.auth-form');
    
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            let isValid = true;
            const inputs = this.querySelectorAll('input[required]');
            
            inputs.forEach(input => {
                if (!input.value.trim()) {
                    isValid = false;
                    const formGroup = input.closest('.form-group');
                    formGroup.classList.add('error');
                    
                    // Remove error class after animation
                    setTimeout(() => {
                        formGroup.classList.remove('error');
                    }, 1000);
                }
            });
            
            // Password match validation for register and reset password forms
            if (this.id === 'register-form' || this.classList.contains('reset-password-form')) {
                const password = this.querySelector('#password');
                const confirmPassword = this.querySelector('#confirm_password');
                
                if (password && confirmPassword && password.value !== confirmPassword.value) {
                    isValid = false;
                    alert('Las contraseñas no coinciden');
                }
            }
            
            if (!isValid) {
                e.preventDefault();
            }
        });
    });
    
    // Add animation to form groups on focus
    const formGroups = document.querySelectorAll('.form-group');
    
    formGroups.forEach(group => {
        const input = group.querySelector('input');
        
        if (input) {
            input.addEventListener('focus', function() {
                group.classList.add('focused');
            });
            
            input.addEventListener('blur', function() {
                group.classList.remove('focused');
            });
        }
    });
    
    // Auto-hide alerts after 5 seconds
    const alerts = document.querySelectorAll('.alert');
    
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.opacity = '0';
            setTimeout(() => {
                alert.style.display = 'none';
            }, 500);
        }, 5000);
    });
});