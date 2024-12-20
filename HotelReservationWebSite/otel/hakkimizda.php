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
    <title>Hakkımızda</title>
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
        <h1>HAKKIMIZDA</h1>
    </section>

    <section class="hakkimizda">
        <div class="satir">
            <div class="hakkimizda-baslik">
                <h1>Demiray Hotel: Doğanın Kalbinde Eşsiz Bir Kaçış</h1>
                <p>Demiray Hotel, lüks konaklama anlayışını doğanın huzuruyla birleştirerek misafirlerine benzersiz bir deneyim sunar. Doğanın kalbinde, yemyeşil manzaralarla çevrili otelimiz, modern tasarımı ve üst düzey hizmet anlayışıyla konforun ve zarafetin eşsiz bir örneğidir.

Her bir detayında kalite ve estetiği buluşturan Demiray Hotel, geniş ve özenle tasarlanmış odalarıyla hem doğanın huzurunu hem de modern yaşamın ayrıcalıklarını misafirlerine sunar. Doğadan ilham alan restoranlarımızda özel lezzetlerin tadını çıkarabilir, spa merkezimizde tüm yorgunluğunuzu geride bırakabilirsiniz.

Misafirlerimiz, otelimizin sakin atmosferinde dinlenmenin yanı sıra çevredeki doğal güzellikleri keşfedebilir, açık hava aktiviteleriyle keyifli vakit geçirebilir. İş toplantılarınız, düğünleriniz ve özel organizasyonlarınız için şık ve modern salonlarımızla her ihtiyacınıza uygun çözümler sunuyoruz.

Demiray Hotel, misafir memnuniyetini birinci öncelik olarak benimser ve unutulmaz anılar biriktirmeniz için her ayrıntıyı titizlikle düşünür. Lüksün ve doğanın eşsiz bir uyum içinde bir araya geldiği bu özel mekânda sizi ağırlamaktan mutluluk duyarız.</p>
<a href="rezervasyon.php" class="kesfet">Demiray Hotel'de Konakla</a>
            </div>
            <div class="hakkimizda-img">
                <img src="Images/hakkimizda_sag.jpg" alt="Hakkımızda">
            </div>
        </div>
    </section>
    <?php
    include("footer.php");
    ?>
</body>
</html>