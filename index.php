<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YKC Festival - Hari Jadi Yogyakarta Ke 270</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=Montserrat:wght@400;700;900&display=swap" rel="stylesheet">
</head>
<body>

    <nav class="navbar">
        <div class="logo">
            <span class="ykc-yellow">YKC</span>
            <span class="festival-pink">Festival</span>
        </div>
        
        <ul class="nav-links">
            <li><a href="#home" class="active">Home</a></li>
            <li><a href="#event">Event</a></li>
            <li><a href="#gallery">Galery</a></li>
        </ul>

        <a href="#event-btn" class="btn-rect-pink">Event</a>
    </nav>

    <section class="hero">
        <video autoplay muted loop playsinline class="bg-video">
            <source src="bg web.mp4" type="video/mp4">
            Browser Anda tidak mendukung tag video.
        </video>

        <div class="hero-overlay"></div>

        <div class="hero-content">
            <h1 class="main-title">HARI JADI YOGYAKARTA<br>KE 270</h1>
            <p class="sub-title">"Nyawiji, Ngayomi, Ngayemi"</p>
            <a href="#" class="btn-rect-pink btn-large">LIHAT DETAIL</a>
        </div>

        <div class="bottom-social">
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-youtube"></i></a>
            <a href="#"><i class="fab fa-whatsapp"></i></a>
            <a href="#"><i class="fab fa-facebook-f"></i></a>
        </div>

        <div class="bottom-corner-box"></div>
    </section>

    <section id="event" class="event-section">
        
        <div class="container">
            <div class="event-image">
                <img src="YRC.jpg" alt="Yogyakarta Royal Orchestra">
                <div class="blob-decoration"></div> 
            </div>

            <div class="event-text">
                <h2 class="royal-title">Yogyakarta Royal <br> Orchestra</h2>
                <p class="royal-desc">
                    Yogyakarta Royal Orchestra (YRO) adalah orkestra resmi Keraton Ngayogyakarta Hadiningrat yang bertugas melestarikan dan mengembangkan musik klasik Keraton (Langen Swara). Keistimewaannya terletak pada perpaduan harmonis antara instrumen Barat (biola, cello) dan instrumen tradisional Jawa (gambang, siter).
                </p>
                <a href="#" class="btn-rect-pink shadow-style">TONTON SEKARANG</a>
            </div>
        </div>

        <div class="event-footer">
            <div class="social-box-pink">
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
                <a href="#"><i class="fab fa-whatsapp"></i></a>
                <a href="#"><i class="fab fa-facebook-f"></i></a>
            </div>

            <button onclick="scrollToTop()" class="scroll-up-btn">
                <i class="fas fa-arrow-up"></i>
            </button>
        </div>

    </section>

    <section class="schedule-section">
        
        <div class="bg-star-pattern"></div>

        <div class="schedule-container">
            <div class="section-header">
                <h2 class="schedule-title">JADWAL EVENT</h2>
                <p class="schedule-subtitle">Ikuti dan jadi bagian dari YKC Festival</p>
            </div>

            <div class="slider-wrapper">
                
                <button class="nav-arrow left"><i class="fas fa-arrow-left"></i></button>

                <div class="cards-container">
                    
                    <div class="event-card card-blue">
                        <div class="date-badge">10 OKTOBER</div>
                        <h3>JOGJA RUNNING FESTIVAL</h3>
                        <p class="location">LOKASI : TITIK NOL<br>GRATIS UNTUK UMUM</p>
                        <a href="#" class="btn-card">DAFTAR SEKARANG</a>
                    </div>

                    <div class="event-card card-orange">
                        <div class="date-badge">11 OKTOBER</div>
                        <h3>YOGYAKARTA ROYAL ORCHESTRA</h3>
                        <p class="location">LOKASI : TITIK NOL<br>GRATIS UNTUK UMUM</p>
                        <a href="#" class="btn-card">LIHAT DETAIL</a>
                    </div>

                    <div class="event-card card-pink">
                        <div class="date-badge">9 OKTOBER</div>
                        <h3>WAYANG JOGJA NIGHT CARNIVAL</h3>
                        <p class="location">LOKASI : TUGU PAL JOGJA<br>GRATIS UNTUK UMUM</p>
                        <a href="#" class="btn-card">LIHAT DETAIL</a>
                    </div>

                </div>

                <button class="nav-arrow right"><i class="fas fa-arrow-right"></i></button>
            </div>
        </div>

        <div class="schedule-footer">
            <div class="social-box-yellow">
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
                <a href="#"><i class="fab fa-whatsapp"></i></a>
                <a href="#"><i class="fab fa-facebook-f"></i></a>
            </div>
            <button onclick="scrollToTop()" class="scroll-up-btn-yellow">
                <i class="fas fa-arrow-up"></i>
            </button>
        </div>

    </section>

    <section id="about" class="about-section">
        
        <div class="about-container">
            <div class="about-image-wrapper">
                <div class="purple-backdrop"></div>
                <img src="jogja ykc.jpg" alt="Ilustrasi Yogyakarta" class="framed-image">
            </div>

            <div class="about-text">
                <p>
                    "YKC" merupakan akronim yang populer di kalangan anak muda dan komunitas hip-hop di Yogyakarta, yang maknanya sering diinterpretasikan sebagai <strong>Yogyakarta King Community</strong> atau sekadar singkatan gaul untuk merujuk pada Kota Yogyakarta itu sendiri. Istilah ini mulai dikenal luas dan dipopulerkan melalui karya-karya musisi lokal, terutama grup hip-hop seperti BlocCalito 782 dan rapper kembar Fandaw Fandow, yang menggunakan "YKC" dalam judul lagu dan lirik mereka untuk menceritakan kehidupan, semangat, dan jatuh bangun seniman muda yang berkarya di kota tersebut. Dengan demikian, YKC bukanlah organisasi formal, melainkan sebuah identitas kultural dan branding yang mewakili komunitas, semangat kreativitas, dan rasa bangga anak muda Yogyakarta.
                </p>
            </div>
        </div>

        <div class="about-footer">
            <div class="social-box-yellow-purple">
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
                <a href="#"><i class="fab fa-whatsapp"></i></a>
                <a href="#"><i class="fab fa-facebook-f"></i></a>
            </div>

            <button onclick="scrollToTop()" class="scroll-up-btn-yellow-purple">
                <i class="fas fa-arrow-up"></i>
            </button>
        </div>

    </section>



    <script src="script.js"></script>
</body>
</html>