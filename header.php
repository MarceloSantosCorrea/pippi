<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<?php include_once('Connections/config_pdo.php');?>
<?php include'conexao.php';?>
<?php date_default_timezone_set("Brazil/East");?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Bruno Pippi - Assessoria Contábil</title>

<link href="style.css" rel="stylesheet" type="text/css" />
<link href="style_agenda.css" rel="stylesheet" type="text/css"/>
<!--[if IE]>  
<link href="style_ie.css" rel="stylesheet" type="text/css" /> 
<![endif]-->
<link href="Scripts/shadowbox/shadowbox.css" rel="stylesheet" type="text/css" />
<link href="style/jquery.click-calendario-1.0.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="Scripts/jquery.js"></script>
<script type="text/javascript" src="Scripts/jquery.click-calendario-1.0-min.js"></script>		
<script type="text/javascript" src="Scripts/exemplo-calendario.js"></script>
<script type="text/javascript" src="Scripts/horario.js" ></script>
<script type="text/javascript" src="Scripts/pop_up.js" ></script>
<script type="text/javascript" src="Scripts/shadowbox/shadowbox.js"></script>
<script type="text/javascript" src="Scripts/shadobox_function.js"></script>
<script type="text/javascript" src="Scripts/mascara_dinheiro.js"></script>
<script type="text/javascript" src="Scripts/add_campo.js" ></script>
<script type="text/javascript" src="Scripts/mascara_data.js" ></script>
<script type="text/javascript" src="Scripts/ativarDesativarInput.js" ></script>
<script type="text/javascript" src="Scripts/aplicacaoAddCampo.js"></script>

</head>


<body onload="iniciar_hora();">
<div id="box">

	<div id="header">
    
    	<div id="header_logo">
       
        	<a href="painel.php"><img src="images/bruno_pippi_logo_painel.png" alt="" title="" border="0" width="250" height="65" /></a>
        </div><!-- hader logo -->
        
        <div id="header_msg">
        </div><!-- header msg -->
    </div><!-- header -->
        <div id="content">