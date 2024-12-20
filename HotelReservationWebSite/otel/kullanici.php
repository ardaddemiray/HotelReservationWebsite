<?php
session_start();
if (!isset($_SESSION['user_id'])) { // Doğru oturum değişkeni kontrol ediliyor
    header("Location: girisyap.php");
    exit;
}

require 'db_baglanti.php';

$user_id = $_SESSION['user_id'];

$query = "SELECT * FROM rezervasyonlar WHERE kullanici_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kullanıcı Paneli</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap">
</head>
<body>
<section class="mini-header">
    <nav>
        <a href="ana-sayfa.php" class="logo">
            <i class="fa-solid fa-hotel"></i> DEMİRAY HOTEL
        </a>
        <div class="nav-sayfalar" id="navSayfalar">
            <ul>
                <li><a href="hakkimizda.php">Hakkımızda</a></li>
                <li><a href="odalarimiz.php">Odalarımız</a></li>
                <li><a href="hizmetlerimiz.php">Hizmetlerimiz</a></li>
                <li><a href="iletisim.php">İletişim</a></li>
                <?php if (!isset($_SESSION['user_id'])): ?>
                    <li><a href="girisyap.php">Giriş | Kayıt</a></li>
                <?php else: ?>
                    <li><a href="kullanici.php" class="btn-kullanici"><i class="fa-solid fa-user"></i></a></li>
                    <li><a href="cikis.php" class="btn-cikis"><i class="fa-solid fa-right-from-bracket"></i></a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
    <h1>KULLANICI PANELİ</h1>
</section>

<div class="kullanici-bilgi">
    <!-- Kullanıcı Bilgileri -->
    <div class="bilgi">
        <h2>Kullanıcı Bilgileriniz</h2>
        <div class="kullanici-icon">
            <i class="fa-solid fa-user"></i>
        </div>
        <p><strong>Ad:</strong> <?= htmlspecialchars($_SESSION['ad'] ?? 'Bilinmiyor') ?></p>
        <p><strong>Soyad:</strong> <?= htmlspecialchars($_SESSION['soyad'] ?? 'Bilinmiyor') ?></p>
        <p><strong>E-posta:</strong> <?= htmlspecialchars($_SESSION['eposta'] ?? 'Bilinmiyor') ?></p>
    </div>

    <!-- Rezervasyonlar -->
    <div class="bilgi">
        <h2>Rezervasyonlarınız</h2>
        <table>
            <tr>
                <th>Oda Türü</th>
                <th>Giriş Tarihi</th>
                <th>Çıkış Tarihi</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['oda_turu']) ?></td>
                    <td><?= htmlspecialchars($row['giris_tarihi']) ?></td>
                    <td><?= htmlspecialchars($row['cikis_tarihi']) ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>

    <!-- Bilgileri Güncelle -->
    <div class="bilgi">
        <h2>Şifre Güncelle</h2>
        <form method="POST" action="sifreguncelle.php">
            <label for="ad">Adınız:</label>
            <input type="text" id="ad" name="ad" value="<?= htmlspecialchars($_SESSION['ad'] ?? '') ?>" readonly>
            <label for="soyad">Soyadınız:</label>
            <input type="text" id="soyad" name="soyad" value="<?= htmlspecialchars($_SESSION['soyad'] ?? '') ?>" readonly>
            <label for="email">E-posta:</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($_SESSION['eposta'] ?? '') ?>" readonly>
            <label for="sifre">Yeni Şifre:</label>
            <input type="password" id="sifre" name="sifre" placeholder="Yeni Şifre" required>
            <button type="submit">Güncelle</button>
        </form>
    </div>
</div>
<?php
    include("footer.php");
?>
</body>
</html>
