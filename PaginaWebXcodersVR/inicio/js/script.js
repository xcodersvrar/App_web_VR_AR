document.addEventListener('DOMContentLoaded', function() {
    // Navbar scroll effect
    const navbar = document.querySelector('.navbar');
    window.addEventListener('scroll', function() {
        if (window.scrollY > 50) {
            navbar.classList.add('navbar-scrolled');
        } else {
            navbar.classList.remove('navbar-scrolled');
        }
    });

            // Floating elements animation
            const floatingElements = document.querySelectorAll('.floating-element');
            floatingElements.forEach((element, index) => {
                const size = Math.random() * 50 + 20;
                element.style.width = `${size}px`;
                element.style.height = `${size}px`;
                element.style.left = `${Math.random() * 100}%`;
                element.style.top = `${Math.random() * 100}%`;
                
                const duration = Math.random() * 20 + 10;
                const delay = Math.random() * 5;
                element.style.animation = `float ${duration}s ${delay}s infinite linear`;
            });
            
            // Scroll animations
            const animateOnScroll = function() {
                const elements = document.querySelectorAll('.feature-card, .testimonial-card, .property-card');
                const windowHeight = window.innerHeight;
                
                elements.forEach(element => {
                    const elementPosition = element.getBoundingClientRect().top;
                    
                    if (elementPosition < windowHeight * 0.9) {
                        element.classList.add('appear');
                    }
                });
            };
            
            // Initialize scroll animations
            window.addEventListener('scroll', animateOnScroll);
            animateOnScroll();
            
            // Video play button
            const playBtn = document.querySelector('.play-btn');
            if (playBtn) {
                playBtn.addEventListener('click', function() {
                    alert('Aquí se abriría el video demostrativo de la experiencia VR. En una implementación real, se cargaría un video en un modal o en la misma sección.');
                });
            }

const userAvatar = document.querySelector('.user-avatar');
    if (userAvatar) {
        userAvatar.addEventListener('click', function(e) {
            if (window.innerWidth < 992) { // Solo para mobile
                const dropdown = this.nextElementSibling.querySelector('.dropdown-menu');
                dropdown.classList.toggle('show');
            }
        });
    }
            
            // Smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    
                    document.querySelector(this.getAttribute('href')).scrollIntoView({
                        behavior: 'smooth'
                    });
                });
            });
        });