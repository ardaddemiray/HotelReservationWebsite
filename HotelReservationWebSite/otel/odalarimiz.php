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
    <title>Odalarımız</title>
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
        <h1>ODALARIMIZ</h1>
    </section>

    <h2 class="baslik">KONFORLU ODALAR SİZİ BEKLİYOR!</h2>    
    <section class="odalarimiz">
    <div class="oda-container">
        <div class="oda-kart">
            <img src="Images/deluxe-room.jpg" alt="Deluxe Oda">
            <h3>Deluxe Oda</h3>
            <p>Geniş ve konforlu yatak<br>Şehir ve doğa manzarası<br>Minibar, TV, Wi-Fi</p>
            <a href="rezervasyon.php" class="oda-rezervasyon">Rezervasyon Yap</a>
        </div>
    </div>
    <div class="oda-container">
        <div class="oda-kart">
            <img src="Images/suite-room.jpg" alt="Suit Oda">
            <h3>Suit Oda</h3>
            <p>Ayrı oturma ve yatak odası<br>Lüks banyo ve jakuzi<br>Geniş oturma alanı</p>
            <a href="rezervasyon.php" class="oda-rezervasyon">Rezervasyon Yap</a>
        </div>
    </div>
    <div class="oda-container">
        <div class="oda-kart">
            <img src="Images/presidential-suite.jpg" alt="Kral Dairesi">
            <h3>Kral Dairesi</h3>
            <p>Geniş oturma ve yemek odası<br>Jakuzi ve büyük boy küvet<br>Özel teras ve balkon</p>
            <a href="rezervasyon.php" class="oda-rezervasyon">Rezervasyon Yap</a>
        </div>
    </div>
    <div class="oda-container">
        <div class="oda-kart">
            <img src="Images/ocean-view.jpg" alt="Deniz Manzaralı Oda">
            <h3>Deniz Manzaralı Oda</h3>
            <p>Panoramik deniz manzarası<br>Özel balkon veya teras<br>Klima ve minibar</p>
            <a href="rezervasyon.php" class="oda-rezervasyon">Rezervasyon Yap</a>
        </div>
    </div>
    <div class="oda-container">
        <div class="oda-kart">
            <img src="Images/family-room.jpg" alt="Aile Odası">
            <h3>Aile Odası</h3>
            <p>Birden fazla yatak<br>Çocuk dostu dekorasyon<br>Geniş banyo</p>
            <a href="rezervasyon.php" class="oda-rezervasyon">Rezervasyon Yap</a>
        </div>
    </div>
    <div class="oda-container">
        <div class="oda-kart">
            <img src="Images/economy-room.jpg" alt="Ekonomik Oda">
            <h3>Ekonomik Oda</h3>
            <p>Kompakt ve ekonomik alan<br>Temel ihtiyaçlar (Wi-Fi, TV)<br>Çift kişilik veya iki tek kişilik yatak</p>
            <a href="rezervasyon.php" class="oda-rezervasyon">Rezervasyon Yap</a>
        </div>
    </div>
</section>
<?php
    include("footer.php");
?>
</body>
</html>