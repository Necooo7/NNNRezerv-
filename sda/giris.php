<?php
ob_start();
session_start();

date_default_timezone_set('Europe/Istanbul');

include 'db.php';


$ad=@$_POST['ad'];
$sifre=@$_POST['sifre'];
$cep=@$_POST['cep'];
$cep=ltrim($cep, "0");
$cep=ltrim($cep, "90");
$sorgu= $baglanti->prepare("select * from uyeler where cep=? and sifre=?");
$sorgu->execute(array($cep,$sifre));
$islem = $sorgu->fetch();



if ($islem) {



$al=$baglanti -> query("SELECT * FROM uyeler where cep='$cep'");
foreach ($al as $key) {
  
$_SESSION['id']=$key['id'];
$_SESSION['ad']=$key['ad'];
$_SESSION['cep']=$key['cep'];
$_SESSION['mail']=$key['adres'];
  
  $id1=$_SESSION['id'];

  if($id1){
    header('location:anasayfa.php');
  }
}

}


?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="keywords" content="" />
  <title>Rezervasyon Yönetim Paneli </title>

  <!-- ========== Css Files ========== -->
  <link href="css/root.css" rel="stylesheet">
  <style type="text/css">
    body{background: #F5F5F5;}
  </style>
  </head>
  <body>

    <div class="login-form">
      <form action="" method='post'>
        <div class="top">
         <!--   <img src="img/kode-icon.png" alt="icon" class="icon">-->
          <h1>NNN Yönetim</h1>
          <h4>Müşteri Yönetim Sistemi</h4>
        </div>
        <div class="form-area">
          <div class="group">
            <input type="text" class="form-control" name='cep'  placeholder="Cep Telefonu" >
            <i class="fa fa-user"></i>
          </div>
          <div class="group">
            <input type="password" class="form-control" name='sifre' placeholder="Şifre" required>
            <i class="fa fa-key"></i>
          </div>

          <button type="submit" class="btn btn-default btn-block">Giriş</button>
          <?php

          $al=$baglanti -> query("SELECT * FROM uyeler where cep='$cep'");
           foreach ($al as $key) {
            $sifre=$key['sifre'];
            $cep1=$key['cep'];
          }
          if($_POST and ($_POST['sifre']!==$sifre)){
            echo "Şifreniz hatalıdır!";
          }

        
          if($_POST and !@$cep1 ){
            echo "Bu cep telefonu ile bir kullanıcı bulunamadı!";
          }

    
      

          ?>
        </div>
      </form>
      <div class="footer-links row">
        <div class="col-xs-6"><a href="uyekayit.php"><i class="fa fa-external-link"></i> Ücretsiz Kayıt Ol</a></div>
        <!--
        <div class="col-xs-6 text-right"><a href="sifremiunuttum.php"><i class="fa fa-lock"></i> Şifremi Unuttum</a></div>
      </div> 
    -->
    </div>

</body>
</html>

<?php
ob_end_flush();
?>