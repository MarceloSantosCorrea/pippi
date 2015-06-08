<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include_once('conexao.php');?>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Bruno Pippi - Assessoria Contábil</title>
<style type="text/css">
body{background:#f4f4f4;}
.ok{ font:18px "Trebuchet MS", Arial, Helvetica, sans-serif; color:#666; border:1px solid :#0F0; background:#DDFFDD; float:left; margin:5px; text-align:center;}
#info form{width:310px; height:135px; float:left; margin:0;}
#info label{display:block; float:left; width:380px; margin:10px;}
#info input{float:left; color:#333;}
#info span{width:150px; float:left; display:block; font:14px "Trebuchet MS", Arial, Helvetica, sans-serif; color:#333;}
#info .btn{width:130px; float:left; margin:33px 5px 0 178px; display:inline;}



</style>
</head>
<link href="style/default.css" rel="stylesheet" type="text/css"/>
<link href="style/jquery.click-calendario-1.0.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="Scripts/jquery.js"></script>
<script type="text/javascript" src="Scripts/jquery.click-calendario-1.0-min.js"></script>
<script type="text/javascript" src="Scripts/jquery.click-calendario-1.0.js"></script>		
<script type="text/javascript" src="Scripts/exemplo-calendario.js"></script>
<script type="text/javascript" src="Scripts/mascara_dinheiro.js"></script>



<body>

 <div id="info">
<?php 
$pagamentoId = $_GET['pagamento'];
$clienteId = $_GET['cliente'];
$SelectPagamento = mysql_query ("SELECT * FROM pagamento WHERE id = '$pagamentoId';") or die (mysql_error());
while($ResPagamento = mysql_fetch_array($SelectPagamento)){
			$IdPagamento = $ResPagamento['id'];
			$DataPagamento = $ResPagamento['data_pagamento'];
			$MesRefente = $ResPagamento['referente_mes'];
			$AnoReferente = $ResPagamento['referente_ano'];
			$Valor = $ResPagamento['valor'];
			$IdCliente = $ResPagamento['id_cliente'];  
}
?>
 	<form name="informacao" method="post" enctype="multipart/form-data" action="">
   
        <label>
                	<span>Data de Pagamento:</span>
                    <input type="text" name="dat_pagamento" id="data_3" style="width:120px;" value="<?php echo date('d/m/Y', strtotime($DataPagamento))?>" />
                </label>
                <label style="width:220px;">
                	<span>Referente:</span>
                    <select name="mes" style="width:70px;">
                    	<option value="<?php echo $MesRefente;?>"><?php
                        switch($MesRefente) {
case"01": $mesNome = "Janeiro"; break;
case"02": $mesNome = "Fevereiro"; break;
case"03": $mesNome = "Março"; break;
case"04": $mesNome = "Abril"; break;
case"05": $mesNome = "Maio"; break;
case"06": $mesNome = "Junho"; break;
case"07": $mesNome = "Julho"; break;
case"08": $mesNome = "Agosto"; break;
case"09": $mesNome = "Setembro"; break;
case"10": $mesNome = "Outubro"; break;
case"11": $mesNome = "Novembro"; break;
case"12": $mesNome = "Dezembro"; break;

}
echo $mesNome;
						?></option>
<?php
$SelectMes = mysql_query ("SELECT * FROM meses") or die (mysql_error());
while($ResMes = mysql_fetch_array($SelectMes)){
	$mesNome = $ResMes['mes_nome'];
	$mesValor = $ResMes['mes_valor'];
?>                          
                            <option value="<?php echo $mesValor;?>"><?php echo $mesNome;?></option>
<?php
}
?>
	               </select>
				</label>
                <label style="width:50px; background:#00FF00;">
				<select name="ano" style="width:60px;">
                	<option value="<? echo $AnoReferente;?>"><? echo $AnoReferente;?></option>
                
<?php
$SelectAno = mysql_query ("SELECT * FROM anos WHERE ano >= '2010'") or die (mysql_error());
while($ResAno = mysql_fetch_array($SelectAno)){
	$Ano = $ResAno['ano'];
?>                
                	<option value="<?php echo $Ano;?>"><?php echo $Ano;?></option>
<?php
}
?> 
                  
                </select>
                </label>
                
                
                <label>
                	<span>Valor: R$</span>
                    <input type="text" name="valor" id="valor" value="<?php echo number_format($Valor, 2, ',', '.'); // retorna R$100.000,50 ?>" style="width:80px;" onKeyPress="return(currencyFormat(this,'','.',event))"/>
                    
                </label>
                
                <input type="submit" name="pagamento" value="Salvar Pagamento" class="btn" />    	
    </form>
<?php if(isset($_POST['pagamento'])){
$NovaData = $_POST['dat_pagamento'];
$NovaHora = date('H:i:s');
$NovaDataTimestamp = substr($NovaData,6,4).'-'.substr($NovaData,3,2).'-'.substr($NovaData,0,2).' '.$NovaHora;
$NovoMes = $_POST['mes'];
$NovoAno = $_POST['ano'];
$NovoValor = $_POST['valor'];
if($NovaData == ''){
	echo'<script type="text/javascript">
	alert("Infome a Nova Data.");
	</script>';
	}elseif($NovoValor == ''){
		echo'<script type="text/javascript">
	alert("Infome o Novo Valor.");
	</script>';
	}else{
$AlterarPagamento = mysql_query ("UPDATE pagamento SET
											data_pagamento = '$NovaDataTimestamp',
											referente_mes = '$NovoMes',
											referente_ano = '$NovoAno',
											valor = '$NovoValor'
											WHERE id = '$IdPagamento'
											") or die (mysql_error());
	echo'
	<script type="text/JavaScript">
    function Refresh() {
    window.opener.location.href = "painel.php?exe=home/honorarios&cliente='.$clienteId.'";}
    function close_window() {
    Refresh();
    window.close();}
    </script>
	<script type="text/javascript">
	alert("Pagamento Alterado com sucesso.");
	close_window();
	</script>	
	';
	}
}
?>

 </div><!-- info -->
</body>
</html>