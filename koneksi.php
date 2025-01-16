<?php
$servername = "localhost";
$username = "root"; // Ganti sesuai username database
$password = ""; // Ganti sesuai password database
$dbname = "webdailyjournal"; // Ganti sesuai nama database

$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>