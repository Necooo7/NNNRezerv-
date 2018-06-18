<?php
ob_start();
session_start();
date_default_timezone_set('Europe/Istanbul');
include 'db.php';
?>


<!DOCTYPE html>
<html lang="tr">
  <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="keywords" content="" />
  <title>Rezervasyon Yönetim Paneli</title>

  <!-- ========== Css Files ========== -->
  <link href="css/root.css" rel="stylesheet">
  <style type="text/css">
    body{background: #F5F5F5;}
  </style>
  </head>
  <body>

    <div class="login-form">
      <form action="" method="post" id='form'>
        <div class="top">
          <h1>Kayıt Ol</h1>
          <h4>Aramıza Hoşgeldiniz</h4>
        </div>
        <div class="form-area">
          <div class="group">
            <input type="text" name="ad" class="form-control" placeholder="İsim" autocomplete="off" required>
            <i class="fa fa-user"></i>
          </div>
          <div class="group">
            <input type="text" pattern=".{0}|.{10,13}" name="cep" class="form-control" placeholder="Cep Telefonu" autocomplete="off">
            <i class="fa fa-phone"></i>
          </div>
          <div class="group">
            <input type="text" class="form-control" name="mail" placeholder="E-mail" autocomplete="off" required>
            <i class="fa fa-envelope-o"></i>
          </div>

          <div class="group">
            <input type="password" class="form-control" name="sifre" id='sifre' placeholder="Şifre" autocomplete="off" required>
            <i class="fa fa-key" aria-hidden="true"></i>
          </div>

          <div class="group">
            <input type="password" class="form-control" name="sifre2" id='sifre2' placeholder="Şifre Tekrarı" autocomplete="off" required>
            <i class="fa fa-key" aria-hidden="true"></i>
          </div>
            </form>
         
          
          <button type="submit" onclick='kaydet()' class="btn btn-default btn-block">Kayıt Ol</button>
        </div>
      <div class="footer-links row">
        <div class="col-xs-6"><a href="giris.php"><i class="fa fa-sign-in"></i> Giriş Sayfası</a></div>
    </div>

</body>
</html>


<?php

        
            // Formdan Gelen Kayıtlar
            $cep= @$_POST['cep'];
            $cep=ltrim($cep, "0");
            $cep=ltrim($cep, "90");
            $cep=ltrim($cep, "+90");
            $sifre=@$_POST['sifre'];
            $ad= @$_POST['ad'];
            $adres= @$_POST['mail'];

           $kontrol=$baglanti->query("SELECT * from uyeler");
            foreach ($kontrol as $kontrol1) {

              if ($cep==$kontrol1['cep']) {
               echo "<script>alert('Bu cep telefonu ile daha önce kayıt oluşturulmuş, lütfen farklı bir cep telefonu ile kayıt oluşturmayı deneyin...');</script>";
                exit();
              }

               if ($_POST and $adres==$kontrol1['adres']) {
               echo "<script>alert('Bu mail adresi  ile daha önce kayıt oluşturulmuş, lütfen farklı bir mail adresi ile kayıt oluşturmayı deneyin...');</script>";
                exit();
              }


            }
			
            $bugun=date("Y-m-d");        
            // Veritabanına Ekleyelim.
            if (is_numeric($cep) and empty(!$ad)) {
              $ekle=$baglanti->prepare("insert into uyeler (ad,sifre,cep,adres,kayittarih) values (?,?,?,?,?)");
              $ekle->execute(array($ad,$sifre,$cep,$adres,$bugun));
         
            }
             $idver=$baglanti->query("SELECT * from uyeler where cep='$cep'");
              foreach ($idver as $idver2) {
                 $uyeid=$idver2['id'];
               $guncelleizingun=$baglanti->query("insert into izingunleri (uyeid) VALUES ('$uyeid')");
              }



///////mesai SAATLERİ EKLE//////////////////////////////////////////////////////////////////////////////
              $verial=$baglanti->query('SELECT * from saatler');
              foreach($verial as $veriver2){
              $saat=$veriver2['saat'];
              $saatguncelle=$baglanti->query("INSERT INTO calismasaatleri (uyeid,saat)values('$uyeid','$saat')");
              unset($saat);
              }
///////SAATLERİ EKLE//////////////////////////////////////////////////////////////////////////////
 
       

 

//kayıt tamam ise session ata ve anasayfaya yönlendir
 if ($ekle) {
  $_SESSION['id']=$uyeid;
  header("location:anasayfa.php");
  }

?>



<script src="js/jquery-3.2.1.js"></script>

<script type="text/javascript">
  
function kaydet(){
var sifre1=$("#sifre").val();
var sifre2=$("#sifre2").val();

if(sifre1==sifre2){
  $("#form").submit();
}else{
  alert("Şifreler uyuşmuyor.");
}

}


</script>


<?php
if (@$ekle and $_POST) {
    echo "<script>alert('Başarıyla kayıt oluşturdunuz, giriş sayfasına geçerek ...');</script>";
    $_SESSION['id']=$uyeid;
    header("location:anasayfa.php");
  }
ob_end_flush();
?>