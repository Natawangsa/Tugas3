<?php
include 'connection.php';

$search = isset($_GET['search']) ? $_GET['search'] : '';
$sql = "SELECT * FROM mahasiswa";

if (!empty($search)) {
    $sql .= " WHERE nama LIKE '%" . $koneksi->real_escape_string($search) . "%'";
}

$sql .= " ORDER BY created_at DESC";
$result = $koneksi->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Speda - Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <div class="container">
            <a href="home.php" class="brand">Speda</a>
            <ul>
                <li><a href="home.php" class="active">Home</a></li>
                <li><a href="tambah.php">Tambah Mahasiswa</a></li>
            </ul>
        </div>
    </nav>

    <div class="container main-content">
        <h1>Daftar Mahasiswa</h1>
        
        <form method="GET" action="home.php" class="search-bar">
            <input type="text" name="search" placeholder="Cari Nama Mahasiswa..." 
                   value="<?= htmlspecialchars($search) ?>">
            <button type="submit">Cari</button>
        </form>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php $no = 1; ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($row['nim']) ?></td>
                        <td><?= htmlspecialchars($row['nama']) ?></td>
                        <td><?= htmlspecialchars($row['jenis_kelamin']) ?></td>
                        <td>
                            <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-update">Update</a>
                            <button class="btn btn-delete" 
                                    onclick="showDeleteModal(<?= $row['id'] ?>, '<?= htmlspecialchars($row['nama']) ?>')">
                                Delete
                            </button>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" style="text-align: center;">Tidak ada data</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <h2>Hapus Data</h2>
            <p>Apakah anda yakin menghapus data mahasiswa: <span id="namaMahasiswa"></span>?</p>
            <div class="modal-actions">
                <button id="confirmDelete" class="btn btn-delete">Hapus</button>
                <button id="cancelDelete" class="btn btn-secondary">Batal</button>
            </div>
        </div>
    </div>

    <script>
        let mahasiswaIdToDelete = null;
        
        function showDeleteModal(id, nama) {
            mahasiswaIdToDelete = id;
            document.getElementById('namaMahasiswa').textContent = nama;
            document.getElementById('deleteModal').style.display = 'flex';
        }
        
        document.getElementById('confirmDelete').addEventListener('click', function() {
            if (mahasiswaIdToDelete) {
                window.location.href = 'logic/deleteLogic.php?id=' + mahasiswaIdToDelete;
            }
        });
        
        document.getElementById('cancelDelete').addEventListener('click', function() {
            document.getElementById('deleteModal').style.display = 'none';
            mahasiswaIdToDelete = null;
        });
        
        // Tutup modal ketika klik di luar
        window.addEventListener('click', function(event) {
            const modal = document.getElementById('deleteModal');
            if (event.target === modal) {
                modal.style.display = 'none';
                mahasiswaIdToDelete = null;
            }
        });
    </script>
</body>
</html>

<?php $koneksi->close(); ?>