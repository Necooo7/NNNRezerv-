<?php
//POST KONTROLÜ YAPILDI
ob_start();
@session_start();
include 'iskelet.php';
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
    <h1 class="title">Müşteri Grubu Kaydı</h1>
     

    <!-- Start Page Header Right Div -->
   
    <!-- End Page Header Right Div -->

  </div>
  <!-- End Page Header -->




 <!-- //////////////////////////////////////////////////////////////////////////// --> 
<!-- START CONTAINER -->
<div class="container-padding">


  
  <!-- Start Row -->
  <div class="row">
    

    <div class="col-md-12 col-lg-9">
      <div class="panel panel-default">

        

            <div class="panel-body">
              <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Müşteri Grubu</label>
                                                <form action="" method="post">
                                    <input type="text" class="form-control" maxlength="25" name="grupadi"  placeholder="Grup Adı" value="">
                                    <br>
                                    <button type="submit" class='btn btn-info btn-fill'>Kaydet</button>
									</div>
                                   </div>
								   
                                        
                                         

                  
                    
                 
				   </form>
               

            </div>
			<br>
 <div class="panel-body table-responsive">
          
          <table class="table table-hover">
            <thead>
              <tr>
                
                <td>Kayıtlı Gruplar</td>
               
              </tr>
            </thead>
            <tbody>
                                    



<?php


$verial = $baglanti->query("SELECT * FROM gruplar where uyeid='$id1' ORDER BY grupid ASC");
foreach($verial as $degerler){
 echo " <tr>";
 print_r( "<td> <form action='grupduzenle.php' method='post'>". "<input type='text' name='grup' maxlength='25' value='".$degerler['grupad']."'>" ."</td>"."<td>".
 " <input type='hidden' name='grupadi' value='".$degerler['grupad']."'> 
 <input type='hidden' name='grupid' value='".$degerler['grupid']."'>
 <input type='submit' class='btn btn-info btn-fill pull-right' onclick='return window.confirm(\"Grup ismini düzenlemek istediğinize emin misiniz?\")' value='Düzenle'></form>" ."</td>");
 
 
  print_r( "<td> <form action='grupsil.php' method='post'>".
 " <input type='hidden' name='grupadi' value='".$degerler['grupad']."'> 
 <input type='hidden' name='grupid' value='".$degerler['grupid']."'>");
 $onayal=$baglanti->query("SELECT * FROM uyeler where id='$id1'");
 foreach($onayal as $onayver){
 $silonay=$onayver['dairesilonay'];
 }
 if($silonay=='0'){
 echo "<input type='submit' class='btn btn-danger btn-fill pull-right' onclick='return window.confirm(\" Devam etmek istiyor musunuz?\")' value='Silme Yetkiniz Yok!' disabled></form>" ."</td>";
 }else{
 echo "<input type='submit' class='btn btn-danger btn-fill pull-right' onclick='return window.confirm(\" Devam etmek istiyor musunuz?\")' value='Sil'></form>" ."</td>";
  
 }
 echo " </tr>";


}



?>
             </tbody>
          </table>
        </div>
      </div>
    </div>
    

   




  </div>
  <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
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

<?php

include 'temizlestr.php';
@$grupadi=filter1(@$_POST['grupadi']);
$tr = array ('ı', 'İ', 'ç', 'Ç', 'Ü', 'ü', 'Ö', 'ö', 'ş', 'Ş', 'ğ', 'Ğ', ',', '.','<','>','|','(',')','*','X','x',';','='); 
$trok = array ('i', 'I', 'c', 'C', 'U', 'u', 'O', 'o', 's', 'S', 'g', 'G','','','','','','','','','','','',''); 
$grupadi = str_replace($tr, $trok, $grupadi);
$grupadi=ltrim($grupadi);
$kontrol=$baglanti->query("SELECT * from gruplar where uyeid='$id1' ");
            foreach ($kontrol as $kontrol1) {

              if ($grupadi==$kontrol1['grupad']) {
               echo "<script>alert('Bu grup adi ile daha önce kayıt yapılmış! Lütfen farklı bir grup adı ile kayıt oluşturmayı deneyin.');</script>";
                exit();
              }





}
if (!empty($grupadi)) {
  $ekle=$baglanti->query("insert into gruplar(uyeid,grupad) values ('$id1','$grupadi')");
}
if (@$ekle) {
    
     header("location:yenigrupkaydi.php");
}







     

ob_end_flush();
?>