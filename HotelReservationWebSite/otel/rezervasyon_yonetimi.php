<?php
session_start();
require 'db_baglanti.php';

if (!isset($_SESSION['yonetici_mi']) || $_SESSION['yonetici_mi'] != 1) {
    header("Location: girisyap.php");
    exit;
}

// Rezervasyonları listeleme
$rezervasyonSorgu = "SELECT rezervasyonlar.id, rezervasyonlar.giris_tarihi, rezervasyonlar.cikis_tarihi, 
                     kullanicilar.ad, kullanicilar.soyad, odalar.oda_adi, odalar.id AS oda_id
                     FROM rezervasyonlar 
                     JOIN kullanicilar ON rezervasyonlar.kullanici_id = kullanicilar.id 
                     JOIN odalar ON rezervasyonlar.oda_id = odalar.id";
$rezervasyonlar = $conn->query($rezervasyonSorgu);

// Rezervasyon silme işlemi
if (isset($_POST['rezervasyon_sil'])) {
    $rezervasyonId = $_POST['rezervasyon_id'];

    // Rezervasyona ait oda ID'sini buluyoruz.
    $sorgu = "SELECT oda_id FROM rezervasyonlar WHERE id = ?";
    $stmt = $conn->prepare($sorgu);
    $stmt->bind_param("i", $rezervasyonId);
    $stmt->execute();
    $sonuc = $stmt->get_result();

    if ($sonuc->num_rows > 0) {
        $rezervasyon = $sonuc->fetch_assoc();
        $odaId = $rezervasyon['oda_id'];

        // Rezervasyonu silme sorgusu
        $silSorgu = "DELETE FROM rezervasyonlar WHERE id = ?";
        $stmtSil = $conn->prepare($silSorgu);
        $stmtSil->bind_param("i", $rezervasyonId);
        $stmtSil->execute();

        // Rezervasyon iptal edildiğinde oda sayısını 1 artıracak
        $stokGuncelleSorgu = "UPDATE odalar SET odaSayisi = odaSayisi + 1 WHERE id = ?";
        $stmtStok = $conn->prepare($stokGuncelleSorgu);
        $stmtStok->bind_param("i", $odaId);
        $stmtStok->execute();

        // Eğer stok > 0 ise odayı müsait hale getir
        $musaitlikGuncelleSorgu = "UPDATE odalar SET musait = 1 WHERE id = ? AND odaSayisi > 0";
        $stmtMusaitlik = $conn->prepare($musaitlikGuncelleSorgu);
        $stmtMusaitlik->bind_param("i", $odaId);
        $stmtMusaitlik->execute();
    }

    header("Location: rezervasyon_yonetimi.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rezervasyon Yönetimi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="tablo-ortala">
        <h1>Rezervasyon Yönetimi</h1>
        <table class="tablo">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Kullanıcı</th>
                    <th>Oda</th>
                    <th>Giriş Tarihi</th>
                    <th>Çıkış Tarihi</th>
                    <th>İşlem</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($rezervasyon = $rezervasyonlar->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($rezervasyon['id']) ?></td>
                    <td><?= htmlspecialchars($rezervasyon['ad']) . ' ' . htmlspecialchars($rezervasyon['soyad']) ?></td>
                    <td><?= htmlspecialchars($rezervasyon['oda_adi']) ?></td>
                    <td><?= htmlspecialchars($rezervasyon['giris_tarihi']) ?></td>
                    <td><?= htmlspecialchars($rezervasyon['cikis_tarihi']) ?></td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="rezervasyon_id" value="<?= htmlspecialchars($rezervasyon['id']) ?>">
                            <button type="submit" name="rezervasyon_sil">Sil</button>
                        </form>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <a href="admin.php">Admin Paneline Dön</a>
    </div>
</body>
</html>
