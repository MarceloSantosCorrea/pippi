<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php 
include_once("conexao.php");
?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<link href="home/style_recibo.css" rel="stylesheet" type="text/css" />

</head>
<?php
if(isset($_POST['enviar'])){
$cliente = $_POST['select_cliente'];
$valor = $_POST['valorRecibo'];
$data = $_POST['dataRecibo'];
$dataTimestamp = substr($data,6,4).'-'.substr($data,3,2).'-'.substr($data,0,2);
$dataHora = $dataTimestamp.' '.date('H:i:s');
$referente = $_POST['referenteRecibo'];
$dia = date('d', strtotime($dataTimestamp));
$ano = date('Y');
$mes = date('m', strtotime($dataTimestamp));
switch($mes) {
case"01": $NomeMes = "Janeiro"; break;
case"02": $NomeMes = "Fevereiro"; break;
case"03": $NomeMes = "Março"; break;
case"04": $NomeMes = "Abril"; break;
case"05": $NomeMes = "Maio"; break;
case"06": $NomeMes = "Junho"; break;
case"07": $NomeMes = "Julho"; break;
case"08": $NomeMes = "Agosto"; break;
case"09": $NomeMes = "Setembro"; break;
case"10": $NomeMes = "Outubro"; break;
case"11": $NomeMes = "Novembro"; break;
case"12": $NomeMes = "Dezembro"; break;
}
if($cliente == '-1'){
	echo'<script type="text/javascript">
	alert("Selecione o Cliente");
	</script>
	<meta http-equiv="refresh" content="0; url=painel.php?exe=home/recibo"';
	}elseif($valor == ''){
	echo'<script type="text/javascript">
	alert("Informe o valor do recibo");
	</script>
	<meta http-equiv="refresh" content="0; url=painel.php?exe=home/recibo"';
	}elseif($data == ''){
	echo'<script type="text/javascript">
	alert("Informe a Data do recibo");
	</script>
	<meta http-equiv="refresh" content="0; url=painel.php?exe=home/recibo"';
	}elseif($referente == ''){
	echo'<script type="text/javascript">
	alert("Informe a referência do recibo");
	</script>
	<meta http-equiv="refresh" content="0; url=painel.php?exe=home/recibo"';
	}else{
$SelectCliente = mysql_query ("SELECT * FROM cadastro_clientes WHERE cliente_id = '$cliente'") or die (mysql_error());
while($resCliente = mysql_fetch_array($SelectCliente)){
	$ClienteNome = $resCliente['cliente_nome'];
	$ClienteRazao = $resCliente['cliente_razao'];	
		}
if($ClienteNome == ''){$NomeCliente = $ClienteRazao;}elseif($ClienteRazao == ''){$NomeCliente = $ClienteNome;}
$RegistrarRecibo = mysql_query ("INSERT INTO recibo (reciboCliente, reciboValor, reciboData, reciboReferente, reciboDataFiltro) VALUES ('$NomeCliente','$valor','$dataHora','$referente', '$dataTimestamp')") or die (mysql_error());
$SelectRecibo = mysql_query ("SELECT * FROM  recibo WHERE reciboData = '$dataHora'") or die (mysql_error());
while($resSelectRecibo = mysql_fetch_array($SelectRecibo)){
	$VizualizarReciboId = $resSelectRecibo['reciboId'];
	$VizualizarReciboCliente = $resSelectRecibo['reciboCliente'];
	$VizualizarReciboData = $resSelectRecibo['reciboData'];
	$VizualizarReciboValor = $resSelectRecibo['reciboValor'];
	$VizualizarReciboReferente = $resSelectRecibo['reciboReferente'];
	}
	}
}else{
$recibo = $_GET['recibo'];
$VisualizarRecibo = mysql_query ("SELECT * FROM recibo WHERE reciboId = '$recibo'") or die (mysql_error());
while($resVisualizarRecibo = mysql_fetch_array($VisualizarRecibo)){
	$VizualizarReciboId = $resVisualizarRecibo['reciboId'];
	$VizualizarReciboCliente = $resVisualizarRecibo['reciboCliente'];
	$VizualizarReciboData = $resVisualizarRecibo['reciboData'];
	$VizualizarReciboValor = $resVisualizarRecibo['reciboValor'];
	$VizualizarReciboReferente = $resVisualizarRecibo['reciboReferente'];
	
	}
$dia = date('d', strtotime($VizualizarReciboData));
$ano = date('Y', strtotime($VizualizarReciboData));
$mes = date('m', strtotime($VizualizarReciboData));
switch($mes) {
case"01": $NomeMes = "Janeiro"; break;
case"02": $NomeMes = "Fevereiro"; break;
case"03": $NomeMes = "Março"; break;
case"04": $NomeMes = "Abril"; break;
case"05": $NomeMes = "Maio"; break;
case"06": $NomeMes = "Junho"; break;
case"07": $NomeMes = "Julho"; break;
case"08": $NomeMes = "Agosto"; break;
case"09": $NomeMes = "Setembro"; break;
case"10": $NomeMes = "Outubro"; break;
case"11": $NomeMes = "Novembro"; break;
case"12": $NomeMes = "Dezembro"; break;
}
	}
?>
<body>
	<div id="recibo">
    	<div id="reciboUm">
    		<div id="topo">
            	<div id="logo">
        			<img src="images/bruno_pippi_logo_painel.png" />
                	<span>ASSESSORIA CONTÁBIL<br />CRC RS 52108</span>
                </div><!-- logo -->
        		<h1>Recibo</h1>
            	<h2>N° <?php echo $VizualizarReciboId;?></h2>
                <h3>Recibo valor: R$ <?php echo number_format($VizualizarReciboValor, 2, ',', '.'); // retorna R$100.000,50 ?></h3>
        </div><!-- topo -->
        	<div id="descricao">
            		<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Recebi de &nbsp;&nbsp;<strong><?php echo $VizualizarReciboCliente;?></strong>&nbsp;&nbsp; Ref° <?php echo $VizualizarReciboReferente;?></p>
            </div><!-- descricao -->
            <div id="data">
            	<p>Santa Maria, <?php echo $dia;?> de <?php echo $NomeMes;?> de <?php echo $ano;?></p>
            </div><!-- data -->
            <div id="assinatura">
            	<p>_______________________________________<br /><br />
Bruno E. Lorenzen Pippi<br />CPF 303.110.630.04</p>
            </div><!-- assinatura -->
            <div id="rodape">
            	Rua Deus Lhe Pague, 12. Sala 02, Bairro KM3 Santa Maria-RS - Fone:(55) 9626-5008
            </div><!-- rodape -->
        </div><!-- reciboUm -->
        
        <div id="reciboDois">
        	<div id="topo">
            	<div id="logo">
        			<img src="images/bruno_pippi_logo_painel.png" />
                	<span>ASSESSORIA CONTÁBIL<br />CRC RS 52108</span>
                </div><!-- logo -->
        		<h1>Recibo</h1>
            	<h2>N° <?php echo $VizualizarReciboId;?></h2>
                <h3>Recibo valor: R$ <?php echo number_format($VizualizarReciboValor, 2, ',', '.'); // retorna R$100.000,50 ?></h3>
        </div><!-- topo -->
        	<div id="descricao">
            		<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Recebi de &nbsp;&nbsp;<strong><?php echo $VizualizarReciboCliente;?></strong>&nbsp;&nbsp; Ref° <?php echo $VizualizarReciboReferente;?></p>
            </div><!-- descricao -->
            <div id="data">
            	<p>Santa Maria, <?php echo $dia;?> de <?php echo $NomeMes;?> de <?php echo $ano;?></p>
            </div><!-- data -->
            <div id="assinatura">
            	<p>_______________________________________<br /><br />
Bruno E. Lorenzen Pippi<br />CPF 303.110.630.04</p>
            </div><!-- assinatura -->
            <div id="rodape">
            	Rua Deus Lhe Pague, 12. Sala 02, Bairro KM3 Santa Maria-RS - Fone:(55) 9626-5008
            </div><!-- rodape -->
    </div><!-- recibo -->
</body>
</html>