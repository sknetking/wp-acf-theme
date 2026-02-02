/**
 * Mobile Menu Toggle
 */
document.addEventListener('DOMContentLoaded', function() {
    const navToggle = document.querySelector('.nav-toggle');
    const navMenu = document.querySelector('.nav-menu');
    
    if (!navToggle || !navMenu) {
        return;
    }
    
    navToggle.addEventListener('click', function() {
        navMenu.classList.toggle('active');
        navToggle.classList.toggle('active');
    });
    
    // Close menu when clicking outside
    document.addEventListener('click', function(event) {
        if (!navMenu.contains(event.target) && !navToggle.contains(event.target)) {
            navMenu.classList.remove('active');
            navToggle.classList.remove('active');
        }
    });
    
    // Close menu when clicking on a link
    const navLinks = document.querySelectorAll('.nav-links a');
    navLinks.forEach(function(link) {
        link.addEventListener('click', function() {
            navMenu.classList.remove('active');
            navToggle.classList.remove('active');
        });
    });
});
