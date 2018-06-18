<?php
session_start();
include 'db.php';
include 'temizle.php';
include 'tarihfunc.php';
if ($_SESSION['id']) {
$id1=$_SESSION['id'];
}
$reziptal=filter($_POST['reziptal']);

$sil=$baglanti->query("DELETE FROM rez where id='$reziptal'");


echo $reziptal;
?>