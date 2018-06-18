<?php 
function filter($string) {
  $replace = "";
  $search = array(">", "<", "|", ";","UPDATE","SELECT","from","DELETE","*");
  $result = str_replace($search, $replace, $string);
  $result = preg_replace('/[^.%0-9]/', '', $result); 
  return $result;
}
?>