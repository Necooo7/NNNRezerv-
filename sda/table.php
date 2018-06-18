<?php
@session_start();
include 'iskelet.php';
include 'temizlestr.php';
if ($_SESSION['id']) {

$id="a".$_SESSION['id'];
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
    <h1 class="title">Müşteri Listesi</h1>
     
  </div>
  <!-- End Page Header -->

  <!-- Start Presentation -->
 
  <!-- End Presentation -->


 <!-- //////////////////////////////////////////////////////////////////////////// --> 
<!-- START CONTAINER -->
<div class="container-padding">


  <!-- Start Row -->
  <div class="row">
  <form action="" method="post">
                <select name="grupad" style="margin-left: 15px; font-size: 15PX;max-width: 140px;">
                <?php 
                
                 echo "<option selected value=''>Seçiniz</option>";
				  echo "<option select value='tumkayit'>Tüm Kayıtlar</option>";
				 
                $verial=$baglanti->query("SELECT * FROM gruplar where uyeid=$id1 ORDER BY grupid ASC");
                foreach ($verial as $key) {
                
                 print_r("<option value='".$key['grupad']."''> " .$key['grupad']. "</option>");
             }
                ?>
            
                 <input style="margin-left:10px; margin-bottom:10px;" type="submit" class="btn btn-info btn-fill" value="Listele" > 
        
                </select> </form>
				

    <!-- Start Panel -->
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-title">
          
        </div>
        <div class="panel-body table-responsive">

            <table id="example0" class="table display">
                <thead>
                    <tr>
                        <th>İSİM</th>
                        <th>CEP TEL</th>
                        <th>GRUP</th>
                        <th>İLGİLİ</th>
                        <th>BORÇ</th>
						
                    </tr>
                </thead>
             
                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </tfoot>
             
                <tbody>
				<?php
				$grupad=filter1(@$_POST['grupad']);

              $_SESSION['grupad']=filter1(@$_POST['grupad']);
              if (filter1(@$_POST['grupad'])) { 
				
                    $verial = $baglanti->query("SELECT * FROM rehberkayitlari where uyeid='$id1' and grup='$grupad' LIMIT 0,6000");
                    foreach($verial as $degerler){
					echo " <tr>";
print_r(  "<td style='word-wrap: break-word; max-width:80px;'>". $degerler['adisoyadi'] ."</td>".
          "<td style='max-width:80px;'>". $degerler['cep'] . "</td>" .
          "<td style='max-width:80px;'>". $degerler['grup'] ."</td>".
          "<td style='max-width:80px;'>". $degerler['ilgilenen'] ."</td>".
          "<td style='max-width:80px;'>". $degerler['borc'] ." TL</td>".


          "<form action='uyebilgileri.php' method='post'>"."<td align='middle'>". "<input type='hidden' name='id' value=".$degerler['id'].">" . 
          "</td>"

);
echo " </tr> </form>";
					}
			  }
			  
			  if(filter1(@$_POST['grupad'])=='tumkayit'){
    
$verial1 = $baglanti->query("SELECT * FROM rehberkayitlari where uyeid='$id1'");
foreach($verial1 as $degerler){
 echo " <tr>";
print_r(  "<td style='word-wrap: break-word; max-width:80px;'>". $degerler['adisoyadi'] ."</td>".
          "<td style='max-width:80px;'>". $degerler['cep'] . "</td>" .
          "<td style='max-width:80px;'>". $degerler['grup'] ."</td>".
          "<td style='max-width:80px;'>". $degerler['ilgilenen'] ."</td>".
          "<td style='max-width:80px;'>". $degerler['borc'] ." TL</td>".


          "<form action='uyebilgileri.php' method='post'>"."<td align='middle'>". "<input type='hidden' name='id' value=".$degerler['id'].">" . 
          "</td>"

);
 
 echo " </tr> </form>";


}

}

if (filter1(@$_POST['ara'])) {
    $ara1="%".filter1(@$_POST['ara'])."%";
$verial = $baglanti->query("SELECT * FROM rehberkayitlari where uyeid='$id1' and (adisoyadi like '$ara1' or cep like '$ara1')");
foreach($verial as $degerler){
 echo " <tr>";
print_r(  "<td style='word-wrap: break-word; max-width:80px;'>". $degerler['adisoyadi'] ."</td>".
          "<td style='max-width:80px;'>". $degerler['cep'] . "</td>" .
          "<td style='max-width:80px;'>". $degerler['grup'] ."</td>".
          "<td style='max-width:80px;'>". $degerler['ilgilenen'] ."</td>".
          "<td style='max-width:80px;'>". $degerler['borc'] ." TL </td>".


          "<form action='uyebilgileri.php' method='post'>"."<td align='middle'>". "<input type='hidden' name='id' value=".$degerler['id'].">" . 
           "</td>"

);
 
 echo " </tr> </form>";


}
}
					
					?>
                </tbody>                                       
            </table>


        </div>

      </div>
	  <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
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

<!-- END SIDEPANEL -->
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
<script src="js/datatables/datatables1.min.js"></script>



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
        "displayLength": 125,
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
