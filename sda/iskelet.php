<?php 
//error_reporting(E_ALL);
ob_start();
//error_reporting(0);
@session_start();
include 'db.php';
date_default_timezone_set('Europe/Istanbul');
$isimid=$_SESSION['id'];

?>
<!DOCTYPE html>
<html lang="en">
  <head>

<link rel="icon" href="logo1.ico" type="image/gif">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="keywords" content="" />
  <title>NNN Yönetim</title>

  <!-- ========== Css Files ========== -->
  <link href="css/root.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery.min.js"></script>
  </head>
  <body>
  <!-- Start Page Loading -->
  <!-- <div class="loading"><img src="img/loading.gif" alt="loading-img"></div> --> 
  <!-- End Page Loading -->
 <!-- //////////////////////////////////////////////////////////////////////////// --> 
  <!-- START TOP -->
  <div id="top" class="clearfix">

  	<!-- Start App Logo -->
  	<div class="applogo">
  		<a href="anasayfa.php" class="logo">NNN+</a>
  	</div>
  	<!-- End App Logo -->

    <!-- Start Sidebar Show Hide Button -->
    <a href="#" class="sidebar-open-button"><i class="fa fa-bars"></i></a>
    <a href="#" class="sidebar-open-button-mobile"><i class="fa fa-bars"></i></a>
    <!-- End Sidebar Show Hide Button -->

    <!-- Start Searchbox -->
    <form action="table.php" method="post" class="searchform">
      <input type="text" name="ara" class="searchbox" id="searchbox" placeholder="Ara (İsim yada Cep)">
      <span class="searchbutton"><button type="submit" class="btn btn-default btn-xs"><i class="fa fa-search"></i></button></span>
    </form>
    <!-- End Searchbox -->
   
    <!-- Start Top Right -->
    <ul class="top-right" style="margin-right:30px;">


    <li class="dropdown link">
      <a href="#" data-toggle="dropdown" class="dropdown-toggle hdbutton">Hesabım  <span class="caret"></span></a>
        <ul class="dropdown-menu dropdown-menu-list">
          <li><a href="hesabim.php"><i class="fa falist fa-wrench"></i>Ayarlar</a></li>
          <li><a href="cikis.php"><i class="fa falist fa-power-off"></i>Çıkış</a></li>
          
        </ul>
    </li>

   

   

    </ul>
    <!-- End Top Right -->

  </div>
  
  <!-- END TOP -->
 <!-- //////////////////////////////////////////////////////////////////////////// --> 

 <!-- //////////////////////////////////////////////////////////////////////////// --> 
<!-- START SIDEBAR -->

<div class="sidebar sidebar-colorful clearfix">
<ul><div style='margin-top:10px; width:200px; overflow: hidden; text-overflow: ellipsis; word-wrap: break-word;'>
<!--
  <p4>Müşteri No<br> <?php 
 
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
							echo "<p4><span class='badge'>".@$isimid." </span> </p4><br>";
							?> 
							</div>
            -->
							</ul>
<ul class="sidebar-panel nav">
  <li class="sidetitle"></li>
  <li><a href="anasayfa.php"><span class="icon color1"><i class="fa fa-home"></i></span>Anasayfa<span class="label label-default"></span></a></li>
  <li><a href="#"><span class="icon color3"><i class="fa fa-users"></i></span>Müşteri İşlemleri<span class="caret"></span></a>
    <ul>
    	<li><a href="yenirehberkaydi.php">Müşteri Ekle</a></li>
	    <li><a href="table.php">Müşteri Listele</a></li>
      <li><a href="yenigrupkaydi.php">Grup Ekle/Düzenle</a></li>
	  <li><a href="kayitsil.php">Müşteri Sil</a></li>
    </ul>
  </li>
   <li><a href="#"><span class="icon color7"><i class="fa fa-user"></i></span>Personel<span class="caret"></span></a>
    <ul>
  <li><a href="personel.php">Personel Ekle/Düzenle</a></li>
     
    </ul>
  </li>
  
  <li><a href="#"><span class="icon color4"><i class="fa fa-gears"></i></span>Ayarlar<span class="caret"></span></a>
    <ul>
      <li><a href="islemturleri.php">İşlem/Satış Türleri</a></li>
    </ul>
  </li>

   <li><a href="hesabim.php"><span class="icon color5"><i class="fa fa-user"></i></span>Hesabım</a></li>
   <li><a href="cikis.php"><span class="icon color9"><i class="fa fa-sign-out"></i></span>Çıkış</a></li>

</div>


