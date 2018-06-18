
<?php
session_start();
include 'db.php';
if ($_SESSION['id']) {

$id=$_SESSION['id'];
$id1=$_SESSION['id'];


}
else {
    header('location:giris.php');
}

$ad=@$_POST['adisoyadi'];
$cep=@$_POST['cep'];
$cep=ltrim($cep, "0");
$cep=ltrim($cep, "90");
$grup=@$_POST['grup'];
$ilgilenen=$_POST['ilgilenen'];
$gun=$_POST['gun'];
$ay=$_POST['ay'];
$yil=$_POST['yil'];
$dogumtarih=$yil."-".$ay."-".$gun;
$persal=$baglanti->query("SELECT * from personel where id='$ilgilenen'");
    foreach($persal as $persver){
        $ilgilenen=$persver['personeladi'];
    }


$ver=$baglanti->query("SELECT * from uyeler where id='$id'");
foreach($ver as $al){
	$paket=$al['paket'];
}
$say=$baglanti->query("SELECT count(id) from rehberkayitlari where uyeid='$id'");
foreach($say as $sayver){
	$kayitsayi=$sayver['count(id)'];
}

	if($paket==="Deneme Sürümü" and $kayitsayi==20){
		
		echo "<script>alert('Deneme sürümünde en fazla 20 adet daire ekleyebilirsiniz.');</script>";
			   
    exit("<script type='text/javascript'>
          window.location = 'anasayfa.php'
          </script>"); 
	}


$ekle2=$baglanti->query("insert into rehberkayitlari(uyeid,adisoyadi,cep,grup,ilgilenen,dogumtarih)values('$id1','$ad','$cep','$grup','$ilgilenen','$dogumtarih')");

if(!$ekle2){
	 echo "Kayıt yapılamadı, tekrar deneyiniz.";
}else{
               
  echo "Kayıt tamamlandı.";

}



?>