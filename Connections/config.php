<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
//$hostname_config = "mysql.brunopippi.cnt.br";
//$database_config = "brunopippi_cnt_br";
//$username_config = "brunopippicntbr";
//$password_config = "bruno2012";
$hostname_config = "localhost";
$database_config = "pippi";
$username_config = "root";
$password_config = "";
$config = mysql_pconnect($hostname_config, $username_config, $password_config) or trigger_error(mysql_error(),E_USER_ERROR); 
?>