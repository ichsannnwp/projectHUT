<?php
// --- BAGIAN 1: LOGIK PHP & DATA SIMULASI ---

// 1. Data Simulasi Admin (Nanti ambil dari Database table 'users')
$current_user = [
    'id' => 1,
    'username' => 'admin_festival',
    'password' => 'rahasia123' // Catatan: Di produksi, password harus di-hash (dienkripsi)
];

// 2. Data Simulasi Peserta Lari (Nanti ambil dari Database table 'peserta')
$data_peserta = [
    [
        'nama' => 'Andi Saputra',
        'nik' => '3201123456789001',
        'hp' => '081234567890',
        'alamat' => 'Jl. Sudirman No. 12, Jakarta',
        'kategori' => '10K Run'
    ],
    [
        'nama' => 'Siti Nurhaliza',
        'nik' => '3276123456789002',
        'hp' => '081298765432',
        'alamat' => 'Jl. Kebon Jeruk, Bandung',
        'kategori' => '5K Fun Run'
    ],
    [
        'nama' => 'Budi Doremi',
        'nik' => '3174123456789003',
        'hp' => '085712345678',
        'alamat' => 'Jl. Merdeka, Surabaya',
        'kategori' => 'Half Marathon'
    ],
    [
        'nama' => 'Citra Kirana',
        'nik' => '3512123456789004',
        'hp' => '081345678901',
        'alamat' => 'Jl. Melati, Yogyakarta',
        'kategori' => '5K Fun Run'
    ]
];

// 3. Menghitung Statistik Sederhana
$total_peserta = count($data_peserta);
$count_5k = 0;
$count_10k = 0;
$count_hm = 0;

foreach ($data_peserta as $p) {
    if ($p['kategori'] == '5K Fun Run') $count_5k++;
    elseif ($p['kategori'] == '10K Run') $count_10k++;
    elseif ($p['kategori'] == 'Half Marathon') $count_hm++;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Festival Lari</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #ff5722; /* Warna Oranye Lari */
            --dark: #2d3436;
            --light: #f1f2f6;
            --sidebar-width: 260px;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', sans-serif; }
        
        body { display: flex; background-color: var(--light); min-height: 100vh; }

        /* Sidebar */
        .sidebar {
            width: var(--sidebar-width);
            background: var(--dark);
            color: white;
            position: fixed;
            height: 100%;
        }
        .brand {
            padding: 20px;
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            border-bottom: 1px solid #636e72;
            color: var(--primary);
        }
        .menu { list-style: none; margin-top: 20px; }
        .menu a {
            display: flex; align-items: center;
            padding: 15px 25px;
            color: #b2bec3;
            text-decoration: none;
            transition: 0.3s;
        }
        .menu a:hover, .menu a.active { background: var(--primary); color: white; }
        .menu i { margin-right: 15px; width: 20px; }

        /* Main Content */
        .main {
            margin-left: var(--sidebar-width);
            flex: 1;
            padding: 30px;
        }

        /* Profile Card (User Info) */
        .profile-section {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-left: 5px solid var(--primary);
        }
        .user-details h4 { color: #636e72; font-size: 14px; margin-bottom: 5px; }
        .user-details span { font-weight: bold; color: var(--dark); margin-right: 15px; }
        .badge-role { background: #ffeaa7; color: #d35400; padding: 2px 8px; border-radius: 4px; font-size: 12px; }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        .card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            text-align: center;
        }
        .card h3 { font-size: 36px; color: var(--dark); margin-bottom: 5px; }
        .card p { color: #636e72; font-size: 14px; }
        .card.highlight { border-top: 4px solid var(--primary); }

        /* Table Styles */
        .table-wrapper {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.05);
        }
        .table-header { margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center; }
        
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { padding: 12px 15px; text-align: left; border-bottom: 1px solid #dfe6e9; }
        th { background: #f8f9fa; color: #636e72; font-weight: 600; }
        tr:hover { background-color: #f1f2f6; }

        /* Category Labels */
        .cat-label { padding: 5px 10px; border-radius: 20px; font-size: 12px; font-weight: bold; color: white; }
        .cat-5k { background-color: #00b894; } /* Green */
        .cat-10k { background-color: #0984e3; } /* Blue */
        .cat-hm { background-color: #d63031; } /* Red */

    </style>
</head>
<body>

    <div class="sidebar">
        <div class="brand"><i class="fas fa-running"></i> RUN FEST</div>
        <ul class="menu">
            <li><a href="#" class="active"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li><a href="#"><i class="fas fa-users"></i> Data Peserta</a></li>
            <li><a href="#"><i class="fas fa-user-cog"></i> Admin Profile</a></li>
            <li><a href="#"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </div>

    <div class="main">
        
        <div class="profile-section">
            <div>
                <h3><i class="fas fa-user-shield"></i> Status Login</h3>
                <p>Anda login sebagai administrator utama.</p>
            </div>
            <div class="user-data">
                <div class="user-details">
                    ID: <span>#<?php echo $current_user['id']; ?></span> | 
                    Username: <span><?php echo $current_user['username']; ?></span> | 
                    Password: <span style="font-family: monospace; background: #eee; padding: 2px 5px;"><?php echo $current_user['password']; ?></span>
                    <span class="badge-role">Admin</span>
                </div>
            </div>
        </div>

        <div class="stats-grid">
            <div class="card highlight">
                <h3><?php echo $total_peserta; ?></h3>
                <p>Total Peserta</p>
            </div>
            <div class="card">
                <h3 style="color: #00b894;"><?php echo $count_5k; ?></h3>
                <p>Peserta 5K</p>
            </div>
            <div class="card">
                <h3 style="color: #0984e3;"><?php echo $count_10k; ?></h3>
                <p>Peserta 10K</p>
            </div>
            <div class="card">
                <h3 style="color: #d63031;"><?php echo $count_hm; ?></h3>
                <p>Half Marathon</p>
            </div>
        </div>

        <div class="table-wrapper">
            <div class="table-header">
                <h2>Daftar Peserta Terdaftar</h2>
                <button style="padding: 10px 20px; background: var(--primary); color: white; border: none; border-radius: 5px; cursor: pointer;">
                    <i class="fas fa-print"></i> Export Data
                </button>
            </div>
            
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Lengkap</th>
                        <th>NIK (16 Digit)</th>
                        <th>No. HP</th>
                        <th>Alamat</th>
                        <th>Kategori Lari</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    foreach ($data_peserta as $row): 
                        // Logika warna label kategori
                        $badge_class = '';
                        if($row['kategori'] == '5K Fun Run') $badge_class = 'cat-5k';
                        elseif($row['kategori'] == '10K Run') $badge_class = 'cat-10k';
                        else $badge_class = 'cat-hm';
                    ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><strong><?php echo $row['nama']; ?></strong></td>
                        <td><?php echo $row['nik']; ?></td>
                        <td><?php echo $row['hp']; ?></td>
                        <td><?php echo $row['alamat']; ?></td>
                        <td><span class="cat-label <?php echo $badge_class; ?>"><?php echo $row['kategori']; ?></span></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>

</body>
</html>