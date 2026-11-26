<?php
$host = "localhost";
$db   = "job_portal";
$user = "root";
$pass = ""; // Default XAMPP MySQL password is usually empty.

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$db;charset=utf8mb4",
        $user,
        $pass,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
} catch (PDOException $e) {
    exit("Database connection failed. Import database.sql using phpMyAdmin first.");
}
