<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "tugas3";
$port = "3306";

$koneksi = new mysqli($hostname, $username, $password, $database, $port);

if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}
?>