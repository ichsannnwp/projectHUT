// Modal Functions
function openModal() {
    document.getElementById('registerModal').style.display = 'flex';
}

function closeModal() {
    document.getElementById('registerModal').style.display = 'none';
    // Remove error parameter from URL
    if(window.location.href.includes('?')) {
        window.location.href = window.location.pathname + window.location.hash;
    }
}

window.onclick = function(event) {
    const modal = document.getElementById('registerModal');
    if (event.target === modal) {
        closeModal();
    }
}

// Route Map Functions
let map;
let currentRoute = null;

const routes = {
    '5K': {
        center: [-7.7956, 110.3695],
        zoom: 14,
        path: [
            [-7.8110, 110.3645],
            [-7.8050, 110.3670],
            [-7.7990, 110.3690],
            [-7.7956, 110.3695],
            [-7.7920, 110.3710],
            [-7.7880, 110.3730]
        ]
    },
    '10K': {
        center: [-7.7500, 110.4000],
        zoom: 13,
        path: [
            [-7.7700, 110.3800],
            [-7.7600, 110.3900],
            [-7.7500, 110.4000],
            [-7.7400, 110.4100],
            [-7.7300, 110.4200]
        ]
    },
    'Half': {
        center: [-7.8500, 110.4000],
        zoom: 12,
        path: [
            [-7.8000, 110.3700],
            [-7.8200, 110.3800],
            [-7.8500, 110.4000],
            [-7.8700, 110.4200],
            [-7.9000, 110.4400]
        ]
    }
};

function showMap(routeType) {
    const routeCards = document.getElementById('routeCards');
    const routeMapContainer = document.getElementById('routeMapContainer');
    
    routeCards.classList.add('shifted');
    routeMapContainer.classList.add('active');
    
    // Initialize map if not already initialized
    if (!map) {
        map = L.map('map');
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);
    }
    
    // Update map view and route
    const route = routes[routeType];
    map.setView(route.center, route.zoom);
    
    // Remove previous route if exists
    if (currentRoute) {
        map.removeLayer(currentRoute);
    }
    
    // Draw new route
    currentRoute = L.polyline(route.path, {
        color: '#0066cc',
        weight: 5,
        opacity: 0.7
    }).addTo(map);
    
    // Add markers for start and finish
    L.marker(route.path[0]).addTo(map)
        .bindPopup('Start')
        .openPopup();
    
    L.marker(route.path[route.path.length - 1]).addTo(map)
        .bindPopup('Finish');
}

// Gallery Carousel
let currentSlide = 0;
const slides = document.querySelectorAll('.carousel-image');

function showSlide(index) {
    slides.forEach((slide, i) => {
        slide.classList.remove('active');
        if (i === index) {
            slide.classList.add('active');
        }
    });
    updateCarouselButtons();
}

function changeSlide(direction) {
    currentSlide += direction;
    
    if (currentSlide >= slides.length) {
        currentSlide = 0;
    } else if (currentSlide < 0) {
        currentSlide = slides.length - 1;
    }
    
    showSlide(currentSlide);
}

function updateCarouselButtons() {
    const prevBtn = document.querySelector('.carousel-btn.prev');
    const nextBtn = document.querySelector('.carousel-btn.next');
    const activeImage = document.querySelector('.carousel-image.active');
    
    if (activeImage && prevBtn && nextBtn) {
        // Get average brightness of image to determine button color
        const canvas = document.createElement('canvas');
        const ctx = canvas.getContext('2d');
        canvas.width = activeImage.width;
        canvas.height = activeImage.height;
        
        try {
            ctx.drawImage(activeImage, 0, 0);
            
            // Sample colors from button positions
            const leftSample = ctx.getImageData(50, canvas.height/2, 1, 1).data;
            const rightSample = ctx.getImageData(canvas.width - 50, canvas.height/2, 1, 1).data;
            
            const leftBrightness = (leftSample[0] + leftSample[1] + leftSample[2]) / 3;
            const rightBrightness = (rightSample[0] + rightSample[1] + rightSample[2]) / 3;
            
            prevBtn.style.background = leftBrightness > 128 ? 'rgba(0, 0, 0, 0.5)' : 'rgba(255, 255, 255, 0.5)';
            prevBtn.style.color = leftBrightness > 128 ? 'white' : 'black';
            
            nextBtn.style.background = rightBrightness > 128 ? 'rgba(0, 0, 0, 0.5)' : 'rgba(255, 255, 255, 0.5)';
            nextBtn.style.color = rightBrightness > 128 ? 'white' : 'black';
        } catch(e) {
            // Fallback to default if CORS issues
            prevBtn.style.background = 'rgba(0, 0, 0, 0.5)';
            prevBtn.style.color = 'white';
            nextBtn.style.background = 'rgba(0, 0, 0, 0.5)';
            nextBtn.style.color = 'white';
        }
    }
}

// Auto-play carousel
setInterval(() => {
    changeSlide(1);
}, 5000);

// Initialize carousel on page load
if (slides.length > 0) {
    showSlide(0);
}

// Notification auto-hide
setTimeout(() => {
    const notification = document.querySelector('.notification.show');
    if (notification) {
        notification.classList.remove('show');
    }
}, 3000);

// Navbar scroll effect
window.addEventListener('scroll', () => {
    const navbar = document.getElementById('navbar');
    if (window.scrollY > 100) {
        navbar.style.boxShadow = '0 4px 20px rgba(0, 0, 0, 0.2)';
    } else {
        navbar.style.boxShadow = '0 2px 10px rgba(0, 0, 0, 0.1)';
    }
});