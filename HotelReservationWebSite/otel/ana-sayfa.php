<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demiray Hotel</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap">
</head>
<body>
    <section class="header">
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
                        <!-- Giriş yapılmamışsa navbar'da bu buton gözükecek-->
                        <li><a href="girisyap.php">Giriş | Kayıt </a></li>
                    <?php else: ?>
                        <!-- Giriş yapılmışsa Kullanıcı Paneli ve Oturumu Kapat butonu gözükecek -->
                        <li><a href="kullanici.php" class="btn-kullanici"><i class="fa-solid fa-user"></i>
                        </i></a></li>
                        <li><a href="cikis.php" class="btn-cikis"><i class="fa-solid fa-right-from-bracket"></i></a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>

        <div class="slogan">
            <h2>Lüksün ve Doğanın Büyüleyici Uyumu</h2>
            <a href="rezervasyon.php" class="rezervasyon">Demiray Hotel'de Konakla</a>
        </div>
    </section>


    <!-- Odalar -->
    <section class="odalar">
    <div class="odalar-container">
        <div class="odalar-yazi">
            <h1><i class="fa-solid fa-bed"></i> | Odalarımız</h1>
            <p>Konukların huzuru ve rahatı için özel olarak hazırlanan yatak odalarında evinizin rahatlığını hissedeceğinize emin olabilirsiniz. Bir muhafazakar otelde olması gereken her şeyin düşünüldüğü odalarda bulunuyor. Tatiliniz boyunca ev rahatlığını hissedeceğiniz odalarımız, farklı konseptlerde rezervasyonunuzu bekliyor.</p>
            <a href="odalarimiz.php" class="kesfet">KEŞFET</a>
        </div>
        <div class="odalar-resim">
            <img src="Images/odalar.jpg" alt="Odalar">
        </div>
    </div>
</section>

<section class="hizmetlerimiz">
    <div class="hizmetler-container">
        <div class="hizmetler-resim">
            <img src="Images/hizmetler.jpg" alt="Hizmetlerimiz">
        </div>
        <div class="hizmetler-yazi">
            <h1><i class="fa-solid fa-concierge-bell"></i> | Hizmetlerimiz</h1>
            <p>Otelimizde konfor ve ayrıcalık, modern tasarımla buluşuyor. Spa merkezimizde yenilenebilir, oturma alanlarımızda huzur bulabilir ve dünya mutfağından eşsiz lezzetlerin tadını çıkarabilirsiniz. Hizmetlerimiz, tatilinizi daha keyifli ve unutulmaz kılmak için tasarlanmıştır. Güler yüzlü personelimiz ile kendinizi özel hissedeceksiniz.</p>
            <a href="hizmetlerimiz.php" class="kesfet">KEŞFET</a>
        </div>
    </div>
</section>

<!-- Neredeyiz -->
<section class="neredeyiz">
    <div class="kart-container">
        <div class="kart neredeyiz-karti">
            <h2><i class="fa-solid fa-map-marker-alt"></i> | Neredeyiz?</h2>
            <p>Otelimiz, doğal güzelliklerin ve şehir merkezine yakın bir konumun buluştuğu özel bir noktada yer alıyor. Aşağıdaki haritada bizi bulabilirsiniz.</p>
            <div class="harita">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2978.0063986875107!2d27.190108112230817!3d41.72038077113969!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40a75484ea76c72d%3A0x644acf49a883ab6d!2sK%C4%B1rklareli%20%C3%9Cniversitesi%20Teknik%20Bilimler%20Meslek%20Y%C3%BCksekokulu!5e0!3m2!1str!2str!4v1733695139047!5m2!1str!2str"
                    width="100%"
                    height="300"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>

        <!-- İletişim -->
        <div class="kart iletisim-karti">
            <h2><i class="fa-solid fa-phone"></i> | İletişim Bilgilerimiz</h2>
            <p><strong>Telefon:</strong> +90 288 555 5555</p>
            <p><strong>Email:</strong> info@demirayhotel.com</p>
            <p><strong>Adres:</strong> Karahıdır, Kırklareli Teknik Bilimler MYO İç Yolu, 39100 Kırklareli Merkez/Kırklareli</p>
            <a href="iletisim.php" class="btn-iletisim">Bizimle İletişime Geç</a>
        </div>
    </div>
</section>
<?php
    include("footer.php");
?>
</body>
</html>