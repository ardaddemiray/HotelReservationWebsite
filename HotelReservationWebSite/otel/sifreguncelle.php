<?php
session_start();
require 'db_baglanti.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'] ?? null;
    $yeni_sifre = $_POST['sifre'] ?? null;

    if (!$user_id || !$yeni_sifre) {
        echo "Geçersiz istek.";
        exit;
    }

    $hash_sifre = password_hash($yeni_sifre, PASSWORD_BCRYPT);

    $sorgu = "UPDATE kullanicilar SET sifre = ? WHERE id = ?";
    $stmt = $conn->prepare($sorgu);
    $stmt->bind_param("si", $hash_sifre, $user_id);

    if ($stmt->execute()) {
        echo "Şifre başarıyla güncellendi.";
        header("Location: kullanici.php");
        exit;
    } else {
        echo "Şifre güncelleme sırasında bir hata oluştu.";
    }
}
?>
