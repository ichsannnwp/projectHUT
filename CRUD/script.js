function openModal() {
    document.getElementById('registerModal').style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    document.getElementById('registerModal').style.display = 'none';
    document.body.style.overflow = 'auto';
    
    if(window.location.href.includes('?')) {
        const baseUrl = window.location.pathname;
        const hash = window.location.hash;
        window.history.replaceState({}, document.title, baseUrl + hash);
    }
}

window.onclick = function(event) {
    const modal = document.getElementById('registerModal');
    if (event.target === modal) {
        closeModal();
    }
}

// ========== ROUTE MAP ==========
let map = null;
let routeLayer = null;

const routes = {
    '5K': {
        center: [-7.7956, 110.3695],
        zoom: 14,
        path: [
            [-7.8110, 110.3645],
            [-7.8080, 110.3660],
            [-7.8050, 110.3670],
            [-7.8020, 110.3680],
            [-7.7990, 110.3690],
            [-7.7956, 110.3695],
            [-7.7920, 110.3710],
            [-7.7890, 110.3720],
            [-7.7860, 110.3730]
        ]
    },
    '10K': {
        center: [-7.7500, 110.4000],
        zoom: 13,
        path: [
            [-7.7750, 110.3800],
            [-7.7700, 110.3850],
            [-7.7650, 110.3900],
            [-7.7600, 110.3950],
            [-7.7550, 110.4000],
            [-7.7500, 110.4050],
            [-7.7450, 110.4100],
            [-7.7400, 110.4150],
            [-7.7350, 110.4200]
        ]
    },
    'Half': {
        center: [-7.8500, 110.4000],
        zoom: 12,
        path: [
            [-7.8000, 110.3700],
            [-7.8100, 110.3750],
            [-7.8200, 110.3800],
            [-7.8300, 110.3850],
            [-7.8400, 110.3900],
            [-7.8500, 110.4000],
            [-7.8600, 110.4100],
            [-7.8700, 110.4200],
            [-7.8800, 110.4300],
            [-7.9000, 110.4400]
        ]
    }
};

function selectRoute(type) {
    const cardsWrapper = document.getElementById('routeCardsWrapper');
    const mapWrapper = document.getElementById('routeMapWrapper');
    
    // Hide cards and show map
    cardsWrapper.classList.add('minimized');
    mapWrapper.classList.add('active');
    
    // Initialize map if first time
    if (!map) {
        map = L.map('map');
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap'
        }).addTo(map);
    }
    
    const route = routes[type];
    
    // Update map view
    map.setView(route.center, route.zoom);
    
    // Remove old route
    if (routeLayer) {
        map.removeLayer(routeLayer);
    }
    
    // Remove markers
    map.eachLayer(function(layer) {
        if (layer instanceof L.Marker) {
            map.removeLayer(layer);
        }
    });
    
    // Draw route
    routeLayer = L.polyline(route.path, {
        color: '#FF4444',
        weight: 6,
        opacity: 0.8
    }).addTo(map);
    
    // Start marker (green)
    L.marker(route.path[0], {
        icon: L.divIcon({
            html: '<div style="background:#28a745;width:20px;height:20px;border-radius:50%;border:3px solid white;box-shadow:0 2px 5px rgba(0,0,0,0.3)"></div>',
            iconSize: [20, 20],
            iconAnchor: [10, 10]
        })
    }).addTo(map).bindPopup('Start').openPopup();
    
    // Finish marker (red)
    L.marker(route.path[route.path.length - 1], {
        icon: L.divIcon({
            html: '<div style="background:#dc3545;width:20px;height:20px;border-radius:50%;border:3px solid white;box-shadow:0 2px 5px rgba(0,0,0,0.3)"></div>',
            iconSize: [20, 20],
            iconAnchor: [10, 10]
        })
    }).addTo(map).bindPopup('Finish');
    
    // Fit bounds
    setTimeout(() => {
        map.fitBounds(routeLayer.getBounds(), {padding: [50, 50]});
    }, 100);
}

// ========== GALLERY CAROUSEL ==========
let currentIndex = 0;
const slides = document.querySelectorAll('.carousel-slide');
const totalSlides = slides.length;

function showSlide(index) {
    slides.forEach((slide, i) => {
        slide.classList.remove('active');
        if (i === index) {
            slide.classList.add('active');
        }
    });
    updateArrowColors();
}

function nextSlide() {
    currentIndex = (currentIndex + 1) % totalSlides;
    showSlide(currentIndex);
}

function prevSlide() {
    currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
    showSlide(currentIndex);
}

function updateArrowColors() {
    const prevBtn = document.querySelector('.carousel-btn.prev');
    const nextBtn = document.querySelector('.carousel-btn.next');
    const activeImg = document.querySelector('.carousel-slide.active');
    
    if (!activeImg || !prevBtn || !nextBtn) return;
    
    const canvas = document.createElement('canvas');
    const ctx = canvas.getContext('2d');
    const img = new Image();
    img.crossOrigin = 'Anonymous';
    
    img.onload = function() {
        canvas.width = img.width;
        canvas.height = img.height;
        
        try {
            ctx.drawImage(img, 0, 0);
            
            // Sample left side
            const leftX = Math.floor(canvas.width * 0.1);
            const leftY = Math.floor(canvas.height * 0.5);
            const leftData = ctx.getImageData(leftX, leftY, 1, 1).data;
            const leftBright = (leftData[0] + leftData[1] + leftData[2]) / 3;
            
            // Sample right side
            const rightX = Math.floor(canvas.width * 0.9);
            const rightY = Math.floor(canvas.height * 0.5);
            const rightData = ctx.getImageData(rightX, rightY, 1, 1).data;
            const rightBright = (rightData[0] + rightData[1] + rightData[2]) / 3;
            
            // Set prev button colors
            if (leftBright > 128) {
                prevBtn.style.background = 'rgba(0, 0, 0, 0.6)';
                prevBtn.style.color = 'white';
            } else {
                prevBtn.style.background = 'rgba(255, 255, 255, 0.6)';
                prevBtn.style.color = 'black';
            }
            
            // Set next button colors
            if (rightBright > 128) {
                nextBtn.style.background = 'rgba(0, 0, 0, 0.6)';
                nextBtn.style.color = 'white';
            } else {
                nextBtn.style.background = 'rgba(255, 255, 255, 0.6)';
                nextBtn.style.color = 'black';
            }
        } catch(e) {
            // Fallback
            prevBtn.style.background = 'rgba(0, 0, 0, 0.6)';
            prevBtn.style.color = 'white';
            nextBtn.style.background = 'rgba(0, 0, 0, 0.6)';
            nextBtn.style.color = 'white';
        }
    };
    
    img.src = activeImg.src;
}

// Auto slide every 5 seconds
let autoSlide = setInterval(nextSlide, 5000);

// Pause on hover
const carousel = document.querySelector('.gallery-carousel');
if (carousel) {
    carousel.addEventListener('mouseenter', () => {
        clearInterval(autoSlide);
    });
    
    carousel.addEventListener('mouseleave', () => {
        autoSlide = setInterval(nextSlide, 5000);
    });
}

// Initialize
if (slides.length > 0) {
    showSlide(0);
}

// ========== NOTIFICATION ==========
setTimeout(() => {
    const toast = document.querySelector('.notification-toast.show');
    if (toast) {
        toast.style.bottom = '-100px';
    }
}, 3000);

// ========== NAVBAR SCROLL ==========
window.addEventListener('scroll', () => {
    const navbar = document.getElementById('navbar');
    if (window.scrollY > 100) {
        navbar.style.boxShadow = '0 4px 20px rgba(0, 0, 0, 0.25)';
    } else {
        navbar.style.boxShadow = '0 2px 10px rgba(0, 0, 0, 0.1)';
    }
});

// ========== SMOOTH SCROLL ==========
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        const href = this.getAttribute('href');
        if (href !== '#' && href.startsWith('#')) {
            e.preventDefault();
            const target = document.querySelector(href);
            if (target) {
                const navbar = document.getElementById('navbar');
                const offset = navbar.offsetHeight;
                const targetPos = target.offsetTop - offset;
                window.scrollTo({
                    top: targetPos,
                    behavior: 'smooth'
                });
            }
        }
    });
});