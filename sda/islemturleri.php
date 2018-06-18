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
    <h1 class="title">İşlem / Satış Türleri</h1>
     

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

        

            <div class="panel-body">
              <div class="col-md-5">
                                            <div class="form-group">
                                                <label>İşlem Türünün Adını Yazınız</label>
                                                <form action="" method="post">
												<input type="text" class="form-control" maxlength="50" name="islemturu" placeholder="" required><br>
                                                
                                            </div>
                                        </div>
										
                                       
                            
                                
										                      <div class="col-md-12">
                                            <div class="form-group">
                                <input type="submit" onclick="return window.confirm('Devam etmek istiyor musunuz?')" class="btn btn-info btn-fill pull-left" value="Kaydet">      
									 </div>
                </div>
                                     

                 
				   </form>
				   <br><br><br><br>
            </div>

      </div>
    </div>
    

   


<div class="col-md-11 col-lg-11">
      <div class="panel panel-default">

        

           <div class="panel panel-widget">
        <div class="panel-title">
          <span class="label label-warning"></span>
          <ul class="panel-tools">
            
            
            <li><a class="icon expand-tool"><i class="fa fa-expand"></i></a></li>
            
          </ul>
        </div>

       


        <div class="panel-body table-responsive">

          <table class="table table-hover table-striped">
            <thead>
              <tr>
               
                <td>İşlem Adı</td>
                <td>SİL</td>
                
              </tr>
            </thead>
            <tbody>
      <?php
             $id1=$_SESSION['id'];
       
                
             $verial = $baglanti->query("SELECT * FROM satisturu where uyeid='$id1' order by id DESC");
             foreach($verial as $degerler){
              $islemid=$degerler['id'];
				 $sablonadi=$degerler['tur'];
         echo " <tr>";
                 print_r("<td>".$sablonadi."</td>");
                 print_r("<td>"."<form action='' method='post'> <input type='hidden' name='islemid' value='$islemid'><input type='submit' class='btn btn-danger' value='Sil'></form>"."</td>");
         echo "<tr>";
       }
  
  
           ?>
            </tbody>
          </table>

        </div>
      </div>
    </div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
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

<?php
@$tur=filter1($_POST['islemturu']);
if(@$tur){
$guncelle1=$baglanti->query("INSERT INTO satisturu(uyeid,tur) values ('$id1','$tur')");
echo '<meta http-equiv="refresh" content="0;URL=\'islemturleri.php\'">';

}


@$sil=filter1($_POST['islemid']);
if(@$sil){
$sil=$baglanti->query("DELETE FROM satisturu where id='$sil'");
echo '<meta http-equiv="refresh" content="0;URL=\'islemturleri.php\'">';
}
?>