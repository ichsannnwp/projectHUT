// --- 1. Fungsi Scroll to Top ---
function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}

// --- 2. Efek Navbar Berubah Warna Saat Scroll ---
window.addEventListener('scroll', function() {
    const navbar = document.querySelector('.navbar');
    // Cek apakah navbar ada untuk menghindari error di halaman lain
    if (navbar) {
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    }
});

console.log("YKC Festival Website Ready!");

/* --- 3. LOGIKA CAROUSEL / SLIDER --- */
// Kita hanya deklarasikan variabel ini SATU KALI saja
const container = document.querySelector('.cards-container');
const btnLeft = document.querySelector('.nav-arrow.left');
const btnRight = document.querySelector('.nav-arrow.right');

// Cek apakah elemen ditemukan sebelum menjalankan fungsi
if (container && btnLeft && btnRight) {
    
    // Fungsi tombol Kanan (Geser Maju)
    btnRight.addEventListener('click', () => {
        container.scrollBy({
            left: 330, // Angka ini sesuaikan dengan lebar kartu + gap
            behavior: 'smooth'
        });
    });

    // Fungsi tombol Kiri (Geser Mundur)
    btnLeft.addEventListener('click', () => {
        container.scrollBy({
            left: -330, 
            behavior: 'smooth'
        });
    });
}