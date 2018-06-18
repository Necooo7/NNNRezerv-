<?php
@session_start();
include 'iskelet.php';
include 'temizlestr.php';
if ($_SESSION['id']) {
$id1=$_SESSION['id'];


}
else {
    header('location:giris.php');
}
?>


 <!-- //////////////////////////////////////////////////////////////////////////// --> 
<!-- START CONTENT -->
<div class="content">

  <!-- Start Page Header -->
  <div class="page-header">
    <h1 class="title">Müşteri Takibi Alanı</h1>
     <p4>Bu alanda sizden daha önce randevu almış fakat son 30 gündür randevu almamış müşterileriniz listelenecektir.</p4>
  </div>
  <!-- End Page Header -->

  <!-- Start Presentation -->
 
  <!-- End Presentation -->


 <!-- //////////////////////////////////////////////////////////////////////////// --> 
<!-- START CONTAINER -->
<div class="container-padding">


  <!-- Start Row -->
  <div class="row">
  <!--<form action="" method="post">
                <select name="personeladi" style="margin-left: 15px; font-size: 15PX;max-width: 140px;">
                <?php 
                /*
                 echo "<option selected value=''>Personele Göre Listele</option>";
                $verial=$baglanti->query("SELECT * FROM personel where uyeid=$id1");
                foreach ($verial as $key) {
                
                 print_r("<option value='".$key['personeladi']."''> " .$key['personeladi']. "</option>");
             }
              */
                ?>
            
                 <input style="margin-left:10px; margin-bottom:10px;" type="submit" class="btn btn-info btn-fill" value="Listele" > 
        
                </select> </form>
				
-->

    <!-- Start Panel -->
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-title">
        
        </div>
        <div class="panel-body table-responsive">

            <table id="example0" class="table display">
                <thead>
                    <tr>
                        <th>EN SON İŞLEM</th>
                        <th>GEÇEN SÜRE</th>
                        <th>BİLGİ</th>
                        <th>İLGİLENEN</th>
                    </tr>
                </thead>
             
                <tfoot>
                    <tr>
                        <th>EN SON İŞLEM</th>
                        <th>GEÇEN SÜRE</th>
                        <th>BİLGİ</th>
                        <th>İLGİLENEN</th>



						
                    </tr>
                </tfoot>
             
                <tbody>
                	<?php
date_default_timezone_set('Europe/Istanbul');
$now=date("Y-m-d");
$nowtime=strtotime($now);

$rehberal=$baglanti->query("SELECT * from rehberkayitlari where uyeid='$id1'");
foreach($rehberal as $rehberver){
$rehberid=$rehberver['id'];
$isim=$rehberver['adisoyadi'];
$rehberkayitlicep=$rehberver['cep'];
$ver=$baglanti->query("SELECT max(tarih) FROM rez where uyeid='$id1' and musteri='$rehberid'");
foreach($ver as $al){
	$ensontarih=$al['max(tarih)'];
	$ensontarihtime=strtotime($ensontarih);
    $fark=($nowtime-$ensontarihtime)/(24*60*60);
    if($fark>30 and $ensontarih){
    	$birdahaver=$baglanti->query("SELECT * FROM rez where uyeid='$id1' and musteri='$rehberid' and tarih='$ensontarih'");
    	foreach($birdahaver as $birdahaal){
    		$ilgilenen=$birdahaal['ilgili'];
    	}
    	echo "<tr>";
    	echo "<td>".@$ensontarih."</td>";
    	echo "<td>".@$fark." Gün</td>";
    	echo "<td>".@$isim."---".$rehberkayitlicep."</td>";
    	echo "<td>".@$ilgilenen."</td>";
    	echo "</tr>";

    	unset($ensontarih);
    	unset($isim);
    	unset($islem);
    	unset($aciklama);
    	unset($ilgilenen);
    	unset($fark);
    	}    	    

} //ver
unset($rehberid);
unset($fark);
} //rehberal

// 2. sorgulamayı dışardan alınan randevular için yapıyoruz.
$rehberal=$baglanti->query("SELECT * from rez where uyeid='$id1' and cep!=''");
foreach($rehberal as $rehberverasd){
$cep=$rehberverasd['cep'];
$rehberal1=$baglanti->query("SELECT * from rez where uyeid='$id1' and cep!='' LIMIT 1");
}
if(@$rehberal1){
foreach($rehberal1 as $rehberver){
  @$cep=$rehberver['cep'];
  @$isim=$rehberver['aciklama'];
$ver=$baglanti->query("SELECT max(tarih) FROM rez where uyeid='$id1' and cep='$cep'");
foreach($ver as $al){
  $ensontarih=$al['max(tarih)'];
  $ensontarihtime=strtotime($ensontarih);
    $fark=($nowtime-$ensontarihtime)/(24*60*60);
    if($fark>30 and $ensontarih){
      $birdahaver=$baglanti->query("SELECT * FROM rez where uyeid='$id1' and cep='$cep' and tarih='$ensontarih'");
      foreach($birdahaver as $birdahaal){
        $ilgilenen=$birdahaal['ilgili'];
        $isim=$birdahaal['aciklama'];
      }
      echo "<tr>";
      echo "<td>".@$ensontarih."</td>";
      echo "<td>".@$fark." Gün</td>";
      echo "<td>".@$isim."</td>";
      echo "<td>".@$ilgilenen."</td>";
      echo "</tr>";

      unset($ensontarih);
      unset($isim);
      unset($islem);
      unset($aciklama);
      unset($ilgilenen);
      unset($fark);
      }         

} //ver
unset($rehberid);
unset($fark);
} //rehberal
}//rehberal if
?>
				
                </tbody>                                       
            </table>


        </div>

      </div>
	  <br><br><br><br><br><br><br><br>  <br><br><br><br><br><br><br><br>  <br><br><br><br><br><br><br><br>  <br><br><br>
    </div>
    <!-- End Panel -->





  </div>
  <!-- End Row -->






</div>
<!-- END CONTAINER -->
 <!-- //////////////////////////////////////////////////////////////////////////// --> 



<!-- End Footer -->


</div>
<!-- End Content -->
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

<!-- ================================================
Data Tables
================================================ -->
<script src="js/datatables/datatables.min.js"></script>

<script>

      function not(myId) {
      //myId = $(this).attr("myId");
      $("#buton" + myId).attr("disabled","disabled");
      var post_edilecek_veriler = 'rehberid='+$("#rehberid" + myId).val() +'&not='+$('#not' + myId).val();    
      $.ajax({ 
  type:'POST', 
  url:'musteritakipnotekle.php', 
  data:post_edilecek_veriler,
  success:function(cevap){
      $("#satir" + myId).fadeOut("slow");
  //$("#satir" + myId).fadeOut("slow");
  //$("#msg" + myId).html(cevap); 
  //$("#sid1" + myId).attr("disabled","disabled");
  //$("#sid1" + myId).remove();
  //$("#buton" + myId).remove();
  
  } //success
  }); // ajax
 } //function

  



</script>




</body>
</html>
<script type="text/javascript">
    $('select').select2();
</script>