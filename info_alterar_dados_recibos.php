<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include_once('conexao.php');?>
<link href="style/default.css" rel="stylesheet" type="text/css"/>
<link href="style/jquery.click-calendario-1.0.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="Scripts/jquery.js"></script>
<script type="text/javascript" src="Scripts/jquery.click-calendario-1.0-min.js"></script>
<script type="text/javascript" src="Scripts/jquery.click-calendario-1.0.js"></script>		
<script type="text/javascript" src="Scripts/exemplo-calendario.js"></script>
<script type="text/javascript" src="Scripts/mascara_dinheiro.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Bruno Pippi - Assessoria Contábil</title>
<style type="text/css">
body{background:#f4f4f4;}
.ok{ font:18px "Trebuchet MS", Arial, Helvetica, sans-serif; color:#666; border:1px solid :#0F0; background:#DDFFDD; float:left; margin:5px; text-align:center;}
#info {float:left; margin:0; padding:0;width:505px;}
#info form{ float:left; width:505px;}
#info fieldset{width:555px; float:left; border:1px solid #666; margin:15px;}
#info legend{color:#069; padding:5px; margin:0 5px;}
#info label{display:block; float:left; width:430px; margin:12px 0 0 80px;}
#info textarea{width:300px; float:left; color:#333;}
#info input{width:300px; float:left; color:#333;}
#info span{width:100px; float:left; display:block;}
#info .btn{width:80px; float:right; margin:30px 5px 10px 0; padding:3px;}
#info .btn2{width:80px; float:right; margin:30px 75px 10px 0; padding:3px;}



</style>
</head>
<body>
	<div id="info">
<?php 
$recibo = $_GET['recibo'];
$ListagemRecibo = mysql_query ("SELECT * FROM recibo WHERE reciboId = '$recibo'") or die (mysql_error());
while($resListagemRecibo = mysql_fetch_array($ListagemRecibo)){
		$ReciboId = $resListagemRecibo['reciboId'];
		$ReciboCliente = $resListagemRecibo['reciboCliente'];
		$ReciboData = $resListagemRecibo['reciboData'];
		$ReciboValor = $resListagemRecibo['reciboValor'];
		$ReciboReferente = $resListagemRecibo['reciboReferente'];	
}
?>
    	<form name="editRecibo" action="" method="post" enctype="multipart/form-data">
        	<fieldset>
            	<legend>Alteração de Dados do Recibo</legend>
                	<label>
                    	<span>Cliente:</span>
                        	<input type="hidden" name="reciboId" id="reciboId" value="<?php echo $ReciboId;?>" />
                        	<input type="text" name="cliente" id="cliente" value="<?php echo $ReciboCliente;?>"  disabled="disabled"/>
                    </label>
                    <label>
                    	<span>Data:</span>
                        	<input type="text" name="data" id="data_1" value="<?php echo date('d/m/Y', strtotime($ReciboData));?>" />
                    </label>
                    <label>
                    	<span>Valor:</span>
                        	<input type="text" name="valor" id="valor" value="<?php echo number_format($ReciboValor, 2, ',', '.'); // retorna R$100.000,50 ?>" onKeyPress="return(currencyFormat(this,'','.',event))" />
                    </label>
                    <label>
                    	<span>Referente:</span>
                        	<textarea name="referente" id="referente"><?php echo $ReciboReferente;?></textarea>
                    </label>
                            <input type="button" name="close" id="close" onclick="close_window();" value="Sair" class="btn2" />
                    		<input type="submit" name="updateRecibo" id="updateRecibo" value="Alterar" class="btn" />
                            
            </fieldset>
        </form>
    
    </div><!-- info -->
<?php
if(isset($_POST['updateRecibo'])){
$id = $_POST['reciboId'];
$data = $_POST['data'];
$DataTimestamp = substr($data,6,4).'-'.substr($data,3,2).'-'.substr($data,0,2).' '.date('H:i:s');
$DataTimestampFiltro = substr($data,6,4).'-'.substr($data,3,2).'-'.substr($data,0,2);
$valor = $_POST['valor'];
$referente = $_POST['referente'];
$updateRecibo = mysql_query ("UPDATE recibo SET reciboData = '$DataTimestamp', 
													 reciboValor = '$valor',
													 reciboReferente = '$referente',
													 reciboDataFiltro = '$DataTimestampFiltro'
													 WHERE reciboId = '$id'") or die (mysql_error());
if($updateRecibo<='0'){
	echo'erro ao Atualizar od dados do recibo';
	}else{
		echo'<script type="text/javascript">
		alert("Os Dados foram Alterado com Sucesso.");
		window.opener.location.href = "painel.php?exe=home/listar_recibos&recibo='.$ReciboId.'";
		window.close();
		</script>';
		}
}
?>
   
   
<script type="text/JavaScript">

function Refresh() {
window.opener.location.href = "painel.php?exe=home/listar_recibos&recibo=<?php echo $ReciboId;?>";

}
function close_window() {
Refresh();
window.close();
}

</script> 

</body>
</html>