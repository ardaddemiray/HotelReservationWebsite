<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require 'db_baglanti.php';

    // Formdan gelen veriler
    $ad = htmlspecialchars($_POST['ad']);
    $soyad = htmlspecialchars($_POST['soyad']);      // htmlspecialchars: Güvenlik için HTML özel karakterlerini temizler
    $eposta = htmlspecialchars($_POST['eposta']);
    $sifre = password_hash($_POST['sifre'], PASSWORD_DEFAULT);

    // E-posta kontrolü
    $epostaKontrol = "SELECT * FROM kullanicilar WHERE eposta = ?";
    $ifade = $conn->prepare($epostaKontrol);

    if (!$ifade) {
        die("E-posta kontrol sorgusunda hata: " . $conn->error);
    }

    $ifade->bind_param("s", $eposta);
    $ifade->execute();
    $sonuc = $ifade->get_result();

    if ($sonuc->num_rows > 0) {
        // Eğer e-posta mevcutsa
        echo "<p style='color: red;'>Bu e-posta adresi zaten kullanılıyor. Lütfen başka bir e-posta deneyin.</p>";
    } else {
        // e-posta nevcut değilse ekleme işlemini yapar
        $kayitSorgusu = "INSERT INTO kullanicilar (ad, soyad, eposta, sifre) VALUES (?, ?, ?, ?)";
        $ifade = $conn->prepare($kayitSorgusu);

        if (!$ifade) {
            die("Kayıt sorgusunda hata: " . $conn->error);
        }

        $ifade->bind_param("ssss", $ad, $soyad, $eposta, $sifre);

        if ($ifade->execute()) {
            // Kayıt başarılıysa giriş sayfasına yönlendirecek
            header("Location: girisyap.php");
        exit;
        } else {
            echo "<p style='color: red;'>Bir hata oluştu: " . $ifade->error . "</p>";
        }
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
    <title>Kayıt Ol</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap">
</head>
<body>
    <div class="log-reg">
        <div class="log-regkutu">
        <form method="POST" action="">
        <h1>Kayıt Ol</h1>
        <div class="giris-kutusu">
            <div class="giris-alani">
                <input type="text" name="ad" placeholder="Ad" required> <i class="fa-solid fa-user"></i>
            </div>
            <div class="giris-alani">
                <input type="text" name="soyad" placeholder="Soyad" required> <i class="fa-solid fa-user"></i>
            </div>
            <div class="giris-alani">
                <input type="email" name="eposta" placeholder="E-posta" required> <i class="fa-solid fa-envelope"></i>
            </div>
            <div class="giris-alani">
                <input type="password" name="sifre" placeholder="Şifre" required> <i class="fa-solid fa-lock"></i>
            </div>
        </div>
            <button type="submit" class="log-regbtn">Kayıt Ol</button>
            <label class="uyeol-giris">
             Zaten bir hesabınız var mı? <a href="girisyap.php">Giriş yapın.</a>
            </label>
        </form>
        </div>
    </div>
</body>
</html>
