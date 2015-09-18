 <?php
 $aurl = $_SERVER['REQUEST_URI'];
 $lurl = strtolower($aurl);

 if($aurl != $lurl){
header('location:'.$lurl);
 } else {
header('location:/404.html');
 }
 ?>