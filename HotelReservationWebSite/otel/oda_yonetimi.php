<?php
session_start();
require 'db_baglanti.php';

// Admin kontrolü
if (!isset($_SESSION['yonetici_mi']) || $_SESSION['yonetici_mi'] != 1) {
    header("Location: girisyap.php");
    exit;
}

// Oda güncelleme işlemi: Oda id'si ile kapasite, fiyat ve müsait oda sayısında değişim yapılabiliyor.
if (isset($_POST['oda_guncelle'])) {
    $odaId = $_POST['oda_id'];
    $kapasite = $_POST['kapasite'];
    $fiyat = $_POST['fiyat'];
    $stok = $_POST['odaSayisi']; 

    // Oda var mı kontrolü
    $kontrolSorgu = "SELECT id FROM odalar WHERE id = $odaId";
    $kontrolSonuc = $conn->query($kontrolSorgu);

    if ($kontrolSonuc->num_rows > 0) {
        $conn->query("UPDATE odalar SET kapasite = $kapasite, fiyat = $fiyat, odaSayisi = $stok WHERE id = $odaId");
        $_SESSION['mesaj'] = "Oda bilgileri başarıyla güncellendi.";
    } else {
        $_SESSION['mesaj'] = "Bu ID'ye sahip oda bulunamadı.";
    }

    // Sayfayı yeniden yükleyerek tabloyu günceller
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// Odaları listeleme
$odaSorgu = "SELECT * FROM odalar";
$odalar = $conn->query($odaSorgu);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oda Yönetimi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="tablo-ortala">
    <h1>Oda Yönetimi</h1>
    <?php if (isset($_SESSION['mesaj'])): ?>
        <p><?= $_SESSION['mesaj'] ?></p>
        <?php unset($_SESSION['mesaj']); ?>
    <?php endif; ?>

    <form method="POST"> <!-- Formdan girilen veriler ile oda yönetimi yapılıyor -->
        <input type="number" name="oda_id" placeholder="Oda ID" required>
        <input type="number" name="kapasite" placeholder="Kapasite" required>
        <input type="number" step="0.01" name="fiyat" placeholder="Fiyat" required>
        <input type="number" name="odaSayisi" placeholder="Oda Sayısı" required> 
        <button type="submit" name="oda_guncelle">Oda Güncelle</button>
    </form>

    <table class="tablo">
        <thead>
            <tr>
                <th>ID</th>
                <th>Oda Adı</th>
                <th>Kapasite</th>
                <th>Fiyat</th>
                <th>Oda Sayısı</th> 
            </tr>
        </thead>
        <tbody>
            <?php while ($oda = $odalar->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($oda['id']) ?></td>
                <td><?= htmlspecialchars($oda['oda_adi']) ?></td>
                <td><?= htmlspecialchars($oda['kapasite']) ?></td>
                <td><?= htmlspecialchars($oda['fiyat']) ?></td>
                <td><?= htmlspecialchars($oda['odaSayisi']) ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <a href="admin.php">Admin Paneline Dön</a>
</div>
</body>
</html>
