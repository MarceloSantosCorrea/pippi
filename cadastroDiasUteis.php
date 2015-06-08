<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
$connect = mysql_connect("localhost","root","") or die (mysql_error());
$db = mysql_select_db("teste") or die (mysql_error());
?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>cadastro de dias úteis</title>
</head>

<body>
<?php
$dia = date('d');
$mes = date('m');
$ano = date('Y');
$data = $ano.'-'.$mes.'-'.$dia;
echo $diaSemana = date('W', strtotime($data));
$sqlCadatroDiaUtil = mysql_query("INSERT INTO dat (data) VALUES ('$data')") or die (mysql_error());
?>
</body>
</html>