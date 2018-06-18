<?php
date_default_timezone_set('Europe/Istanbul');
session_start();
print_r($_POST);
if ($_SESSION['id']) {
$id1=$_SESSION['id'];
}
else {
    exit();
}
include 'temizle.php';
include 'temizlestr.php';
include 'db.php';
if(filter(@$_POST['tl'])){
$tl=filter($_POST['tl']);
$krs=filter($_POST['krs']);
if(!$tl){
	$tl=0;
}
if(!$krs){
	$krs=0;
}
$tutar=$tl.".".$krs;
@settype($tutar, double);
$tutar=round($tutar,1);
$ilgilenen=filter1($_POST['ilgilenen']);
$tarih=date("Y-m-d");
$donem=$tarih;
$musteri=filter($_POST['musteri']);
$aciklama=filter1($_POST['aciklama']);
$tur=filter1($_POST['tur']);
$kasa=filter1($_POST['kasa']);


echo "$musteri --- $id1 --- $tarih --- $tutar --- $donem --- $kasa --- $aciklama --- $tur ---- $ilgilenen";

$guncelle1=$baglanti->query("INSERT INTO tahsilatlar(rehberid,tabloid,tarih,tutar,donem,banka,aciklama,tur,ilgilenen)
	values
	('$musteri','$id1','$tarih','$tutar','$donem','$kasa','$aciklama','$tur','$ilgilenen')");
}

?>