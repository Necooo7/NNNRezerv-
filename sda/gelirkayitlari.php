<?php
ob_start();
@session_start();
include 'tarihfunc.php';
include 'donemduzenle.php';
include 'temizle.php';
include 'temizlestr.php';
include 'iskelet.php';
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
    <h1 class="title">Gelir Kayıtları</h1>
     
<p6></p6>
    <!-- Start Page Header Right Div -->
   
    <!-- End Page Header Right Div -->

  </div>
  <!-- End Page Header -->




 <!-- //////////////////////////////////////////////////////////////////////////// --> 
<!-- START CONTAINER -->
<div class="container-padding">
  <!-- Start Row -->
  <div class="row">
<div class="col-md-11 col-lg-11">
      <div class="panel panel-default">

        

           <div class="panel panel-widget">
        <div class="panel-title">
          GELİR Kayıtları <span class="label label-warning"></span>
          
        </div>
       <form action="" method="post">
       <select name="donem" style='margin-bottom:10px;'>
					    <option selected value="">Dönem Seçiniz</option>
                        
						<?php
						$donem=$baglanti->query("SELECT * from donemler");
						foreach($donem as $donemver){
							$donemdeger=$donemver['donemdeger'];
							$donemadi=$donemver['donemadi'];
						echo "<option value='$donemdeger'>$donemadi</option>";
						}
						
						?>		
       </select>

       <select name="personel" style='margin-bottom:10px;'>
              <option selected value="">Personel Seçiniz</option>
                        
            <?php
            $personelver=$baglanti->query("SELECT * from personel where uyeid='$id1'");
            foreach($personelver as $personelal){
              $personeladi=$personelal['personeladi'];
            echo "<option value='$personeladi'>$personeladi</option>";
            }
            
            ?>    
       </select>
       <input type='submit' class="btn btn-success" value='Listele'>
					  </form>
                     <ul class="panel-tools">
            
            
                      
					   <li> <form action="tumgelirexcel.php" method="post" target="_blank">
				 <?php
				 if(filter1(@$_POST['donem'])){
				 @$donem=filter1($_POST['donem']);
				 echo "<input type='hidden' name='donem' value='$donem'>";
				 }
         if(filter1(@$_POST['personel'])){
         @$personel=filter1($_POST['personel']);
         echo "<input type='hidden' name='personel' value='$personel'>";
         }
				 ?>
          <button type='submit' class='btn btn-success btn-icon'><i class='fa fa-file-excel-o' > </i> </button>
					</form>
					</li>
					<li><a class="icon expand-tool"><i class="fa fa-expand"></i></a></li>
					</ul>

       <div class="panel-body table-responsive">

           <table id="example0" class="table display">
                <thead>
                    <tr>
                        <th>TARİH</th>
                        <th>BİLGİ</th>
                        <th>PERSONEL</th>
                        <th>TUTAR</th>
						            <th>KASA</th>
						
						
                    </tr>
                </thead>
             
                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        
						
						
                    </tr>
                </tfoot>
             
                <tbody>
				<?php 
        @$donem=filter1($_POST['donem']);
        
        if($donem){
				$geliral=$baglanti->query("SELECT * from tahsilatlar where tabloid='$id1' and donem='$donem'");
				}

        if(@$personel){
        $geliral=$baglanti->query("SELECT * from tahsilatlar where tabloid='$id1' and ilgilenen='$personel'");
        }

         if($donem and @$personel){
        $geliral=$baglanti->query("SELECT * from tahsilatlar where tabloid='$id1' and ilgilenen='$personel' and donem='$donem'");
        }

        if(!$donem and !@$personel){
				$geliral=$baglanti->query("SELECT * from tahsilatlar where tabloid='$id1'");
				}
				foreach ($geliral as $gelirver){
					$rehberid=$gelirver['rehberid'];
					$silid=$gelirver['id'];
          $personel=$gelirver['ilgilenen'];
					$rehberal=$baglanti->query("SELECT * from rehberkayitlari where id='$rehberid'");
					foreach($rehberal as $rehberver){
						$musteriadi=$rehberver['adisoyadi'];
						$bilgi=$musteriadi." <br>".@$gelirver['tur'] ." <br>".@$gelirver['aciklama']."";
					}
					if(!$rehberid){
						$bilgi=@$gelirver['aciklama'];
					}
					$tarih=tarih($gelirver['tarih']);
					$tutar=$gelirver['tutar'];
					$kasa=$gelirver['banka'];
				    if($kasa=="Elden Teslim"){
						$kasa="Nakit Kasa";
					}
            $gelironayal=$baglanti->query("SELECT * from uyeler where id='$id1'");
            foreach($gelironayal as $gelironayver){
              $onay123=$gelironayver['gelirgidersilonay'];
            }
            if($onay123=='0'){
					$silbuton="<form action='gelirkayitsil.php' method='post'><input type='hidden' name='silid' value='$silid'><input type='submit' style='margin-left:5px;' class='btn btn-danger' value='Silme Yetkiniz Yok!' disabled></form>";   
          }else{
            $silbuton="<form action='gelirkayitsil.php' method='post'><input type='hidden' name='silid' value='$silid'><input type='submit' style='margin-right:5px;' class='btn btn-danger' value='Sil'></form>";   
          }  
                    
					echo "<tr>
					    <td>$tarih</td>
						  <td>$bilgi</td>
              <td>$personel</td>
						  <td>$tutar TL</td>
						  <td>$kasa $silbuton</td>
						  </tr>";
						  
						  unset($bilgi);
				}
		
				?>
                </tbody>                                       
            </table>
        </div>
      </div>
    </div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
  </div>

  
  <!-- End Row -->


  


</div>
<!-- End Content -->
 <!-- //////////////////////////////////////////////////////////////////////////// --> 




<!-- ================================================
jQuery Library
================================================ -->
<script type="text/javascript" src="js/jquery.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
 <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
 <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
 <script>
 $( function() {
 
 $( "#tarih" ).datepicker({
 
 dateFormat: "yy-mm-dd",
 altFormat: "yy-mm-dd",
 altField:"#tarih-db",
 monthNames: [ "Ocak", "Şubat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık" ],
 dayNamesMin: [ "Pa", "Pt", "Sl", "Ça", "Pe", "Cu", "Ct" ],
 firstDay:1
});
 
 } );
 
 </script>
<script type="text/javascript" src="jquery-1.9.0.js"></script>

<script type="text/javascript" src="jquery-ui-1.10.0.custom.js"></script>

<link rel="stylesheet" href="demos.css" />

<link rel="stylesheet" href="jquery-ui-1.10.0.custom.min.css" />



<script type="text/javascript">

  $(function() {

  

    $( "#tarih" ).datepicker({

      dateFormat: "yy-mm-dd",//tarih formatı yy=yıl mm=ay dd=gün

      appendText: "(yıl-ay-gün)",//inputun sonuna bu yazıyı yazar.

      autoSize: true,//inputu otomatik boyutlandırır

      changeMonth: true,//ayı elle seçmeyi aktif eder

      changeYear: true,//yılı elee seçime izin verir

      dayNames:[ "pazar", "pazartesi", "salı", "çarşamba", "perşembe", "cuma", "cumartesi" ],//günlerin adı

      dayNamesMin: [ "pa", "pzt", "sa", "çar", "per", "cum", "cmt" ],//kısaltmalar

      defaultDate: +5,//takvim açılınca seçili olanı bu günden 10 gün sonra olsun dedik

      /*isRTL: true//takvimi ters çevirir garip bi özellik :D*/

      maxDate: "+2y+1m +2w",//ileri göre bilme zamanını 2 yıl 1 ay 2 hafta yaptık

      minDate: "-1y-1m -2w",//geriyi göre bilme alanını 1 yıl 1 ay 2 hafta yaptık.bunu istediğiniz gibi ayarlaya bilirsiniz

      monthNamesShort: [ "Ocak", "Şubat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık" ],//ay seçim alanın düzenledik

      nextText: "ileri",//ileri butonun türkçeleştirdik

      prevText: "geri",//buda geri butonu için

      showAnim: "bounce",//takvim açılım animasyonu alta tüm animasyon isimleri yazdım 

      /*fold-blind-bounce-clip-drop-explode-fade-highlight-puff-pulsate-scale-shake-slide-size-transfer*/

      showOn: "both",//inputun yanına ... butonu koyuyor

    });

    

  });

</script>

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
$(document).ready(function() {
    $('#example0').DataTable();
} );
</script>



<script>
$(document).ready(function() {
    var table = $('#example').DataTable({
        "columnDefs": [
            { "visible": false, "targets": 2 }
        ],
        "order": [[ 2, 'asc' ]],
        "displayLength": 25,
        "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
 
            api.column(2, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr class="group"><td colspan="5">'+group+'</td></tr>'
                    );
 
                    last = group;
                }
            } );
        }
    } );
 
    // Order by the grouping
    $('#example tbody').on( 'click', 'tr.group', function () {
        var currentOrder = table.order()[0];
        if ( currentOrder[0] === 2 && currentOrder[1] === 'asc' ) {
            table.order( [ 2, 'desc' ] ).draw();
        }
        else {
            table.order( [ 2, 'asc' ] ).draw();
        }
    } );
} );
</script>

</body>
</html>

<?php
ob_end_flush();
?>