 <script src="dialog/dist/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="dialog/dist/sweetalert.css">

<?php
@session_start();
include 'iskelet.php';
if ($_SESSION['id']) {

$id="a".$_SESSION['id'];
$id1=$_SESSION['id'];


}
else {
    header('location:giris.php');
}
$binavarmi=$baglanti->query("SELECT * FROM gruplar where uyeid='$id1'");
foreach($binavarmi as $binavarmii){
  $bina123=$binavarmii['grupad'];
}
?>


 <!-- //////////////////////////////////////////////////////////////////////////// --> 
<!-- START CONTENT -->
<div class="content">

  <!-- Start Page Header -->
  <div class="page-header">
    <h1 class="title">Müşteri Kaydı</h1>
     
<p4>Aşağıdaki alana müşteri bilgilerini yazarak müşteri listenize kaydedebilirsiniz.</p4>
    <!-- Start Page Header Right Div -->
   
    <!-- End Page Header Right Div -->

  </div>
  <!-- End Page Header -->




 <!-- //////////////////////////////////////////////////////////////////////////// --> 
<!-- START CONTAINER -->
<div class="container-padding">


  
  <!-- Start Row -->
  <div class="row">
    <div class="col-md-6">
      <div class="panel panel-default">
            <div class="panel-body">
                                         <div class="col-md-5">
                                            <div class="form-group">
                                              <form method='post' action='rehberverandevu.php'>
                                                <label>Müşteri Adı</label>
                                                <input type="text" class="form-control" maxlength="30" name="adisoyadi" id="adisoyadi"  placeholder="Müşteri Adı" value="" required>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Cep Telefonu </label>
                                                <input type="number" class="form-control" name="cep" id="cep" value="" placeholder="Cep Telefonu" required> 
                                            </div>
                                        </div>
                                        
                                         <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Müşteri Grubu *</label>
                                                <br>
                                              <select name='grup' class="form-group" id='grup' style="max-width: 140px;" required>
                                           <?php  echo "<option selected value=''>Seçiniz</option>";
										   $verial = $baglanti->query("SELECT * FROM gruplar WHERE uyeid='$id1'");
                                                 foreach ($verial as $deger) {
                                                 echo  "<option class='form-control' value='".$deger['grupad']."'>" .$deger['grupad'] ."</option>";
                                                
                                            }
											?>
                                                
                                                  </select> 
												  
												 
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>İlgilenen *</label>
                                                <br>
                                              <select name='ilgilenen' id='ilgilenen' class="form-group" style="max-width: 140px;" required>
                                           <?php  echo "<option selected value=''>Seçiniz</option>";
										   $verial = $baglanti->query("SELECT * FROM personel WHERE uyeid='$id1'");
                                                 foreach ($verial as $deger) {
                                                 echo  "<option class='form-control' value='".$deger['id']."'>" .$deger['personeladi'] ."</option>";
                                                
                                            }
											?>
                                                
                                                  </select> 
												  
												 
                                            </div>
                                        </div>
								                              <div class="col-md-12">
                                                <div class="form-group">
                                                <label>Doğum Tarihi</label>
                                              </div>
                                              </div>


                                            <div class="col-md-2">
                                                <label></label>
                                                <br>
                                              <select name='gun' id='dogumgun' class="form-group">
                                                <option selected value=''>Gün</option>
                                                <option value='01'>01</option>
                                                <option value='02'>02</option>
                                                <option value='03'>03</option>
                                                <option value='04'>04</option>
                                                <option value='05'>05</option>
                                                <option value='06'>06</option>
                                                <option value='07'>07</option>
                                                <option value='08'>08</option>
                                                <option value='09'>09</option>
                                                <option value='10'>10</option>
                                                <?php
                                                for ($i=11; $i < 32; $i++) { 
                                                 echo "<option value='$i'>$i</option>";
                                                }
                                                ?>
                                                
                                                  </select> 
                                          </div>

                                           <div class="col-md-2">
                                                <label></label>
                                                <br>
                                              <select name='ay' id='dogumay' class="form-group" style="margin-left:10px;">
                                                <option selected value=''>Ay</option>
                                                <option value='01'>Ocak</option>
                                                <option value='02'>Şubat</option>
                                                <option value='03'>Mart</option>
                                                <option value='04'>Nisan</option>
                                                <option value='05'>Mayıs</option>
                                                <option value='06'>Haziran</option>
                                                <option value='07'>Temmuz</option>
                                                <option value='08'>Ağustos</option>
                                                <option value='09'>Eylül</option>
                                                <option value='10'>Ekim</option>
                                                <option value='11'>Kasım</option>
                                                <option value='12'>Aralık</option>
                                                  </select> 
                                        </div>


                                            <div class="col-md-2">
                                                <label></label>
                                                <br>
                                              <select name='yil' id='dogumyil' class="form-group" style="margin-left:50px;">
                                                <option selected value=''>Yıl</option>
                                                <?php
                                                for ($i=2017; $i > 1945; $i--) { 
                                                 echo "<option value='$i'>$i</option>";
                                                }
                                                ?>
                                                  </select> 
                                        </div>
                                        <div class="col-md-12">&nbsp</div>

                  <div class="col-md-6">
                    <div class="form-group">
                       <label>Randevu Tarihi</label>
                       <br>
                    <input size='14' name='tarih' id='tarih' placeholder="Seçiniz" type='text' required>
                  </div>
                  </div>
                  <br>
                    <div class="col-md-6">
                      <br>
                      <div class="form-group">
                   <button type="submit" name='randevulu' class="btn btn-warning">Kaydet ve Randevu Gir</button>
                  </div>
                  </div>
                </form>
                <div class="col-md-12">
                <div class="col-md-6" >
                </div>
                  <div class="col-md-6" >
                    <div class="form-group">
                    <button  type="submit" id='rehberkayit' onclick='rehberkayit()' class="btn btn-default">Sadece Müşteri Kaydet</button>
                  </div>
                  </div>
                </div>




      </div>
    </div>
    </div>
    </div>






  </div>
  <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
  <!-- End Row -->


  


</div>
<!-- End Content -->
 <!-- //////////////////////////////////////////////////////////////////////////// --> 
<style>
 .error input{ border:1px solid #000; padding:8px; border-color:red; }
 .error select{ border:1px solid #000; padding:8px; border-color:red; }

</style>


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
<script>$(document).ready(function() {
	setTimeout(function(){ $("#badge").fadeOut("slow"); }, 3000);
	});
	</script>
	
   <script>
    function rehberkayit() { 
 detay = ['adisoyadi','cep','grup','ilgilenen'];  //array değerlerimiz yukarıdaki inputların idsi
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
      var veriler = 'adisoyadi='+$("#adisoyadi").val() +'&cep='+$('#cep').val() +'&grup='+$('#grup').val() +'&ilgilenen='+$('#ilgilenen').val() +'&gun='+$('#dogumgun').val() +'&ay='+$('#dogumay').val() +'&yil='+$('#dogumyil').val(); 
      $.ajax({ 
  type:'POST', 
  url:'rehberkayitekle.php',     // post işleminin yapılacağı dosyayı belirliyoruz.
  data:veriler,
  success:function(rehberkayitcevap){    
  alert(rehberkayitcevap)   ;              //ajax işlemi sonucu verilerin_gonderilecegi_dosya.php sayfasından gelen yanıtı cevap değişkenine atıyoruz.
    swal({
  position: 'top-right',
  type: 'success',
  title: rehberkayitcevap,
  showConfirmButton: false,
  timer: 2000
})   
 $("#cep").val('');
 $("#adisoyadi").val('');                         
  } //success kapandı
  }); // ajax kapandı
 } //function kapandı
}
  </script>


</body>
</html>