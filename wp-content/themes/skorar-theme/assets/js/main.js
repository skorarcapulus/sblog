/**
 * Skorar Theme JavaScript
 */

(function() {
    'use strict';

    // Wait for DOM to be ready
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Skorar Theme loaded');
        
        // Initialize theme features
        initMobileMenu();
        initSmoothScroll();
        
        // Development mode indicator
        if (document.body.classList.contains('debug-mode')) {
            console.log('🔧 Development mode active');
        }
    });

    /**
     * Mobile Menu Toggle (if needed later)
     */
    function initMobileMenu() {
        const nav = document.querySelector('.main-nav');
        if (!nav) return;

        // Add mobile menu button if nav exists
        // This is a placeholder for future mobile menu functionality
        console.log('Navigation found, mobile menu ready');
    }

    /**
     * Smooth scroll for anchor links
     */
    function initSmoothScroll() {
        const anchorLinks = document.querySelectorAll('a[href^="#"]');
        
        anchorLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                const targetId = this.getAttribute('href').substring(1);
                const targetElement = document.getElementById(targetId);
                
                if (targetElement) {
                    e.preventDefault();
                    targetElement.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });
    }

    /**
     * Utility function to make AJAX requests
     */
    window.skorarAjax = function(action, data, callback) {
        const formData = new FormData();
        formData.append('action', action);
        formData.append('nonce', skorarTheme.nonce);
        
        // Add custom data
        for (let key in data) {
            formData.append(key, data[key]);
        }

        fetch(skorarTheme.ajaxUrl, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(callback)
        .catch(error => console.error('AJAX Error:', error));
    };

})();