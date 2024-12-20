<?php
session_start();

require 'db_baglanti.php';

// Musait odaları çekiyoruz
$sql = "SELECT id, oda_adi FROM odalar WHERE musait = 1";
$result = $conn->query($sql);
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['rezervasyon_yap'])) {
    if (isset($_SESSION['user_id'])) {
        // Kullanıcı ve form verileri
        $kullanici_id = $_SESSION['user_id'];
        $oda_id = $_POST['oda_id'];
        $giris_tarihi = $_POST['giris_tarihi'];
        $cikis_tarihi = $_POST['cikis_tarihi'];
        $gece_sayisi = $_POST['gece_sayisi'];

        // Oda türünü alma kısmı
        $sql_oda_turu = "SELECT oda_turu FROM odalar WHERE id = ?";
        $stmt_oda_turu = $conn->prepare($sql_oda_turu);
        $stmt_oda_turu->bind_param("i", $oda_id);
        $stmt_oda_turu->execute();
        $result_oda_turu = $stmt_oda_turu->get_result();
        $oda_turu = $result_oda_turu->fetch_assoc()['oda_turu'] ?? '';

        // Rezervasyon ekleme
        if ($oda_turu) {
            $sql_insert = "INSERT INTO rezervasyonlar (oda_id, kullanici_id, oda_turu, giris_tarihi, cikis_tarihi, gece_sayisi) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql_insert);
            $stmt->bind_param("iisssi", $oda_id, $kullanici_id, $oda_turu, $giris_tarihi, $cikis_tarihi, $gece_sayisi);

            if ($stmt->execute()) {
                // Rezervasyon yapıldıktan sonra oda sayısını azaltıyoruz
                $sql_update = "UPDATE odalar SET odaSayisi = odaSayisi - 1 WHERE id = ? AND odaSayisi > 0";
                $stmt_update = $conn->prepare($sql_update);
                $stmt_update->bind_param("i", $oda_id);
                $stmt_update->execute();

                echo "<p style='color: green;'>Rezervasyon başarıyla yapıldı!</p>";
            } else {
                echo "<p style='color: red;'>Rezervasyon sırasında hata oluştu: " . $stmt->error . "</p>";
            }
        } else {
            echo "<p style='color: red;'>Oda türü bilgisi alınamadı.</p>";
        }
    } else {
        echo "<p style='color: red;'>Rezervasyon için giriş yapmalısınız.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap">
    <title>Rezervasyon</title>
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
    <h1>REZERVASYON YAP!</h1>
</section>

<section class="rezervasyon-yap">
    <div class="hotel-hakkinda">
        <div class="hotel-video">
            <video autoplay muted loop class="video-background">
                <source src="Images/anasayfa.mp4" type="video/mp4">
                Tarayıcınız bu videoyu desteklemiyor.
            </video>
        </div>
        <div class="hotel-bilgi">
            <h1>DEMİRAY HOTEL</h1>
            <p class="adres">
                <i class="fas fa-map-marker-alt"></i>
                Karahıdır, Kırklareli Teknik Bilimler MYO İç Yolu, 39100 Kırklareli Merkez/Kırklareli
            </p>
            <div class="hotel-iletisim">
                <p><i class="fas fa-envelope"></i> info@demirayhotel.com</p>
                <p><i class="fas fa-phone"></i> +90 288 555 5555</p>
                <p><i class="fas fa-globe"></i> <a href="ana-sayfa.php" target="_blank">www.demirayhotel.com</a></p>
            </div>
            <div class="hotel-tanitim">
                <p>Kırklareli'nin kalbinde yer alan Demiray Hotel, misafirlerine modern olanaklarla donatılmış, konforlu ve unutulmaz bir konaklama deneyimi sunmaktadır. İster iş seyahati için ister tatil amaçlı konaklamalarınızda, Demiray Hotel sıcak ve samimi ortamıyla sizleri bekliyor.</p>
            </div>
        </div>
    </div>

    <form method="POST" action="">
    <div class="otel-arama-container">
        <div class="otel-arama">
            <div class="arama-bilgisi">
                <div class="arama-alani">
                    <i class="fas fa-calendar-alt"></i>
                    <span>Giriş Tarihi</span>
                    <input type="date" id="giris-tarihi" name="giris_tarihi">
                </div>
                <div class="arama-alani">
                    <i class="fas fa-calendar-alt"></i>
                    <span>Çıkış Tarihi</span>
                    <input type="date" id="cikis-tarihi" name="cikis_tarihi">
                </div>
                <div class="arama-alani">
                    <i class="fas fa-user"></i>
                    <span>Kişi Sayısı</span>
                    <select id="kisi-sayisi" name="kisi_sayisi">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                    </select>
                </div>
            <div class="arama-butonlari">
                <button type="submit" class="btn-ara" name="ara"><i class="fas fa-search"></i> Ara</button>
                <button type="submit" class="btn-musaitlik" name="musaitlik"><i class="fas fa-calendar-check"></i> Müsaitlik</button>
            </div>
        </div>
    </div>
    </form>
</section>

<?php // Bu kod bloğu, kullanıcının giriş ve çıkış tarihini seçerek otelde müsait odaları aramasını ve rezervasyon yapmasını sağlar.
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ara'])) {
    $giris_tarihi = $_POST['giris_tarihi'];
    $cikis_tarihi = $_POST['cikis_tarihi'];
    $kisi_sayisi = $_POST['kisi_sayisi'];

    $giris = new DateTime($giris_tarihi);
    $cikis = new DateTime($cikis_tarihi);
    $gece_sayisi = $giris->diff($cikis)->days;

    if ($gece_sayisi > 0) {
        $sql = "SELECT id, oda_adi, resim_yolu, kapasite, fiyat FROM odalar WHERE kapasite >= ? AND musait = 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $kisi_sayisi);
        $stmt->execute();
        $result = $stmt->get_result();

        echo "<div class='musait-odalar'>";
        while ($row = $result->fetch_assoc()) {
            $resim = !empty($row['resim_yolu']) ? htmlspecialchars($row['resim_yolu']) : 'default-image.jpg';
            $oda_fiyati = htmlspecialchars($row['fiyat']);
            $toplam_fiyat = $oda_fiyati * $gece_sayisi;

            echo "<div class='oda-kart'>";
            echo "<h3>" . htmlspecialchars($row['oda_adi']) . "</h3>";
            echo "<img src='$resim' alt='" . htmlspecialchars($row['oda_adi']) . "' style='width:100%; height:auto;'>";
            echo "<p>Kapasite: " . htmlspecialchars($row['kapasite']) . " kişi</p>";
            echo "<p>Günlük Fiyat: $oda_fiyati TL</p>";
            echo "<p>Toplam Fiyat: $toplam_fiyat TL</p>";

            echo "<form method='POST' action='' onsubmit='return rezervasyonOnayla()'>";
            echo "<input type='hidden' name='oda_id' value='" . htmlspecialchars($row['id']) . "'>";
            echo "<input type='hidden' name='giris_tarihi' value='$giris_tarihi'>";
            echo "<input type='hidden' name='cikis_tarihi' value='$cikis_tarihi'>";
            echo "<input type='hidden' name='gece_sayisi' value='$gece_sayisi'>";
            echo "<input type='hidden' name='toplam_fiyat' value='$toplam_fiyat'>";
            echo "<button type='submit' name='rezervasyon_yap' class='btn-rezervasyon'><i class='fas fa-bell'></i> Rezervasyon</button>";
            echo "</form>";
            echo "</div>";
        }
        echo "</div>";
    } else {
        echo "<p style='color: red;'>Çıkış tarihi giriş tarihinden sonra olmalıdır.</p>";
    }
}
?>

<script> // Kullanıcı rezervasyon yapmadan önce son bir onay mesajı için küçük bir javascript kodlaması
function rezervasyonOnayla() {
    return confirm("Rezervasyon yapmak istediğinize emin misiniz?");
}
</script>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['musaitlik'])) {
    $baslangicTarihi = date('Y-m-d'); // Bugün
    $bitisTarihi = date('Y-m-d', strtotime('+30 days')); // 30 gün sonrası

    // Tarih aralığını oluştur
    $tarihAraligi = [];
    $baslangic = new DateTime($baslangicTarihi);
    $bitis = new DateTime($bitisTarihi);
    while ($baslangic <= $bitis) {
        $tarihAraligi[] = $baslangic->format('Y-m-d');
        $baslangic->modify('+1 day');
    }

    // Tüm odaları ve oda sayılarını çekiyoruz
    $odalarSorgu = "SELECT id, oda_adi, odaSayisi FROM odalar";
    $odalarSonuc = $conn->query($odalarSorgu);

    $rezervasyonSorgu = "SELECT oda_id, giris_tarihi, cikis_tarihi, COUNT(*) AS rezervasyon_sayisi 
                         FROM rezervasyonlar 
                         GROUP BY oda_id, giris_tarihi, cikis_tarihi";
    $rezervasyonSonuc = $conn->query($rezervasyonSorgu);

    $rezervasyonlar = [];
    while ($row = $rezervasyonSonuc->fetch_assoc()) {
        $rezervasyonlar[] = $row;
    }

    // Müsaitlik tablosunu oluşturma 
    echo '<table class="musaitlik-tablosu">';
    echo '<thead><tr><th>Odalar</th>';

    foreach ($tarihAraligi as $tarih) {
        echo '<th>' . date('d M', strtotime($tarih)) . '</th>';
    }
    echo '</tr></thead><tbody>';

    while ($oda = $odalarSonuc->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($oda['oda_adi']) . '</td>';

        foreach ($tarihAraligi as $tarih) {
            $stokKalan = $oda['odaSayisi']; 

            // Tarihe göre rezervasyonları kontrol et
            foreach ($rezervasyonlar as $rez) {
                if ($rez['oda_id'] == $oda['id'] && $tarih >= $rez['giris_tarihi'] && $tarih < $rez['cikis_tarihi']) {
                    $stokKalan -= $rez['rezervasyon_sayisi']; 
                }
            }

            // Hücre rengi stok durumuna müsait oda varsa tabloda yeşil yok ise kırmızı gözükecek
            if ($stokKalan > 0) {
                echo '<td class="musait-gun">✓ (' . $stokKalan . ')</td>'; 
            } else {
                echo '<td class="dolu-gun">✖</td>';
            }
        }
        echo '</tr>';
    }
    echo '</tbody></table>';
}
?>

<div class="bilgilendirme-alani">
    <span class="bilgi-musait">
        <i class="fas fa-check"></i> Müsait Günler
    </span>
    <span class="bilgi-dolu">
    <i class="fa-solid fa-xmark"></i> Müsait Değil
    </span>
    <span class="bilgi-oda-sayisi">
        <i class="fas fa-bed"></i> Oda Sayısı: <strong>Her hücrede mevcut oda sayısı parantez içinde gösterilir.</strong>
    </span>
</div>

<?php
include("footer.php");
?>


</body>
</html>
