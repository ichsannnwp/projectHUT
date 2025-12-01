// script.js
console.log("YKC Festival Website Loaded");

// Anda bisa menambahkan interaksi di sini nanti.
// Contoh: Jika ingin navbar berubah warna saat discroll

window.addEventListener('scroll', function() {
    const navbar = document.querySelector('.navbar');
    if (window.scrollY > 50) {
        navbar.style.background = 'rgba(26, 26, 64, 0.9)'; // Biru gelap solid
    } else {
        navbar.style.background = 'transparent';
    }
});
// Fungsi Scroll to Top
function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}