<?php
// Giriş kontrolü burada yapılır
session_start();

if ($_POST['username'] == "b231210008@sakarya.edu.tr" && $_POST['password'] == "b231210008") {
    // Giriş başarılı
    header("Location: anasayfa.html");
    exit();
} else {
    // Giriş başarısızsa geri dön
    echo "Kullanıcı adı veya şifre hatalı!";
}
?>
