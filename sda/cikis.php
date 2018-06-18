 <?php
ob_start();
@session_start();
include 'iskelet.php';
?>

 <!-- //////////////////////////////////////////////////////////////////////////// --> 
<!-- START CONTENT -->
<div class="content">



  <!-- Start Presentation -->
  <div class="row presentation">

    <div class="col-lg-8 col-md-6 titles">
      <span class="icon color5-bg"><i class="fa fa-check"></i></span>
      <h1>Çıkış yapılıyor...</h1>
      <h4>Anasayfaya yönlendiriliyorsunuz...</h4>
      <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    </div>


  </div>
  <!-- End Presentation -->







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


 

<?php
session_destroy();
  echo "<script>document.location.href = 'giris.php';</script>";
  ob_end_flush();
?>
</body>
</html>
