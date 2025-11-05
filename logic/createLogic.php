<?php
include '../connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $jenisKelamin = $_POST['jenisKelamin'];
    
    // Cek apakah NIM sudah ada
    $checkSql = "SELECT id FROM mahasiswa WHERE nim = ?";
    $checkStmt = $koneksi->prepare($checkSql);
    $checkStmt->bind_param("s", $nim);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();
    
    if ($checkResult->num_rows > 0) {
        echo "<script>alert('NIM sudah terdaftar!'); window.history.back();</script>";
        exit();
    }
    
    // Insert data baru
    $sql = "INSERT INTO mahasiswa (nim, nama, jenis_kelamin) VALUES (?, ?, ?)";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("sss", $nim, $nama, $jenisKelamin);
    
    if ($stmt->execute()) {
        header("Location: ../home.php");
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
    $checkStmt->close();
}

$koneksi->close();
?>