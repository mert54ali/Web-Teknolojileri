<?php
// 'sanitize' fonksiyonu, formdan gelen veriyi temizler ve güvenli hale getirir
function sanitize($key) {
  // $_POST dizisinde $key anahtarına sahip veri varsa, onu trim yapar ve HTML karakterlerini dönüştürür
  return isset($_POST[$key]) ? htmlspecialchars(trim($_POST[$key])) : '';
}

// Formdan gelen verileri temizle ve değişkenlere ata
$fullname = sanitize('fullname'); // Ad Soyad
$email = sanitize('email'); // E-posta
$phone = sanitize('phone'); // Telefon
$subject = sanitize('subject'); // Konu
$message = sanitize('message'); // Mesaj

$errors = []; // Hata mesajlarını tutacak dizi

// Gerekli alanların kontrolü
if (!$fullname) $errors[] = "Ad Soyad gerekli."; // Ad soyad boşsa hata ekle
if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Geçerli bir e-posta giriniz."; // E-posta boş veya geçerli değilse hata
if (!$phone || !preg_match('/^[0-9]{10}$/', $phone)) $errors[] = "Geçerli bir telefon numarası giriniz."; // Telefon 10 haneli değilse hata
if (!$subject) $errors[] = "Konu seçiniz."; // Konu boş ise hata
if (!$message) $errors[] = "Mesaj boş olamaz."; // Mesaj boşsa hata
?>

<!DOCTYPE html> <!-- HTML belge tipi belirtimi -->
<html lang="tr"> <!-- Sayfa dili Türkçe olarak ayarlandı -->
<head>
  <meta charset="UTF-8"> <!-- Karakter kodlaması UTF-8 -->
  <title>İletişim Sonuç</title> <!-- Sayfa başlığı -->
  <link href="styles.css" rel="stylesheet"> <!-- Dış CSS dosyasını linkle -->
</head>
<body>
  <div class="container"> <!-- İçeriği sınırlandıran kutu -->
    <h1>İletişim Formu Sonucu</h1> <!-- Ana başlık -->

    <?php if ($errors): ?> <!-- Eğer hata dizisi boş değilse -->
      <div class="error-box"> <!-- Hata mesajlarının gösterileceği kutu -->
        <h2>Hatalar:</h2> <!-- Hata başlığı -->
        <ul> <!-- Hata mesajlarını listele -->
          <?php foreach ($errors as $error): ?> <!-- Hata dizisinde döngü -->
            <li><?php echo $error; ?></li> <!-- Her hata mesajını listeye ekle -->
          <?php endforeach; ?>
        </ul>
        <a href="javascript:history.back();">Geri dön</a> <!-- Kullanıcıyı geri gitmeye yönlendir -->
      </div>
    <?php else: ?> <!-- Eğer hata yoksa -->
      <div class="result-box"> <!-- Sonuçların gösterileceği kutu -->
        <p><strong>Ad Soyad:</strong> <?php echo $fullname; ?></p> <!-- Ad Soyad -->
        <p><strong>E-posta:</strong> <?php echo $email; ?></p> <!-- E-posta -->
        <p><strong>Telefon:</strong> <?php echo $phone; ?></p> <!-- Telefon -->
        <p><strong>Konu:</strong> <?php echo $subject; ?></p> <!-- Konu -->
        <p><strong>Mesaj:</strong> <?php echo nl2br($message); ?></p> <!-- Mesaj, satır sonları html satır sonlarına dönüştürülür -->
      </div>
    <?php endif; ?>

    <nav class="nav-container"> <!-- Navigasyon bölümü -->
      <a href="anasayfa.html">Anasayfa</a> <!-- Ana sayfa linki -->
      <a href="iletisim.html">Yeni Mesaj</a> <!-- Yeni mesaj formuna dönüş linki -->
    </nav>
  </div>
</body>
</html>