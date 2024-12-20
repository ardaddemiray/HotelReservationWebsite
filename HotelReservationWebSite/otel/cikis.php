<?php
session_start();
session_unset(); // Oturum değişkenlerini temizler
session_destroy(); // Oturumu tamamen sonlandırır
header("Location: ana-sayfa.php"); // Ana sayfaya yönlendirir
exit;
?>
