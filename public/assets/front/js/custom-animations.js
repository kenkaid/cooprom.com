
/**
 * Gestion de l'apparition progressive des éléments au défilement
 */
document.addEventListener('DOMContentLoaded', function() {
    const revealElements = document.querySelectorAll('section, .login-card, .register-card, .news-block, .services-block, .team-block, .feature-block');

    // Ajout de la classe reveal aux éléments qui ne l'ont pas encore
    revealElements.forEach(el => {
        if (!el.classList.contains('wow')) { // On évite de doubler avec WOW si présent
            el.classList.add('reveal');
        }
    });

    const revealOnScroll = () => {
        const windowHeight = window.innerHeight;
        const revealPoint = 150;

        const elements = document.querySelectorAll('.reveal');
        elements.forEach(el => {
            const revealTop = el.getBoundingClientRect().top;
            if (revealTop < windowHeight - revealPoint) {
                el.classList.add('active');
            }
        });
    };

    // Utilisation de IntersectionObserver pour de meilleures performances si disponible
    if ('IntersectionObserver' in window) {
        const observerOptions = {
            threshold: 0.15,
            rootMargin: "0px 0px -50px 0px"
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
    } else {
        // Fallback pour les anciens navigateurs
        window.addEventListener('scroll', revealOnScroll);
        revealOnScroll(); // Appel initial
    }
});
