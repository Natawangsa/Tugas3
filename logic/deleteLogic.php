<?php
include '../connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $sql = "DELETE FROM mahasiswa WHERE id = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        header("Location: ../home.php");
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
} else {
    header("Location: ../home.php");
}

$koneksi->close();
?>