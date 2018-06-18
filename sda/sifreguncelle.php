<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<?php
@session_start();
$id=$_SESSION['id'];
include 'db.php';
include 'temizlestr.php';
$eskisifre=filter1($_POST['eskisifre']);
$yenisifre=filter1($_POST['yenisifre']);

$yenisifre=str_replace("ç","c",$yenisifre);
$yenisifre=str_replace("Ç","C",$yenisifre);
$yenisifre=str_replace("ş","s",$yenisifre);
$yenisifre=str_replace("Ş","S",$yenisifre);
$yenisifre=str_replace("ü","u",$yenisifre);
$yenisifre=str_replace("Ü","U",$yenisifre);
$yenisifre=str_replace("İ","I",$yenisifre);
$yenisifre=str_replace("ı","i",$yenisifre);
$yenisifre=str_replace("ğ","g",$yenisifre);
$yenisifre=str_replace("Ğ","G",$yenisifre);
$yenisifre=str_replace("ö","o",$yenisifre);
$yenisifre=str_replace("Ö","O",$yenisifre);

$al=$baglanti->query("SELECT * from uyeler where id='$id' ");
foreach ($al as $ver) {
   
    if($eskisifre==$ver['sifre']){
		$guncelle=$baglanti->exec("UPDATE uyeler set sifre='$yenisifre' where id='$id'");
		echo "<script>alert('İşleminiz başarıyla tamamlandı.');</script>";
           echo "<script>window.close()</script>";
	                             }else {
									 echo "<script>alert('Eski şifreniz hatalıdır, lütfen tekrar deneyiniz.');</script>";
               echo "<script>window.close()</script>";
				}
								 
	

}

?>