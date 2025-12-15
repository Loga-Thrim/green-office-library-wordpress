/**
 * Navigation Script for Green Library Theme
 */

document.addEventListener('DOMContentLoaded', function() {
    // Hamburger menu toggle for all navigation types
    const mobileMenuToggles = document.querySelectorAll('.mobile-menu-toggle');
    
    mobileMenuToggles.forEach(toggle => {
        toggle.addEventListener('click', function() {
            this.classList.toggle('active');
            
            // Find the associated navigation menu
            let navigation;
            if (this.classList.contains('green-office-toggle')) {
                navigation = document.querySelector('.green-office-menu');
            } else if (this.classList.contains('green-library-toggle')) {
                navigation = document.querySelector('.green-library-sub-navigation');
            } else {
                navigation = document.querySelector('.main-navigation');
            }
            
            if (navigation) {
                navigation.classList.toggle('active');
                
                // Update aria-expanded attribute
                const isExpanded = navigation.classList.contains('active');
                this.setAttribute('aria-expanded', isExpanded);
            }
        });
    });
    
    // Close mobile menu when clicking outside
    document.addEventListener('click', function(event) {
        const isClickInsideMenu = event.target.closest('.mobile-menu-toggle') || 
                                 event.target.closest('.main-navigation') ||
                                 event.target.closest('.green-office-menu') ||
                                 event.target.closest('.green-library-sub-navigation');
        
        if (!isClickInsideMenu) {
            document.querySelectorAll('.mobile-menu-toggle.active').forEach(toggle => {
                toggle.classList.remove('active');
                toggle.setAttribute('aria-expanded', 'false');
            });
            
            document.querySelectorAll('.main-navigation.active, .green-office-menu.active, .green-library-sub-navigation.active').forEach(nav => {
                nav.classList.remove('active');
            });
        }
    });

    // Mobile menu toggle (if implementing mobile menu in future)
    const menuToggle = document.querySelector('.menu-toggle');
    const mainNav = document.querySelector('.main-navigation');

    if (menuToggle && mainNav) {
        menuToggle.addEventListener('click', function() {
            mainNav.classList.toggle('toggled');
            this.setAttribute('aria-expanded', 
                this.getAttribute('aria-expanded') === 'true' ? 'false' : 'true'
            );
        });
    }

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                e.preventDefault();
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Add active class to current menu item
    const currentLocation = window.location.href;
    const menuItems = document.querySelectorAll('.main-navigation a');
    
    menuItems.forEach(item => {
        if (item.href === currentLocation) {
            item.classList.add('active');
        }
    });

    // Sticky header on scroll
    let lastScroll = 0;
    const header = document.querySelector('.site-header');
    
    window.addEventListener('scroll', function() {
        const currentScroll = window.pageYOffset;
        
        if (currentScroll <= 0) {
            header.classList.remove('scroll-up');
            return;
        }
        
        if (currentScroll > lastScroll && !header.classList.contains('scroll-down')) {
            // Scrolling down
            header.classList.remove('scroll-up');
            header.classList.add('scroll-down');
        } else if (currentScroll < lastScroll && header.classList.contains('scroll-down')) {
            // Scrolling up
            header.classList.remove('scroll-down');
            header.classList.add('scroll-up');
        }
        
        lastScroll = currentScroll;
    });

})();
