<?php
include "../connection.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

$sql = "SELECT * FROM peserta ORDER BY created_at DESC";
$result = mysqli_query($koneksi, $sql);

$showRegisterModal = isset($_GET['show_modal']);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda - JRF</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar" id="navbar">
        <div class="nav-brand">
            <img src="../assets/jrfLogo.png" alt="JRF Logo" class="nav-logo">
            <span>Jogja Running Festival</span>
        </div>
        <div class="nav-links">
            <a href="#home">Beranda</a>
            <a href="#route">Rute</a>
            <a href="#participants">Peserta</a>
            <a href="#gallery">Galeri</a>
            <a href="logic/logout.php" class="btn-logout">LOGOUT</a>
        </div>
    </nav>

    <!-- Section Beranda -->
    <section id="home" class="hero-section">
        <div class="hero-content">
            <h1 class="hero-title">JOGJA RUNNING<br>FESTIVAL</h1>
            <p class="hero-subtitle">Lari, Budaya, dan Pesta.</p>
        </div>
        <div class="hero-bottom">
            <p class="hero-description">Rasakan semangat berlari di jantung<br>kota istimewa, ukir cerita tak<br>terlupakan.</p>
            <button onclick="openModal()" class="btn-register-hero">DAFTAR SEKARANG</button>
        </div>
    </section>

    <!-- Section Rute -->
    <section id="route" class="route-section">
        <div class="route-bg"></div>
        <div class="route-container">
            <h2 class="route-title">Rute Perlombaan</h2>
            
            <div class="route-layout" id="routeLayout">
                <!-- Route Cards -->
                <div class="route-cards-wrapper" id="routeCardsWrapper">
                    <div class="route-box" onclick="selectRoute('5K')">
                        <h3>5K Fun Run</h3>
                        <div class="route-detail">
                            <span>📅</span>
                            <span>15 Desember 2025</span>
                        </div>
                        <div class="route-detail">
                            <span>🕐</span>
                            <span>Pukul 06.00 WIB</span>
                        </div>
                        <p class="route-link">Klik untuk lihat rute</p>
                    </div>

                    <div class="route-box" onclick="selectRoute('10K')">
                        <h3>10K Run</h3>
                        <div class="route-detail">
                            <span>📅</span>
                            <span>16 Desember 2025</span>
                        </div>
                        <div class="route-detail">
                            <span>🕐</span>
                            <span>Pukul 06.00 WIB</span>
                        </div>
                        <p class="route-link">Klik untuk lihat rute</p>
                    </div>

                    <div class="route-box" onclick="selectRoute('Half')">
                        <h3>Half Marathon</h3>
                        <div class="route-detail">
                            <span>📅</span>
                            <span>17 Desember 2025</span>
                        </div>
                        <div class="route-detail">
                            <span>🕐</span>
                            <span>Pukul 06.00 WIB</span>
                        </div>
                        <p class="route-link">Klik untuk lihat rute</p>
                    </div>
                </div>

                <!-- Map Section -->
                <div class="route-map-wrapper" id="routeMapWrapper">
                    <h3 class="map-title">Rute Perlombaan</h3>
                    
                    <div class="map-content">
                        <div id="map" class="leaflet-map"></div>
                        
                        <div class="route-sidebar">
                            <div class="sidebar-item" onclick="selectRoute('5K')">
                                <h4>5K<br>Fun Run</h4>
                                <p>Klik untuk lihat rute</p>
                            </div>
                            <div class="sidebar-item" onclick="selectRoute('10K')">
                                <h4>10K<br>Run</h4>
                                <p>Klik untuk lihat rute</p>
                            </div>
                            <div class="sidebar-item" onclick="selectRoute('Half')">
                                <h4>Half<br>Marathon</h4>
                                <p>Klik untuk lihat rute</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Peserta -->
    <section id="participants" class="participants-section">
        <div class="container">
            <h2 class="section-title-white">Peserta Lomba</h2>

            <?php if(mysqli_num_rows($result) > 0): ?>
            <div class="table-box">
                <table class="table-peserta">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        while($data = mysqli_fetch_assoc($result)): 
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($data['nama']); ?></td>
                            <td><?= htmlspecialchars($data['kategori']); ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <?php else: ?>
            <div class="empty-box">
                <p>Belum ada peserta terdaftar</p>
            </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Section Galeri -->
    <section id="gallery" class="gallery-section">
        <div class="container">
            <h2 class="section-title">Galeri</h2>
            <div class="gallery-carousel">
                <button class="carousel-btn prev" onclick="prevSlide()">‹</button>
                <div class="carousel-track">
                    <img src="https://thumb.viva.co.id/media/frontend/thumbs3/2023/10/24/6537a47134f55-hibank-jakarta-marathon-2023-powered-by-le-minerale_1265_711.jpg" alt="Marathon Event 1" class="carousel-slide active">
                    <img src="https://www.barnardos.org.uk/sites/default/files/2023-03/london-marathon-woman-runner-hands-up-jodie-challenge-events-march2023.jpg" alt="Marathon Event 2" class="carousel-slide">
                    <img src="https://www.justrunlah.com/wp-content/uploads/2016/07/standard-chartered-kl-marathon.jpg" alt="Marathon Event 3" class="carousel-slide">
                </div>
                <button class="carousel-btn next" onclick="nextSlide()">›</button>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <h3>Contact Us</h3>
            <div class="footer-icons">
                <a href="#" class="footer-icon">📘</a>
                <a href="#" class="footer-icon">📷</a>
                <a href="https://wa.me/6281234567890" class="footer-icon">💬</a>
            </div>
        </div>
    </footer>

    <!-- Modal Daftar -->
    <div id="registerModal" class="modal-overlay" style="display: <?= $showRegisterModal ? 'flex' : 'none'; ?>;">
        <div class="modal-box">
            <div class="modal-header">
                <h2>Daftar Sekarang</h2>
                <span class="modal-close" onclick="closeModal()">&times;</span>
            </div>
            
            <?php if(isset($_GET['error'])): ?>
                <div class="alert-error">
                    <?php 
                    if($_GET['error'] == 'invalid_nik') echo "❌ NIK harus 16 digit angka!";
                    elseif($_GET['error'] == 'nik_exists') echo "❌ NIK sudah terdaftar!";
                    ?>
                </div>
            <?php endif; ?>

            <form action="logic/daftarPeserta.php" method="post" class="modal-form">
                <div class="form-input">
                    <label for="nama">Nama Lengkap :</label>
                    <input type="text" name="nama" id="nama" required>
                </div>
                
                <div class="form-input">
                    <label for="nik">NIK (16 Digit) :</label>
                    <input type="text" name="nik" id="nik" pattern="[0-9]{16}" maxlength="16" required>
                </div>
                
                <div class="form-input">
                    <label for="no_tlp">Nomor Telepon :</label>
                    <input type="tel" name="no_tlp" id="no_tlp" required>
                </div>
                
                <div class="form-input">
                    <label for="alamat">Alamat :</label>
                    <textarea name="alamat" id="alamat" rows="3" required></textarea>
                </div>
                
                <div class="form-input">
                    <label for="kategori">Kategori :</label>
                    <select name="kategori" id="kategori" required>
                        <option value="">Pilih Kategori</option>
                        <option value="5K Fun Run">5K Fun Run</option>
                        <option value="10K Run">10K Run</option>
                        <option value="Half Marathon">Half Marathon</option>
                    </select>
                </div>
                
                <button type="submit" class="btn-submit-form">Kirim</button>
            </form>
        </div>
    </div>

    <?php if(isset($_SESSION['flash_success'])): ?>
    <div class="notification-toast show">
        ✅ <?= $_SESSION['flash_success']; ?>
    </div>
    <?php 
    unset($_SESSION['flash_success']);
    endif; 
    ?>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="script.js"></script>
</body>
</html>