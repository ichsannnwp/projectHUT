<?php
include "connection.php";

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
            <img src="logo.png" alt="JRF Logo" class="nav-logo">
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
        <video autoplay muted loop class="hero-video">
            <source src="marathon.mp4" type="video/mp4">
        </video>
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1 class="hero-title">JOGJA RUNNING<br>FESTIVAL</h1>
            <p class="hero-subtitle">Lari, Budaya, dan Pesta.</p>
            <p class="hero-description">Rasakan semangat berlari di jantung<br>kota istimewa, ukir cerita tak<br>terlupakan.</p>
            <button onclick="openModal()" class="btn-register-hero">DAFTAR SEKARANG</button>
        </div>
    </section>

    <!-- Section Rute -->
    <section id="route" class="route-section">
        <div class="container">
            <h2 class="section-title">Rute Perlombaan</h2>
            <div class="route-wrapper">
                <div class="route-cards" id="routeCards">
                    <div class="route-card" onclick="showMap('5K')">
                        <h3>5K Fun Run</h3>
                        <div class="route-date">
                            <span>📅</span>
                            <span>15 Desember 2025</span>
                        </div>
                        <div class="route-time">
                            <span>🕐</span>
                            <span>Pukul 06.00 WIB</span>
                        </div>
                        <p class="route-cta">Klik untuk lihat rute</p>
                    </div>

                    <div class="route-card" onclick="showMap('10K')">
                        <h3>10K Run</h3>
                        <div class="route-date">
                            <span>📅</span>
                            <span>16 Desember 2025</span>
                        </div>
                        <div class="route-time">
                            <span>🕐</span>
                            <span>Pukul 06.00 WIB</span>
                        </div>
                        <p class="route-cta">Klik untuk lihat rute</p>
                    </div>

                    <div class="route-card" onclick="showMap('Half')">
                        <h3>Half Marathon</h3>
                        <div class="route-date">
                            <span>📅</span>
                            <span>17 Desember 2025</span>
                        </div>
                        <div class="route-time">
                            <span>🕐</span>
                            <span>Pukul 06.00 WIB</span>
                        </div>
                        <p class="route-cta">Klik untuk lihat rute</p>
                    </div>
                </div>
                
                <div class="route-map-container" id="routeMapContainer">
                    <h3 class="map-title">Rute Perlombaan</h3>
                    <div class="route-sidebar">
                        <div class="route-sidebar-item" onclick="showMap('5K')">
                            <h4>5K<br>Fun Run</h4>
                            <p>Klik untuk lihat rute</p>
                        </div>
                        <div class="route-sidebar-item" onclick="showMap('10K')">
                            <h4>10K<br>Run</h4>
                            <p>Klik untuk lihat rute</p>
                        </div>
                        <div class="route-sidebar-item" onclick="showMap('Half')">
                            <h4>Half<br>Marathon</h4>
                            <p>Klik untuk lihat rute</p>
                        </div>
                    </div>
                    <div id="map" class="map"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Peserta -->
    <section id="participants" class="participants-section">
        <div class="container">
            <div class="participants-header">
                <h2 class="section-title">Peserta Lomba</h2>
                <button class="btn-add" onclick="openModal()">+ Daftar</button>
            </div>

            <?php if(mysqli_num_rows($result) > 0): ?>
            <div class="table-container">
                <table class="participants-table">
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
            <div class="empty-state">
                <p>Belum ada peserta terdaftar</p>
            </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Section Galeri -->
    <section id="gallery" class="gallery-section">
        <div class="container">
            <h2 class="section-title">Galeri</h2>
            <div class="carousel">
                <button class="carousel-btn prev" onclick="changeSlide(-1)">‹</button>
                <div class="carousel-container">
                    <img src="gallery1.jpg" alt="Marathon 1" class="carousel-image active">
                    <img src="gallery2.jpg" alt="Marathon 2" class="carousel-image">
                    <img src="gallery3.jpg" alt="Marathon 3" class="carousel-image">
                </div>
                <button class="carousel-btn next" onclick="changeSlide(1)">›</button>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <h3>Contact Us</h3>
            <div class="social-icons">
                <a href="#" class="social-icon">📘</a>
                <a href="#" class="social-icon">📷</a>
                <a href="https://wa.me/6281234567890" class="social-icon">💬</a>
            </div>
        </div>
    </footer>

    <!-- Modal Daftar -->
    <div id="registerModal" class="modal" style="display: <?= $showRegisterModal ? 'flex' : 'none'; ?>;">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Daftar Sekarang</h2>
                <span class="close" onclick="closeModal()">&times;</span>
            </div>
            
            <?php if(isset($_GET['error'])): ?>
                <div class="alert alert-danger">
                    <?php 
                    if($_GET['error'] == 'invalid_nik') echo "❌ NIK harus 16 digit angka!";
                    elseif($_GET['error'] == 'nik_exists') echo "❌ NIK sudah terdaftar!";
                    ?>
                </div>
            <?php endif; ?>

            <form action="logic/daftarPeserta.php" method="post" class="modal-form">
                <div class="form-group">
                    <label for="nama">Nama Lengkap :</label>
                    <input type="text" name="nama" id="nama" required>
                </div>
                
                <div class="form-group">
                    <label for="nik">NIK (16 Digit) :</label>
                    <input type="text" name="nik" id="nik" pattern="[0-9]{16}" maxlength="16" required>
                </div>
                
                <div class="form-group">
                    <label for="no_tlp">Nomor Telepon :</label>
                    <input type="tel" name="no_tlp" id="no_tlp" required>
                </div>
                
                <div class="form-group">
                    <label for="alamat">Alamat :</label>
                    <textarea name="alamat" id="alamat" rows="3" required></textarea>
                </div>
                
                <div class="form-group">
                    <label for="kategori">Kategori :</label>
                    <select name="kategori" id="kategori" required>
                        <option value="">Pilih Kategori</option>
                        <option value="5K Fun Run">5K Fun Run</option>
                        <option value="10K Run">10K Run</option>
                        <option value="Half Marathon">Half Marathon</option>
                    </select>
                </div>
                
                <button type="submit" class="btn-submit">Kirim</button>
            </form>
        </div>
    </div>

    <?php if(isset($_SESSION['flash_success'])): ?>
    <div class="notification show">
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