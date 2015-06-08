<?php
include'Connections/config.php';
$connect = mysql_connect("$hostname_config", "$username_config", "$password_config") or die('erro ao localizar base de dados'.mysql_error());
$db = mysql_select_db("$database_config") or die('erro ao localizar banco de dados'.mysql_error());
?>