<?php
include 'db.php';
include 'temizle.php';
include 'temizlestr.php';
include 'personel.php';

$adi=filter1($_POST['adi']);
$cep=filter1($_POST['cep']);
$primoran=filter($_POST['primoran']);
$uyeid=filter($_POST['uyeid']);
$cep=ltrim($cep, "0");
$cep=ltrim($cep, "90");

$tr = array ('ı', 'İ', 'ç', 'Ç', 'Ü', 'ü', 'Ö', 'ö', 'ş', 'Ş', 'ğ', 'Ğ', ',', '.','<','>','|','(',')','*','X','x',';','='); 
$trok = array ('i', 'I', 'c', 'C', 'U', 'u', 'O', 'o', 's', 'S', 'g', 'G','','','','','','','','','','','',''); 
$adi = str_replace($tr, $trok, $adi);

$ekle=$baglanti->query("INSERT INTO personel(personeladi,personelcep,uyeid,primoran) values ('$adi','$cep','$uyeid','$primoran')");

if(ekle)
	header("location:personel.php");

?>