<?php
include 'connection.php';

if (!isset($_GET['id'])) {
    header("Location: home.php");
    exit();
}

$id = $_GET['id'];
$sql = "SELECT * FROM mahasiswa WHERE id = ?";
$stmt = $koneksi->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if (!$data) {
    header("Location: home.php");
    exit();
}
$stmt->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Speda - Update Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <div class="container">
            <a href="home.php" class="brand">Speda</a>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="tambah.php">Tambah Mahasiswa</a></li>
            </ul>
        </div>
    </nav>

    <div class="container main-content">
        <h1>Update Mahasiswa</h1>
        
        <form action="logic/updateLogic.php" method="POST" class="add-form">
            <input type="hidden" name="id" value="<?= $data['id'] ?>">
            
            <div class="form-group">
                <label for="nim">NIM</label>
                <input type="text" id="nim" name="nim" value="<?= htmlspecialchars($data['nim']) ?>" required>
            </div>
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" id="nama" name="nama" value="<?= htmlspecialchars($data['nama']) ?>" required>
            </div>
            <div class="form-group">
                <label>Jenis Kelamin</label>
                <div class="radio-group">
                    <input type="radio" id="laki" name="jenisKelamin" value="Laki-Laki" 
                           <?= $data['jenis_kelamin'] == 'Laki-Laki' ? 'checked' : '' ?> required>
                    <label for="laki">Laki-Laki</label>
                    <input type="radio" id="perempuan" name="jenisKelamin" value="Perempuan"
                           <?= $data['jenis_kelamin'] == 'Perempuan' ? 'checked' : '' ?>>
                    <label for="perempuan">Perempuan</label>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-submit">Update</button>
                <a href="home.php" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</body>
</html>

<?php $koneksi->close(); ?>