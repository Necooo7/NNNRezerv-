<?php
@session_start();


if ($_SESSION['id']) {

$id="a".$_SESSION['id'];
$id1=$_SESSION['id'];
unset($_SESSION['kayitid']);


}
else {
    header('location:giris.php');
}

include 'db.php';
include 'iskelet.php';

?>


 <!-- //////////////////////////////////////////////////////////////////////////// --> 
<!-- START CONTENT -->
<div class="content">

  <!-- Start Page Header -->
  <div class="page-header">
    <h1 class="title">Grup/Blok <?php echo $_POST['grupad1']; ?>  Kayıt Silme Ekranı</h1>
     

    <!-- Start Page Header Right Div -->
   
    <!-- End Page Header Right Div -->

  </div>
  <!-- End Page Header -->




 <!-- //////////////////////////////////////////////////////////////////////////// --> 
<!-- START CONTAINER -->
<div class="container-padding">


  
  <!-- Start Row -->
  <div class="row">
    

    <div class="col-md-12 col-lg-8">
      <div class="panel panel-default">

        

    
			<br>
 <div class="panel-body table-responsive">
          
          <table class="table table-hover">
            <thead>
              <tr>
                
        <td>Adı Soyadı</td>
				<td>Cep Tel</td>
				<td>Grup</td>
        <td></td>
               
              </tr>
            </thead>
            <tbody>
                    <?php
if($_POST['grupad1']==''){
	$grupad1=$_SESSION['grup1'];
}else{
	$grupad1=$_POST['grupad1'];
}


if ($grupad1) {

 
    
$verial = $baglanti->query("SELECT * FROM rehberkayitlari where grup='$grupad1' and uyeid='$id1'");
echo "<form action='kayitsil3.php' method='post'>";
foreach($verial as $degerler){
 echo " <tr>";
 print_r( "<td style='max-width:80px;'>". $degerler['adisoyadi'] ."</td>".
          "<td style='max-width:80px;'>". $degerler['cep'] . "</td>" .
          "<td style='max-width:80px;'>". $degerler['grup'] ."</td>".
          "<td><input type='checkbox' name='id[]' value='".$degerler['id']."'>" . "</td>"

);
 
 


}


}





?>
           </tbody>	
          </table>
        </div>
      </div>
    </div>
    

<?php 
$onayal=$baglanti->query("SELECT * FROM uyeler where id='$id1'");
foreach($onayal as $onayver){
	$silonay=$onayver['dairesilonay'];
}
if($silonay=='0'){
echo "<input type='submit' class='btn btn-danger btn-fill' value='Silme Yetkiniz Yok!' disabled></></tr> </form>";

}else{
echo "<input type='submit' class='btn btn-danger btn-fill' onclick='return window.confirm(\"Seçili kayıtları silmek istediğinize emin misiniz? Bu işlemin geri dönüşü olmayacaktır.\")' value='Seçili Kayıtları Sil'></></tr> </form>";
}
?>



  </div>
  <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
  <!-- End Row -->


  


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

</body>
</html>

