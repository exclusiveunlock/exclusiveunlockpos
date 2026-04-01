// Enhanced Theme Toggle Functionality with Mobile Support
document.addEventListener('DOMContentLoaded', function() {
    // Initialize theme on page load
    const savedTheme = localStorage.getItem('theme');
    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    const theme = savedTheme || (prefersDark ? 'dark' : 'light');
    
    applyTheme(theme);
    
    // Listen for system theme changes
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
        if (!localStorage.getItem('theme')) {
            applyTheme(e.matches ? 'dark' : 'light');
        }
    });

    // Initialize mobile menu functionality
    initializeMobileMenu();
    
    // Initialize responsive utilities
    initializeResponsiveUtils();
});

function applyTheme(theme) {
    document.documentElement.setAttribute('data-theme', theme);
    document.documentElement.classList.toggle('dark', theme === 'dark');
    
    // Update theme toggle buttons if they exist
    const lightButtons = document.querySelectorAll('[data-theme-toggle="light"]');
    const darkButtons = document.querySelectorAll('[data-theme-toggle="dark"]');
    
    lightButtons.forEach(btn => {
        btn.classList.toggle('active', theme === 'light');
        btn.setAttribute('aria-pressed', theme === 'light');
    });
    
    darkButtons.forEach(btn => {
        btn.classList.toggle('active', theme === 'dark');
        btn.setAttribute('aria-pressed', theme === 'dark');
    });

    // Update toggle switch if it exists
    const themeToggle = document.querySelector('#theme-toggle');
    if (themeToggle) {
        themeToggle.checked = theme === 'dark';
    }

    // Update meta theme-color for mobile browsers
    updateMetaThemeColor(theme);
}

function toggleTheme() {
    const currentTheme = document.documentElement.getAttribute('data-theme');
    const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
    
    localStorage.setItem('theme', newTheme);
    applyTheme(newTheme);
    
    // Add smooth transition
    enableThemeTransition();
    
    // Dispatch custom event for other components
    window.dispatchEvent(new CustomEvent('themeChanged', { detail: { theme: newTheme } }));
}

function setTheme(theme) {
    localStorage.setItem('theme', theme);
    applyTheme(theme);
    
    // Add smooth transition
    enableThemeTransition();
    
    // Dispatch custom event for other components
    window.dispatchEvent(new CustomEvent('themeChanged', { detail: { theme: theme } }));
}

// Update meta theme-color for mobile browsers
function updateMetaThemeColor(theme) {
    let metaThemeColor = document.querySelector('meta[name="theme-color"]');
    if (!metaThemeColor) {
        metaThemeColor = document.createElement('meta');
        metaThemeColor.name = 'theme-color';
        document.head.appendChild(metaThemeColor);
    }
    
    const colors = {
        light: '#ffffff',
        dark: '#1f2937'
    };
    
    metaThemeColor.content = colors[theme] || colors.light;
}

// Mobile menu functionality
function initializeMobileMenu() {
    const mobileMenuButton = document.querySelector('[data-mobile-menu-toggle]');
    const mobileMenu = document.querySelector('[data-mobile-menu]');
    
    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', function() {
            const isOpen = mobileMenu.classList.contains('open');
            
            if (isOpen) {
                closeMobileMenu();
            } else {
                openMobileMenu();
            }
        });

        // Close menu when clicking outside
        document.addEventListener('click', function(e) {
            if (!mobileMenu.contains(e.target) && !mobileMenuButton.contains(e.target)) {
                closeMobileMenu();
            }
        });

        // Close menu on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeMobileMenu();
            }
        });
    }
}

function openMobileMenu() {
    const mobileMenu = document.querySelector('[data-mobile-menu]');
    const mobileMenuButton = document.querySelector('[data-mobile-menu-toggle]');
    
    if (mobileMenu && mobileMenuButton) {
        mobileMenu.classList.add('open');
        mobileMenuButton.setAttribute('aria-expanded', 'true');
        document.body.style.overflow = 'hidden'; // Prevent scrolling
    }
}

function closeMobileMenu() {
    const mobileMenu = document.querySelector('[data-mobile-menu]');
    const mobileMenuButton = document.querySelector('[data-mobile-menu-toggle]');
    
    if (mobileMenu && mobileMenuButton) {
        mobileMenu.classList.remove('open');
        mobileMenuButton.setAttribute('aria-expanded', 'false');
        document.body.style.overflow = ''; // Restore scrolling
    }
}

// Responsive utilities
function initializeResponsiveUtils() {
    // Handle viewport height on mobile devices
    function setVH() {
        const vh = window.innerHeight * 0.01;
        document.documentElement.style.setProperty('--vh', `${vh}px`);
    }
    
    setVH();
    window.addEventListener('resize', setVH);
    window.addEventListener('orientationchange', setVH);

    // Handle touch interactions
    if ('ontouchstart' in window) {
        document.documentElement.classList.add('touch-device');
    }

    // Optimize for reduced motion
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        document.documentElement.classList.add('reduce-motion');
    }
}

// Smooth theme transition
function enableThemeTransition() {
    const css = document.createElement('style');
    css.textContent = `
        * {
            transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease !important;
        }
        .reduce-motion * {
            transition: none !important;
        }
    `;
    document.head.appendChild(css);
    
    // Remove transition after animation completes
    setTimeout(() => {
        if (document.head.contains(css)) {
            document.head.removeChild(css);
        }
    }, 300);
}

// Utility functions for responsive behavior
function isMobile() {
    return window.innerWidth < 768;
}

function isTablet() {
    return window.innerWidth >= 768 && window.innerWidth < 1024;
}

function isDesktop() {
    return window.innerWidth >= 1024;
}

// Make functions globally available
window.toggleTheme = toggleTheme;
window.setTheme = setTheme;
window.openMobileMenu = openMobileMenu;
window.closeMobileMenu = closeMobileMenu;
window.isMobile = isMobile;
window.isTablet = isTablet;
window.isDesktop = isDesktop;

// Apply smooth transitions when theme changes
window.addEventListener('themeChanged', enableThemeTransition);

// Enhanced scroll behavior for mobile
let lastScrollTop = 0;
window.addEventListener('scroll', function() {
    if (isMobile()) {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        const navbar = document.querySelector('nav');
        
        if (navbar && scrollTop > lastScrollTop && scrollTop > 100) {
            // Scrolling down
            navbar.style.transform = 'translateY(-100%)';
        } else {
            // Scrolling up
            navbar.style.transform = 'translateY(0)';
        }
        
        lastScrollTop = scrollTop;
    }
}, { passive: true });

// Performance optimization for mobile
if (isMobile()) {
    // Reduce animation complexity on mobile
    document.documentElement.classList.add('mobile-optimized');
}

// Add CSS for mobile optimizations
const mobileCSS = document.createElement('style');
mobileCSS.textContent = `
    .mobile-optimized * {
        will-change: auto;
    }
    
    .mobile-optimized .hover\\:scale-105:hover {
        transform: scale(1.02) !important;
    }
    
    @media (max-width: 767px) {
        .mobile-optimized .backdrop-blur-lg {
            backdrop-filter: blur(8px) !important;
        }
        
        .mobile-optimized .shadow-xl {
            box-shadow: 0 10px 25px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05) !important;
        }
    }
`;
document.head.appendChild(mobileCSS);

