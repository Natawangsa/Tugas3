<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Speda - Tambah Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <div class="container">
            <a href="home.php" class="brand">Speda</a>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="tambah.php" class="active">Tambah Mahasiswa</a></li>
            </ul>
        </div>
    </nav>

    <div class="container main-content">
        <h1>Tambah Mahasiswa</h1>
        
        <form action="logic/createLogic.php" method="POST" class="add-form">
            <div class="form-group">
                <label for="nim">NIM</label>
                <input type="text" id="nim" name="nim" required>
            </div>
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" id="nama" name="nama" required>
            </div>
            <div class="form-group">
                <label>Jenis Kelamin</label>
                <div class="radio-group">
                    <input type="radio" id="laki" name="jenisKelamin" value="Laki-Laki" required>
                    <label for="laki">Laki-Laki</label>
                    <input type="radio" id="perempuan" name="jenisKelamin" value="Perempuan">
                    <label for="perempuan">Perempuan</label>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-submit">Tambah</button>
                <a href="home.php" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</body>
</html>