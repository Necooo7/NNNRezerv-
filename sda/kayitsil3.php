<?php
ob_start();
@session_start();


if ($_SESSION['id']) {

$id="a".$_SESSION['id'];
$id1=$_SESSION['id'];
unset($_SESSION['kayitid']);


}
else {
    header('location:giris.php');
}

include 'db.php';
$idler=$_POST['id'];
foreach($idler as $idler1) {
	$kayitid=$idler1;
	echo $kayitid;
$sil=$baglanti->exec("DELETE FROM rehberkayitlari WHERE id='$kayitid'");
$sil2=$baglanti->exec("DELETE FROM hesaphareket WHERE rehberid='$kayitid'");

}

header("location:success.php");
ob_end_flush();
?>
