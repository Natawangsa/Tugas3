<?php
include '../connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $jenisKelamin = $_POST['jenisKelamin'];
    
    // Cek apakah NIM sudah ada (kecuali untuk data yang sama)
    $checkSql = "SELECT id FROM mahasiswa WHERE nim = ? AND id != ?";
    $checkStmt = $koneksi->prepare($checkSql);
    $checkStmt->bind_param("si", $nim, $id);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();
    
    if ($checkResult->num_rows > 0) {
        echo "<script>alert('NIM sudah terdaftar!'); window.history.back();</script>";
        exit();
    }
    
    // Update data
    $sql = "UPDATE mahasiswa SET nim = ?, nama = ?, jenis_kelamin = ? WHERE id = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("sssi", $nim, $nama, $jenisKelamin, $id);
    
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