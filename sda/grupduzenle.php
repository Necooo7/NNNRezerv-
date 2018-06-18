<?php
@session_start();
include 'iskelet.php';

$id1=$_SESSION['id'];

include 'db.php';
include 'temizlestr.php';
include 'temizle.php';



$grup=filter1($_POST['grup']);
$eskiad=filter1($_POST['grupadi']);
$grupid12=filter($_POST['grupid']);


$kontrol=$baglanti->query("SELECT * FROM gruplar where uyeid='$id1'");
foreach($kontrol as $kontrol1) {
	if ($grup==$kontrol1['grupad']) {
               echo "<script>alert('Bu grup adı ile rehberinizde bir grup adı daha bulunuyor, lütfen farklı bir grup adı  ile deneyin...');</script>";
			   
                exit("<script type='text/javascript'>
          window.location = 'yenigrupkaydi.php'
         </script>"); 
              }
}
$tr = array ('ı', 'İ', 'ç', 'Ç', 'Ü', 'ü', 'Ö', 'ö', 'ş', 'Ş', 'ğ', 'Ğ', ',', '.','<','>','|','(',')','*','X','x',';','='); 
$trok = array ('i', 'I', 'c', 'C', 'U', 'u', 'O', 'o', 's', 'S', 'g', 'G','','','','','','','','','','','',''); 
$grup = str_replace($tr, $trok, $grup);
$eskiad = str_replace($tr, $trok, $eskiad);
$grup=ltrim($grup);
$guncelle=$baglanti->exec("UPDATE gruplar SET grupad='$grup' where grupid='$grupid12'");

$guncelle2=$baglanti->exec("UPDATE rehberkayitlari set grup='$grup' where uyeid='$id1' and grup='$eskiad'");

    
echo "<script type='text/javascript'>
          window.location = 'yenigrupkaydi.php'
         </script>"

?>