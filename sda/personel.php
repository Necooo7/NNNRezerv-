<?php
@session_start();
include 'iskelet.php';
include 'db.php';

if ($_SESSION['id']) {
  $id1=$_SESSION['id'];
} else {
    header('location:giris.php');
}

?>

 <!-- //////////////////////////////////////////////////////////////////////////// --> 
<!-- START CONTENT -->
<div class="content">

  <!-- Start Page Header -->
  <div class="page-header">
    <h1 class="title">Personeller</h1>
  </div>
  <!-- End Page Header -->

 <!-- //////////////////////////////////////////////////////////////////////////// --> 
<!-- START CONTAINER -->
 <div class="container-fluid">

 
 <div class="col-md-12 col-lg-10">
      <div class="panel panel-default">
        <div class="panel-body">
        

            <div class="panel-body">
              <div class="col-md-12">
                                    <div class="form-group">
                                    <h4 class="title">Yeni Personel Ekle </h4>
                                    <form action="personelekle.php" method="post">
                                    <div class="col-md-4">
                                    <input type="text" class="form-control" size='5' maxlength="50"  name="adi"  placeholder="Personel Adı" value="" required>
                                    </div>
                                    <div class="col-md-12">&nbsp</div>
                                     <div class="col-md-4">
                                    <input type="number" class="form-control" size='5'   name="cep"  placeholder="Personel Cep" value="" required>
                                    </div>
									                  <input type="hidden"  name='uyeid' value="<?php echo $id1; ?>">
                                    </div>
                                     <div class="col-md-12">&nbsp</div>
                                     <div class="col-md-12">

                                      <div class="col-md-12">
                                       <select name='primoran'>
                                        <option selected value=''>Prim Oranı Seçiniz</option>
                                        <option value='5'>%5</option>
                                        <option value='10'>%10</option>
                                        <option value='15'>%15</option>
                                        <option value='20'>%20</option>
                                        <option value='25'>%25</option>
                                        <option value='30'>%30</option>
                                        <option value='40'>%40</option>
                                        <option value='50'>%50</option>
                                        <option value='100'>%100</option>
                                      </select>
                                     </div>
      
                                     <div class="col-md-12">&nbsp</div>
                                    <div class="col-md-12">
									                  <button type="submit" onclick="return window.confirm('Emin misiniz?')" class='btn btn-info btn-fill'>Kaydet</button>
                                    </div>
                                   </div> 
                                         

                  
                    
                 
				   </form>
               

            </div>
			<br>
			<div class="col-md-12">
 <div class="panel-body table-responsive">
          
          <table class="table table-hover">
            <thead>
              <tr>
                
                <td>Personel Adı</td>
               <td>Personel Cep</td>
               <td>Durum</td>
               <td>GÜNCELLE</td>
              </tr>
            </thead>
            <tbody>				
					 <?php 
                          $personelal=$baglanti->query("SELECT * from personel where uyeid='$id1'");
                          foreach ($personelal as $personelver){
                          	$personeladi=$personelver['personeladi'];
                            $personelcep=$personelver['personelcep'];
                            $personelid=$personelver['id'];
                            $personeldurum=$personelver['durum'];
                            $primoran=$personelver['primoran'];

                                //CEP TELEFONU VE İSİM
                            	echo "<tr> <td><form action='personelguncelle.php' method='POST'>
								                    <input type='hidden' name='personelid' value='".$personelver['id']."'>
                                    <input type='hidden' name='eskiad' value='$personeladi'>
                            	   <input type='text' name='yeniad' value='$personeladi' required></td>";
                                echo "<td><input type='text' name='yenicep' value='$personelcep' required></td>";  



                                //AKTİFLİK DURUMU
                                if($personeldurum=='1'){
                                echo "<td><select name='durum'>
                                           <option selected value='1'>Aktif</option>
                                           <option value='0'>Pasife Al</option>
                                           </select>";

                                }else{
                                	echo "<td><select name='durum'>
                                           <option selected value='0'>Pasif</option>
                                           <option value='1'>Aktif Et</option>
                                           </select>";
                                }

                                /////////////////               
								echo "<td><input type='submit' class='btn btn-success' value='Güncelle'>";
								echo "</form>";

						  }								
						  ?> 
					
					            
            </tbody>
          </table>
        </div>
      </div>
	  </div>

 </div>
 <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
 </div>
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