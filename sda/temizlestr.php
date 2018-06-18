<?php 
function filter1($string) {
  $replace = "";
  $search = array("|", ";","UPDATE","SELECT","FROM","DELETE","*","'","(",")","=","where","WHERE",'where','select','from','update','delete');
  $result = str_replace($search, $replace, $string);
  return $result;
}
?>