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


$al=$baglanti->query("SELECT * from uyeler where id='$id1'");
foreach ($al as $ver) {
    $ad=$ver['ad'];
    $cep=$ver['cep'];
    $adres=$ver['adres'];
}

?>


 <!-- //////////////////////////////////////////////////////////////////////////// --> 
<!-- START CONTENT -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div class="content">

  <!-- Start Page Header -->
  <div class="page-header">
    <h1 class="title">Hesap Ayarları</h1>
     

    <!-- Start Page Header Right Div -->
   
    <!-- End Page Header Right Div -->

  </div>
  <!-- End Page Header -->




 <!-- //////////////////////////////////////////////////////////////////////////// --> 
<!-- START CONTAINER -->
<div class="container-padding">


  
  <!-- Start Row -->
  <div class="row">
    

    <div class="col-md-12 col-lg-10">
      <div class="panel panel-default">

        

            <div class="panel-body">
              <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Ad, Soyad</label>
                                                <form action="hesabimguncelle.php" method="post">
                                                <input type="text" class="form-control" maxlength="30" name="ad"  placeholder="Kullanıcı Adı" value="<?php echo"$ad";?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Cep Telefonu </label>
                                                <input type="text" class="form-control" maxlength="11" name="tel" value="<?php echo"$cep";?>" readonly>
                                            </div>
                                        </div>
										
										 <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Mail</label>
                                                <input type="text" class="form-control" maxlength="50" name="mail" value="<?php echo"$adres";?>">
                                            </div>
                                        </div>

                                      
<div class="form-group">
                  <div  class="col-md-6">
                    <button type="submit" class="btn btn-default">Bilgileri Güncelle</button>
                  </div>
				   </form>
                </div>

            </div>

      </div>
	       <div class="panel panel-default">

        

            <div class="panel-body">
              <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Eski Şifre</label>
                                              <form action="sifreguncelle.php" method="post" target="_blank">
                                                <input type="password" class="form-control" name="eskisifre" maxlength="10" placeholder="" required>   </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Yeni Şifre </label>
                                                  <input type="password" class="form-control" name="yenisifre"  maxlength="10" placeholder="En Fazla 10 Karakter" required>
                                             </div>
                                        </div>
										<div class="col-md-6">
										<p3>Yeni şifrenizi girerken Türkçe karakter kullanmayınız.</p3>
									</div>
                                      
                                      
										
                                      
<div class="form-group">
                 <div  class="col-md-12">
                    <button type="submit" class="btn btn-default">Şifre Güncelle</button>
                  </div>
				   </form>
                </div>

            </div>

      </div>
    </div>
    

   




  </div>
  <br><br><br><br><br><br><br><br><br><br><br><br><br>
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