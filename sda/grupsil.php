<?php
ob_start();
@session_start();
$id1=$_SESSION['id'];
include 'db.php';

include 'iskelet.php';

@$grupad=@$_POST['grupadi'];
@$grupid=@$_POST['grupid'];
$sec=$baglanti->query("SELECT * from rehberkayitlari where uyeid='$id1' and grup='$grupad'");
foreach($sec as $sec1){
$idler[]=$sec1['id'];	
}
foreach($idler as $idler1){
	echo $idler1;
	$sil3=$baglanti->exec("DELETE FROM hesaphareket WHERE rehberid='$idler1'");
	$sil33=$baglanti->exec("DELETE FROM tahsilatlar WHERE rehberid='$idler1'");
}

$sil=$baglanti->exec("DELETE FROM gruplar WHERE grupid='$grupid'");
$sil2=$baglanti->exec("DELETE FROM rehberkayitlari WHERE uyeid='$id1' and grup='$grupad'");
if ($sil) {
    
     header("location:yenigrupkaydi.php");
}

ob_end_flush();
?>
