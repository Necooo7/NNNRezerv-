<?php
ob_start();

@session_start();
$id=$_SESSION['id'];
include 'db.php';
$al=$baglanti->query("SELECT * from uyeler where id=$id ");

$uyeid=$_SESSION['id'];
$yeniad=$_POST['ad'];
//$yenicep=$_POST['tel'];
$yenimail=$_POST['mail'];

$guncelle=$baglanti->exec("UPDATE uyeler set ad='$yeniad' where id='$uyeid' ");
// $guncelle2=$baglanti->exec("UPDATE uyeler set cep='$yenicep' where id='$uyeid' ");
$guncelle3=$baglanti->exec("UPDATE uyeler set adres='$yenimail' where id='$uyeid' ");

header("location:hesabim.php");
ob_end_flush();
?>