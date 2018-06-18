<?php
ob_start();
session_start();
include 'iskelet.php';
include 'tarihfunc.php';
include 'temizle.php';
include 'temizlestr.php';
$now=date("Y-m-d");


if ($_SESSION['id']) {
 $id1=$_SESSION['id'];

}
else {
    //header('location:giris.php');
}


?>
<!-- Start Page Loading -->
  
  <!-- End Page Loading -->
 <!-- //////////////////////////////////////////////////////////////////////////// --> 
<!-- START CONTENT -->
<div class="content">
<div class="loading"><img src="img/loading.gif" alt="loading-img"></div>


 <!-- //////////////////////////////////////////////////////////////////////////// --> 
<!-- START CONTAINER -->
<div class="container-padding">


  
  <div class="row">


   
  <div class="col-md-12">
    <div class="col-md-3">
   

  <!-- Start Quick Menu -->
  <ul class="panel quick-menu clearfix">
    <li class="col-sm-12">
     <a href="#i1" id='satisgir' style='background:#EF5350; '><i class="fa fa-money" style='color:#fff;'></i><p style='color:#fff;'>Satış Gir</p></a>
    </li>
  </ul>
  <!-- End Quick Menu -->

    </div>

    <div class="col-md-3">

 <!-- Start Quick Menu -->
  <ul class="panel quick-menu clearfix">
    <li class="col-sm-12">
      <a href="#i2" id='randevugir' style='background:#51b7a3;' ><i class="fa fa-clock-o" style='color:#fff;'></i><p style='color:#fff;'>Randevu Gir</p></a>
    </li>
  </ul>
  </div>
  <!-- End Quick Menu -->
    <!-- Start Quick Menu -->
     <div class="col-md-3">
  <ul class="panel quick-menu clearfix">
    <li class="col-sm-12">
      <a href="#i3" id='bugungoster' style='background: #f39c12;'><i class="fa fa-list" style='color:#fff;'></i><p style='color:#fff;'>Randevular </p></a>
    </li>
  </ul>
    </div>

</div>



 <!--/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->

  <div class="col-md-12" id='satis'>
     <div class="panel panel-widget">
        <div class="panel-title">
          Satış Gir <hr>
          </div>
  	<ul class="topstats clearfix">
   
	<li class="col-md-3">
      <span class="title"><i class="fa fa-credit-card"></i>Tutar</span>
      <h3><input size='2'  id='satisgirtl' placeholder='TL' type='number' min='0' max='9999'>
          <input size='1'  id='satisgirkrs' placeholder='Krş' type='number' min='0' max='9'></h3>
      
    </li>
    <li class="col-md-2">
      <span class="title"><i class="fa fa-user-md"></i>İlgilenen</span><br>
       	<select  id='satisgirilgilenen' style="max-width: 140px;" required>

          <?php 
			$verial = $baglanti->query("SELECT * FROM personel WHERE uyeid='$id1' and durum='1'");
            foreach ($verial as $deger) {
            echo  "<option class='form-control' value='".$deger['personeladi']."'>" .$deger['personeladi'] ."</option>";
            }
            ?>
         </select>  

      
    </li>

    <li class="col-md-2">
      <span class="title"><i class="fa fa-user-md"></i>Kasa</span><br>
       	<select  id='satisgirkasa' style="max-width: 140px;" required>

          <?php 
          echo "<option class='form-control' value='genel'>Genel</option'>";
			$verial = $baglanti->query("SELECT * FROM personelkasa WHERE uyeid='$id1'");
            foreach ($verial as $deger) {
            }
            ?>
         </select>  

      
    </li>

     <li class="col-md-2">
      <span class="title"><i class="fa fa-list-ul"></i>İşlem Türü</span><br>
        <select  id='satisgirtur' name="tur">

          <?php 
          echo "<option selected value='boya'>Boya</option>";
			$verial1234 = $baglanti->query("SELECT * FROM satisturu WHERE uyeid='$id1'");
            foreach ($verial1234 as $deger1234) {
            echo  "<option 'value= ".$deger1234['tur']."'>" .$deger1234['tur'] ."</option>";
            }
            ?>
         </select>  

      
    </li>
    <li class="col-md-2">
    	 <span class="title"><i class="fa fa-user"></i>Müşteri</span><br>
    <select id='satisgirmusteri'>
      <?php
  $verial=$baglanti->query("SELECT * from rehberkayitlari where uyeid='$id1'");
  foreach($verial as $veriver){
    $isim=$veriver['adisoyadi'];
    $cep=$veriver['id'];

    echo "<option value='$cep'>$isim</option>";
  }
  ?>
    </select>

    </li>
      <li class="col-md-5">
      <span class="title"><i class="fa fa-file-text-o"></i>Açıklama</span>
      <h3> </h3><textarea  id='satisgiraciklama' cols='40' rows='4' maxlength="250"></textarea>
    <li class="col-md-11">
      <span class="title"></span>
      <h3><input type='submit' onclick='satiskaydet()' class='btn btn-danger' value='Kaydet'></h3>
      
    </li>
  </ul>
  </div>
</div>


  <!--///////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
   <div class="col-md-12" id='randevu'>
    <div class="panel panel-widget">
        <div class="panel-title">
          Randevu Oluştur <hr>
          </div>
    <ul class="topstats clearfix">
   <li class="col-md-4"></li>
  <li class="col-md-2">
      <span class="title"><i class="fa fa-clock-o"></i>Tarih</span>
      <h3>
        <form action="" method="post">
      <?php
      if(filter1(@$_POST['rezsorgu'])){
      $posttarih=filter1($_POST['tarih']);  
      echo "<input size='8' name='tarih' id='tarih' value='$posttarih' type='text'>";
      }else{
        echo "<input size='8' name='tarih' id='tarih' value='$now' type='text'>";
      }
      ?>
         </h3>
      
    </li>
    <li class="col-md-2">
      <span class="title"><i class="fa fa-user-md"></i>İlgilenen</span><br>
        <select name='ilgilenen' id='ilgilenen' style="max-width: 140px;" required>
        <option selected value=''>Seçiniz</option>
          <?php  
            $verial = $baglanti->query("SELECT * FROM personel WHERE uyeid='$id1'");
            foreach ($verial as $deger) {
            $personelid=$deger['id'];
            $personeladi=$deger['personeladi'];
            echo "<option value='$personelid'>$personeladi</option>";
            }
            ?>
         </select>  

      
    </li>
    <li class="col-md-4"></li>
 <li class="col-md-12">
      <span class="title"></span>
      <h3><input type='submit' id='gonder' value='Sorgula' name='rezsorgu' class='btn btn-success' value='Kaydet'></h3>
      </form>
    </li>
  </ul>
  </div>
</div>
  <!--///////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->

    <!--///////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->

<div class="col-md-12" id='bugunrandevulari'>
      <div class="panel panel-widget">
        <div class="panel-title">
          BUGÜNE AİT Randevular <form method="post" action="tumrez.php" target="_blank">
                                <button style='float:right;' class='btn btn-warning' type="submit">Tüm Aktif Randevular</button>
                                </form>
          <?php
          @$bugunrez=filter1($_POST['bugunrez']);
          if($bugunrez){
            echo "<span class='label label-warning'>$bugunrez</span> <hr>";
            echo "<form action='' method='post'>";
            echo "TARİH DEĞİŞTİR<br><input size='8' name='bugunrez' id='bugunrez' value='$bugunrez' type='text' onchange='this.form.submit()'>";
            echo "</form>";
          }else{
            echo "<span class='label label-warning'>$now</span> <hr>";
            echo "<form action='' method='post'>";
            echo "TARİH DEĞİŞTİR<br><input size='8' name='bugunrez' id='bugunrez' value='$now' type='text' onchange='this.form.submit()'>";
            echo "</form>";
          }
          ?>
         
        </div>

       


        <div class="panel-body table-responsive">

          <table class="table table-hover table-striped">
            <thead>
              <tr>
                <td>Saat</td>
                <td>MÜŞTERİ</td>
                <td>İLGİLENEN</td>
                <td>İptal</td>
                
                
              </tr>
            </thead>
            <tbody>
      <?php
            
       
    
            if($bugunrez){
              echo "<input type='hidden' id='reztarihvarmi' value='1'>";
              $verial = $baglanti->query("SELECT * FROM rez where uyeid='$id1' and tarih='$bugunrez' ORDER BY saat ASC");
             }else{
             $verial = $baglanti->query("SELECT * FROM rez where uyeid='$id1' and tarih='$now' ORDER BY saat ASC");
             }
             foreach($verial as $degerler){
             $rezid123=$degerler['id'];
             $saat=$degerler['saat'];
             $anket=$degerler['anket'];
             $onlinemusteri=$degerler['aciklama'];
             $musteri123=$degerler['musteri'];
             $musterial1=$baglanti->query("SELECT * from rehberkayitlari where id='$musteri123'");
             foreach($musterial1 as $musteriver1){
             $musteriadi1=$musteriver1['adisoyadi'];
             if(!$musteriadi1){
              $musteriadi1=$degerler['aciklama'];
             }
             }
              if(!@$musteriadi1){
              $musteriadi1=$onlinemusteri;
             }
             $ilgilenen=$degerler['ilgili'];
             echo "<tr id='reziptalsatir$rezid123'>";
             echo "<td>$saat</td>";
             echo "<td>$musteriadi1</td>";
             echo "<td>$ilgilenen</td>";
             echo "<td><input type='hidden' id='reziptal$rezid123' name='reziptal$rezid123' value='$rezid123'>
                      <input type='submit' id='reziptalbuton' class='btn btn-danger' onclick='reziptal($rezid123)' name='reziptalbuton' value='İptal Et'></td>";
             echo "</tr>";
             unset($musteriadi1);
             unset($musteri123);
             }
  
           ?>
            </tbody>
          </table>

        </div>
      </div>
    </div>

   <!--/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->


  <?php
  if(filter1(@$_POST['rezsorgu']))
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
  echo "<script> alert('Üzgünüz, seçtiğiniz tarihte hizmet veremiyoruz.');</script>";
         
    exit("<script type='text/javascript'>
          window.location = 'anasayfa.php'
          </script>"); 
}




//Pazar ve salı günü sorgusu////////////////////
    $ilgilenen=filter($_POST['ilgilenen']);
    $persal=$baglanti->query("SELECT * from personel where id='$ilgilenen'");
    foreach($persal as $persver){
        $ilgilenen=$persver['personeladi'];
    }
  ?>
  <div class='col-md-2'></div>
    <div class="col-md-8">
    <ul class="topstats clearfix">
    <li class="col-md-12">
       <span class="title"><i class="fa fa-user"></i>Müşteri</span><br>
    <select  id='musteri1' name="musteri1">
      <?php
    echo "<option selected value=''>Seçiniz</option>";
    $verial=$baglanti->query("SELECT * from rehberkayitlari where uyeid='$id1'");
    foreach($verial as $veriver){
    $isim=$veriver['adisoyadi'];
    $cep=$veriver['id'];

    echo "<option value='$cep'>$isim</option>";
     }
     ?>
     </select>
     <br><br>
      <span class="title"><i class="fa fa-clock-o"></i><strong>Rezervasyon Oluşturulacak Tarih</strong></span><br>
    <span class='label label-warning'><?php echo tarih($reztarih); ?></span>
    </li>
    <li class="col-md-12">
      <span class="title"><i class="fa fa-clock-o"></i>Hatırlatma SMS'i Ne Zaman Ulaşsın?</span>
      <h3>
        </h3>
        <!--REZERV TARİHİ -1 GÜN -->
        <?php
        $rezartibir = strtotime('-1 day',strtotime($reztarih));
        $rezartibir = date('Y-m-d' ,$rezartibir );
        ?>
        <!--<input size='9' name='ileritarih' id='ileritarih'  placeholder='Tarih' type='text'>-->
        <select name='ileritarih' id='ileritarih'>
        <option selected value='<?=$reztarih?>'><?=$reztarih?></option>
        <option value='<?=$rezartibir?>'><?=$rezartibir?></option>
        </select>
        <select name='ilerisaat' id='ilerisaat'>
        <option selected value=''>Saat</option>
        <option value='08'>08</option>
        <option value='09'>09</option>
        <option value='10'>10</option>
        <option value='11'>11</option>
        <option value='12'>12</option>
        <option value='13'>13</option>
        <option value='14'>14</option>
        <option value='15'>15</option>
        <option value='16'>16</option>
        <option value='17'>17</option>
        <option value='18'>18</option>
        <option value='19'>19</option>
        <option value='20'>20</option>
        <option value='21'>21</option>
        <option value='22'>22</option>
        <option value='23'>23</option>
        </select>

        <select name='ileridakika' id='ileridakika'>
        <option selected value='00'>Dk</option>
        <option value='00'>00</option>
        <option value='15'>15</option>
        <option value='30'>30</option>
        <option value='45'>45</option>
        </select>
      
    </li>
  </form>
  <li class="col-md-12">
   <span class="title"><i class="fa fa-clock-o"></i><strong>Hatırlatma SMS İçeriği</strong></span><br>
   <textarea id="myText" name='myText' cols='30' rows='5'><?php echo "Sayın [isim], [saat] ".tarih($reztarih)." tarihinde bulunan randevunuzu hatırlatmak isteriz... Randevunuzu iptali için tıklayın; [iptal]"; ?></textarea>
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
        $suansaat=$suansaat+1;
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
    unset($yazdir12);
    unset($musteriadi);
    //foreach
    } ?>
    </ul>
    </div>
  <div class='col-md-2'></div>
  <?php } ?>


   



 <!--/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
    


</div>
</div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</div>

<!-- //////////////////////////////////////////////////////////////////////////// --> 

<!-- END CONTAINER -->
 <!-- //////////////////////////////////////////////////////////////////////////// --> 

<!-- End Content -->
 <!-- //////////////////////////////////////////////////////////////////////////// --> 

<!-- //////////////////////////////////////////////////////////////////////////// --> 

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




<!--=============MODAL FILES==========-->

  <!-- This is what you need -->
  <script src="dialog/dist/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="dialog/dist/sweetalert.css">
  <!--=============MODAL FILES==========-->

<style>
 .error { border:1px solid #000; padding:8px; border-color:red; }

</style>
  <script>
  

      function rez(myId) {
   
 detay = ['musteri1'];  //array değerlerimiz yukarıdaki inputların idsi
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
      var post_edilecek_veriler = 'saat='+$("#saat" + myId).val() +'&ilgilenen='+$('#ilgilenen' + myId).val()+'&tarih='+$('#tarih' + myId).val()+ '&musteri='+$('#musteri1').val();   
      $.ajax({  
  type:'POST', 
  url:'rezgir.php', 
  data:post_edilecek_veriler,
  success:function(cevap){
    alert(cevap)
  
  } //success
  }); // ajax
 } //function
}
 
 
  



</script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
<script>
$( "#tarih" ).datepicker({
dateFormat: "yy-mm-dd",
monthNames: [ "Ocak", "Şubat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık" ],
dayNamesMin: [ "Pa", "Pt", "Sl", "Ça", "Pe", "Cu", "Ct" ],
firstDay:1
});
 </script>

 <script>
$( "#ileritarih" ).datepicker({
dateFormat: "yy-mm-dd",
monthNames: [ "Ocak", "Şubat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık" ],
dayNamesMin: [ "Pa", "Pt", "Sl", "Ça", "Pe", "Cu", "Ct" ],
firstDay:1
});
 </script>

  <script>
$( "#borctarih" ).datepicker({
dateFormat: "yy-mm-dd",
monthNames: [ "Ocak", "Şubat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık" ],
dayNamesMin: [ "Pa", "Pt", "Sl", "Ça", "Pe", "Cu", "Ct" ],
firstDay:1
});
 </script>

   <script>
$( "#bugunrez" ).datepicker({
dateFormat: "yy-mm-dd",
monthNames: [ "Ocak", "Şubat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık" ],
dayNamesMin: [ "Pa", "Pt", "Sl", "Ça", "Pe", "Cu", "Ct" ],
firstDay:1
});
 </script>



  <!-- REZ İPTAL =================================================================>-->

<script>
 function reziptal(rezid) {
 
 
swal({
  title: "Emin misiniz?",
  text:  'Evet butonuna tıkladığınızda rezervasyon iptal edilecektir.',
  type: "info",
  showCancelButton: true,
  closeOnConfirm: true,
  showLoaderOnConfirm: false,
  confirmButtonText: "Evet",
  cancelButtonText: "Hayır",
},
function(){      
var post_edilecek_veriler = 'reziptalbuton='+$('#reziptalbuton').val() + '&reziptal='+$('#reziptal'+ rezid).val();
      $.ajax({ 
          type:'POST',  
          url:'reziptal.php',  
          data:post_edilecek_veriler,  
          success: 
        function(cevap){ 
          $("#reziptalsatir" + cevap).fadeOut("slow"); 
        } 
      }); 
});

 };


</script>
<!-- REZ İPTAL =================================================================>-->


<script>
   $("#satis").hide();
    $("#randevu").hide();
    $("#bugunrandevulari").hide();
</script>
<script>
$("#satisgir").click(function(){
   $("#satis").toggle(100);
   $("#randevu").hide();
   $("#bugunrandevulari").hide();
});
$("#randevugir").click(function(){
   $("#randevu").toggle(100);
   $("#satis").hide();
   $("#bugunrandevulari").hide();
});
$("#bugungoster").click(function(){
   $("#randevu").hide();
   $("#satis").hide();
   $("#bugunrandevulari").toggle(100);
});
</script>
<script>
if($("#sessionkontrol").val()==''){
	$("#temsilci").show();
}else{
$("#temsilci").hide();
}
</script>


<script>
  $(document).ready(function(){
   if($("#reztarihvarmi").val()=='1'){
    $("#bugunrandevulari").show();
   }
  });
</script>
</body>
</html>
<?php
ob_end_flush();
?>



<script>
  function satiskaydet(){
  veriler = new Object();
  veriler.tl = $("#satisgirtl").val();
  veriler.krs = $("#satisgirkrs").val();
  veriler.ilgilenen = $("#satisgirilgilenen").val();
  veriler.kasa = $("#satisgirkasa").val();
  veriler.tur = $("#satisgirtur").val();
  veriler.musteri = $("#satisgirmusteri").val();
  veriler.aciklama = $("#satisgiraciklama").val();
  
  $.ajax({
    type:'POST',
    data:veriler,
    url:'gelirkaydet.php',
    success:function(cevap){
      alert("Tamamlandı!");
    }
  })

    }
</script>