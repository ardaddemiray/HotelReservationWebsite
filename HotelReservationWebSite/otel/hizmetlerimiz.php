<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap">
    <title>Hizmetlerimiz</title>

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
        <h1>HİZMETLERİMİZ</h1>
    </section>

<section class="hizmet">
    <div class="ana-hizmetler">
        <div class="hizmet-sol">
            <div class="hizmet-resim">
                <img src="Images/konaklama.jpg" alt="Konaklama Hizmetleri">
            </div>
            <div class="hizmet-yazi">
                <h2>Konaklama Hizmetleri</h2>
                <ul>
                    <li>Standart Odalar</li>
                    <li>Deluxe Odalar</li>
                    <li>Suit Odalar</li>
                    <li>Aile Odaları</li>
                    <li>Özel Balkonlu veya Deniz Manzaralı Odalar</li>
                </ul>
            </div>
        </div>
        <div class="hizmet-sag">
            <div class="hizmet-yazi">
                <h2>Yemek ve İçecek</h2>
                <ul>
                    <li>Açık Büfe Kahvaltı</li>
                    <li>Restoran (Yerel ve Uluslararası Mutfağı Sunan)</li>
                    <li>Bar ve Lounge</li>
                    <li>Oda Servisi</li>
                    <li>Kafe ve Pastane</li>
                </ul>
            </div>
            <div class="hizmet-resim">
                <img src="Images/yemek.jpg" alt="Yemek ve İçecek">
            </div>
        </div>
        <div class="hizmet-sol">
            <div class="hizmet-resim">
                <img src="Images/spa.jpg" alt="Rahatlama ve Spa Hizmetleri">
            </div>
            <div class="hizmet-yazi">
                <h2>Rahatlama ve Spa Hizmetleri</h2>
                <ul>
                    <li>Spa ve Wellness Merkezi</li>
                    <li>Sauna ve Buhar Odası</li>
                    <li>Masaj Hizmetleri</li>
                    <li>Fitness Salonu</li>
                    <li>Jakuzi</li>
                </ul>
            </div>
        </div>
        <div class="hizmet-sag">
            <div class="hizmet-yazi">
                <h2>Eğlence ve Etkinlikler</h2>
                <ul>
                    <li>Yüzme Havuzu (Açık/Kapalı)</li>
                    <li>Çocuk Kulübü</li>
                    <li>Canlı Müzik veya Etkinlikler</li>
                    <li>Doğa Gezileri ve Turlar</li>
                    <li>Su Sporları</li>
                </ul>
            </div>
            <div class="hizmet-resim">
                <img src="Images/eglence.jpg" alt="Eğlence ve Etkinlikler">
            </div>
        </div>
        <div class="hizmet-sol">
            <div class="hizmet-resim">
                <img src="Images/is.jpg" alt="İş ve Toplantı Hizmetleri">
            </div>
            <div class="hizmet-yazi">
                <h2>İş ve Toplantı Hizmetleri</h2>
                <ul>
                    <li>Toplantı ve Konferans Salonları</li>
                    <li>Düğün ve Organizasyon Hizmetleri</li>
                    <li>İş Merkezi (Bilgisayar ve Yazıcı Erişimi)</li>
                    <li>Proje Ekipmanları Kiralama</li>
                </ul>
            </div>
        </div>
        <div class="hizmet-sag">
            <div class="hizmet-yazi">
                <h2>Ulaşım ve Diğer Hizmetler</h2>
                <ul>
                    <li>Havalimanı Transfer Hizmeti</li>
                    <li>Araç Kiralama</li>
                    <li>Vale ve Otopark Hizmeti</li>
                    <li>Tur Rehberliği</li>
                    <li>Çamaşırhane ve Kuru Temizleme</li>
                </ul>
            </div>
            <div class="hizmet-resim">
                <img src="Images/ulasim.jpg" alt="Ulaşım ve Diğer Hizmetler">
            </div>
        </div>
    </div>
</section>
<?php
    include("footer.php");
?>
</body>
</html>