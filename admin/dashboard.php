<?php
include "../connection.php";

// Cek sesi admin
if(!isset($_SESSION['admin_logged_in'])){
    header("Location: login.php");
    exit;
}

// Ambil data peserta dari database
$sql = "SELECT * FROM peserta ORDER BY id DESC";
$result = mysqli_query($koneksi, $sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - JRF</title>
    <link rel="stylesheet" href="styleAdmin.css">
</head>
<body>

    <header class="admin-header">
        <div class="header-left">
            <img src="../assets/jrfLogo.png" alt="Logo">
            <h1>ADMIN JRF</h1>
        </div>
        <a href="logic/logout.php" class="btn-logout">LOGOUT</a>
    </header>

    <div class="content-wrapper">
        
        <?php if(isset($_GET['msg']) && $_GET['msg'] == 'updated'): ?>
            <div style="background: #d4edda; color: #155724; padding: 15px; margin-bottom: 20px; border: 1px solid #c3e6cb; border-radius: 5px;">
                ✅ Data berhasil diperbarui!
            </div>
        <?php endif; ?>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NAMA</th>
                        <th>NIK</th>
                        <th>NO TELP</th>
                        <th>ALAMAT</th>
                        <th>KATEGORI</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    if(mysqli_num_rows($result) > 0):
                        while($row = mysqli_fetch_assoc($result)): 
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= htmlspecialchars($row['nama']); ?></td>
                        <td><?= htmlspecialchars($row['nik']); ?></td>
                        <td><?= htmlspecialchars($row['no_tlp']); ?></td>
                        <td><?= htmlspecialchars($row['alamat']); ?></td>
                        <td><?= htmlspecialchars($row['kategori']); ?></td>
                        <td>
                            <button class="btn-aksi btn-edit" onclick="openEditModal(
                                '<?= $row['id'] ?>',
                                '<?= htmlspecialchars($row['nama'], ENT_QUOTES) ?>',
                                '<?= $row['nik'] ?>',
                                '<?= $row['no_tlp'] ?>',
                                '<?= htmlspecialchars($row['alamat'], ENT_QUOTES) ?>',
                                '<?= $row['kategori'] ?>'
                            )">EDIT</button>
                            
                            <a href="logic/deleteProcess.php?id=<?= $row['id']; ?>" 
                               class="btn-aksi btn-hapus"
                               onclick="return confirm('Yakin ingin menghapus data peserta ini?')">HAPUS</a>
                        </td>
                    </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                    <tr>
                        <td colspan="7">Belum ada data peserta.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div id="editModal" class="modal-overlay">
        <div class="modal-box">
            <h2 style="margin-bottom: 20px; text-align: center;">Edit Data Peserta</h2>
            <form action="logic/updateProcess.php" method="POST" class="modal-form">
                <input type="hidden" name="id" id="edit_id">
                
                <label>Nama Lengkap :</label>
                <input type="text" name="nama" id="edit_nama" required>

                <label>NIK (16 Digit) :</label>
                <input type="text" name="nik" id="edit_nik" maxlength="16" required>

                <label>Nomor Telepon :</label>
                <input type="text" name="no_tlp" id="edit_tlp" required>

                <label>Alamat :</label>
                <textarea name="alamat" id="edit_alamat" rows="3" required></textarea>

                <label>Kategori :</label>
                <select name="kategori" id="edit_kategori">
                    <option value="5K Fun Run">5K Fun Run</option>
                    <option value="10K Run">10K Run</option>
                    <option value="Half Marathon">Half Marathon</option>
                </select>

                <div style="margin-top: 20px; display: flex; justify-content: flex-end; gap: 10px;">
                    <button type="button" onclick="document.getElementById('editModal').style.display='none'" style="background: #6c757d; color: white; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer;">Batal</button>
                    <button type="submit" class="btn-save">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openEditModal(id, nama, nik, tlp, alamat, kategori) {
            document.getElementById('editModal').style.display = 'flex';
            document.getElementById('edit_id').value = id;
            document.getElementById('edit_nama').value = nama;
            document.getElementById('edit_nik').value = nik;
            document.getElementById('edit_tlp').value = tlp;
            document.getElementById('edit_alamat').value = alamat;
            document.getElementById('edit_kategori').value = kategori;
        }

        window.onclick = function(event) {
            const modal = document.getElementById('editModal');
            if (event.target === modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>
</html>