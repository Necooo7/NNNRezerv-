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
    header('location:giris.php');
}

 $id1=$_SESSION['id'];
//$verial1=$baglanti->query("SELECT * from vatanapi where uyeid='$id1'");

foreach ($verial1 as $veriver) {
	$a=$veriver['musterino'];
	$b=$veriver['kulad'];
	$c=$veriver['sifre'];
	$d=$veriver['gonderen'];

}
//bakiye sorgulama
header('Content-Type: text/html; charset=utf-8');
ini_set("soap.wsdl_cache_enabled", "0"); 

/*
$SOAP = new SoapClient("http://www.oztekbayi.com/webservis/service.php?wsdl", array(
"trace"      => 1,
"exceptions" => 0));

@$MUSTERINO=$a; 
@$KULLANICIADI=$b;
@$SIFRE=$c; 
$SONUC = $SOAP->UyeBilgisiSorgula($MUSTERINO,$KULLANICIADI,$SIFRE); 
//echo "</pre>";       
*/
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


  
  <!-- Start Row -->
  <div class="row">

  

<div class="col-md-9">
      <div class="panel panel-widget">
        <div class="panel-title">
          Tüm Aktif Randevular
        </div>

       


        <div class="panel-body table-responsive">

          <table class="table table-hover table-striped">
            <thead>
              <tr>
                <td>TARİH</td>
                <td>Saat</td>
                <td>MÜŞTERİ</td>
                <td>İLGİLENEN</td>
                <td>SMS Zamanı</td>
                <td>İptal</td>
                
              </tr>
            </thead>
            <tbody>
      <?php
            
       
    
           
             $verial = $baglanti->query("SELECT * FROM rez where uyeid='$id1' and tarih>='$now' and durum='0' ORDER BY tarih DESC");
             foreach($verial as $degerler){
             $rezid123=$degerler['id'];
             $tarih=$degerler['tarih'];
             $saat=$degerler['saat'];
             $musteri123=$degerler['musteri'];
             $onlinemusteri=$degerler['aciklama'];
             $musterial1=$baglanti->query("SELECT * from rehberkayitlari where id='$musteri123'");
             foreach($musterial1 as $musteriver1){
             $musteriadi1=$musteriver1['adisoyadi'];
             }
              if(!@$musteriadi1){
              $musteriadi1=$onlinemusteri;
             }
             $ileritarihsms=$degerler['ileritarihsms'];
             $ilgilenen=$degerler['ilgili'];
             echo "<tr id='reziptalsatir$rezid123'>";
             echo "<td>$tarih</td>";
             echo "<td>$saat</td>";
             echo "<td>$musteriadi1</td>";
             echo "<td>$ilgilenen</td>";
             echo "<td>$ileritarihsms</td>";
             echo "<td><input type='hidden' id='reziptal$rezid123' name='reziptal$rezid123' value='$rezid123'>
                      <input type='submit' id='reziptalbuton' class='btn btn-danger' onclick='reziptal($rezid123)' name='reziptalbuton' value='İptal Et'></td>";
             echo "</tr>";
            unset($musteriadi1);
            unset($musteri123);
            unset($onlinemusteri);
             }
           ?>
            </tbody>
          </table>

        </div>
      </div>
    </div>

    <!--///////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->

  

</div>
</div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</div>

<!-- //////////////////////////////////////////////////////////////////////////// --> 

<!-- END CONTAINER -->
 <!-- //////////////////////////////////////////////////////////////////////////// --> 

<!-- End Content -->
 <!-- //////////////////////////////////////////////////////////////////////////// --> 

<!-- //////////////////////////////////////////////////////////////////////////// --> 

<script type="text/javascript">
    $('select').select2();
</script>
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
<script>
$('#gonder').click(function(){  //buton basılınca başlıyoruz...
 detay = ['ilgilenen','tl','musteri'];  //array değerlerimiz yukarıdaki inputların idsi
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
 $('#load').show(); //çalıştığını görmek için ajax loader.gif e sahip resmi görünür yaptık
 
 /* Burada kalan alan size ait. İster Ajax gönderim için kod yazın, isterseniz başka birşey yaptırın.*/
swal(
  'İşlem tamamlandı!',
  '',
  'success'
)

var post_edilecek_veriler = 'musteri='+$('#musteri').val() + '&tur='+$('#tur').val() + '&aciklama='+$('#aciklama').val() + '&ilgilenen='+$('#ilgilenen').val() + '&tl='+$('#tl').val() + '&krs='+$('#krs').val();
      $.ajax({ 
          type:'POST',  
          url:'gelirkaydet.php',  
          data:post_edilecek_veriler,  
          success: 
        function(cevap){ 
          alert(cevap)
             $("#musteri").val('');
             $("#tl").val('');
             $("#krs").val('');
             $("#aciklama").val('');
             $("#select2-musteri-container").val('Seçiniz');
             $("#select2-musteri-container").html('Seçiniz');
             $("#select2-selection__rendered").val('Seçiniz');
             $("#select2-selection__rendered").html('Seçiniz');
        } 
      });
};
});
  </script>
<style>
 .error { border:1px solid #000; padding:8px; border-color:red; }

</style>
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
 $('#load').show(); //çalıştığını görmek için ajax loader.gif e sahip resmi görünür yaptık
 
      //myId = $(this).attr("myId");
      var post_edilecek_veriler = 'saat='+$("#saat" + myId).val() +'&ilgilenen='+$('#ilgilenen' + myId).val() + '&ileridakika='+$('#ileridakika').val() + '&ilerisaat='+$('#ilerisaat').val() + '&ileritarih='+$('#ileritarih').val() + '&tarih='+$('#tarih' + myId).val()+ '&musteri='+$('#musteri1').val();   
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

  //$("#satir" + myId).fadeOut("slow");
  //$("#msg" + myId).html(cevap); 
  $("#buton" + myId).attr("disabled","disabled");
  $("#buton" + myId).fadeOut("slow");
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


</body>
</html>
<?php
//include 'limituyari.php';
ob_end_flush();
?>