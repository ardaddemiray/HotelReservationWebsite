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
    <title>İletişim</title>
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
        <h1>İLETİŞİM</h1>
    </section>

    <section class="iletisim" id="iletisim">
    <div class="iletisim">
        <div class="form-basligi">
        <h1>Bize Ulaşın!</h1>
        <p>"Talep, öneri ve şikayetleriniz için bize ulaşabilirsiniz."</p>
        </div>
        <form>
            <div class="form-oge">

                <div class="form">
                    <span><i class="fa-solid fa-user"></i> Adınız-Soyadınız</span>
                    <input type="text" placeholder="Adınızı ve Soyadınızı giriniz" required>
                </div>
                <div class="form">
                    <span><i class="fa-solid fa-envelope"></i> E-Mail Adresiniz</span>
                    <input type="email" placeholder="E-Mail adresinizi giriniz" required>
                </div>
            </div>
                <div class="form">
                    <span><i class="fa-solid fa-phone"></i> Telefon Numaranız</span>
                    <input type="text" placeholder="Telefon Numaranızı giriniz" required>
                </div>
                <div class="form">
                    <span><i class="fa-solid fa-message"></i> Mesajınız</span>
                    <textarea rows="8" placeholder="Mesajınızı yazınız"></textarea>
                </div>
                <button type="submit">Gönder <i class="fa-solid fa-paper-plane"></i></button>
            </div>
        </form>
    </div>
</section>
<?php
    include("footer.php");
?>
</body>
</html>