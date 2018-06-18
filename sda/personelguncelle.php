<?php
session_start();
if ($_SESSION['id']) {

$id1=$_SESSION['id'];


}
else {
    header('location:giris.php');
}

include 'db.php';
include 'temizle.php';
include 'temizlestr.php';
$personelid=filter($_POST['personelid']);
$yeniad=filter1($_POST['yeniad']);
$yenicep=filter1($_POST['yenicep']);
$yenicep=ltrim($yenicep, "0");
$yenicep=ltrim($yenicep, "90");
$yenidurum=filter($_POST['durum']);
$eskiad=filter1($_POST['eskiad']);

$tr = array ('ı', 'İ', 'ç', 'Ç', 'Ü', 'ü', 'Ö', 'ö', 'ş', 'Ş', 'ğ', 'Ğ', ',', '.','<','>','|','(',')','*','X','x',';','='); 
$trok = array ('i', 'I', 'c', 'C', 'U', 'u', 'O', 'o', 's', 'S', 'g', 'G','','','','','','','','','','','',''); 
$yeniad = str_replace($tr, $trok, $yeniad);

$guncelle=$baglanti->query("UPDATE personel set personeladi='$yeniad' where id='$personelid'");

$guncelle2=$baglanti->query("UPDATE personel set personelcep='$yenicep' where id='$personelid'");

$guncelle3=$baglanti->query("UPDATE personel set durum='$yenidurum' where id='$personelid'");

$guncelle4=$baglanti->query("UPDATE tahsilatlar set ilgilenen='$yeniad' where ilgilenen='$eskiad' and tabloid='$id1'");

header("location:personel.php");
?>