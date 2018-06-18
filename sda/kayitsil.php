<?php
@session_start();



if ($_SESSION['id']) {

$id="a".$_SESSION['id'];


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
<div class="container-padding">


  <!-- Start Row -->
  <div class="row">
  <!-- Start Page Header -->
  <div class="page-header">
    <h1 class="title">Müşteri Kaydı Silme Ekranı</h1>
  </div>
  <!-- End Page Header -->

 <!-- //////////////////////////////////////////////////////////////////////////// --> 
<!-- START CONTAINER -->

  
  <div class="col-md-9 col-lg-5">
      <div class="panel panel-widget">
        <div class="panel-title">
          Gruplar/Bloklar
          <ul class="panel-tools">
            
           
            <li><a class="icon expand-tool"><i class="fa fa-expand"></i></a></li>
            
          </ul>
        </div>

       


        <div class="panel-body table-responsive">

          <table class="table table-hover table-striped">
            
            <tbody>
			<?php


    $id1=$_SESSION['id'];


include 'db.php';


$verial = $baglanti->query("SELECT * FROM gruplar where uyeid='$id1'");
foreach($verial as $degerler){


 print_r( "<tr>"."<td>"."<form action='kayitsil2.php' method='post'>"."<td align='middle'>". "<input type='hidden' name='grupad1' value='".$degerler['grupad']."''>" ."</td>"."<td>". "<input type='submit' class='btn btn-info btn-fill' value='".$degerler['grupad']."'>" ."</td>" . "</tr> </form>");
 
 


}



?>
            </tbody>
          </table>

        </div>
      </div>
    </div>
	

   

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

</div>
<!-- END CONTAINER -->
 <!-- //////////////////////////////////////////////////////////////////////////// --> 
</div>
</div>

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


</body>
</html>
