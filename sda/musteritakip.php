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
     <p4>Bu alanda 30 gün boyunca işlem yapılmamış müşterileriniz listelenecektir.</p4>
  </div>
  <!-- End Page Header -->

  <!-- Start Presentation -->
 
  <!-- End Presentation -->

 <!-- //////////////////////////////////////////////////////////////////////////// --> 
<!-- START CONTAINER -->
<div class="container-padding">


  <!-- Start Row -->
  <div class="row">


    <!-- Start Panel -->
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-title">
        
        </div>
        <div class="panel-body table-responsive">
          <form action='musteritakiprandevu.php'>
          <input type='submit' class='btn btn-danger' value='Randevu Alanlara Göre Raporla'>
          </form>
            <table id="example0" class="table display">
                <thead>
                    <tr>
                        <th>EN SON İŞLEM</th>
                        <th>GEÇEN SÜRE</th>
                        <th>İSİM</th>
                        <th>İŞLEM TÜRÜ</th>
                        <th>AÇIKLAMA</th>
                        <th>İLGİLENEN</th>
                        <th>NOT</th>
                        <th>NOT EKLE</th>

                    </tr>
                </thead>
             
                <tfoot>
                    <tr>
                        <th>EN SON İŞLEM</th>
                        <th>GEÇEN SÜRE</th>
                        <th>İSİM</th>
                        <th>İŞLEM TÜRÜ</th>
                        <th>AÇIKLAMA</th>
                        <th>İLGİLENEN</th>
                        <th>NOT</th>
                        <th>NOT EKLE</th>


						
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
$not=$rehberver['note'];

$ver=$baglanti->query("SELECT max(tarih) FROM tahsilatlar where tabloid='$id1' and rehberid='$rehberid'");
foreach($ver as $al){
	$ensontarih=$al['max(tarih)'];
	$ensontarihtime=strtotime($ensontarih);
    $fark=($nowtime-$ensontarihtime)/(24*60*60);
    if($fark>30 and $ensontarih){
    	$birdahaver=$baglanti->query("SELECT * FROM tahsilatlar where tabloid='$id1' and rehberid='$rehberid' and tarih='$ensontarih'");
    	foreach($birdahaver as $birdahaal){
    		$tid=$birdahaal['id'];
    		$islem=$birdahaal['tur'];
    		$aciklama=$birdahaal['aciklama'];
    		$ilgilenen=$birdahaal['ilgilenen'];
    	}
      $fark=round($fark,1);
    	echo "<tr id='satir$tid'>";
    	echo "<td>".@$ensontarih."</td>";
    	echo "<td>".@$fark." Gün</td>";
    	echo "<td>".@$isim."</td>";
    	echo "<td>".@$islem."</td>";
    	echo "<td>".@$aciklama."</td>";
    	echo "<td>".@$ilgilenen."</td>";
    	echo "<td style='word-wrap: break-word; overflow-wrap: break-word;  max-width:100px; width:400px;'>".@$not."</td>";
    	echo "<td style='word-wrap: break-word; overflow-wrap: break-word;  max-width:100px; width:200px;'>
    	          <input type='hidden' name='rehberid$tid' id='rehberid$tid' value='$rehberid'>
    	          <input type='text' name='not$tid' id='not$tid'><br><br>
    	          <input type='button' id='buton$tid' class='btn btn-success btn-xs' value='Not Ekle' onclick='not($tid)' style='margin-left:50px;'>
    	      </td>";
    	echo "</tr>";

    	unset($ensontarih);
    	unset($isim);
    	unset($islem);
    	unset($aciklama);
    	unset($ilgilenen);
    	unset($fark);
    	unset($not);
    	}    	    

} //ver
unset($rehberid);
unset($fark);
} //rehberal
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
