<?php
session_start();
require 'db_baglanti.php';

// Admin kontrolü
if (!isset($_SESSION['yonetici_mi']) || $_SESSION['yonetici_mi'] != 1) {
    header("Location: girisyap.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Paneli</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap"></head>
</head>
<body>
    <div class="admin-panel">
        <div class="admin">
            <h1>Admin Paneli</h1>
            <a href="kullanici_yonetimi.php"><i class="fa-solid fa-arrow-right"></i> Kullanıcı Yönetimi</a>
            <a href="rezervasyon_yonetimi.php"><i class="fa-solid fa-arrow-right"></i> Rezervasyon Yönetimi</a>
            <a href="oda_yonetimi.php"><i class="fa-solid fa-arrow-right"></i> Oda Yönetimi</a>
            <a href="girisyap.php"><i class="fa-solid fa-arrow-right"></i> Admin Panelinden Çık</a>
        </div>
    </div>

</body>
</html>
