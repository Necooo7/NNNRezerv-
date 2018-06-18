<?php
ob_start();
session_start();
?><!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="keywords" content="bootstrap, admin, dashboard, flat admin template, responsive," />
  <title>VatanSMS Site Yönetim Paneli</title>

  <!-- ========== Css Files ========== -->
  <link href="css/root.css" rel="stylesheet">
  <style type="text/css">
    body{background: #F5F5F5;}
  </style>
  </head>
  <body>

    <div class="login-form">
      <form action="" method="post">
        <div class="top">
          <h1>Şifrenizi mi unuttunuz?</h1>
          <h4>Aşağıdaki alana sisteme kayıtlı cep telefonunu girerek giriş bilgilerinizin cep telefonunuza gönderilmesini sağlayabilirsiniz.</h4>
        </div>
        <div class="form-area">
          <div class="group">
           <input type="text" pattern=".{0}|.{10,13}" name="cep" class="form-control" placeholder="Cep Telefonu" autocomplete="off"
            required title="Bu alan 10-13 karakter arasında cep telefonu içermelidir.
            
            Örn:05456667889 
            Örn:5456667889
            Örn:+905456667889">
            <i class="fa fa-phone"></i>
          </div>
         
        
          
          
          <button type="submit" class="btn btn-default btn-block">Gönder</button>
        </div>
      </form>
      <div class="footer-links row">
        <div class="col-xs-6"><a href="giris.php"><i class="fa fa-sign-in"></i> Giriş Sayfası</a></div>
        
      </div>
    </div>

</body>
</html>

<?php
include 'db.php';

        
 
if($_POST['cep']){
    $cep=$_POST['cep'];
  $cep=ltrim($cep, "0");
    $cep=ltrim($cep, "90");
  $cep=ltrim($cep, "+90");


$ver=$baglanti->query("SELECT * from uyeler where cep='$cep'");
foreach($ver as $al){
  $ad=$al['ad'];
  $sifre=$al['sifre'];
  $cep2=$al['cep'];
  $tekrar=$al['sifrehatirlatma'];
}
$tekrararti=$tekrar +1;
   if($tekrar>5){
     echo "<script>alert('En fazla 5 kez şifre hatırlatması yapabilirsiniz. İşleminiz tamamlanamadı, lütfen temsilciniz ile iletişime geçiniz.');</script>";
     exit();
   }
  if(!$cep2){
    
    echo "<script>alert('Bu cep telefonu ile kayıt bulunamamıştır. Lütfen temsilciniz ile iletişime geçiniz.');</script>";
    echo "<script>window.close()</script>";
  }else{

header('Content-Type: text/html; charset=utf-8');
$postUrl='http://panel.vatansms.com/panel/smsgonder1Npost.php';
$MUSTERİNO='14821'; //5 haneli müşteri numarası
$KULLANICIADI='cuneyt';
$SIFRE='123456';       
$ORGINATOR="GoldYonetim";        

$TUR='Normal';  // Normal yada Turkce
$ZAMAN='';

$mesaj1="Sayın ".$ad." hesabınıza ait  şifreniz:".$sifre."
Saygılarımızla,
www.vatansms.com";
$numara1=$cep;
$numara2='';

$xmlString='data=<sms>
<kno>'. $MUSTERİNO .'</kno>
<kulad>'. $KULLANICIADI .'</kulad>
<sifre>'.$SIFRE .'</sifre>
<gonderen>'.  $ORGINATOR .'</gonderen>
<mesaj>'. $mesaj1 .'</mesaj>
<numaralar>'. $numara1.','. $numara2.'</numaralar>
<tur>'. $TUR .'</tur>
</sms>';


$Veriler =  $xmlString;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $postUrl);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $Veriler);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
$response = curl_exec($ch);
curl_close($ch);

echo "<script>alert('Şifreniz cep telefonunuza iletilmiştir.');</script>";
echo "<script>window.close()</script>";
$guncelle=$baglanti->exec("UPDATE uyeler set sifrehatirlatma='$tekrararti' where cep='$cep' ");
}
}
      
?>
