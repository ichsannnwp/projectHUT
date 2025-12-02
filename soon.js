// Animasi Fade In saat load
document.addEventListener("DOMContentLoaded", () => {
    const content = document.querySelector('.content-box');
    content.style.opacity = 0;
    content.style.transform = 'translateY(20px)';
    content.style.transition = 'all 0.8s ease';

    setTimeout(() => {
        content.style.opacity = 1;
        content.style.transform = 'translateY(0)';
    }, 100);
});

// Fungsi Tombol Notifikasi
function kirimNotifikasi() {
    const emailInput = document.getElementById('userEmail');
    
    if(emailInput.value === "") {
        alert("Silakan isi email atau nomor WhatsApp dulu ya!");
    } else {
        alert("Terima kasih! Kami akan mengabari kamu saat info event ini rilis.");
        emailInput.value = ""; // Kosongkan form
    }
}