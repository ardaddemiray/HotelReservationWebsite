<?php
session_start();
require 'db_baglanti.php';

// Admin kontrolü
if (!isset($_SESSION['yonetici_mi']) || $_SESSION['yonetici_mi'] != 1) {
    header("Location: girisyap.php");
    exit;
}

// Kullanıcıları listeleme
$kullaniciSorgu = "SELECT * FROM kullanicilar";
$kullanicilar = $conn->query($kullaniciSorgu);

// Kullanıcı silme işlemi
if (isset($_POST['kullanici_sil'])) {
    $kullaniciId = $_POST['kullanici_id'];
    $conn->query("DELETE FROM kullanicilar WHERE id = $kullaniciId");
    header("Location: kullanici_yonetimi.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kullanıcı Yönetimi</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap"></head></head>
<body>
    <div class="tablo-ortala">
    <h1>Kullanıcı Yönetimi</h1>
    <table class="tablo">
        <thead>
            <tr>
                <th>ID</th>
                <th>Ad</th>
                <th>Soyad</th>
                <th>E-posta</th>
                <th>İşlem</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($kullanici = $kullanicilar->fetch_assoc()): ?> <!-- Kullanıcı bilgilerini görmek için bir tablo tasarlandı. -->
            <tr>
                <td><?= $kullanici['id'] ?></td>
                <td><?= $kullanici['ad'] ?></td>
                <td><?= $kullanici['soyad'] ?></td>
                <td><?= $kullanici['eposta'] ?></td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="kullanici_id" value="<?= $kullanici['id'] ?>">
                        <button type="submit" name="kullanici_sil">Sil</button>
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