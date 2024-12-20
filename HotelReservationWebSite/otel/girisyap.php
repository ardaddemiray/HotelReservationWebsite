<?php
session_start();
require 'db_baglanti.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Formdan gelen veriler
    $eposta = $_POST['eposta'];
    $sifre = $_POST['sifre'];

    // Kullanıcıyı veritabanında bulma
    $sorgu = "SELECT * FROM kullanicilar WHERE eposta = ?";
    $ifade = $conn->prepare($sorgu);
    $ifade->bind_param("s", $eposta);
    $ifade->execute();
    $sonuc = $ifade->get_result();

    if ($sonuc->num_rows === 1) {
        $kullanici = $sonuc->fetch_assoc();

        // Kullanıcının şifresini doğrulama kodlaması
        if (password_verify($sifre, $kullanici['sifre'])) {
            $_SESSION['user_id'] = $kullanici['id']; 
            $_SESSION['ad'] = $kullanici['ad'];
            $_SESSION['soyad'] = $kullanici['soyad'];
            $_SESSION['yonetici_mi'] = $kullanici['yonetici_mi'];
            $_SESSION['eposta'] = $kullanici['eposta'];
            // Kullanıcı ve admin kontrolü
            if ($kullanici['yonetici_mi'] == 1) {
                header("Location: admin.php");
            } else {
                header("Location: kullanici.php");
            }
        } else {
            echo "<p>Hatalı şifre! Lütfen tekrar deneyin.</p>";
        }
    } else {
        echo "<p>E-posta adresi bulunamadı! Lütfen kayıt olun.</p>";
    }

    $ifade->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Yap</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap">
</head>
<body>
<div class="log-reg">
    <div class="log-regkutu">
        <form method="POST" action="">
            <h1>Giriş Yap</h1>
            <div class="giris-kutusu">
                <div class="giris-alani">
                    <input type="email" name="eposta" placeholder="E-posta" required>
                    <i class="fa-solid fa-user"></i>
                </div>
                <div class="giris-alani">
                    <input type="password" name="sifre" placeholder="Şifre" required>
                    <i class="fa-solid fa-lock"></i>
                </div>
            </div>
            <button type="submit" class="log-regbtn">Giriş Yap</button>
            <label class="uyeol-giris">
                Üye değil misiniz? <a href="kayitol.php">Bize katılın</a>
            </label>
        </form>
    </div>
</div>
</body>
</html>
