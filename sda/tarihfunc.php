<?php
function tarih($tarih1){
$tarih1=explode("-",$tarih1);
@$tarih1[1]=str_replace("01","Ocak",$tarih1[1]);
@$tarih1[1]=str_replace("02","Şubat",$tarih1[1]);
@$tarih1[1]=str_replace("03","Mart",$tarih1[1]);
@$tarih1[1]=str_replace("04","Nisan",$tarih1[1]);
@$tarih1[1]=str_replace("05","Mayıs",$tarih1[1]);
@$tarih1[1]=str_replace("06","Haziran",$tarih1[1]);
@$tarih1[1]=str_replace("07","Temmuz",$tarih1[1]);
@$tarih1[1]=str_replace("08","Ağustos",$tarih1[1]);
@$tarih1[1]=str_replace("09","Eylül",$tarih1[1]);
@$tarih1[1]=str_replace("10","Ekim",$tarih1[1]);
@$tarih1[1]=str_replace("11","Kasım",$tarih1[1]);
@$tarih1[1]=str_replace("12","Aralık",$tarih1[1]);
@$tarih2=$tarih1[2]." ".$tarih1[1]." ".$tarih1[0];
return $tarih2;
}


?>