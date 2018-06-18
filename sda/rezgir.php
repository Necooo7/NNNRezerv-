<?php
date_default_timezone_set('Europe/Istanbul');
@session_start();
include 'db.php';
include 'temizle.php';
include 'temizlestr.php';
date_default_timezone_set('Europe/Istanbul');
$now=date("Y-m-d");
if ($_SESSION['id']) {
$id1=$_SESSION['id'];

}
else {
    header('location:giris.php');
}
$tarih=filter1($_POST['tarih']);
$musteriid=filter1($_POST['musteri']);


$saat=filter($_POST['saat']);
$saatal=$baglanti->query("SELECT * from calismasaatleri where id='$saat'");
foreach($saatal as $saatver){
  $saat=$saatver['saat'];
}
$ilgilenen=filter1($_POST['ilgilenen']);
 $persal=$baglanti->query("SELECT * from personel where id='$ilgilenen'");
    foreach($persal as $persver){
        $ilgilenen=$persver['personeladi'];
    }


$ekle1=$baglanti->query("INSERT INTO rez (uyeid,ilgili,musteri,tarih,saat)values('$id1','$ilgilenen','$musteriid','$tarih','$saat')");


if($ekle1){
  echo "Randevunuz başarıyla oluşturuldu.";
}
?>
