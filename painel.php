<?php 
foreach ($_REQUEST as $___opt => $___val) {
  $$___opt = $___val;
}
if(empty($exe)) {
include("home/home.php");
}
elseif(substr($exe, 0, 4)=='http' or substr($exe, 
0, 1)=="/" or substr($exe, 0, 1)==".") 
{
echo '<br><font face=arial size=11px><br><b>A p�gina n�o existe.</b><br>Por favor selecione uma p�gina a partir do Menu Principal.</font>'; 
}
else {
include("$exe.php");
}

?>