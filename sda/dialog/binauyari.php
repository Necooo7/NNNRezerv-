<!doctype html>

<html>



  <link rel="stylesheet" href="example/example.css">
  <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>

  <!-- This is what you need -->
  <script src="dist/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="dist/sweetalert.css">

<body>


<?php echo "";
?>
<script>



$(document).ready(function(){
swal({
  title: "Uyarı!",
  text: "Daire kaydetmeden önce bina eklemelisiniz.",
  type: "warning",
  showCancelButton: false,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Bina Ekle",
  closeOnConfirm: false,
  closeOnCancel: false
},
function(){
  window.location = "yenigrupkaydi.php"
});
});

</script>



</body>

</html>
