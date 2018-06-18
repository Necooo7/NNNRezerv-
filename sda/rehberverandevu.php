 <script src="dialog/dist/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="dialog/dist/sweetalert.css">
<?php
ob_start();
session_start();
include 'db.php';
include 'iskelet.php';
include 'tarihfunc.php';
include 'temizle.php';
include 'temizlestr.php';
if ($_SESSION['id']) {

$id=$_SESSION['id'];
$id1=$_SESSION['id'];


}
else {
    header('location:giris.php');
}
$now=date("Y-m-d");
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



//AYNI CEP TELEFONU İLE KAYIT VARMI DİYE SORGULUYORUZ
	$kayitsorgula=$baglanti->query("SELECT * FROM rehberkayitlari where cep='$cep' and grup='$grup' and uyeid='$id1'");
	 foreach($kayitsorgula as $idver){
	 	$rehberid=$idver['id'];
	 	$ad=$idver['adisoyadi'];
	 	$cep=$idver['cep'];
	 }

//EĞER KAYIT YOKSA VERİ TABANINA KAYDEDİYORUZ
	 if($rehberid){
echo "<script> swal({
  position: 'top-right',
  type: 'success',
  title: 'Her şey yolunda gözüküyor şimdi randevu bilgilerini girebilirsiniz. ',
  showConfirmButton: true,
  timer: 7000
}) </script>";
	 }else{
     $ekle2=$baglanti->query("insert into rehberkayitlari(uyeid,adisoyadi,cep,grup,ilgilenen,dogumtarih)values('$id1','$ad','$cep','$grup','$ilgilenen','$dogumtarih')");
     }
//EĞER KAYIT YOKSA VERİ TABANINA KAYDEDİYORUZ
if(!$ekle2){
}else{
       echo "<script> swal({
  position: 'top-right',
  type: 'success',
  title: 'Kayıt tamamlandı şimdi randevu bilgilerini girebilirsiniz. ',
  showConfirmButton: true,
  timer: 7000
}) </script>";        
 $idal=$baglanti->query("SELECT * FROM rehberkayitlari where cep='$cep' and adisoyadi='$ad' and uyeid='$id1'");
	 foreach($idal as $idver){
	 	$rehberid=$idver['id'];
	 	$ad=$idver['adisoyadi'];
	 	$cep=$idver['cep'];
	 }
}

  if($rehberid)
  { 
$reztarih=filter1($_POST['tarih']);
    //Pazar ve salı günü sorgusu////////////////////
$strdate=strtotime($reztarih);
$datedate=date("l",$strdate);
function turkce($md){
  $md=str_replace("Sunday","Pazar", $md);
  $md=str_replace("Tuesday","Salı", $md);
  return $md;
}
$rezgunu123=turkce($datedate);
$izingunual=$baglanti->query("SELECT * FROM izingunleri where uyeid='$id1'");
foreach($izingunual as $izingunuver){
  $izingunu=$izingunuver['izingunu'];
}
if($rezgunu123=="$izingunu"){
  echo "<script> swal('Üzgünüz, seçtiğiniz tarihte randevu veremiyoruz.');</script>";
         
    exit("<script type='text/javascript'>
          window.location = 'anasayfa.php'
          </script>"); 
}




//Pazar ve salı günü sorgusu////////////////////
  ?>
  <div class="content">
<style type="text/css">
	 .error select{ border:1px solid #000; padding:8px; border-color:red; }
</style>
 <!-- //////////////////////////////////////////////////////////////////////////// --> 
<!-- START CONTAINER -->
<div class="container-padding">
  <!-- Start Row -->
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
            <div class="panel-body">
  <div class='col-md-2'></div>
    <div class="col-md-8">
    <ul class="topstats clearfix">
    <li class="col-md-12">
       <span class="title"><i class="fa fa-user"></i>Müşteri</span><br>
       <input type='hidden' name='musteri1' id='musteri1' value='<?php echo $rehberid; ?>'>
       <input type='hidden' name='ilgilenen' id='ilgilenen' value='<?php echo $ilgilenen; ?>'>
       <input type='hidden' name='tarih' id='tarih' value='<?php echo $reztarih; ?>'>
       <span class='label label-warning'><?php echo $ad; ?></span>
     <br><br>
      <span class="title"><i class="fa fa-clock-o"></i><strong>Rezervasyon Oluşturulacak Tarih</strong></span><br>
    <span class='label label-warning'><?php echo tarih($reztarih); ?></span>
    </li>

     <?php
       $say=0;
 $verial=$baglanti->query("SELECT * from calismasaatleri where uyeid='$id1' and durum='1'");
 foreach($verial as $veriver2){
  $say++;
  $saat=$veriver2['saat'];
  $saatid=$veriver2['id'];
 ?>
 
 <li class="col-md-2">
      <input type='hidden' name='<?php echo "tarih".$saatid; ?>' id='<?php echo "tarih".$saatid; ?>' value='<?php echo $reztarih; ?>'>
      <input type='hidden' name='<?php echo "ilgilenen".$saatid; ?>' id='<?php echo "ilgilenen".$saatid; ?>' value='<?php echo $ilgilenen; ?>'>
      <input type='hidden' name='<?php echo "saat".$saatid; ?>' id='<?php echo "saat".$saatid; ?>' value='<?php echo $saatid; ?>'>
      <?php
      //Belirtilen saat boş mu ona bakıyoruz
      $verial=$baglanti->query("SELECT * from rez where uyeid='$id1' and ilgili='$ilgilenen' and tarih='$reztarih' and saat='".$saat."'");
      foreach($verial as $veriver){
        @$saatsorgu=$veriver['saat'];
        @$rezmusterisi=$veriver['musteri'];
        $musterial=$baglanti->query("SELECT * from rehberkayitlari where id='$rezmusterisi'");
        foreach($musterial as $musteriver){
          $musteriadi=$musteriver['adisoyadi'];
        }
        }
      if(@$saatsorgu==$saat){
        echo "<input type='submit' style='height:20px; width:50px;' class='btn btn-danger btn-xs' value='".$saat."' name='buton$saatid' disabled>";
        echo "<br>".@$musteriadi;
      }else{
        $yazdir12="<input type='submit' style='height:20px; width:50px;' id='buton$saatid' onclick='rez($saatid)'  class='btn btn-success btn-xs' value='".$saat."'>";
        $bugunstr=strtotime($now);
        $reztarihstr=strtotime($reztarih);
        $suansaat=date("H");
        $suandakika=date("i");
        $butonsaat=explode(":",$saat);
        $butonsaat1=$butonsaat[0];
        $butondakika1=$butonsaat[1];
        if(($suansaat>=$butonsaat1 and $reztarih==$now) or $reztarihstr<$bugunstr){
         echo "<input type='submit' style='height:20px; width:50px;' class='btn btn-danger btn-xs' value='".$saat."' name='buton$saatid' disabled>";
        }else{
        echo $yazdir12;
      }
      }
      ?>
    </li>
    <?php
    if($say==6 or $say==12 or $say==18){
     echo "<li class='col-md-12'></li>";
    }

    //foreach
    } ?>
    </ul>
    </div>
  <div class='col-md-2'></div>
</div>
</div>
</div>
</div>
<br><br><br><br><br><br><br><br><br><br><br><br><br>
</div>

  <?php } ?>

    <script>
  

      function rez(myId) {
 detay = ['ileritarih','musteri1','ileridakika','ilerisaat'];  //array değerlerimiz yukarıdaki inputların idsi
 sta = true; //varsayılan olarak gönderim değerimiz true 
    
 $.each(detay, function(){
 if ($('#'+this).val() == "")  //array için verilen her değer için #id inputun değerini kontrol ediyoruz
 {
 $('#'+this).parent().addClass('error'); //yukarıdaki if alanında boş döngü olursa yani değer yoksa bir üst alana error classı atıyoruz
 sta = false;  //ve tabii ki gönderimi kesmek için bu değeri false yapıyoruz.
 } else 
 {
 $('#'+this).parent().removeClass('error'); //değer alanı doldurulmuşsa alandaki class değerini siliyoruz
 }
 });
        if (sta == true)  // herşeyimiz doğru olarak yapılmışsa direkt gönderimi yapıyoruz.
 {
 $('#load').show(); //çalıştığını görmek için ajax loader.gif e sahip resmi görünür yaptık   myText
 $("#buton" + myId).attr("disabled","disabled");
      //myId = $(this).attr("myId");
      var post_edilecek_veriler = 'saat='+$("#saat" + myId).val() +'&ilgilenen='+$('#ilgilenen').val() + '&ileridakika='+$('#ileridakika').val() + '&ilerisaat='+$('#ilerisaat').val() + '&ileritarih='+$('#ileritarih').val() + '&tarih='+$('#tarih').val()+ '&musteri='+$('#musteri1').val() + '&myText='+$('#myText').val();   
      $.ajax({  
  type:'POST', 
  url:'rezgir.php', 
  data:post_edilecek_veriler,
  success:function(cevap){
    swal(
  'Rezervasyon tamamlandı!',
  '',
  'success'
)
  if(cevap=="none"){
    
  }
  //$("#satir" + myId).fadeOut("slow");
  //$("#msg" + myId).html(cevap); 
  $("#buton" + myId).attr("disabled","disabled");
  $("#buton" + myId).fadeOut("slow");
  $("#select2-musteri1-container").val()='';
  $("#select2-musteri1-container").html()='Seçiniz';

  //$("#sid1" + myId).remove();
  //$("#buton" + myId).remove();
  
  } //success
  }); // ajax
 } //function
}
 
 
  



</script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
<!-- ================================================
jQuery Library
================================================ -->
<script type="text/javascript" src="js/jquery.min.js"></script>

<!-- ================================================
Bootstrap Core JavaScript File
================================================ -->
<script src="js/bootstrap/bootstrap.min.js"></script>

<!-- ================================================
Plugin.js - Some Specific JS codes for Plugin Settings
================================================ -->
<script type="text/javascript" src="js/plugins.js"></script>