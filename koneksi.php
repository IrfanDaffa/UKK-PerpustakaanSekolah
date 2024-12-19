<?php
// Database connection
$host = 'localhost'; // Atau bisa gunakan 127.0.0.1
$db = 'ukk_perpus_sekolah_db'; 
$user = 'root'; // Default user untuk MySQL lokal
$pass = ''; // Password MySQL jika ada
$charset = 'utf8mb4';

$dns = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dns, $user, $pass, $options);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    exit();
}